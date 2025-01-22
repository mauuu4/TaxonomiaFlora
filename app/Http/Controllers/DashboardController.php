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
        $totalRegistros = Registro::whereHas('especie.genero.familia.reino', function($query) {
                $query->where('reino_nombre', 'plantae');
            })->count();
        
        $validacionesPendientes = Registro::whereHas('especie.genero.familia.reino', function($query) {
                $query->where('reino_nombre', 'plantae');
            })->where('regis_estado', 'Pendiente')->count();
        
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
        $totalRegistros = auth()->user()->registros()
            ->whereHas('especie.genero.familia.reino', function($query) {
                $query->where('reino_nombre', 'plantae');
            })->count();
            
        $validacionesPendientes = Registro::whereHas('especie.genero.familia.reino', function($query) {
                $query->where('reino_nombre', 'plantae');
            })->where('regis_estado', 'Pendiente')->count();
        
        return view('dashboard', compact('validacionesPendientes', 'totalRegistros'));
    }

    protected function userDashboard()
    {   
        $especiesValidadas = auth()->user()->registros()
            ->whereHas('especie.genero.familia.reino', function($query) {
                $query->where('reino_nombre', 'plantae');
            })->where('regis_estado', 'Validado')->count();

        $totalRegistros = auth()->user()->registros()
            ->whereHas('especie.genero.familia.reino', function($query) {
                $query->where('reino_nombre', 'plantae');
            })->count();

        return view('dashboard', compact('totalRegistros', "especiesValidadas"));
    }
}
