<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\TenderProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [UserController::class, 'logout']);
});
Route::get('/users', [UserController::class, 'index']);
Route::post("/login", [UserController::class, "login"]);
Route::post("/register", [UserController::class, "register"]);

// Office
Route::get('/offices', [OfficeController::class, 'index']);
Route::get('/offices/{id}', [OfficeController::class, 'show']);

//Tender Project
Route::get('/tender-projects', [TenderProjectController::class, 'index']);
Route::get('/tender-projects/{id}', [TenderProjectController::class, 'show']);
