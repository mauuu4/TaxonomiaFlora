<?php
// app/Http/Controllers/HomeController.php
namespace App\Http\Controllers;

use App\Models\Especie;
use App\Models\Imagen;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $imagenes = Imagen::orderBy('created_at', 'desc')->limit(5)->get();      
            
        $stats = [
            'especies' => Especie::count(),
            'taxonomos' => User::whereHas('roles', function ($query) {
                $query->where('tipus_detalles', 'Taxónomo');
            })->count(),
            'usuarios' => User::count(),
        ];
        
        return view('welcome', compact('imagenes', 'stats'));
    }
}
