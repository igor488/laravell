<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horario;

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

        $horario = Horario::create($request->all());

        return response()->json([
            'message' => 'Horário criado com sucesso!',
            'data' => $horario
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $horario = Horario::findOrFail($id);
            return response()->json($horario, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Horário não encontrado.'], 404);
        }
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

        try {
            $horario = Horario::findOrFail($id);
            $horario->update($request->all());

            return response()->json([
                'message' => 'Horário atualizado com sucesso!',
                'data' => $horario
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao atualizar horário.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $horario = Horario::findOrFail($id);
            $horario->delete();
            return response()->json(['message' => 'Horário excluído com sucesso!'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao excluir horário.'], 500);
        }
    }

    /**
     * Pesquisar horários por nome.
     */
    public function searchByName(Request $request)
    {
        $request->validate(['nome' => 'required|string']);

        $horarios = Horario::where('nome', 'LIKE', '%' . $request->nome . '%')->get();

        return response()->json([
            'message' => 'Resultados da pesquisa:',
            'data' => $horarios
        ], 200);
    }
}
