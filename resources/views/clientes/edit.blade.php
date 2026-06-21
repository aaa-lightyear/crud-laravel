@extends('layouts.crud')
@section('content')
    <div class="container3">
        <img src="{{ asset('imagens/laravel.png') }}" class="float1">
        <img src="{{ asset('imagens/mysql.png') }}" class="float2">
        <img src="{{ asset('imagens/python.png') }}" class="float3">

        <form action="/clientes/{{ $cliente->id }}" method="POST" class="form" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <h1 style="font-family: sans-serif; font-size:1.3rem; color: white;">Editar Aluno</h1>

            <input type="text" class="input_name" name="nome" value="{{ $cliente->nome }}" required>
            <input type="email" class="input_email" name="email" value="{{ $cliente->email }}" required>

            <select name="curso_id">

                <option value="" {{ $cliente->curso_id == null ? 'selected' : '' }}>
                    Sem curso
                </option>

                @foreach ($cursos as $curso)
                    <option value="{{ $curso->id }}" {{ $cliente->curso_id == $curso->id ? 'selected' : '' }}>
                        {{ $curso->nome }}
                    </option>
                @endforeach

            </select>

            <select name="nivel">
                <option value="Beginner" {{ $cliente->nivel == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                <option value="Intermediary" {{ $cliente->nivel == 'Intermediary' ? 'selected' : '' }}>Intermediary
                </option>
                <option value="Pro" {{ $cliente->nivel == 'Pro' ? 'selected' : '' }}>Pro</option>
            </select>

            <select name="linguagem">
                <option value="JavaScript" {{ $cliente->linguagem == 'JavaScript' ? 'selected' : '' }}>JavaScript</option>
                <option value="Python" {{ $cliente->linguagem == 'Python' ? 'selected' : '' }}>Python</option>
                <option value="Java" {{ $cliente->linguagem == 'Java' ? 'selected' : '' }}>Java</option>
                <option value="C#" {{ $cliente->linguagem == 'C#' ? 'selected' : '' }}>C#</option>
                <option value="C++" {{ $cliente->linguagem == 'C++' ? 'selected' : '' }}>C++</option>
                <option value="PHP" {{ $cliente->linguagem == 'PHP' ? 'selected' : '' }}>PHP</option>
                <option value="Go (Golang)" {{ $cliente->linguagem == 'Go (Golang)' ? 'selected' : '' }}>Go (Golang)
                </option>
            </select>

            <div class="foto-perfil-wrapper">
                @if ($cliente->imagem)
                    <img src="{{ asset('storage/' . $cliente->imagem) }}" class="foto-perfil-preview">
                @else
                    <div class="foto-perfil-placeholder"></div>
                @endif
                <label for="imagem" class="btn-foto">Escolher foto</label>
                <input type="file" name="imagem" id="imagem" accept="image/*" style="display:none;">
            </div>
            <button type="submit" class="login">Atualizar</button>
        </form>
    </div>
@endsection
