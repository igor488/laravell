<?php
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\LaboratorioController;
use App\Http\Controllers\PeriodoController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\AgendamentoController;


Route::get('/', function () {
    return view('welcome');
});

// Rotas para Professores
Route::prefix('professores')->group(function () {
    Route::get('/', [ProfessorController::class, 'index']);        
    Route::get('/{id}', [ProfessorController::class, 'show']);      
    Route::post('/', [ProfessorController::class, 'store']);   
    Route::put('/{id}', [ProfessorController::class, 'update']);     
    Route::delete('/{id}', [ProfessorController::class, 'destroy']); 
});

// Rotas para Laboratórios
Route::prefix('laboratorios')->group(function () {
    Route::get('/', [LaboratorioController::class, 'index']);
    Route::get('/{id}', [LaboratorioController::class, 'show']);
    Route::post('/', [LaboratorioController::class, 'store']); 
    Route::put('/{id}', [LaboratorioController::class, 'update']);
    Route::delete('/{id}', [LaboratorioController::class, 'destroy']);
});

// Rotas para Períodos
Route::prefix('periodos')->group(function () {
    Route::get('/', [PeriodoController::class, 'index']);
    Route::get('/{id}', [PeriodoController::class, 'show']);
    Route::post('/', [PeriodoController::class, 'store']); 
    Route::put('/{id}', [PeriodoController::class, 'update']);
    Route::delete('/{id}', [PeriodoController::class, 'destroy']);
});

// Rotas para Horários
Route::prefix('horarios')->group(function () {
    Route::get('/', [HorarioController::class, 'index']);
    Route::get('/{id}', [HorarioController::class, 'show']);
    Route::post('/', [HorarioController::class, 'store']);
    Route::put('/{id}', [HorarioController::class, 'update']);
    Route::delete('/{id}', [HorarioController::class, 'destroy']);
});

// Rotas para Agendamentos
Route::prefix('agendamentos')->group(function () {
    Route::get('/', [AgendamentoController::class, 'index']);
    Route::get('/{id}', [AgendamentoController::class, 'show']);
    Route::post('/', [AgendamentoController::class, 'store']); 
    Route::put('/{id}', [AgendamentoController::class, 'update']);
    Route::delete('/{id}', [AgendamentoController::class, 'destroy']);
});
