<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\TaxonomistRequestNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class TaxonomistRequestController extends Controller
{
    public function create()
    {
        // Verificar si ya es taxónomo o tiene solicitud pendiente
        if(auth()->user()->hasRole('Taxonomo')) {
            return redirect()->back()->with('info', 'Ya eres taxónomo');
        }
        
        return view('auth.request-taxonomist');
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        
        // Verificar si ya tiene un rol o solicitud pendiente
        if($user->hasRole('Taxonomo')) {
            return redirect()->back()->with('error', 'Ya eres taxónomo');
        }

        // Obtener administradores
        $admins = User::whereHas('roles', function($query) {
            $query->where('tipus_detalles', 'Administrador');
        })->get();

        // Enviar notificación
        Notification::send($admins, new TaxonomistRequestNotification($user));

        // Marcar solicitud pendiente (si quieres trackear en BD)
        // $user->update(['taxonomist_request_pending' => true]);

        return redirect()->route('dashboard')
            ->with('success', 'Solicitud enviada. Los administradores la revisarán pronto.');
    }
}
