<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [UserController::class, 'login']);
Route::post('/createUser', [UserController::class, 'createUser']);

Route::prefix('/users')->middleware('auth:api')->group(function () {

    Route::get('/listUser', [UserController::class, 'listUsers']);

    Route::get('/logout', [UserController::class, 'logout']);
    Route::put('/updateUser/{user}', [UserController::class, 'updateUser']);
    Route::delete('/deleteUser/{user}', [UserController::class, 'deleteUser']);
});