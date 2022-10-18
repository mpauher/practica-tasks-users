<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;

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

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'auth'
], function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'me']);
    Route::get('destroy', [AuthController::class, 'destroy']);
    Route::get('show', [AuthController::class, 'show']);
    Route::get('index', [AuthController::class, 'index']);
});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});

Route::group([
    'prefix' => 'tasks'
], function () {
    Route::post('create', [TaskController::class, 'create']);
    Route::get('show', [TaskController::class, 'show']);
    Route::get('index', [TaskController::class, 'index']);
    Route::put('update', [TaskController::class, 'update']);
    Route::delete('destroy', [TaskController::class, 'destroy']);
});

Route::get('/hello', function () {
    return ("hello world");
});
