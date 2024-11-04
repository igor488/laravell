<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    protected $colors;

    public function __construct()
    {
        $colors = require app_path('Helpers/colors.php');
        $this->colors = [
            'primary' => $colors['primaryColors'](),
            'secondary' => $colors['secondaryColors'](),
        ];
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
    ]);

    $professor = Professor::findOrFail($id);
    $professor->update($request->all());

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
        foreach ($this->colors['primary'] as $color) {
            if (!in_array($color, $usedColors)) {
                return $color;
            }
        }
        foreach ($this->colors['secondary'] as $color) {
            if (!in_array($color, $usedColors)) {
                return $color;
            }
        }
        return null;
    
    }
}
