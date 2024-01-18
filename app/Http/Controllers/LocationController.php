<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Location/Index', [
            'data' => Location::orderBy('id','DESC')->get()
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
            'name' => 'required'
        ]);

        $store = Location::create(request()->all());

        if (!$store) {
            return redirect()->route('locations.index')->with([
                'message' => '¡Error al crear la locacion!',
                'type' => 'error'
            ]);
        } else {
            return redirect()->route('locations.index')->with([
                'message' => 'Locacion creada correctamente!',
                'type' => 'success'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $update = $location->update(request()->all());

        if (!$update) {
            return redirect()->route('locations.index')->with([
                'message' => '¡Error al actualizar la locacion!',
                'type' => 'error'
            ]);
        } else {
            return redirect()->route('locations.index')->with([
                'message' => 'Locacion actualizada correctamente!',
                'type' => 'success'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        $delete = $location->delete();

        if (!$delete) {
            return redirect()->route('locations.index')->with([
                'message' => '¡Error al eliminar la locacion!',
                'type' => 'error'
            ]);
        } else {
            return redirect()->route('locations.index')->with([
                'message' => 'Locacion eliminada correctamente!',
                'type' => 'success'
            ]);
        }
    }
}
