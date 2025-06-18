<?php

use Illuminate\Support\Facades\Route;
 
// Rotas para a página inicial
Route::get('/', function () {
    return view('home');
})->name('home');
