<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periodo;

class PeriodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() 
    { 
        return Periodo::all(); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:32',
        ]);

        $periodo = Periodo::create($request->all());

        return response()->json([
            'message' => 'Período criado com sucesso!',
            'data' => $periodo
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $periodo = Periodo::findOrFail($id);
            return response()->json($periodo, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Período não encontrado.'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nome' => 'sometimes|string|max:32',
        ]);

        try {
            $periodo = Periodo::findOrFail($id);
            $periodo->update($request->all());

            return response()->json([
                'message' => 'Período atualizado com sucesso!',
                'data' => $periodo
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao atualizar período.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $periodo = Periodo::findOrFail($id);
            $periodo->delete();
            return response()->json(['message' => 'Período excluído com sucesso!'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao excluir período.'], 500);
        }
    }

    /**
     * Pesquisar períodos por nome.
     */
    public function searchByName(Request $request)
    {
        $request->validate(['nome' => 'required|string']);

        $periodos = Periodo::where('nome', 'LIKE', '%' . $request->nome . '%')->get();

        return response()->json([
            'message' => 'Resultados da pesquisa:',
            'data' => $periodos
        ], 200);
    }
}
