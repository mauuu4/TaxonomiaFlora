<?php

namespace App\Http\Controllers;

use App\Models\Especie;
use App\Models\Familia;
use Illuminate\Http\Request;

class ExplorerController extends Controller
{
    public function especies(Request $request)
    {
        $especies = Especie::whereHas('genero.familia.reino', function($query) {
            $query->where('reino_nombre', 'plantae');
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        $familias = Familia::whereHas('reino', function($query) {
            $query->where('reino_nombre', 'plantae');
        })->get();
        
        return view('explorar.especies', compact('especies', 'familias'));
    }
}
