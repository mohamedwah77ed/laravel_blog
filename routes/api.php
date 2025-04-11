<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\DashboardControllerApi;
use App\Http\Controllers\Api\EditUserControllerApi;
use App\Http\Controllers\Api\CrudController;
use App\Http\Controllers\Api\CrudControllerApi;





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

Route::get('/', function () { //test
    return 3;
});

Route::post('/login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout_api');
    Route::put('/userupdate', [EditUserControllerApi::class, 'update']);
    Route::get('/dashboard', [DashboardControllerApi::class, 'index']);
});
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/posts', [CrudControllerApi::class, 'store']);
    Route::get('/posts', [CrudControllerApi::class, 'show']);
    Route::get('/posts/{id}', [CrudControllerApi::class, 'index']);
    Route::put('/posts/{id}', [CrudControllerApi::class, 'update']);
    Route::delete('/posts/{id}', [CrudControllerApi::class, 'destroy']); 
    Route::delete('/comments/{id}', [CrudControllerApi::class, 'deleteComment']);
    Route::get('/posts/search', [CrudControllerApi::class, 'search']);
    Route::post('/posts/{post}/comments', [CrudControllerApi::class, 'storeComment']);
   
});

