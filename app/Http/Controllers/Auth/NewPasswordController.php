<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(string $token, Request $request): \Illuminate\View\View
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }

    /**
     * Handle an incoming new password request.
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        // Validar los datos del formulario
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email', 'exists:usuarios,user_email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Recuperar el token de la caché
        $cachedToken = Cache::get('password_reset_' . $request->email);

        // Verificar si el token coincide
        if (!$cachedToken || $cachedToken !== $request->token) {
            return back()->withErrors(['email' => __('The password reset token is invalid or has expired.')]);
        }

        // Actualizar la contraseña en la base de datos
        DB::table('usuarios')
            ->where('user_email', $request->email)
            ->update([
                'user_password' => Hash::make($request->password),
            ]);

        // Eliminar el token de la caché
        Cache::forget('password_reset_' . $request->email);

        // Redirigir al login con un mensaje de éxito
        return redirect()->route('login')->with('status', __('Your password has been reset!'));
    }
}
