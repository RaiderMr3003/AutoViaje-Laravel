<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Rutas Públicas / Redirección Inicial
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('home')
        : redirect()->route('login');
});

// Rutas de Autenticación
Route::middleware('guest')->controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login');
});

// Rutas Protegidas
Route::middleware('auth')->group(function () {
    // Home
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Autorizaciones
    Route::resource('autorizaciones', \App\Http\Controllers\AutorizacionController::class)->except(['show', 'destroy']);
    Route::post('/autorizaciones/{id}/participantes', [\App\Http\Controllers\AutorizacionController::class, 'addParticipant'])->name('autorizaciones.addParticipant');
    Route::put('/autorizaciones/{id}/participantes/{persona_id}', [\App\Http\Controllers\AutorizacionController::class, 'updateParticipant'])->name('autorizaciones.updateParticipant');
    Route::delete('/autorizaciones/{id}/participantes/{persona_id}', [\App\Http\Controllers\AutorizacionController::class, 'removeParticipant'])->name('autorizaciones.removeParticipant');

    // Personas Buscar
    Route::get('/personas/search/{num_doc}', [\App\Http\Controllers\AutorizacionController::class, 'searchPersona'])->name('personas.search');

    // Exportar
    Route::get('/exportar', [\App\Http\Controllers\ExportController::class, 'index'])->name('exportar.index');
    Route::get('/exportar/download', [\App\Http\Controllers\ExportController::class, 'export'])->name('exportar.download');

    // Documentos Word
    Route::get('/autorizaciones/{id}/download-word', [\App\Http\Controllers\DocumentoController::class, 'descargar'])->name('autorizaciones.documento');
});