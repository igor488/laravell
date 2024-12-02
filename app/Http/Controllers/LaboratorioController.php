<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laboratorio;

class LaboratorioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
     { 
        return Laboratorio::all();
     }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:64',
            'descricao' => 'required|string',
        ]);

        $laboratorio = Laboratorio::create($request->all());

        return response()->json([
            'message' => 'Laboratório criado com sucesso!',
            'data' => $laboratorio
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $laboratorio = Laboratorio::findOrFail($id);
            return response()->json($laboratorio, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Laboratório não encontrado.'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nome' => 'sometimes|string|max:64',
            'descricao' => 'sometimes|string',
        ]);

        try {
            $laboratorio = Laboratorio::findOrFail($id);
            $laboratorio->update($request->all());

            return response()->json([
                'message' => 'Laboratório atualizado com sucesso!',
                'data' => $laboratorio
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao atualizar laboratório.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $laboratorio = Laboratorio::findOrFail($id);
            $laboratorio->delete();
            return response()->json(['message' => 'Laboratório excluído com sucesso!'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao excluir laboratório.'], 500);
        }
    }

    /**
     * Pesquisar laboratórios por nome.
     */
    public function searchByName(Request $request)
    {
        $request->validate(['nome' => 'required|string']);

        $laboratorios = Laboratorio::where('nome', 'LIKE', '%' . $request->nome . '%')->get();

        return response()->json([
            'message' => 'Resultados da pesquisa:',
            'data' => $laboratorios
        ], 200);
    }
}
