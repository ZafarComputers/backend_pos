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
use App\Http\Controllers\Api\CityApiController;

use App\Http\Controllers\Api\CustomerApiController;

use App\Http\Controllers\Api\EmployeeApiController;

use App\Http\Controllers\Api\VendorController;

use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\SubCategoryApiController;
use App\Http\Controllers\Api\SizeController;
use App\Http\Controllers\Api\ColorController;
use App\Http\Controllers\Api\SeasonController;
use App\Http\Controllers\Api\MaterialController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductController as ProductApiController;

use App\Http\Controllers\Api\PurchaseApiController;
use App\Http\Controllers\Api\PurchaseDetailApiController;

use App\Http\Controllers\Api\PurchaseReturnApiController;
use App\Http\Controllers\Api\PurchaseReturnDetailApiController;

use App\Http\Controllers\Api\PosApiController;
use App\Http\Controllers\PosDetailController;
use App\Http\Controllers\Api\PosReturnApiController;

use App\Http\Controllers\Api\PosReturnDetailApiController;
use App\Http\Controllers\Api\PosCartController;
use App\Http\Controllers\Api\CoaMainApiController;
use App\Http\Controllers\Api\CoaSubApiController;
use App\Http\Controllers\Api\CoaApiController;

use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\ProfileController;

// Reprot Controller
use App\Http\Controllers\Api\SalesRepApiController;



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


// User Register 
Route::post('/register', [AuthController::class, 'register']);

// Login Routes
Route::post('login', [AuthController::class, 'login']);


// After Login All Routes Protected 
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('profile', [AuthController::class, 'profile']);
    Route::post('refresh-token', [AuthController::class, 'refreshToken']);
    Route::put('update-profile', [AuthController::class, 'updateProfile']);
    Route::post('change-password', [AuthController::class, 'changePassword']);
    
    // Role-based user retrieval
    Route::get('users-by-role/{roleName}', [AuthController::class, 'getUsersByRole'])
        ->middleware('role:admin,manager');
});


// User Routes
Route::middleware('auth:sanctum')->group(function () {
    
    // Roles
    Route::get('/roles', [RoleController::class, 'index']);
    Route::post('/roles', [RoleController::class, 'store']);
    Route::get('/roles/{role}', [RoleController::class, 'show']);
    Route::put('/roles/{role}', [RoleController::class, 'update']);
    Route::delete('/roles/{role}', [RoleController::class, 'destroy']);

    // User CRUD
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

// Inventory's Routes
Route::middleware('auth:sanctum')->group(function () {
        
    // Variant Routes
    Route::apiResource('sizes', SizeController::class);
    Route::apiResource('colors', ColorController::class);
    Route::apiResource('seasons', SeasonController::class);
    Route::apiResource('materials', MaterialController::class);

    // Vendor's Route
    Route::apiResource('vendors', VendorController::class);
    
    // Categories n Sub-Categories
    Route::apiResource('categories', CategoryApiController::class);
    Route::apiResource('subcategories', SubCategoryApiController::class);
    
    // Prodcut Api Route
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('products.index');
        Route::post('/', [ProductController::class, 'store'])->name('products.store');
        Route::get('/low-stock', [ProductController::class, 'lowStock'])->name('products.low-stock');
        Route::get('/{product}', [ProductController::class, 'show'])->name('products.show');
        Route::put('/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    });

});
// End Inventory's Routes

   

// Country's Routes
Route::middleware('auth:sanctum')->group(function () {
            
    Route::apiResource('countries', CountryApiController::class);
    Route::apiResource('states', StateController::class);
    Route::apiResource('cities', CityApiController::class);
});
// End Country's Routes

   

// General Setting's Routes
Route::middleware('auth:sanctum')->group(function () {
    // Customer's Routes
    Route::apiResource('customers', CustomerApiController::class);
   
    // Employee's Routes
    Route::apiResource('employees', EmployeeApiController::class);

});
// End General Setting's Routes
   

// Purchase's Routes
Route::middleware('auth:sanctum')->group(function () {
    // Routes for Purchases and It's Deatil / Purchase Return and it's Detail
    Route::apiResource('purchases', PurchaseApiController::class);
    Route::apiResource('purchase-details', PurchaseDetailApiController::class);
    Route::apiResource('purchase-returns', PurchaseReturnApiController::class);
    Route::apiResource('purchase-return-details', PurchaseReturnDetailApiController::class);
});
// End Purchase's Routes


// POS & POS-Detail Routes
Route::prefix('pos')->group(function () {
    // PoS Routes
    Route::get('/', [PosApiController::class, 'index']);     // List all invoices
    Route::post('/', [PosApiController::class, 'store']);       // Create new invoice
    Route::get('/{id}', [PosApiController::class, 'show']);     // Show single invoice
    Route::put('/{id}', [PosApiController::class, 'update']);   // Update invoice
    Route::delete('/{id}', [PosApiController::class, 'destroy']); // Delete invoice

    // POS-Cart Routes (Not Finalize)
    Route::prefix('pos')->group(function () {
        // Show all products or by category
        // Route::get('/products', [PosApiController::class, 'products'])->name('pos.products');

        // Cart (selected products in POS)
        // Route::get('/cart', [PosApiController::class, 'cart'])->name('pos.cart');
        // Route::post('/cart/add', [PosApiController::class, 'addToCart'])->name('pos.cart.add');
        // Route::post('/cart/update/{productId}', [PosApiController::class, 'updateCart'])->name('pos.cart.update');
        // Route::delete('/cart/remove/{productId}', [PosApiController::class, 'removeFromCart'])->name('pos.cart.remove');
    });


    // POS-Detail Routes
    Route::get('/', [PosDetailController::class, 'apiIndex']);
    Route::post('/', [PosDetailController::class, 'store']);
    Route::get('/{id}', [PosDetailController::class, 'show']);
    Route::put('/{id}', [PosDetailController::class, 'update']);
    Route::delete('/{id}', [PosDetailController::class, 'destroy']);

    // POS-Return's Routes
    Route::get('/', [PosReturnApiController::class, 'apiIndex']);
    Route::post('/', [PosReturnApiController::class, 'store']);
    Route::get('/{id}', [PosReturnApiController::class, 'show']);
    Route::put('/{id}', [PosReturnApiController::class, 'update']);
    Route::delete('/{id}', [PosReturnApiController::class, 'destroy']);
    
    // POS-Return-Detail Routes
    Route::apiResource('pos_return_details', PosReturnDetailApiController::class);
});

// POS Cart Management Routes
Route::middleware('auth:sanctum')->prefix('pos-cart')->group(function () {
    Route::get('/', [PosCartController::class, 'getCart']);
    Route::post('/add', [PosCartController::class, 'addToCart']);
    Route::put('/{productId}', [PosCartController::class, 'updateCartItem']);
    Route::delete('/{productId}', [PosCartController::class, 'removeFromCart']);
    Route::delete('/', [PosCartController::class, 'clearCart']);
    Route::post('/discount', [PosCartController::class, 'applyDiscount']);
});
// End POS & POS-Detail Routes



// Account's Routes
Route::middleware('auth:sanctum')->group(function () {
    // Account Routes (Coas, coa-Subs, coa_mains)
    Route::apiResource('coa-mains', CoaMainApiController::class);
    Route::apiResource('coa_subs', CoaSubApiController::class);
    Route::apiResource('coas', CoaApiController::class);
});
// End Account's Routes
   

// Report's Routes
Route::middleware('auth:sanctum')->group(function () {
    // Sale Report's Routes
    Route::get('/salesRep', [SalesRepApiController::class, 'getSalesReport']);
    Route::get('/reports/best-selling-products', [SalesRepApiController::class, 'bestSellingProducts']);
    
    // Inventory's Reports
    Route::get('/InvtoryReport', [SalesRepApiController::class, 'getInventory']);
    Route::get('/InvtoryInHistory', [SalesRepApiController::class, 'getInventoryHistory']);
    Route::get('/InventorySold', [SalesRepApiController::class, 'getInventorySold']);
    
    
    Route::get('/purReport', [SalesRepApiController::class, 'getPurReport']);

    // Vendor's Reports
    // Route::get('/vendorPurchasesReport', [SalesRepApiController::class, 'getVendorPurchases']);
    Route::get('/vendorReport', [SalesRepApiController::class, 'getVendorPurchases']);
    Route::get('/vendorDuesReport', [SalesRepApiController::class, 'getVendorDues']);

    

});
// End Report's Routes
   




// Public routes
