<?php

use Illuminate\Support\Facades\Route;
 
// Rotas para a página inicial
Route::get('/', function () {
    return view('home');
})->name('home');

Route::middleware('web')
    ->group(function() {
        require base_path('routes/grupos/produto.php');
    });
