<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EspecieController;
use App\Http\Controllers\ExplorerController;
use App\Http\Controllers\FamiliaController;
use App\Http\Controllers\GeneroController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaxonomistRequestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ValidateController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('especies', EspecieController::class)->except('show')
        ->names('especies');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:Administrador'])->group(function () {
    Route::resource('users', UserController::class);
});

Route::middleware(['auth', 'role:Administrador,Taxonomo'])->group(function () {
    Route::get('/validate', [ValidateController::class, 'index'])->name('validate.index');
    Route::get('/validate/{regis_id}', [ValidateController::class, 'show'])->name('validate.show');
    Route::post('/validate/{regis_id}/validate', [ValidateController::class, 'validate'])->name('validate.validate');
    Route::post('/validate/{regis_id}/reject', [ValidateController::class, 'reject'])->name('validate.reject');

    Route::resource('generos', GeneroController::class);

    Route::resource('familias', FamiliaController::class)->names('familias');
});


Route::get('/explorar', [ExplorerController::class, 'especies'])
    ->name('explorar.especies');

Route::get('/especies/{especie}', [EspecieController::class, 'show'])
    ->name('especies.show');

Route::get('/nosotros', function () {
    return view('home.nosotros');
});
Route::get('/preguntas-frecuentes', function () {
    return view('home.preguntas-frecuentes');
});

Route::get('/request-taxonomist', [TaxonomistRequestController::class, 'create'])
    ->middleware('auth')
    ->name('request-taxonomist.create');

// Para enviar la solicitud
Route::post('/request-taxonomist', [TaxonomistRequestController::class, 'store'])
    ->middleware('auth')
    ->name('request-taxonomist.store');

require __DIR__ . '/auth.php';
