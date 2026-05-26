<?php

use App\Http\Controllers\SafeController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Rotas de Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rotas protegidas por autenticação
Route::middleware(['auth'])->group(function () {
    
    // Admin (AQV) - Criar autorizações e dashboard
    Route::get('/', [SafeController::class, 'index'])->name('safe.index');
    Route::post('/store', [SafeController::class, 'store'])->name('safe.store');
    
    // Professor
    Route::get('/professor', [SafeController::class, 'professor'])->name('safe.professor');
    
    // Portaria
    Route::get('/portaria', [SafeController::class, 'portaria'])->name('safe.portaria');
    
    // Rotas de ação
    Route::patch('/aprovar/{autorizacao}/{etapa}', [SafeController::class, 'aprovar'])->name('safe.aprovar');
});

// Nota: o acesso à raiz '/' é protegido por auth; visitantes não autenticados serão redirecionados ao login.