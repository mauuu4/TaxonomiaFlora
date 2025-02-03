<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index()
    {
        $tipos = Tipo::whereIn('tipus_detalles', ['Usuario', 'Administrador', 'Taxonomo'])->get();
        $users = User::whereIn('tipus_id', $tipos->pluck('tipus_id'))->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $tipos = Tipo::whereIn('tipus_detalles', ['Usuario', 'Administrador', 'Taxonomo'])->get();
        return view('admin.users.create', compact('tipos'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'tipus_id' => 'required|exists:tipos_usuarios',            
                'user_cedula' => ['required', 'regex:/^[0-9]{10}$/', 'max:10'],
                'user_nombre' => ['required', 'string', 'max:50', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'],
                'user_apellido' => ['required', 'string', 'max:50', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'],
                'user_telefono' => ['required', 'regex:/^[0-9]{10}$/', 'max:10'],
                'user_email' => ['required', 'string', 'lowercase', 'email', 'max:35', 'unique:'.User::class],
                'user_password' => ['required', 'confirmed',Rules\Password::defaults()],
            ]);

            $user = User::create([
                'tipus_id' => $request->tipus_id,
                'user_cedula' => $request->user_cedula,
                'user_nombre' => $request->user_nombre,
                'user_apellido' => $request->user_apellido,
                'user_telefono' => $request->user_telefono,
                'user_email' => $request->user_email,
                'user_password' => Hash::make($request->user_password),
                'user_estado' => false,
            ]);

            return redirect()->route('admin.users.index')->with('success', 'El usuario se creó con éxito');
        } catch (\Illuminate\Database\QueryException $e) {
            if (str_contains($e->getMessage(), 'Cédula no válida')) {
                preg_match('/ERROR: (.+?) CONTEXT/', $e->getMessage(), $matches);
                $errorMessage = $matches[1] ?? 'Cédula no válida';
                
                return redirect()->route('admin.users.create')
                    ->withInput()
                    ->withErrors(['user_cedula' => $errorMessage]);
            }
            
            return redirect()->route('admin.users.create')
                ->withInput()
                ->withErrors(['error' => 'Ha ocurrido un error al crear el usuario']);
        }
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

        return redirect()->route('admin.users.index')->with('success', 'El usuario se actualizó con éxito');
    }
}