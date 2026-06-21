@extends('layouts.crud')
@section('body-class', 'center-vertical')
@section('content')
<div class="container2">
    <img src="{{ asset('imagens/laravel.png') }}" class="float1">
    <img src="{{ asset('imagens/mysql.png') }}" class="float2">
    <img src="{{ asset('imagens/python.png') }}" class="float3">

    <form action="{{ route('cursos.store') }}" method="POST" class="form">
        @csrf
        <h1 style="font-family: sans-serif; font-size:1.3rem; color:#e6edf3;">
            Criar Curso
        </h1>

        <input type="text"
               name="nome"
               placeholder="Nome do curso"
               class="input_name"
               required>

        <button type="submit" class="login">
            Guardar
        </button>

        <a href="{{ route('clientes.index') }}"
           class="btn-lixeira"
           style="width:100%; max-width:200px; align-self:center; box-sizing:border-box; height:46px; display:flex; align-items:center; justify-content:center; text-decoration:none; text-align:center;">
            ← Voltar à tabela
        </a>
    </form>
</div>
@endsection