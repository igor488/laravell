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
            'professor' => 'required|string|max:128',
            'laboratorio' => 'required|string|max:64',
            'data' => 'required|date_format:d/m/Y',
            'periodo' => 'required|string|max:32',
            'horario' => 'required|string|max:32',
            'aulas' => 'required|array',
            'aulas.' => 'string',
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
