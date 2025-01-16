<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->paginate();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $tipos = Tipo::all();
        return view('admin.users.create', compact('tipos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipus_id' => 'required|exists:tipos_usuarios',
            'user_nombre' => 'required|string|max:255',
            'user_apellido' => 'required|string|max:255',
            'user_email' => 'required|string|email|max:255|unique:usuarios',
            'user_telefono' => 'required|string|max:255',
            'user_password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'tipus_id' => $request->tipus_id,
            'user_nombre' => $request->user_nombre,
            'user_apellido' => $request->user_apellido,
            'user_email' => $request->user_email,
            'user_telefono' => $request->user_telefono,
            'user_password' => Hash::make($request->user_password),
        ]);

        return redirect()->route('admin.users.index');
    }

    public function edit($user)
    {
        $tipos = Tipo::all();
        $user = User::with('roles')->findOrFail($user);
        return view('admin.users.edit', compact('user', 'tipos'));
    }

    public function update(Request $request, $user)
    {
        $request->validate([
            'tipus_id' => 'required|exists:tipos_usuarios',
        ]);

        $user = User::findOrFail($user);
        $user->update($request->all());

        return redirect()->route('admin.users.index');
    }
}