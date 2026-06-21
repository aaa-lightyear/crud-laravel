<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            $cursos = Curso::all();
        } else {
            $cursos = Curso::where('user_id', auth()->id())->get();
        }
        return view('cursos.index', compact('cursos'));
    }

    public function create()
    {
        return view('cursos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required'
        ]);

        Curso::create([
            'nome' => $request->nome,
            'user_id' => auth()->id()
        ]);

        return redirect()->route('cursos.index')
            ->with('success', 'Curso criado com sucesso.');
    }

    public function destroy($id)
    {
        $curso = Curso::findOrFail($id);

        if ($curso->clientes()->count() > 0) {
            return redirect()->route('cursos.index')
                ->with('error', 'Este curso tem clientes associados.');
        }

        $curso->delete();

        return redirect()->route('cursos.index')
            ->with('success', 'Curso enviado para a lixeira.');
    }

    public function lixeira()
    {
        if (auth()->user()->role === 'admin') {
            $cursos = Curso::onlyTrashed()->get();
        } else {
            $cursos = Curso::onlyTrashed()->where('user_id', auth()->id())->get();
        }
        return view('cursos.lixeira', compact('cursos'));
    }

    public function restaurar($id)
    {
        $curso = Curso::withTrashed()->findOrFail($id);

        if (auth()->user()->role !== 'admin' && $curso->user_id !== auth()->id()) {
            return redirect()->route('cursos.lixeira')->with('error', 'Permissão negada.');
        }

        $curso->restore();

        return redirect()->route('cursos.lixeira')
            ->with('success', 'Curso restaurado.');
    }

    public function forcar($id)
    {
        $curso = Curso::onlyTrashed()->findOrFail($id);

        if (auth()->user()->role !== 'admin' && $curso->user_id !== auth()->id()) {
            return redirect()->route('cursos.lixeira')->with('error', 'Permissão negada.');
        }

        // Apaga clientes associados (activos e soft-deleted) antes de apagar o curso
        $curso->clientes()->withTrashed()->forceDelete();

        $curso->forceDelete();

        return redirect()->route('cursos.lixeira')
            ->with('success', 'Curso apagado definitivamente.');
    }
}
