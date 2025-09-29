<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

use App\Http\Controllers\Api\CountryController;
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
use App\Http\Controllers\ProductController;

use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchaseReturnController;
use App\Http\Controllers\PurchaseReturnDetailController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\PosDetailController;
use App\Http\Controllers\PosReturnController;

use App\Http\Controllers\Api\PosReturnDetailApiController;
// use App\Http\Controllers\Api\POS_Return_DetailController;





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
// Route::post('/register', [AuthController::class, 'register']);
// Route::post('/login', [AuthController::class, 'login']);
// Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

Route::get('/register', [RegisteredUserController::class, 'create'])
        ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store']);

// Role routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/roles', [RoleController::class, 'index']);
    Route::post('/roles', [RoleController::class, 'store']);
    Route::get('/roles/{role}', [RoleController::class, 'show']);
    Route::put('/roles/{role}', [RoleController::class, 'update']);
    Route::delete('/roles/{role}', [RoleController::class, 'destroy']);
});

// User routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{user}', [UserController::class, 'show']);
    Route::put('/users/{user}', [UserController::class, 'update']);
    Route::delete('/users/{user}', [UserController::class, 'destroy']);
});



// Routes OK
    Route::apiResource('countries', CountryController::class);
    Route::apiResource('states', StateController::class);
    Route::apiResource('cities', CityController::class);
    
    Route::apiResource('customers', CustomerApiController::class);
    Route::apiResource('employees', EmployeeApiController::class);
    Route::apiResource('vendors', VendorController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('subcategories', SubCategoryController::class);
    Route::apiResource('sizes', SizeController::class);
    Route::apiResource('colors', ColorController::class);
    Route::apiResource('seasons', SeasonController::class);
    Route::apiResource('materials', MaterialController::class);

    Route::get('products', [ProductController::class, 'apiIndex']);
    Route::post('products', [ProductController::class, 'store']);

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
