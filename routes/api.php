<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//User
Route::post('/register',[AuthController::class,'register']);
Route::get('/images/{urlImage}',[ImageController::class,'show']);
Route::post('/login',[AuthController::class,'login']);
Route::put('/update',[AuthController::class,'update']);
//Prouct 
Route::post('/create',[ProductController::class,'createPro']);
Route::put('/edit',[ProductController::class,'editPro']);
Route::get('/showPro',[ProductController::class,'showPro']);