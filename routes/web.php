<?php
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\LaboratorioController;
use App\Http\Controllers\PeriodoController;

// Rota inicial (exemplo, pode ser removida se não for necessária)
Route::get('/', function () {
    return view('welcome');
});

//rota professor
Route::post('/professor/save', [ProfessorController::class, 'store']);
Route::get('/professor/list', [ProfessorController::class, 'index']);
Route::get('/professor/{id}', [ProfessorController::class, 'show']);
Route::put('/professor/{id}', [ProfessorController::class, 'update']);
Route::delete('/professor/{id}', [ProfessorController::class, 'destroy']);

//rota
Route::post('/agendamento/save', [AgendamentoController::class, 'store']);
Route::get('/agendamento/list', [AgendamentoController::class, 'index']);
Route::get('/agendamento/{id}', [AgendamentoController::class, 'show']);
Route::put('/agendamento/{id}', [AgendamentoController::class, 'update']);
Route::delete('/agendamento/{id}', [AgendamentoController::class, 'destroy']);


Route::post('/horario/save', [HorarioController::class, 'store']);
Route::get('/horario/list', [HorarioController::class, 'index']);
Route::get('/horario/{id}', [HorarioController::class, 'show']);
Route::put('/horario/{id}', [HorarioController::class, 'update']);
Route::delete('/horario/{id}', [HorarioController::class, 'destroy']);

