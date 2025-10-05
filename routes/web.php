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
use App\Http\Controllers\PosReturnDetailController;
use App\Http\Controllers\CoaMainController;
use App\Http\Controllers\CoaSubController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;


// *************************** Temport Routes for Hosting
// Temporary Routes For Clear Cache etc
// Method 01
// Route::get('/clear-all', function () {
//     \Artisan::call('route:clear');
//     \Artisan::call('config:clear');
//     \Artisan::call('cache:clear');
//     \Artisan::call('view:clear');
//     return "All caches cleared!";
// });

// // Method 2
// use Illuminate\Support\Facades\Artisan;

// Route::get('/clear-cache/{key}', function ($key) {
//     // secret key check
//     if ($key !== 'MySecretKey123') {
//         abort(403, 'Unauthorized');
//     }

//     Artisan::call('optimize:clear');
//     return response()->json([
//         'status' => 'success',
//         'message' => 'Cache cleared successfully!',
//     ]);
// });
// // After it run the command 
// // https://zafarcomputers.com/clear-cache/MySecretKey123

// for route checking
Route::get('route-list', function () {
    Artisan::call('route:list --json');
    return response()->json(json_decode(Artisan::output(), true));
});
// https://zafarcomputers.com/route-list

// *********** End Temport Routes for Hosting



// My Working Routes
Route::get('/', function () {
    return view('welcome');
});

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [UserController::class, 'profile'])->name('profile');
// });


Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);


// Route::get('/dashboard', function () {
//     // dd('you are in dashboard');
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::get('/dashboard', function () {
    // dd('you are in dashboard');
    return view('dashboard');
})->name('dashboard');

Route::resource('roles', RoleController::class);
// Route::resource('users', UserController::class);

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

Route::resource('pos_return_details', PosReturnDetailController::class);
Route::resource('coa-mains', CoaMainController::class);
Route::resource('coa-subs', CoaSubController::class);



