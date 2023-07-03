<?php
use App\Http\Controllers\TenantsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Redirect;


Auth::routes();


Route::resource('tenants', TenantsController::class);


Route::get('/', function () {
    // dd(Auth::user());
    if ((Auth::user())) {
        return view ('dashboard');
    } else {
        return view ('auth.login');
    }
});


Route::post('/', function () {
    Auth::logout();    
    return Redirect::to('/');
})->name('logout');


?>