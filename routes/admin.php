<?php

use App\Http\Controllers\Admin\Adminview;
use App\Http\Controllers\Admin\Authenticate as AdminAuthenticate;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\Product as AdminProduct;
use App\Http\Controllers\Admin\ProductBrand;
use App\Http\Controllers\admin\Productcategory as AdminProductcategory;
use App\Http\Controllers\admin\ProductCategoryController;
use App\Models\Admin\ProductCategory;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->name('admin.')->group(function () {

    Route::post('/register', [AdminAuthenticate::class, 'register'])->name('register');

    Route::post("/login", [AdminAuthenticate::class, "login"])->name('login');
});

Route::prefix('admin')->middleware(['adminauth'])->name('admin.')->group(function () {

    Route::get("/",function(){

    });

    Route::get("/admindashboard", [Adminview::class, "index"])->name("dashboard");

    Route::resource('productbrand', ProductBrand::class);
    Route::post("searchbrand", [ProductBrand::class, "searchbrand"])->name("searchbrand");

    //this is for the productacategory
    Route::resource("productcategory", ProductCategoryController::class);
    Route::post("searchproductcategory", [ProductCategoryController::class, "searchproductcategory"])->name('searchproductcategory');


    Route::post("searchbanner", [BannerController::class, "searchbanner"])->name('searchbanner');

    Route::post("searchproducts", [AdminProduct::class, "searchproducts"])->name("searchproduct");

    Route::resource("product", AdminProduct::class);

    Route::resource("banner", BannerController::class);
});
