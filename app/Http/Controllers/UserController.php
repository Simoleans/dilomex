<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Administracion/Users/Index', [
            'data' => User::where('id','!=',auth()->user()->id)->orderBy('id', 'DESC')->get(),
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
            'name' => 'required|string|max:255',
            'email' => 'email|required|unique:users,email',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $store = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => strtolower($request->username),
            'password' => \Hash::make($request->password)
        ]);

        if ($store) {
            return redirect()->route('users.index')->with([
                'message' => '¡Error al crear usuario!',
                'type' => 'error'
            ]);
        } else {
            return redirect()->route('users.index')->with([
                'message' => '¡El usuario se ha creado correctamente!',
                'type' => 'success'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'email|required|unique:users,email,'.$user->id,
            'username' => 'required|string|max:255|unique:users,username,'.$user->id,
        ]);

        $update = $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'username' => strtolower($request->username),
        ]);

        if (!$update) {
            return redirect()->route('users.index')->with([
                'message' => '¡Error al actualizar usuario!',
                'type' => 'error'
            ]);
        } else {
            return redirect()->route('users.index')->with([
                'message' => '¡El usuario se ha actualizado correctamente!',
                'type' => 'success'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $delete = $user->delete();

        if (!$delete) {
            return redirect()->route('users.index')->with([
                'message' => '¡Error al eliminar usuario!',
                'type' => 'error'
            ]);
        } else {
            return redirect()->route('users.index')->with([
                'message' => '¡El usuario se ha eliminado correctamente!',
                'type' => 'success'
            ]);
        }
    }

    //change password
    public function changePassword(Request $request,User $user)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $update = $user->update([
            'password' => \Hash::make($request->password)
        ]);

        if (!$update) {
            return redirect()->route('users.index')->with([
                'message' => '¡Error al actualizar la contraseña!',
                'type' => 'error'
            ]);
        } else {
            return redirect()->route('users.index')->with([
                'message' => '¡La contraseña se ha actualizado correctamente!',
                'type' => 'success'
            ]);
        }
    }
}
