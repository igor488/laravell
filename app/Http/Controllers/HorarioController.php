<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Horario::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'periodo_id' => 'required|exists:periodos,id',
            'nome' => 'required|string|max:32',
            'aulas' => 'required|json',
        ]);

        return Horario::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Horario::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'periodo_id' => 'sometimes|exists:periodos,id',
            'nome' => 'sometimes|string|max:32',
            'aulas' => 'sometimes|json',
        ]);

        $horario = Horario::findOrFail($id);
        $horario->update($request->all());

        return $horario;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $horario = Horario::findOrFail($id);
        $horario->delete();
        return response()->noContent();
    }
}
