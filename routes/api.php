<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillingAddressController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PromoCodeController;
use App\Http\Controllers\ShippingInformationController;
use App\Http\Controllers\ShippingMethodController;
use App\Http\Controllers\SizeController;
use App\Http\Middleware\AuthAdmin;
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
    Route::get('/products/{id}', [CategoryController::class, 'products']);
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/{category}', [CategoryController::class, 'show']);
});

Route::prefix('promoCode')->group(function () {
    Route::get('/', [PromoCodeController::class, 'index']);
    Route::post('/', [PromoCodeController::class, 'store']);
    Route::put('/{id}', [PromoCodeController::class, 'update']);
    Route::delete('/{id}', [PromoCodeController::class, 'destroy']);
});

Route::prefix('product')->group(function () {
    Route::get('/all', [ProductController::class, 'everything']);
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/{product}', [ProductController::class, 'show']);
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

Route::group(['middleware' => ['auth:sanctum', AuthAdmin::class]], function() {
    Route::prefix('category')->group(function () {
        Route::post('/', [CategoryController::class, 'store']);
        Route::put('/{category}', [CategoryController::class, 'update']);
        Route::delete('/{category}', [CategoryController::class, 'destroy']);
    });
    Route::prefix('product')->group(function () {
        Route::get('/demote/{id}', [ProductController::class, 'demote']);
        Route::get('/promote/{id}', [ProductController::class, 'promote']);
        Route::put('/{product}', [ProductController::class, 'update']);
        Route::post('/', [ProductController::class, 'store']);
        Route::delete('/{product}', [ProductController::class, 'destroy']);
    });
});

Route::group(['middleware' => ['auth:sanctum', AuthUser::class]], function() {
    Route::prefix('shippingInformation')->group(function () {
        Route::get('/', [ShippingInformationController::class, 'index']);
        Route::post('/', [ShippingInformationController::class, 'store']);
        Route::put('/', [ShippingInformationController::class, 'update']);
        Route::delete('/', [ShippingInformationController::class, 'destroy']);
    });
    Route::prefix('shippingMethod')->group(function () {
        Route::post('/', [ShippingMethodController::class, 'store']);
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
        Route::put('/{id}', [ItemController::class, 'update']);
        Route::delete('/{id}', [ItemController::class, 'destroy']);
    });

    Route::prefix('order')->group(function () {
        Route::post('/', [OrderController::class, 'store']);
        Route::get('/', [OrderController::class, 'index']);
    });

    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index']);
    });

    Route::get("/user", [AuthController::class, 'user']);
});

