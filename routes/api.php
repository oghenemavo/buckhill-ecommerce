<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderStatusController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('v1')->group(function () {
    Route::prefix('user')->group(function () {
        Route::controller(UserController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('create', 'create');
            Route::post('login', 'login');
            Route::post('logout', 'logout');
            Route::post('refresh', 'refresh');
            Route::put('edit', 'edit');
            Route::delete('/', 'remove');
        });
    });

    Route::prefix('admin')->group(function () {
        Route::controller(AdminController::class)->group(function () {
            Route::post('create', 'store');
            Route::post('login', 'login');
            Route::post('logout', 'logout')->middleware(['auth:api', 'user-access:admin']);
        });
        Route::controller(AdminUserController::class)->middleware(['auth:api', 'user-access:admin'])->group(function () {
            Route::get('user-listing', 'allUsers');
            Route::put('user-edit/{uuid}', 'editUser');
            Route::delete('user-delete/{uuid}', 'delete');
        });
    });
    
    Route::post('files/{uuid}', [FileController::class, 'download']);

    Route::apiResource('products', ProductController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('brands', BrandController::class);
    Route::apiResource('order-statuses', OrderStatusController::class);
    
    Route::middleware(['auth:api', 'user-access:admin'])->group(function() {
        Route::post('files', [FileController::class, 'store']);
        Route::get('/orders/{uuid}/download', [OrderController::class, 'download']);
        Route::get('/orders/dashboard', [OrderController::class, 'index']);
        Route::get('/orders/shipment-locator', [OrderController::class, 'shipmentLocator']);
        Route::apiResource('orders', OrderController::class);
        Route::apiResource('payments', PaymentController::class);
    });

});
