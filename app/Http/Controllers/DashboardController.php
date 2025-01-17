<?php

namespace App\Http\Controllers;

use App\Models\Especie;
use App\Models\Registro;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('Administrador')) {
            return $this->adminDashboard();
        } elseif (auth()->user()->hasRole('Taxonomo')) {
            return $this->taxonomistDashboard();
        } else {
            return $this->userDashboard();
        }        
    }

    protected function adminDashboard()
    {
        $totalUsuarios = User::count();
        $totalRegistros = Registro::count();
        $validacionesPendientes = Registro::where('regis_estado', 'Pendiente')->count();
        
        // Obtener las últimas actividades (necesitarás crear esta tabla)
        $ultimasActividades = collect([]); // Por ahora vacío, hasta que implementemos el sistema de actividades
        
        return view('dashboard', compact(
            'totalUsuarios',
            'totalRegistros',
            'validacionesPendientes',
            'ultimasActividades'
        ));
    }

    protected function taxonomistDashboard()
    {
        $totalRegistros = auth()->user()->registros->count();
        $validacionesPendientes = Registro::where('regis_estado', 'Pendiente')->count();
        
        return view('dashboard', compact('validacionesPendientes', 'totalRegistros'));
    }

    protected function userDashboard()
    {   
        $especiesValidadas = auth()->user()->registros->where('regis_estado', 'Validado')->count();
        $totalRegistros = auth()->user()->registros->count();
        return view('dashboard', compact('totalRegistros', "especiesValidadas"));
    }
}
