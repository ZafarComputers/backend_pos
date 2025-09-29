<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchaseReturnController;
use App\Http\Controllers\PurchaseReturnDetailController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\PosDetailController;
use App\Http\Controllers\PosReturnController;









Route::get('/', function () {
    return view('welcome');
});


// Route::get('/dashboard', function () {
//     // dd('you are in dashboard');
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::get('/dashboard', function () {
    // dd('you are in dashboard');
    return view('dashboard');
})->name('dashboard');

Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);

Route::resource('countries', CountryController::class);
Route::resource('states', StateController::class);
Route::resource('cities', CityController::class);

Route::middleware(['web'])->group(function () {
    // Resource routes for web (index, create, store, edit, update, delete)
    Route::resource('customers', CustomerController::class);
});

Route::resource('employees', EmployeeController::class);

Route::resource('vendors', VendorController::class);

Route::resource('categories', CategoryController::class);
Route::resource('subcategories', SubCategoryController::class);

Route::resource('sizes', SizeController::class);
Route::resource('colors', ColorController::class);
Route::resource('seasons', SeasonController::class);
Route::resource('materials', MaterialController::class);
Route::resource('products', ProductController::class);

Route::resource('purchases', PurchaseController::class);
Route::resource('purchase_returns', PurchaseReturnController::class);
Route::resource('purchase_return_details', PurchaseReturnDetailController::class);
Route::resource('pos', PosController::class);
Route::resource('pos_details', PosDetailController::class);
Route::resource('pos_returns', PosReturnController::class);
