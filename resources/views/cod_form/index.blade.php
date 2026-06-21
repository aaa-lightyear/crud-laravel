@extends('layouts.crud')
@section('content')
<div class="container" style="max-width: 400px;">
    <img src="{{ asset('imagens/laravel.png') }}" class="float1">
    <img src="{{ asset('imagens/mysql.png') }}" class="float2">
    <img src="{{ asset('imagens/python.png') }}" class="float3">

    <form action="/clientes" method="post" class="form" enctype="multipart/form-data">
        @csrf
        <input type="text" class="input_name" name="nome" placeholder="Nome">
        @error('nome') <span style="color: #f85149; font-size: 12px;">⚠ {{ $message }}</span> @enderror

        <input type="email" class="input_email" name="email" placeholder="E-mail">
        @error('email') <span style="color: #f85149; font-size: 12px;">⚠ {{ $message }}</span> @enderror

        <select name="linguagem">
            <option value="escolha">Linguagem</option>
            <option value="JavaScript">JavaScript</option>
            <option value="Python">Python</option>
            <option value="Java">Java</option>
            <option value="C#">C#</option>
            <option value="C++">C++</option>
            <option value="PHP">PHP</option>
            <option value="Go (Golang)">Go</option>
        </select>

        <div style="display: flex; gap: 8px;">
            <select name="nivel" style="flex: 1;">
                <option value="nivel">Nível</option>
                <option value="Beginner">Beginner</option>
                <option value="Intermediary">Intermediary</option>
                <option value="Pro">Pro</option>
            </select>
            <select name="curso_id" style="flex: 1;">
                <option value="">Curso</option>
                @foreach($cursos as $curso)
                    <option value="{{ $curso->id }}">{{ $curso->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="foto-perfil-wrapper">
            <div class="foto-perfil-placeholder" id="placeholder"></div>
            <img id="preview" class="foto-perfil-preview" style="display:none;" src="" alt="preview">
            <label for="imagem" class="btn-foto">Escolher foto</label>
            <input type="file" name="imagem" id="imagem" accept="image/*" style="display:none;">
        </div>

        <button type="submit" class="login">Cadastrar</button>
    </form>
</div>

<script>
    document.getElementById('imagem').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview').src = e.target.result;
                document.getElementById('preview').style.display = 'block';
                document.getElementById('placeholder').style.display = 'none';
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection