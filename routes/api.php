<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillingAddressController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PromoCodeController;
use App\Http\Controllers\ShippingInformationController;
use App\Http\Controllers\SizeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthUser;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post("/register", [AuthController::class, 'register']);
Route::post("/login", [AuthController::class, 'login']);

Route::prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::post('/', [CategoryController::class, 'store']);
    Route::get('/{category}', [CategoryController::class, 'show']);
    Route::put('/{category}', [CategoryController::class, 'update']);
    Route::delete('/{category}', [CategoryController::class, 'destroy']);
});

Route::prefix('promoCode')->group(function () {
    Route::get('/', [PromoCodeController::class, 'index']);
    Route::post('/', [PromoCodeController::class, 'store']);
    Route::put('/{id}', [PromoCodeController::class, 'update']);
    Route::delete('/{id}', [PromoCodeController::class, 'destroy']);
});

Route::prefix('product')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::post('/', [ProductController::class, 'store']);
    Route::get('/{product}', [ProductController::class, 'show']);
    Route::put('/{product}', [ProductController::class, 'update']);
    Route::delete('/{product}', [ProductController::class, 'destroy']);
    Route::get('/test/{id}', [ProductController::class, 'test']);
    Route::get('/category/{category}', [ProductController::class, 'category']);
    Route::get('/promotion/{categoriId}', [ProductController::class, 'promotion']);
});

Route::prefix('image')->group(function () {
    Route::post('/', [ImageController::class, 'store']);
});

Route::prefix('size')->group(function () {
    Route::get('/', [SizeController::class, 'index']);
});

Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::get("/logout", [AuthController::class, 'logout']);
});


Route::group(['middleware' => ['auth:sanctum', AuthUser::class]], function() {
    Route::prefix('shippingInformation')->group(function () {
        Route::get('/', [ShippingInformationController::class, 'index']);
        Route::post('/', [ShippingInformationController::class, 'store']);
        Route::put('/', [ShippingInformationController::class, 'update']);
        Route::delete('/', [ShippingInformationController::class, 'destroy']);
    });

    Route::prefix('paymentMethod')->group(function () {
        Route::get('/', [PaymentMethodController::class, 'index']);
        Route::post('/', [PaymentMethodController::class, 'store']);
        Route::put('/', [PaymentMethodController::class, 'update']);
        Route::delete('/', [PaymentMethodController::class, 'destroy']);
    });

    Route::prefix('billingAddress')->group(function () {
        Route::get('/', [BillingAddressController::class, 'index']);
        Route::post('/', [BillingAddressController::class, 'store']);
        Route::put('/', [BillingAddressController::class, 'update']);
        Route::delete('/', [BillingAddressController::class, 'destroy']);
    });

    Route::prefix('item')->group(function () {
        Route::get('/', [ItemController::class, 'index']);
        Route::post('/', [ItemController::class, 'store']);
        Route::get('/{id}', [ItemController::class, 'show']);
        // Route::put('/', [BillingAddressController::class, 'update']);
        // Route::delete('/', [BillingAddressController::class, 'destroy']);
    });

    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index']);
        // Route::post('/', [CartController::class, 'store']);
        // Route::get('/{id}', [CartController::class, 'show']);
        // Route::put('/', [BillingAddressController::class, 'update']);
        // Route::delete('/', [BillingAddressController::class, 'destroy']);
    });

    Route::get("/user", [AuthController::class, 'user']);
});


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
