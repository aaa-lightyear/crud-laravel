@extends('layouts.crud')
@section('content')

@once
<style>
.menu-modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(1, 4, 9, .7);
    z-index: 300;

    align-items: center;
    justify-content: center;
    padding: 20px;
}

.menu-modal-overlay.is-open {
    display: flex;
}

.menu-modal {
    width: 100%;
    max-width: 280px;

    background: #0d1117;
    border: 1px solid #21262d;
    border-radius: 12px;
    padding: 16px;

    display: flex;
    flex-direction: column;
    align-items: stretch;
    gap: 6px;
}

.menu-modal-title {
    color: #f0f6fc;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 4px;
    padding-bottom: 10px;
    border-bottom: 1px solid #21262d;
}

.menu-modal a {
    display: block;
}

.menu-modal-close {
    margin-top: 6px;
    width: 100%;
    padding: 7px 12px;
    background: transparent;
    border: 1px solid #30363d;
    border-radius: 6px;
    color: #8b949e;
    font-size: 12px;
    cursor: pointer;
    transition: .15s;
}

.menu-modal-close:hover {
    background: #161b22;
    color: #c9d1d9;
}

.btn-apagar {
    height: 26px;
    padding: 0 10px;
    font-size: 11px;
}
</style>
@endonce

<div class="dashboard">
    <div class="dashboard-header">
        <h1>Lista de Cursos</h1>
        <div class="dashboard-header-actions">
            <button type="button" id="menuToggle" class="btn-lixeira" style="cursor: pointer;">☰ Menu</button>
        </div>
    </div>

    <div class="menu-modal-overlay" id="menuModalOverlay">
        <div class="menu-modal">
            <p class="menu-modal-title">Ações</p>
            <a href="{{ route('cursos.create') }}" class="btn-cadastrar">+ Criar Curso</a>
            <a href="{{ route('cursos.lixeira') }}" class="btn-lixeira">🗑 Lixeira</a>
            <a href="{{ route('clientes.index') }}" class="btn-lixeira">← Voltar</a>
            <button type="button" class="menu-modal-close" id="menuModalClose">Fechar</button>
        </div>
    </div>

    <div class="tabela-wrapper">
        <table class="tabela">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome do Curso</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cursos as $curso)
                    <tr>
                        <td>{{ $curso->id }}</td>
                        <td>{{ $curso->nome }}</td>
                        <td>{{ $curso->created_at }}</td>
                        <td>
                            <form action="{{ route('cursos.destroy', $curso->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-apagar">
                                    Apagar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align:center; color:#8b949e;">
                            Nenhum curso encontrado
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const overlay = document.getElementById('menuModalOverlay');
        const toggle = document.getElementById('menuToggle');
        const close = document.getElementById('menuModalClose');

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