<?php

namespace App\Http\Controllers;

use App\Models\Especie;
use App\Models\Familia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExplorerController extends Controller
{
    public function especies(Request $request)
    {
        $registros = $query = DB::table('vista_registros_especies')->orderBy('created_at', 'desc')
            ->paginate(10);;

        $familias = Familia::whereHas('reino', function($query) {
            $query->where('reino_nombre', 'Plantae');
        })->get();
        
        return view('explorar.especies', compact('registros', 'familias'));
    }
}
