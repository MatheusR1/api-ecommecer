<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CampanhaController;
use App\Http\Controllers\CidadeController;
use App\Http\Controllers\GrupoCidadeController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [LoginController::class, 'login' ]);
Route::post('/logout', [LoginController::class, 'logout' ])->middleware('auth:sanctum');
Route::post('/register', [RegisterController::class, 'register' ]);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('/cidades', CidadeController::class);
    Route::apiResource('/grupo-cidades', GrupoCidadeController::class);
    Route::apiResource('/campanha', CampanhaController::class);
});
