<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Curso;

class AdminController extends Controller
{
    public function dashboard()
{
    $clientes = Cliente::with('user', 'curso')->get();

    $cursos = Curso::all();

    $lixeira = Cliente::onlyTrashed()
        ->with('user', 'curso')
        ->get();

    return view('admin.dashboard', [
        'clientes' => $clientes,
        'cursos' => $cursos,
        'lixeira' => $lixeira,
        'total' => Cliente::count(),
        'ativos' => Cliente::whereNull('deleted_at')->count(),
        'apagados' => Cliente::onlyTrashed()->count(),
    ]);
}

    public function restaurar($id)
    {
        $cliente = Cliente::withTrashed()->findOrFail($id);
        $cliente->restore();

        return back();
    }

    public function apagar($id)
    {
        Cliente::findOrFail($id)->delete();

        return back();
    }
}