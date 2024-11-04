<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgendamentoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function() {
    return 'WORLD';
});

Route::post('/save', [AgendamentoController::class, 'store']);