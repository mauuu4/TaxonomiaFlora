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

Route::get('/especies', [EspecieController::class, 'index'])->name('especies.index');

Route::get('/especies/create', [EspecieController::class, 'create'])->name('especies.create');
Route::post('/especies', [EspecieController::class, 'store'])->name('especies.store');
Route::get('/especies/{especie}', [EspecieController::class, 'show'])->name('especies.show');

Route::get('/especies/{especie}/edit', [EspecieController::class, 'edit'])->name('especies.edit');
Route::put('/especies/{especie}', [EspecieController::class, 'update'])->name('especies.update');

Route::delete('/especies/{especie}', [EspecieController::class, 'destroy'])->name('especies.destroy');

require __DIR__.'/auth.php';
