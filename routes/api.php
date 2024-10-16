<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Route::apiResource('/tasks', App\Http\Controllers\Api\Diary\TasksController::class)->middleware('auth:sanctum');
Route::apiResource('/tasks', App\Http\Controllers\Api\Diary\TasksController::class);


