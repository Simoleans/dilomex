<?php

namespace App\Http\Controllers;

use App\Models\Administracion\Cap;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Administracion/CAPS/Index', [
            'data' => Cap::orderBy('id', 'desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'business_name' => 'required',
            'contact' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        $store = Cap::create($request->all());

        if (!$store) {
            return redirect()->route('caps.index')->with([
                'message' => '¡Error al crear el CAPs!',
                'type' => 'error'
            ]);
        } else {
            return redirect()->route('caps.index')->with([
                'message' => '¡El CAPs se ha creado correctamente!',
                'type' => 'success'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cap $cap)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cap $cap)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cap $cap)
    {
        $request->validate([
            'business_name' => 'required',
            'contact' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        $update = $cap->update($request->all());

        if (!$update) {
            return redirect()->route('caps.index')->with([
                'message' => '¡Error al actualizar el CAPs!',
                'type' => 'error'
            ]);
        } else {
            return redirect()->route('caps.index')->with([
                'message' => '¡El CAPs se ha actualizado correctamente!',
                'type' => 'success'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cap $cap)
    {
        $delete = $cap->delete();

        if (!$delete) {
            return redirect()->route('caps.index')->with([
                'message' => '¡Error al eliminar el CAPs!',
                'type' => 'error'
            ]);
        } else {
            return redirect()->route('caps.index')->with([
                'message' => '¡El CAPs se ha eliminado correctamente!',
                'type' => 'success'
            ]);
        }
    }
}
