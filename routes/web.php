<?php

use App\Http\Controllers\EspecieController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/especies', [EspecieController::class, 'index']);
Route::get('/especies/create', [EspecieController::class, 'create']);
Route::get('/especies/{especie}', [EspecieController::class, 'show']);

Route::get('prueba', function () {

    $especie = new App\Models\Especie();
    $especie->esp_gene_id = 1;
    $especie->esp_nombre_cientifico = 'CAnIS lUpUUUs';
    $especie->esp_nombre_comun = 'Lobo';
    $especie->esp_descripcion = 'El lobo (Canis lupus)......';
    $especie->save();

    return $especie;
});

require __DIR__.'/auth.php';
