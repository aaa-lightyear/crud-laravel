<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\ClienteController;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    /*Dashboard*/
    Route::get('/dashboard', function () {

        // ADMIN
        if (auth()->user()->role === 'admin') {
            return redirect('/admin/dashboard');
        }

        // PROFESSOR
        return redirect('/clientes');

    })->name('dashboard');
    
    /*Admin*/
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');
        
        
        
    /*Alunos*/    
    Route::get('/clientes/lixeira', [ClienteController::class, 'lixeira'])
        ->name('clientes.lixeira');

    Route::patch('/clientes/{id}/restaurar', [ClienteController::class, 'restaurar'])
        ->name('clientes.restaurar');

    Route::delete('/clientes/{id}/forcar-deletar', [ClienteController::class, 'forcarDeletar'])
        ->name('clientes.forcarDeletar');

    Route::resource('clientes', ClienteController::class);


    /*Cursos*/
    Route::get('/cursos/lixeira', [CursoController::class, 'lixeira'])
        ->name('cursos.lixeira');

    Route::patch('/cursos/{id}/restaurar', [CursoController::class, 'restaurar'])
        ->name('cursos.restaurar');

    Route::delete('/cursos/{id}/forcar', [CursoController::class, 'forcar'])
        ->name('cursos.forcar');

    Route::resource('cursos', CursoController::class);

});