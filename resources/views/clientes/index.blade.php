@extends('layouts.crud')
@section('content')

@once
<style>
/* RESET */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html,
body {
    height: 100%;
}

body {
    background: #010409;
    color: #c9d1d9;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    min-height: 100vh;
    margin: 0 !important;
    padding: 0 !important;
}

/* LAYOUT */
.wrapper {
    display: flex;
    min-height: 100vh;
    width: 100%;
    max-width: 100vw;
    overflow-x: hidden;
}

/* TOPBAR MOBILE */
.topbar-mobile {
    display: none;
}

/* SIDEBAR */
.sidebar {
    position: fixed;
    top: 0;
    left: 0;

    width: 260px;
    height: 100vh;

    padding: 24px 20px;

    background: #0d1117;
    border-right: 1px solid #21262d;

    display: flex;
    flex-direction: column;
    gap: 8px;

    overflow-y: auto;
}

.sidebar-title {
    color: #f0f6fc;
    font-size: 16px;
    font-weight: 600;

    margin-bottom: 8px;
    padding-bottom: 12px;

    border-bottom: 1px solid #21262d;
}

.sidebar-nav {
    display: flex;
    flex-direction: column;
    gap: 4px;

    margin-top: 8px;
    flex: 1;
}

.btn-nav {
    width: 100%;
    padding: 8px 12px;

    background: transparent;
    border: 1px solid transparent;
    border-radius: 6px;

    color: #8b949e;
    font-size: 13px;
    text-decoration: none;
    text-align: left;

    cursor: pointer;
    transition: .15s;
}

.btn-nav:hover {
    background: #161b22;
    border-color: #30363d;
    color: #c9d1d9;
}

.btn-nav.active {
    background: #1f6feb22;
    border-color: #1f6feb44;
    color: #388bfd;
}

.sidebar-footer {
    margin-top: auto;
    padding-top: 12px;
    border-top: 1px solid #21262d;
}

.btn-logout {
    width: 100%;
    padding: 8px 12px;

    background: transparent;
    border: 1px solid #f8514933;
    border-radius: 6px;

    color: #f85149;
    font-size: 13px;
    text-align: left;

    cursor: pointer;
    transition: .15s;
}

.btn-logout:hover {
    background: #f8514922;
}

/* CONTENT */
.content {
    width: 100%;
    max-width: 100%;
    margin-left: 260px;
    padding: 32px;
    overflow-x: hidden;
}

.content-header {
    display: flex;
    justify-content: space-between;
    align-items: center;

    margin-bottom: 24px;
    padding-bottom: 16px;

    border-bottom: 1px solid #21262d;
}

.content-header h1 {
    color: #f0f6fc;
    font-size: 20px;
    font-weight: 600;
}

.subtitle {
    color: #8b949e;
    font-size: 13px;
    margin-top: 2px;
}

/* TABELA WRAPPER — garante o scroll horizontal, não a página inteira */
.tabela-wrapper {
    width: 100%;
    max-width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    border-radius: 10px;
    border: 1px solid #21262d;
}

/* TABELA */
.tabela {
    width: 100%;
    min-width: 700px;

    border-collapse: collapse;

    background: #0d1117;

    color: #c9d1d9;
    font-size: 14px;
}

.tabela thead tr {
    border-bottom: 1px solid #21262d;
}

.tabela th {
    background: #161b22;

    padding: 10px 16px;

    color: #6e7681;
    font-size: 11px;
    font-weight: 500;
    text-align: left;
    text-transform: uppercase;
    letter-spacing: .06em;
    white-space: nowrap;
}

.tabela td {
    padding: 12px 16px;
}

.tabela tbody tr {
    border-bottom: 1px solid #161b22;
    transition: background .1s;
}

.tabela tbody tr:last-child {
    border-bottom: none;
}

.tabela tbody tr:hover {
    background: #161b22;
}

/* COLUNA AÇÕES */
.tabela th:last-child,
.tabela td:last-child {
    width: 150px;
    text-align: left;
}

td.acoes {
    display: flex;
    flex-direction: row;
    flex-wrap: nowrap;
    align-items: center;
    gap: 6px;
}

td.acoes form {
    margin: 0;
}

/* BOTÕES */
.btn-edit,
.btn-delete {
    width: 64px;
    height: 28px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 5px;

    font-size: 12px;
    text-decoration: none;

    cursor: pointer;
    transition: .15s;
}

.btn-edit {
    background: transparent;
    border: 1px solid #1f6feb44;
    color: #388bfd;
}

.btn-edit:hover {
    background: #1f6feb22;
}

.btn-delete {
    background: transparent;
    border: 1px solid #f8514933;
    color: #f85149;
}

.btn-delete:hover {
    background: #f8514922;
}

/* AVATAR */
.avatar {
    width: 36px;
    height: 36px;

    border-radius: 50%;
    border: 2px solid #388bfd33;

    object-fit: cover;
    display: block;
}

/* MODAL DE AÇÕES (mobile) */
.acoes-modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(1, 4, 9, .35);
    backdrop-filter: blur(6px);
    -webkit-backdrop-filter: blur(6px);
    z-index: 300;

    align-items: center;
    justify-content: center;
    padding: 20px;
}

.acoes-modal-overlay.is-open {
    display: flex;
}

.acoes-modal {
    width: 100%;
    max-width: 320px;

    background: #0d1117;
    border: 1px solid #21262d;
    border-radius: 12px;
    padding: 20px;

    display: flex;
    flex-direction: column;
    gap: 8px;
}

.acoes-modal-title {
    color: #f0f6fc;
    font-size: 15px;
    font-weight: 600;
    margin-bottom: 8px;
    padding-bottom: 12px;
    border-bottom: 1px solid #21262d;
}

.acoes-modal .btn-nav,
.acoes-modal .btn-logout {
    font-size: 14px;
    padding: 10px 12px;
}

.acoes-modal-close {
    margin-top: 4px;
    width: 100%;
    padding: 10px 12px;
    background: transparent;
    border: 1px solid #30363d;
    border-radius: 6px;
    color: #8b949e;
    font-size: 13px;
    cursor: pointer;
    transition: .15s;
}

.acoes-modal-close:hover {
    background: #161b22;
    color: #c9d1d9;
}

/* MOBILE */
@media (max-width: 768px) {

    .sidebar {
        display: none;
    }
    .topbar-mobile {
        display: flex;
        align-items: center;
        justify-content: space-between;

        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        width: 100%;
        z-index: 120;

        padding: 14px 16px;
        margin: 0;

        background: #0d1117;
        border-bottom: 1px solid #21262d;
    }

    .topbar-mobile h1 {
        color: #f0f6fc;
        font-size: 16px;
        font-weight: 600;
    }

    .btn-menu-toggle {
        width: 36px;
        height: 36px;
        flex-shrink: 0;

        display: flex;
        align-items: center;
        justify-content: center;

        background: #161b22;
        border: 1px solid #30363d;
        border-radius: 6px;

        color: #c9d1d9;
        font-size: 16px;
        cursor: pointer;
    }

    .content {
        margin-left: 0;
        padding: 16px;
        padding-top: 76px;
    }

    .content-header {
        display: none;
    }

    .tabela {
        font-size: 12px;
    }

    .tabela th,
    .tabela td {
        padding: 8px;
    }

    .tabela th:last-child,
    .tabela td:last-child {
        width: 74px;
    }

    td.acoes {
        flex-direction: column;
        align-items: stretch;
        gap: 4px;
    }

    .btn-edit,
    .btn-delete {
        width: 100%;
        height: 26px;
        font-size: 11px;
    }
}
</style>
@endonce

<div class="wrapper">

    <div class="topbar-mobile">
        <h1>Lista de alunos</h1>
        <button type="button" class="btn-menu-toggle" id="menuToggle" aria-label="Abrir menu de ações">☰</button>
    </div>

    <aside class="sidebar">
        <p class="sidebar-title">Painel do Professor</p>

        <nav class="sidebar-nav">
            <a href="/clientes" class="btn-nav active">Lista de alunos</a>
            <a href="/clientes/create" class="btn-nav">+ Cadastrar aluno</a>
            <a href="{{ route('cursos.create') }}" class="btn-nav">+ Criar curso</a>
            <a href="{{ route('cursos.index') }}" class="btn-nav">Ver cursos</a>
            <a href="/clientes/lixeira" class="btn-nav">Lixeira</a>
        </nav>

        <div class="sidebar-footer">
            <form action="/logout" method="POST">
                @csrf
                <button class="btn-logout" type="submit">Logout</button>
            </form>
        </div>
    </aside>

    <!-- MODAL DE AÇÕES — só usado no mobile via topbar -->
    <div class="acoes-modal-overlay" id="acoesModalOverlay">
        <div class="acoes-modal">
            <p class="acoes-modal-title">Ações</p>

            <a href="/clientes" class="btn-nav active">Lista de alunos</a>
            <a href="/clientes/create" class="btn-nav">+ Cadastrar aluno</a>
            <a href="{{ route('cursos.create') }}" class="btn-nav">+ Criar curso</a>
            <a href="{{ route('cursos.index') }}" class="btn-nav">Ver cursos</a>
            <a href="/clientes/lixeira" class="btn-nav">Lixeira</a>

            <form action="/logout" method="POST">
                @csrf
                <button class="btn-logout" type="submit" style="width:100%;">Logout</button>
            </form>

            <button type="button" class="acoes-modal-close" id="acoesModalClose">Fechar</button>
        </div>
    </div>

    <main class="content">
        <div class="content-header">
            <div>
                <h1>Lista de alunos</h1>
                <p class="subtitle">{{ $clientes->count() }} aluno(s) registado(s)</p>
            </div>
        </div>

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
                    @foreach ($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->nome }}</td>
                            <td>{{ $cliente->email }}</td>
                            <td>{{ $cliente->linguagem }}</td>
                            <td>{{ $cliente->nivel }}</td>
                            <td>{{ optional($cliente->curso)->nome ?? '—' }}</td>
                            <td>
                                @if ($cliente->imagem)
                                    <img class="avatar"
                                         src="{{ asset('storage/' . $cliente->imagem) }}"
                                         alt="Foto de {{ $cliente->nome }}">
                                @else
                                    <span style="color:#6e7681;">—</span>
                                @endif
                            </td>
                            <td class="acoes">
                                <a href="/clientes/{{ $cliente->id }}/edit" class="btn-edit">Editar</a>
                                <form action="/clientes/{{ $cliente->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">Apagar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const overlay = document.getElementById('acoesModalOverlay');
        const toggle = document.getElementById('menuToggle');
        const close = document.getElementById('acoesModalClose');

        function openModal() {
            overlay.classList.add('is-open');
        }

        function closeModal() {
            overlay.classList.remove('is-open');
        }

        toggle.addEventListener('click', openModal);
        close.addEventListener('click', closeModal);

        overlay.addEventListener('click', function (e) {
            if (e.target === overlay) closeModal();
        });
    });
</script>

@endsection