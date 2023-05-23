<?php

use App\Http\Controllers\Api\Dashboard\Auth\LoginController;
use App\Http\Controllers\Api\Dashboard\Auth\LogoutController;
use App\Http\Controllers\Api\Dashboard\Auth\PasswordUpdateController;
use App\Http\Controllers\Api\Dashboard\Auth\ProfileController;
use App\Http\Controllers\Api\Dashboard\MediaFileController;
use App\Http\Controllers\Api\Dashboard\PermissionController;
use App\Http\Controllers\Api\Dashboard\RoleController;
use App\Http\Controllers\Api\Dashboard\TagController;
use App\Http\Controllers\Api\Dashboard\UserController;
use App\Http\Controllers\Api\Dashboard\UserLogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Dashboard\PostController;
use App\Http\Controllers\Api\Dashboard\HeadingController;
use App\Http\Controllers\Api\Dashboard\PosterController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', LoginController::class);
    Route::post('logout', LogoutController::class)->middleware('auth:sanctum');
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('users', UserController::class);
    Route::apiResource('tags', TagController::class);

    Route::apiResource('heading', HeadingController::class);

    Route::apiResource('posts', PostController::class);

    Route::apiResource('poster', PosterController::class);

    Route::group(['prefix' => 'profile', 'controller' => ProfileController::class], function () {
        Route::get('', 'show');
        Route::put('', 'update');
        Route::post('avatar', 'storeAvatar');
        Route::post('update-password', PasswordUpdateController::class);
    });

    Route::get('permissions', [PermissionController::class, 'index']);
    Route::apiResource('roles', RoleController::class)->only(['index', 'show', 'update']);

    Route::apiResource('media-files', MediaFileController::class);

    Route::get('user-logs', [UserLogController::class, 'index']);
});

//post


