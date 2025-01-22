<?php

namespace App\Http\Controllers;

use App\Models\Especie;
use App\Models\Reino;
use Illuminate\Http\Request;

class ExplorerController extends Controller
{
    public function especies(Request $request)
    {
        $especies = Especie::orderBy('created_at', 'desc')->paginate(10);
        $reinos = Reino::all();
        return view('explorer.especies', compact('especies', 'reinos'));
    }
}
