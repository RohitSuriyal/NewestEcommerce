<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
require __DIR__ . '/admin.php';
// Route::get('/', function () {
//     return view('Admin.register');    
// })->name('adminregisterview');

Route::get('/', function () {
    return view('Admin.login');    
})->name('adminregisterview');
Route::get("/adminlogin",function(){

    return view('Admin.login');
})->name("adminloginview");


Route::get('/logout',function(){

 
Auth::guard('admin')->logout();   // Logout from admin guard
    request()->session()->invalidate(); // Invalidate session
    request()->session()->regenerateToken();

    return redirect()->route('adminloginview');

})->name('adminlogout');
