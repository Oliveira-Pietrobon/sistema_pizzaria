<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/cadastrar', [UserController::class, 'store']);
Route::put('/atualizar/{id}', [UserController::class, 'update']);
Route::delete('/excluir/{id}', [UserController::class, 'destroy']);

Route::prefix('/user')->group(function (){
    Route::get('/', [UserController::class, 'index']);
});
