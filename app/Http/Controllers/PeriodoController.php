<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $request->validate(['nome' => 'required|string|max:32']);
        return Periodo::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Periodo::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(['nome' => 'sometimes|string|max:32']);
        $periodo = Periodo::findOrFail($id);
        $periodo->update($request->all());

        return $periodo;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $periodo = Periodo::findOrFail($id);
        $periodo->delete();
        return response()->noContent();
    }
}
