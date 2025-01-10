<?php

namespace App\Http\Controllers;

use App\Models\Especie;
use Illuminate\Http\Request;

class EspecieController extends Controller
{
    public function index()
    {
        $especies = Especie::all();
        return view('especies.index', compact('especies'));
    }

    public function create()
    {
        return view('especies.create');
    }

    public function show($especie)
    {
        $especie = Especie::find($especie);
        return view('especies.show', compact('especie'));
    }
}
