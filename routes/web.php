<?php
use App\Http\Controllers\TenantsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\MiscController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\AdminController;
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


// Reports
Route::get('/reports/monthly', [ReportsController::class, 'monthly'])->name('reports.monthly');
Route::get('/reports/date', [ReportsController::class, 'date'])->name('reports.date');

// Payments
Route::get('/admin/payments', [AdminController::class, 'payments'])->name('admin.payments');
Route::get('/admin/payments/date-result', [AdminController::class, 'paymentsResult'])->name('admin.paymentsResult');

// Expenses
Route::get('/admin/expenses', [AdminController::class, 'expensesLanding'])->name('admin.expensesLanding');
Route::get('/admin/expenses/date-result', [AdminController::class, 'expensesResult'])->name('admin.expensesResult');

// Water Misc
Route::get('/admin/misc/water', [AdminController::class, 'waterMiscLanding'])->name('admin.waterMiscLanding');
Route::get('/admin/misc/date-result-water', [AdminController::class, 'waterMiscResult'])->name('admin.waterMiscResult');

// Elec Misc
Route::get('/admin/misc/elec', [AdminController::class, 'elecMiscLanding'])->name('admin.elecMiscLanding');
Route::get('/admin/misc/date-result-elect', [AdminController::class, 'elecMiscResult'])->name('admin.elecMiscResult');



Route::get('/', function () {

    if ((Auth::user())) {
        
        if(Auth::user()->level == 'admin'){
            $currentMonth = date('m'); // Get the current month (e.g., '09' for September)
            $currentYear = date('Y');   // Get the current year (e.g., '2023')
            
            $users = User::count();
            $tenants = Tenants::orderBy('full_name','asc')->get();
            
            $totalExpenses = Expenses::whereMonth('date', $currentMonth)
            ->whereYear('date', $currentYear)
            ->sum('amount');

            $sumPayments = DB::table('payments')
                            ->whereDate('created_at', now()->toDateString())->where('option','Payment')
                            ->sum('amount');
    
            return view ('dashboard',compact('users','tenants','sumPayments', 'totalExpenses'));

        }elseif (Auth::user()->level == 'encoder' || Auth::user()->level == 'admin'){

            $tenants = Tenants::all();
            $payments = Payments::whereDate('created_at', '=', now()->toDateString())->get();
            $paidToday = Payments::orderBy('created_at','desc')->whereDate('created_at', '=', now()->toDateString())->limit(5)->get();
            $expenses = Expenses::orderBy('created_at','desc')->whereDate('created_at', '=', now()->toDateString())->limit(5)->get();
            $miscWater = Misc::where('misc','water')->orderBy('created_at','desc')->limit(5)->get();
            $miscElec = Misc::where('misc','electricity')->orderBy('created_at','desc')->limit(5)->get();
            $tenantsWithWaterUtility = Tenants::where('utility', 'LIKE', '%water%')->get();
            $tenantsWithElecUtility = Tenants::where('utility', 'LIKE', '%electricity%')->get();


            $unpaidTenants = $tenants->reject(function ($tenant) use ($payments) {
                return $payments->contains('tenant_id', $tenant->id);
            });

            return view ('encoder.dashboard', compact('unpaidTenants','paidToday','expenses','miscWater','miscElec','tenantsWithWaterUtility','tenantsWithElecUtility'));
        }else{
            return view ('viewer.dashboard');
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