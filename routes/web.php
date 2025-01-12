<?php

use App\Http\Controllers\EspecieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaxonomistController;
use App\Http\Controllers\ValidateController;
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

    Route::resource('especies', EspecieController::class)
    ->names('especies');
});


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', function () {
        return 'Bienvenido administrador';
    });
});

Route::middleware(['auth', 'taxonomist'])->group(function () {
    Route::get('/validate', [ValidateController::class, 'index'])->name('validate.index');
    Route::get('/validate/{regis_id}', [ValidateController::class, 'show'])->name('validate.show');
    Route::post('/validate/{regis_id}/validate', [ValidateController::class, 'validate'])->name('validate.validate');
    Route::post('/validate/{regis_id}/reject', [ValidateController::class, 'reject'])->name('validate.reject');
});

Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/user', function () {
        return 'Bienvenido usuario';
    });
});

require __DIR__.'/auth.php';
