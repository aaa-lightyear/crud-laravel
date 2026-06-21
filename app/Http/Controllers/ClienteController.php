<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    public function index()
{
    // ADMIN
    if (auth()->user()->role === 'admin') {

        $clientes = Cliente::with('user', 'curso')->get();

        $cursos = Curso::all();

        $lixeira = Cliente::onlyTrashed()
            ->with('user', 'curso')
            ->get();

        $total = Cliente::count();
        $ativos = Cliente::count();
        $apagados = Cliente::onlyTrashed()->count();

        return view('admin.dashboard', compact(
            'clientes',
            'cursos',
            'lixeira',
            'total',
            'ativos',
            'apagados'
        ));
    }

    // PROFESSOR
    $clientes = Cliente::where('user_id', auth()->id())
        ->with('curso')
        ->get();

    $cursos = Curso::where('user_id', auth()->id())->get();

    return view('clientes.index', compact('clientes', 'cursos'));
}

    public function create()
    {
        if (auth()->user()->role === 'admin') {
            $cursos = Curso::all();
        } else {
            $cursos = Curso::where('user_id', auth()->id())->get();
        }
        return view('cod_form.index', compact('cursos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome'      => 'required',
            'email'     => 'required|email|unique:clientes',
            'linguagem' => 'required',
            'nivel'     => 'required',
            'imagem'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'curso_id'  => 'nullable|exists:cursos,id',
        ]);

        $data = $request->only(['nome', 'email', 'linguagem', 'nivel', 'curso_id']);
        $data['user_id'] = auth()->id();

        if ($request->hasFile('imagem')) {
            $data['imagem'] = $request->file('imagem')->store('clientes', 'public');
        }

        // Verifica se o curso pertence ao usuário autenticado (exceto admin)
        if (!empty($data['curso_id']) && auth()->user()->role !== 'admin') {
            $cursoValido = Curso::where('id', $data['curso_id'])->where('user_id', auth()->id())->exists();
            if (! $cursoValido) {
                return redirect()->back()->with('error', 'Curso inválido.');
            }
        }

        Cliente::create($data);
        return redirect()->route('clientes.index');
    }

    public function show(Cliente $cliente)
    {
        //
    }

    public function edit(Cliente $cliente)
    {
        if (auth()->user()->role === 'admin') {
            $cursos = Curso::all();
        } else {
            $cursos = Curso::where('user_id', auth()->id())->get();
        }
        return view('clientes.edit', compact('cliente', 'cursos'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nome'      => 'required',
            'email'     => 'required|email|unique:clientes,email,' . $cliente->id,
            'linguagem' => 'required',
            'nivel'     => 'required',
            'imagem'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'curso_id'  => 'nullable|exists:cursos,id',
        ]);

        $data = $request->only(['nome', 'email', 'linguagem', 'nivel', 'curso_id']);

        // Verifica se o curso pertence ao usuário autenticado (exceto admin)
        if (!empty($data['curso_id']) && auth()->user()->role !== 'admin') {
            $cursoValido = Curso::where('id', $data['curso_id'])->where('user_id', auth()->id())->exists();
            if (! $cursoValido) {
                return redirect()->back()->with('error', 'Curso inválido.');
            }
        }

        if ($request->hasFile('imagem')) {
            // Apaga a imagem antiga se existir
            if ($cliente->imagem) {
                Storage::disk('public')->delete($cliente->imagem);
            }
            $data['imagem'] = $request->file('imagem')->store('clientes', 'public');
        }

        $cliente->update($data);
        return redirect()->route('clientes.index');
    }

    public function destroy(Cliente $cliente)
    {
        // Soft delete — não apaga da BD, só marca como eliminado
        $cliente->delete();
        return redirect()->route('clientes.index');
    }
    public function lixeira()
    {
        if (auth()->user()->role === 'admin') {
            $clientes = Cliente::onlyTrashed()->with('user', 'curso')->get();
        } else {
            $clientes = Cliente::onlyTrashed()
                ->where('user_id', auth()->id())
                ->with('user', 'curso')
                ->get();
        }

        return view('clientes.lixeira', compact('clientes'));
    }
    public function restaurar($id)
    {
        $cliente = Cliente::onlyTrashed()->findOrFail($id);

        // SEGURANÇA: só admin ou dono pode restaurar
        if (
            auth()->user()->role !== 'admin' &&
            $cliente->user_id !== auth()->id()
        ) {
            abort(403);
        }

        $cliente->restore();

        return back();
    }
    public function forcarDeletar($id)
    {
        $cliente = Cliente::withTrashed()->findOrFail($id);

        // Apaga a imagem do storage antes de apagar o registo
        if ($cliente->imagem) {
            Storage::disk('public')->delete($cliente->imagem);
        }

        $cliente->forceDelete();

        return redirect()->route('clientes.lixeira')
            ->with('success', 'Cliente apagado definitivamente.');
    }
}
