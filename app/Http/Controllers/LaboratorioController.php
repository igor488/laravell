<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        return Laboratorio::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Laboratorio::findOrFail($id);
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

        $laboratorio = Laboratorio::findOrFail($id);
        $laboratorio->update($request->all());

        return $laboratorio;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $laboratorio = Laboratorio::findOrFail($id);
        $laboratorio->delete();
        return response()->noContent();
    }
}
