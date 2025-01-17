<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Tipo;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'user_cedula' => ['required', 'regex:/^[0-9]{10}$/', 'max:10'],
            'user_nombre' => ['required', 'string', 'max:50', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'],
            'user_apellido' => ['required', 'string', 'max:50', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'],
            'user_telefono' => ['required', 'regex:/^[0-9]{10}$/', 'max:10'],
            'user_email' => ['required', 'string', 'lowercase', 'email', 'max:35', 'unique:'.User::class],
            'user_password' => ['required', 'confirmed',Rules\Password::defaults()],

        ]);

        // Busca el tipus_id correspondiente al tipo "user"
        $tipoUsuario = Tipo::where('tipus_detalles', 'user')->first();

        $user = User::create([
            'tipus_id' => $tipoUsuario->tipus_id,
            'user_cedula' => $request->user_cedula,
            'user_nombre' => $request->user_nombre,
            'user_apellido' => $request->user_apellido,
            'user_telefono' => $request->user_telefono,
            'user_email' => $request->user_email,
            'user_password' => Hash::make($request->user_password),
            'user_estado' => false,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
