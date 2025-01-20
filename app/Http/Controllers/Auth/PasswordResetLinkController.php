<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use App\Notifications\ResetPasswordNotification;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;


class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'user_email' => ['required', 'email', 'exists:usuarios,user_email'],
        ]);

        // Generar un token único
        $token = Str::random(64);

        // Almacenar el token en caché por 1 hora
        Cache::put('password_reset_' . $request->user_email, $token, now()->addHour());

        // Generar el enlace de restablecimiento
        $resetLink = route('password.reset', ['token' => $token, 'email' => $request->user_email]);

        // Enviar el enlace usando la notificación predeterminada
        Notification::route('mail', $request->user_email)->notify(new ResetPasswordNotification($resetLink));

        return back()->with('status', __('We have emailed your password reset link!'));
    }
}
