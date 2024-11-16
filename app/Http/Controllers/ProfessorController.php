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
            'color' => 'required|string|max:16',
        ]);
        return Professor::create($request->all());
    
        //cor única ao novo professor
        $color = $this->getUniqueColor();
    
        return Professor::create([
            'nome' => $request->nome,
            'color' => $color,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Professor::findOrFail($id);
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