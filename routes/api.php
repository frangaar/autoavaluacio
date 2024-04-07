<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UsuariController;
use App\Http\Controllers\Api\RubricaController;
use App\Http\Controllers\Api\CriteriAvaluacioController;
use App\Http\Controllers\Api\ResultatAprenentatgeController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('criteris',CriteriAvaluacioController::class);
Route::apiResource('resultats',ResultatAprenentatgeController::class);

Route::apiResource('moduls/usuari',UsuariController::class);

Route::get('lista-moduls/{userId}',[UsuariController::class,'modulByUser']);
Route::get('lista-moduls',[UsuariController::class,'modulsAll']);

Route::get('rubricas/{idModul}',[ResultatAprenentatgeController::class,'mostrarResultadosAprendizaje']);
Route::get('rubricas-usuari/{userId}',[UsuariController::class,'mostrarResultadosAprendizajePorUser']);

Route::put('modificar-criteris/{userId}',[CriteriAvaluacioController::class,'saveCriteris']);

