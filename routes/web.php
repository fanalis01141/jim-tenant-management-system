<?php
use App\Http\Controllers\TenantsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Tenants;



Auth::routes();


Route::resource('tenants', TenantsController::class);
Route::resource('user', UserController::class);



Route::get('/', function () {
    // dd(Auth::user());
    if ((Auth::user())) {

        $users = User::count();
        $tenants = Tenants::orderBy('full_name','asc')->get();

        return view ('dashboard',compact('users','tenants'));
    } else {
        return view ('auth.login');
    }
});


Route::post('/', function () {
    Auth::logout();    
    return Redirect::to('/');
})->name('logout');


?>