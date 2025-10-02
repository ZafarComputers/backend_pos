<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController as AuthController;

// use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

use App\Http\Controllers\Api\CountryApiController;
use App\Http\Controllers\Api\StateController;
use App\Http\Controllers\Api\CityController;

use App\Http\Controllers\Api\CustomerApiController;

use App\Http\Controllers\Api\EmployeeApiController;

use App\Http\Controllers\Api\VendorController;

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SubCategoryController;
use App\Http\Controllers\Api\SizeController;
use App\Http\Controllers\Api\ColorController;
use App\Http\Controllers\Api\SeasonController;
use App\Http\Controllers\Api\MaterialController;
// use App\Http\Controllers\ProductController;
use App\Http\Controllers\Api\ProductController as ProductApiController;

use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchaseReturnController;
use App\Http\Controllers\PurchaseReturnDetailController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\PosDetailController;
use App\Http\Controllers\PosReturnController;

use App\Http\Controllers\Api\PosReturnDetailApiController;
// use App\Http\Controllers\Api\POS_Return_DetailController;
use App\Http\Controllers\Api\CoaMainApiController;
use App\Http\Controllers\Api\CoaSubApiController;

use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\ProfileController;



// Test Routes

// **** End Test Routes



// Old Reoute for Profile
// Route::middleware('auth:sanctum')->get('/profile', function (Request $request) {
//     return $request->user();
// });
Route::middleware('auth:sanctum')->group(function () {
    // User CRUD
    // Route::apiResource('users', UserApiController::class);
    Route::apiResource('users', UserApiController::class)->names([
        'index' => 'api.users.index',
        'store' => 'api.users.store',
        'show' => 'api.users.show',
        'update' => 'api.users.update',
        'destroy' => 'api.users.destroy',
    ]);


    // Profile CRUD
    Route::apiResource('profiles', ProfileController::class);
});




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| These routes are loaded by the RouteServiceProvider within a group
| assigned the "api" middleware group. They will all be prefixed with /api.
|
*/

// Example: check API health
Route::get('/ping', function () {
    return response()->json(['message' => 'API is working!']);
});

// Auth routes

// Public routes

Route::post('/register', [AuthController::class, 'register']);
// Route::post('register', [AuthApiController::class, 'register']);


// Login Routes
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('profile', [AuthController::class, 'profile']);
});



// Route::get('/profile', [AuthController::class, 'profile']);
// Route::middleware('auth:sanctum')->get('/profile', [UserController::class, 'profile']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // // User CRUD
    // Route::get('/users', [UserApiController::class, 'index']);
    // Route::post('/users', [UserApiController::class, 'store']);
    // Route::get('/users/{user}', [UserApiController::class, 'show']);
    // Route::put('/users/{user}', [UserApiController::class, 'update']);
    // Route::delete('/users/{user}', [UserApiController::class, 'destroy']);
});


// Role routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/roles', [RoleController::class, 'index']);
    Route::post('/roles', [RoleController::class, 'store']);
    Route::get('/roles/{role}', [RoleController::class, 'show']);
    Route::put('/roles/{role}', [RoleController::class, 'update']);
    Route::delete('/roles/{role}', [RoleController::class, 'destroy']);

        // Variant Routes
        Route::apiResource('sizes', SizeController::class);
        Route::apiResource('colors', ColorController::class);
        Route::apiResource('seasons', SeasonController::class);
        Route::apiResource('materials', MaterialController::class);

        // Vendor's Route
        Route::apiResource('vendors', VendorController::class);
        
        // Categories n Sub-Categories
        Route::apiResource('categories', CategoryController::class);
        Route::apiResource('subcategories', SubCategoryController::class);
        
        // Low stock route
        Route::get('products/low-stock', [ProductApiController::class, 'lowStock']);

        // Prodcut Api Route
        Route::apiResource('products', ProductApiController::class);



    // });

// // User routes
// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('/users', [UserController::class, 'index']);
//     Route::post('/users', [UserController::class, 'store']);
//     Route::get('/users/{user}', [UserController::class, 'show']);
//     Route::put('/users/{user}', [UserController::class, 'update']);
//     Route::delete('/users/{user}', [UserController::class, 'destroy']);
// });



// Routes OK
    Route::apiResource('countries', CountryApiController::class);
    Route::apiResource('states', StateController::class);
    Route::apiResource('cities', CityController::class);
    
    Route::apiResource('customers', CustomerApiController::class);
    Route::apiResource('employees', EmployeeApiController::class);

    
    // Route::apiResource('vendors', VendorController::class);
    // Route::middleware('auth:sanctum')->group(function () {

    });
    

    // Route::get('products', [ProductController::class, 'apiIndex']);
    // Route::post('products', [ProductController::class, 'store']);

    Route::get('purchases', [PurchaseController::class, 'apiIndex']);
    Route::post('purchases', [PurchaseController::class, 'store']);

    Route::get('purchase_returns', [PurchaseReturnController::class, 'apiIndex']);
    Route::post('purchase_returns', [PurchaseReturnController::class, 'store']);
    Route::get('purchase_return_details', [PurchaseReturnDetailController::class, 'apiIndex']);
    Route::post('purchase_return_details', [PurchaseReturnDetailController::class, 'store']);

    // Route::get('pos', [PosController::class, 'apiIndex']);
    // Route::post('pos', [PosController::class, 'store']);

    // use App\Http\Controllers\PosController;

    // All CRUD API routes for POS
    Route::prefix('pos')->group(function () {
        Route::get('/', [PosController::class, 'apiIndex']);     // List all invoices
        Route::post('/', [PosController::class, 'store']);       // Create new invoice
        Route::get('/{id}', [PosController::class, 'show']);     // Show single invoice
        Route::put('/{id}', [PosController::class, 'update']);   // Update invoice
        Route::delete('/{id}', [PosController::class, 'destroy']); // Delete invoice
    });

    Route::prefix('pos_details')->group(function () {
        Route::get('/', [PosDetailController::class, 'apiIndex']);
        Route::post('/', [PosDetailController::class, 'store']);
        Route::get('/{id}', [PosDetailController::class, 'show']);
        Route::put('/{id}', [PosDetailController::class, 'update']);
        Route::delete('/{id}', [PosDetailController::class, 'destroy']);
    });

    Route::prefix('pos_returns')->group(function () {
        Route::get('/', [PosReturnController::class, 'apiIndex']);
        Route::post('/', [PosReturnController::class, 'store']);
        Route::get('/{id}', [PosReturnController::class, 'show']);
        Route::put('/{id}', [PosReturnController::class, 'update']);
        Route::delete('/{id}', [PosReturnController::class, 'destroy']);
    });

    Route::apiResource('pos_return_details', PosReturnDetailApiController::class);
    // Route::apiResource('pos-return-details', POS_Return_DetailController::class);

    Route::apiResource('coa-mains', CoaMainApiController::class);
    Route::apiResource('coa-subs', CoaSubApiController::class);
