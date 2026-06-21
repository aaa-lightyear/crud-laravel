@extends('layouts.crud')
@section('content')
<div class="dashboard">
    <div class="dashboard-header">
        <h1>Lixeira</h1>
        <div class="dashboard-header-actions">
            <a href="/clientes" class="btn-cadastrar">
                ← Voltar
            </a>
        </div>
    </div>

    @if (session('success'))
        <div style="color:#3fb950; margin-bottom:15px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="tabela-wrapper">
        <table class="tabela">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Linguagem</th>
                    <th>Nível</th>
                    <th>Curso</th>
                    <th>Foto</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->nome }}</td>
                        <td>{{ $cliente->email }}</td>
                        <td>{{ $cliente->linguagem }}</td>
                        <td>{{ $cliente->nivel }}</td>
                        <td>
                            {{ optional($cliente->curso)->nome ?? 'Sem curso' }}
                        </td>
                        <td>
                            @if ($cliente->imagem)
                                <img
                                    src="{{ asset('storage/' . $cliente->imagem) }}"
                                    width="40"
                                    height="40"
                                    style="border-radius:50%; object-fit:cover;"
                                >
                            @else
                                —
                            @endif
                        </td>
                        <td>
                            <div class="acoes">
                                <form action="/clientes/{{ $cliente->id }}/restaurar" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn-restaurar">
                                        Restaurar
                                    </button>
                                </form>
                                <form action="/clientes/{{ $cliente->id }}/forcar-deletar" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-apagar">
                                        Apagar definitivo
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center; padding:20px;">
                            Nenhum cliente na lixeira.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection