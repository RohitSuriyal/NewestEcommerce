<?php

use App\Http\Controllers\admin\product;
use App\Http\Controllers\frontend\LoginController;
use App\Http\Controllers\frontend\ProductController;
use App\Models\admin\product as AdminProduct;
use App\Models\Banner;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

Route::prefix('website')->name('website.')->group(function () {


    Route::get("/website", function () {

        $banners = Banner::all();
        $products = AdminProduct::all();
        return view('frontend.home', compact('banners', 'products'));

    })->name('home');

    Route::get("/allproducts/{id}", [ProductController::class, "allproduct"])->name(name: 'allproduct');
    Route::get("/singleproduct/{id}", action: [ProductController::class, "singleproduct"])->name('singleproduct');

    Route::middleware(['customerauth'])->group(function () 
    {
        Route::get("/buynowlogin/{id}", [ProductController::class, "buynowlogin"])->name('buynowlogin');
    });

    Route::get("/customerloginview",[LoginController::class,"customerloginview"])->name("customerloginview");
    Route::post("/emialverify", [ProductController::class, "emialverify"])->name('emialverify');

    Route::post("/customerlogin",[LoginController::class,"customerlogin"])->name('customerlogin');

    Route::post("/saveuseraddress", [ProductController::class, "saveuseraddress"])->name('saveuseraddress');
});
