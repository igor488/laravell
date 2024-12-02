<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    protected $colors;
    public function __construct()
    {
        // Carregar as cores do arquivo colors.php
        $this->colors = require app_path('Helpers/colors.php');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Professor::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:128',
        ]);

        $color = $this->getUniqueColor();

        if (!$color) {
            return response()->json(['message' => 'Todas as cores já foram usadas.'], 400);
        }

        $professor = Professor::create([
            'nome' => $request->nome,
            'color' => $color,
        ]);

        return response()->json([
            'message' => 'Professor criado com sucesso!',
            'data' => $professor
        ], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $professor = Professor::findOrFail($id);
        return response()->json($professor, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nome' => 'sometimes|string|max:128',
            'color' => 'sometimes|string|max:16',
        ]);
        
    $request->validate([
        'nome' => 'sometimes|string|max:128',
    ]);

        $professor = Professor::findOrFail($id);
        $professor->update($request->all());
    $professor = Professor::findOrFail($id);
    $professor->update($request->all());

        return $professor;
    return $professor;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $professor = Professor::findOrFail($id);
        $professor->delete();
        return response()->noContent();
    }
    protected function getUniqueColor()
    {
        $usedColors = Professor::pluck('color')->toArray();
        $availableColors = array_diff($this->colors, $usedColors);
        if (empty($availableColors)) {
            return null; 
        }
        return array_values($availableColors)[0];
    }
}