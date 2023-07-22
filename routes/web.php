<?php
use App\Http\Controllers\TenantsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\MiscController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Tenants;
use App\Models\Payments;
use App\Models\Expenses;
use App\Models\Misc;





Auth::routes();


Route::resource('tenants', TenantsController::class);
Route::resource('user', UserController::class);
Route::resource('payments', PaymentsController::class);
Route::resource('expenses', ExpensesController::class);
Route::resource('misc', MiscController::class);

Route::get('/', function () {

    if ((Auth::user())) {
        
        if(Auth::user()->level == 'admin'){

            $users = User::count();
            $tenants = Tenants::orderBy('full_name','asc')->get();
            $sumPayments = DB::table('payments')
                            ->whereDate('created_at', now()->toDateString())
                            ->sum('amount');
    
            return view ('dashboard',compact('users','tenants','sumPayments'));

        }elseif (Auth::user()->level == 'encoder' || Auth::user()->level == 'admin'){

            $tenants = Tenants::all();
            $payments = Payments::whereDate('created_at', '=', now()->toDateString())->get();
            $paidToday = Payments::orderBy('created_at','desc')->limit(5)->get();
            $expenses = Expenses::orderBy('created_at','desc')->limit(5)->get();
            $misc = Misc::orderBy('created_at','desc')->limit(5)->get();


            $unpaidTenants = $tenants->reject(function ($tenant) use ($payments) {
                return $payments->contains('tenant_id', $tenant->id);
            });

            return view ('encoder.dashboard', compact('unpaidTenants','paidToday','expenses','misc'));
        }

    } else {
        return view ('auth.login');
    }
});


Route::post('/', function () {
    Auth::logout();    
    return Redirect::to('/');
})->name('logout');


?>