<?php

use App\Http\Controllers\Admin\Adminview;
use App\Http\Controllers\Admin\Authenticate as AdminAuthenticate;
use App\Http\Controllers\admin\product;
use App\Http\Controllers\Admin\ProductBrand;
use App\Http\Controllers\admin\Productcategory as AdminProductcategory;
use App\Http\Controllers\admin\ProductCategoryController;
use App\Models\Admin\ProductCategory;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->name('admin.')->group(function () {
    Route::post('/register', [AdminAuthenticate::class, 'register'])->name('register');

    Route::post("/login", [AdminAuthenticate::class, "login"])->name('login');

    Route::get("/admindashboard", [Adminview::class, "index"])->name("dashboard");
    Route::resource('productcategory', ProductCategoryController::class);
    Route::resource('productbrand', ProductBrand::class);
    Route::post("searchbrand", [ProductBrand::class, "searchbrand"])->name("searchbrand");

    //this is for the productacategory
     Route::resource("productcategory", ProductCategoryController::class);
     Route::post("searchproductcategory",[ProductCategoryController::class,"searchproductcategory"])->name('searchproductcategory');

     Route::resource("product",product::class); 
});
