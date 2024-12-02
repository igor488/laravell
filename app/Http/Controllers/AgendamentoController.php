<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agendamento;

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
            'aulas.*' => 'string', // Corrigido a regra de validação do array
        ]);

        $agendamento = Agendamento::create($request->all());

        return response()->json([
            'message' => 'Agendamento criado com sucesso!',
            'data' => $agendamento
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $agendamento = Agendamento::findOrFail($id);
            return response()->json($agendamento, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Agendamento não encontrado.'], 404);
        }
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

        try {
            $agendamento = Agendamento::findOrFail($id);
            $agendamento->update($request->all());

            return response()->json([
                'message' => 'Agendamento atualizado com sucesso!',
                'data' => $agendamento
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao atualizar agendamento.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $agendamento = Agendamento::findOrFail($id);
            $agendamento->delete();
            return response()->json(['message' => 'Agendamento excluído com sucesso!'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao excluir agendamento.'], 500);
        }
    }

    /**
     * Pesquisar agendamentos por professor ou laboratório.
     */
    public function search(Request $request)
    {
        $request->validate([
            'professor' => 'nullable|string',
            'laboratorio' => 'nullable|string',
        ]);

        $query = Agendamento::query();

        if ($request->has('professor')) {
            $query->where('professor', 'LIKE', '%' . $request->professor . '%');
        }

        if ($request->has('laboratorio')) {
            $query->where('laboratorio', 'LIKE', '%' . $request->laboratorio . '%');
        }

        $agendamentos = $query->get();

        return response()->json([
            'message' => 'Resultados da pesquisa:',
            'data' => $agendamentos
        ], 200);
    }
}
