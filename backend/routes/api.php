<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'v1'], function () {
    Route::post('/login', [App\Http\Controllers\Api\Auth\LoginController::class, 'index']);
    Route::post('/logout', [App\Http\Controllers\Api\Auth\LoginController::class, 'logout']);

    Route::get('/orders/export/excel', [App\Http\Controllers\Api\Admin\OrderController::class, 'exportExcel']);

    Route::group(['middleware' => ['auth:api', "checkRole:admin"]], function () {
        Route::apiResource('/users', App\Http\Controllers\Api\Admin\UserController::class);
        Route::get('/users/head/list', [App\Http\Controllers\Api\Admin\UserController::class, 'getHeadUserList']);
        Route::get('/users/branch/list', [App\Http\Controllers\Api\Admin\UserController::class, 'getBranchUserList']);

        Route::apiResource('/companies', App\Http\Controllers\Api\Admin\CompanyController::class);
        Route::apiResource('/drivers', App\Http\Controllers\Api\Admin\DriverController::class);
        Route::apiResource('/mines', App\Http\Controllers\Api\Admin\MineController::class);
        Route::apiResource('/vehicles', App\Http\Controllers\Api\Admin\VehicleController::class);

        Route::group(['prefix' => 'orders'], function () {
            Route::post('/', [App\Http\Controllers\Api\Admin\OrderController::class, 'store']);
            Route::put('/{order}', [App\Http\Controllers\Api\Admin\OrderController::class, 'update']);
            Route::delete('/{order}', [App\Http\Controllers\Api\Admin\OrderController::class, 'destroy']);
            Route::get('/analytic/view', [App\Http\Controllers\Api\Admin\OrderController::class, 'analytics']);
        });
    });

    Route::group(['middleware' => ['auth:api', "checkRole:admin,pic_branch_office,pic_head_office"]], function () {
        Route::group(['prefix' => 'orders'], function () {
            Route::get('/', [App\Http\Controllers\Api\Admin\OrderController::class, 'index']);
            Route::get('/{order}', [App\Http\Controllers\Api\Admin\OrderController::class, 'show']);
        });
    });

    Route::group(['middleware' => ['auth:api', "checkRole:pic_branch_office,pic_head_office"]], function () {
        Route::group(['prefix' => 'orders'], function () {
            Route::get('/approval/list', [App\Http\Controllers\Api\Admin\OrderController::class, 'approvalList']);
            Route::get('/{order}/approve', [App\Http\Controllers\Api\Admin\OrderController::class, 'approve']);
            Route::get('/{order}/reject', [App\Http\Controllers\Api\Admin\OrderController::class, 'reject']);
        });
    });
});
