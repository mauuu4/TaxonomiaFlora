<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EspecieController extends Controller
{
    public function index()
    {
        return view('especies.index');
    }

    public function create()
    {
        return view('especies.create');
    }

    public function show($especie)
    {
        return view('especies.show', compact('especie'));
    }
}
