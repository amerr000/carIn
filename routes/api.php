<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;




Route::post('/signup', [AuthController::class, 'signup']);    
Route::post('/login', [AuthController::class, 'login']); 
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum'); 
Route::get('/cars', [CarController::class, 'index']);
Route::get('/test',[CarController::class,'test']);



