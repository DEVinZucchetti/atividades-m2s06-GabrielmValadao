<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PessoasController;


Route::resource('pessoas', PessoasController::class)
  ->only(['index', 'show', 'store', 'update', 'destroy']);


/*
maneira mais limpa de digitar esse codigo

Route::resource('pessoas', [PessoasController::class])->only([
    'index', - exibe todos
    'show',  - exibe um
    'store', - cadastra
    'update', - atualiza
    'destroy' - destroi / deleta
]);
*/
