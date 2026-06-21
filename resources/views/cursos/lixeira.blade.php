@extends('layouts.crud')

@section('content')
<div class="dashboard">

    <div class="dashboard-header">
        <h1>🗑 Lixeira de Cursos</h1>

        <a href="{{ route('cursos.index') }}" class="btn-lixeira">
            ← Voltar
        </a>
    </div>

    {{-- MENSAGENS --}}
    @if (session('success'))
        <div style="color:#3fb950; margin-bottom:10px;">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div style="color:#f85149; margin-bottom:10px;">
            {{ session('error') }}
        </div>
    @endif

    <table class="tabela">
        <thead>
            <tr>
                <th>ID</th>
                <th>Curso</th>
                <th>Eliminado em</th>
                <th style="text-align:right;">Ações</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($cursos as $curso)
                <tr>
                    <td>{{ $curso->id }}</td>
                    <td>{{ $curso->nome }}</td>
                    <td>{{ $curso->deleted_at }}</td>

                    <td>
                        <div class="acoes" style="justify-content:flex-end;">

                            {{-- Restaurar --}}
                            <form action="{{ route('cursos.restaurar', $curso->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button class="btn-restaurar">
                                    Restaurar
                                </button>
                            </form>

                            {{-- Apagar definitivo --}}
                            <form action="{{ route('cursos.forcar', $curso->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn-apagar">
                                    Apagar
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align:center; color:#8b949e; padding:20px;">
                        A lixeira está vazia
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection