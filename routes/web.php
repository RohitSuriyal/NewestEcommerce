<?php

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
