<?php

namespace App\Http\Controllers;

use App\Models\Especie;
use App\Models\Registro;
use App\Models\User;
use App\Models\Familia;
use App\Models\Genero;
use Illuminate\Support\Facades\DB;

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
            $query->where('reino_nombre', 'Plantae');
        })->count();
        
        $validacionesPendientes = Registro::whereHas('especie.genero.familia.reino', function($query) {
            $query->where('reino_nombre', 'Plantae');
        })->where('regis_estado', 'Pendiente')->count();
        
        // Métricas adicionales para administrador
        $totalFamilias = Familia::count();
        $totalGeneros = Genero::count();
        $totalEspecies = Especie::count();

        // Distribución de registros por estado
        $registrosPorEstado = Registro::select('regis_estado', DB::raw('COUNT(*) as count'))
            ->groupBy('regis_estado')
            ->get();

        // Usuarios más activos
        $usuariosMasActivos = User::withCount('registros')
            ->orderBy('registros_count', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalUsuarios',
            'totalRegistros',
            'validacionesPendientes',
            'totalFamilias',
            'totalGeneros',
            'totalEspecies',
            'registrosPorEstado',
            'usuariosMasActivos'
        ));
    }

    protected function taxonomistDashboard()
    {
        $user = auth()->user();
        
        $totalRegistros = $user->registros()
            ->whereHas('especie.genero.familia.reino', function($query) {
                $query->where('reino_nombre', 'Plantae');
            })->count();
        
        $totalFamilias = Familia::count();
        $totalGeneros = Genero::count();
        $totalEspecies = Especie::count();
        
        $validacionesPendientes = Registro::whereHas('especie.genero.familia.reino', function($query) {
            $query->where('reino_nombre', 'Plantae');
        })->where('regis_estado', 'Pendiente')->count();
        
        // Registros pendientes asignados al taxonomo
        $registrosPendientes = Registro::whereHas('especie.genero.familia.reino', function($query) {
            $query->where('reino_nombre', 'Plantae');
        })->where('regis_estado', 'Pendiente')
          ->latest()
          ->take(10)
          ->get();

        $registrosPorEstado = Registro::select('regis_estado', DB::raw('COUNT(*) as count'))
        ->groupBy('regis_estado')
        ->get();

        // Estadísticas de validación del taxonomo
        $estadisticasValidacion = Registro::where('user_id', $user->id)
            ->select('regis_estado', DB::raw('COUNT(*) as count'))
            ->groupBy('regis_estado')
            ->get();

        return view('dashboard', compact(
            'totalRegistros', 
            'totalFamilias',
            'totalGeneros',
            'totalEspecies',
            'validacionesPendientes', 
            'registrosPendientes',
            'estadisticasValidacion',
            'registrosPorEstado'
        ));
    }

    protected function userDashboard()
    {   
        $user = auth()->user();

        $especiesValidadas = $user->registros()
            ->whereHas('especie.genero.familia.reino', function($query) {
                $query->where('reino_nombre', 'Plantae');
            })->where('regis_estado', 'Validado')->count();

        $totalRegistros = $user->registros()
            ->whereHas('especie.genero.familia.reino', function($query) {
                $query->where('reino_nombre', 'Plantae');
            })->count();

        // Últimos registros del usuario
        $ultimosRegistros = $user->registros()
            ->with('especie.genero')
            ->latest()
            ->take(5)
            ->get();

        // Distribución de registros por estado
        $registrosPorEstado = $user->registros()
            ->select('regis_estado', DB::raw('COUNT(*) as count'))
            ->groupBy('regis_estado')
            ->get();

        return view('dashboard', compact(
            'totalRegistros', 
            'especiesValidadas', 
            'ultimosRegistros',
            'registrosPorEstado'
        ));
    }
}