<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgendamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Agendamento::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'laboratorio_id' => 'required|exists:laboratorios,id',
            'periodo_id' => 'required|exists:periodos,id',
            'horario_id' => 'required|exists:horarios,id',
            'aulas' => 'required|json',
        ]);

        return Agendamento::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Agendamento::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'laboratorio_id' => 'sometimes|exists:laboratorios,id',
            'periodo_id' => 'sometimes|exists:periodos,id',
            'horario_id' => 'sometimes|exists:horarios,id',
            'aulas' => 'sometimes|json',
        ]);

        $agendamento = Agendamento::findOrFail($id);
        $agendamento->update($request->all());

        return $agendamento;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $agendamento = Agendamento::findOrFail($id);
        $agendamento->delete();
        return response()->noContent();
    }
}
