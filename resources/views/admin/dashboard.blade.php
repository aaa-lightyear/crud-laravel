<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
/* RESET */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background: #010409;
    color: #c9d1d9;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    min-height: 100vh;
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
    width: 100%;
    color: #f0f6fc;
    font-size: 16px;
    font-weight: 600;

    margin-bottom: 8px;
    padding-bottom: 12px;

    border-bottom: 1px solid #21262d;
}

/* CARDS DE ESTATÍSTICA */
.stat {
    width: 100%;
    padding: 12px 14px;

    background: #161b22;
    border: 1px solid #21262d;
    border-radius: 8px;
}

.stat h3 {
    color: #8b949e;
    font-size: 11px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.05em;

    margin-bottom: 4px;
}

.stat p {
    color: #f0f6fc;
    font-size: 24px;
    font-weight: 600;
}

.stat.green p { color: #3fb950; }
.stat.red p { color: #f85149; }

.sidebar-nav {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 4px;

    margin-top: 8px;
    flex: 1;
}

.btn-nav {
    width: 100%;
    display: block;
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
    width: 100%;
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

.content-header .subtitle {
    color: #8b949e;
    font-size: 13px;
    margin-top: 2px;
}

/* BOTÕES DE AÇÃO */
.btn-edit {
    display: inline-block;
    padding: 5px 12px;

    background: transparent;
    border: 1px solid #1f6feb44;
    border-radius: 5px;

    color: #388bfd;
    font-size: 12px;
    text-decoration: none;

    cursor: pointer;
    transition: .15s;
}

.btn-edit:hover { background: #1f6feb22; }

.btn-delete {
    padding: 5px 12px;

    background: transparent;
    border: 1px solid #f8514933;
    border-radius: 5px;

    color: #f85149;
    font-size: 12px;

    cursor: pointer;
    transition: .15s;
}

.btn-delete:hover { background: #f8514922; }

.btn-restore {
    padding: 5px 12px;

    background: transparent;
    border: 1px solid #3fb95033;
    border-radius: 5px;

    color: #3fb950;
    font-size: 12px;

    cursor: pointer;
    transition: .15s;
}

.btn-restore:hover { background: #3fb95022; }

/* TABELA WRAPPER — permite scroll horizontal sem quebrar o layout */
.tabela-wrapper {
    width: 100%;
    max-width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    border-radius: 10px;
}

/* TABELA */
.tabela {
    width: 100%;
    min-width: 560px;

    border-collapse: collapse;

    background: #0d1117;
    border: 1px solid #21262d;
    border-radius: 10px;

    overflow: hidden;

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

.tabela tbody tr {
    border-bottom: 1px solid #161b22;
    transition: background .1s;
}

.tabela tbody tr:hover {
    background: #161b22;
}

.tabela td {
    padding: 12px 16px;
}

td.acoes {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 6px;
    min-width: 160px;
}

td.acoes form {
    margin: 0;
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

/* MODAIS DE CONTEÚDO (Alunos, Cursos, Lixeira, Detalhes) */
.modal {
    display: none;
    position: fixed;
    inset: 0;

    background: rgba(0, 0, 0, .65);
    backdrop-filter: blur(6px);
    z-index: 1000;

    align-items: center;
    justify-content: center;
    padding: 20px;
}

.modal-box {
    width: 680px;
    max-width: 95vw;
    max-height: 85vh;

    padding: 24px;

    background: #0d1117;
    border: 1px solid #21262d;
    border-radius: 12px;

    overflow-y: auto;
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;

    margin-bottom: 20px;
    padding-bottom: 14px;

    border-bottom: 1px solid #21262d;
}

.modal-header h3 {
    color: #f0f6fc;
    font-size: 16px;
    font-weight: 600;
}

.btn-close {
    padding: 5px 10px;

    background: transparent;
    border: 1px solid #30363d;
    border-radius: 6px;

    color: #8b949e;
    font-size: 12px;

    cursor: pointer;
    transition: .15s;
}

.btn-close:hover {
    background: #161b22;
    color: #c9d1d9;
}

.detail-avatar {
    width: 72px;
    height: 72px;

    border-radius: 50%;
    border: 2px solid #388bfd;

    object-fit: cover;
    display: none;

    margin-bottom: 16px;
}

.detail-row {
    display: flex;
    gap: 8px;

    padding: 10px 0;

    border-bottom: 1px solid #21262d;

    font-size: 14px;
}

.detail-row .label {
    min-width: 90px;
    color: #8b949e;
}

/* MODAL DE MENU (mobile) */
.menu-modal-overlay {
    display: none;
    position: fixed;
    inset: 0;

    background: rgba(1, 4, 9, .7);
    z-index: 1100;

    align-items: flex-start;
    justify-content: center;
    padding: 20px;
    padding-top: 6vh;
}

.menu-modal-overlay.is-open {
    display: flex;
}

.menu-modal {
    width: 100%;
    max-width: 280px;
    max-height: 88vh;

    padding: 18px;

    background: #0d1117;
    border: 1px solid #21262d;
    border-radius: 12px;

    display: flex;
    flex-direction: column;
    align-items: stretch;
    gap: 8px;

    overflow-y: auto;
}

.menu-modal-title {
    color: #f0f6fc;
    font-size: 14px;
    font-weight: 600;

    margin-bottom: 6px;
    padding-bottom: 10px;

    border-bottom: 1px solid #21262d;
}

.menu-modal .stat {
    margin-bottom: 4px;
}

.menu-modal .btn-nav,
.menu-modal .btn-logout {
    width: 100%;
    text-align: left;
    font-size: 13px;
    padding: 9px 12px;
}

.menu-modal-close {
    width: 100%;
    margin-top: 6px;
    padding: 8px 12px;

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

        background: #0d1117;
        border-bottom: 1px solid #21262d;
    }

    .topbar-mobile h1 {
        color: #f0f6fc;
        font-size: 16px;
        font-weight: 600;
    }

    .btn-menu-toggle {
        width: 32px;
        height: 32px;
        flex-shrink: 0;

        display: flex;
        align-items: center;
        justify-content: center;

        background: #161b22;
        border: 1px solid #30363d;
        border-radius: 6px;

        color: #c9d1d9;
        font-size: 14px;

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

    td.acoes {
        min-width: unset;
    }
}
    </style>
</head>
<body>

<div class="wrapper">

    <div class="topbar-mobile">
        <h1>Painel DG (Admin)</h1>
        <button type="button" class="btn-menu-toggle" id="menuToggle" aria-label="Abrir menu">☰</button>
    </div>

    <aside class="sidebar">
        <p class="sidebar-title">Admin Panel</p>

        <div class="stat">
            <h3>Total alunos</h3>
            <p>{{ $total }}</p>
        </div>
        <div class="stat green">
            <h3>Ativos</h3>
            <p>{{ $ativos }}</p>
        </div>
        <div class="stat red">
            <h3>Apagados</h3>
            <p>{{ $apagados }}</p>
        </div>

        <nav class="sidebar-nav">
            <button class="btn-nav active" onclick="openModal('modalAlunos')">Ver alunos</button>
            <button class="btn-nav" onclick="openModal('modalCursos')">Ver cursos</button>
            <button class="btn-nav" onclick="openModal('modalLixeira')">Lixeira</button>
        </nav>

        <div class="sidebar-footer">
            <form action="/logout" method="POST">
                @csrf
                <button class="btn-logout" type="submit">Logout</button>
            </form>
        </div>
    </aside>

    <!-- MODAL DE MENU — só usado no mobile -->
    <div class="menu-modal-overlay" id="menuModalOverlay">
        <div class="menu-modal">
            <p class="menu-modal-title">Menu</p>

            <div class="stat">
                <h3>Total alunos</h3>
                <p>{{ $total }}</p>
            </div>
            <div class="stat green">
                <h3>Ativos</h3>
                <p>{{ $ativos }}</p>
            </div>
            <div class="stat red">
                <h3>Apagados</h3>
                <p>{{ $apagados }}</p>
            </div>

            <button type="button" class="btn-nav active" onclick="openModal('modalAlunos'); closeMenuModal();">Ver alunos</button>
            <button type="button" class="btn-nav" onclick="openModal('modalCursos'); closeMenuModal();">Ver cursos</button>
            <button type="button" class="btn-nav" onclick="openModal('modalLixeira'); closeMenuModal();">Lixeira</button>

            <form action="/logout" method="POST">
                @csrf
                <button class="btn-logout" type="submit">Logout</button>
            </form>

            <button type="button" class="menu-modal-close" id="menuModalClose">Fechar</button>
        </div>
    </div>

    <main class="content">
        <div class="content-header">
            <div>
                <h1>Painel DG (Admin)</h1>
                <p class="subtitle">Bem-vindo, {{ auth()->user()->name }}</p>
            </div>
        </div>

        <div class="tabela-wrapper">
            <table class="tabela">
                <thead>
                    <tr>
                        <th>Aluno</th>
                        <th>Professor</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->nome }}</td>
                            <td>{{ $cliente->user->name }}</td>
                            <td class="acoes">
                                <button class="btn-edit"
                                    onclick="openDetails(
                                        '{{ $cliente->nome }}',
                                        '{{ $cliente->email }}',
                                        '{{ $cliente->linguagem }}',
                                        '{{ $cliente->nivel }}',
                                        '{{ $cliente->curso->nome ?? 'Sem curso' }}',
                                        '{{ $cliente->user->name }}',
                                        '{{ $cliente->imagem ? asset('storage/' . $cliente->imagem) : '' }}'
                                    )">
                                    Ver mais
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</div>

{{-- MODAL: ALUNOS --}}
<div class="modal" id="modalAlunos" onclick="if(event.target===this) closeModals()">
    <div class="modal-box">
        <div class="modal-header">
            <h3>Alunos</h3>
            <button class="btn-close" onclick="closeModals()">Fechar</button>
        </div>
        <div class="tabela-wrapper">
            <table class="tabela">
                <thead><tr><th>Nome</th><th>Professor</th></tr></thead>
                <tbody>
                    @foreach ($clientes as $c)
                        <tr><td>{{ $c->nome }}</td><td>{{ $c->user->name }}</td></tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL: CURSOS --}}
<div class="modal" id="modalCursos" onclick="if(event.target===this) closeModals()">
    <div class="modal-box">
        <div class="modal-header">
            <h3>Cursos</h3>
            <button class="btn-close" onclick="closeModals()">Fechar</button>
        </div>
        <div class="tabela-wrapper">
            <table class="tabela">
                <thead><tr><th>Curso</th></tr></thead>
                <tbody>
                    @foreach ($cursos as $curso)
                        <tr><td>{{ $curso->nome }}</td></tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL: LIXEIRA --}}
<div class="modal" id="modalLixeira" onclick="if(event.target===this) closeModals()">
    <div class="modal-box">
        <div class="modal-header">
            <h3>Lixeira</h3>
            <button class="btn-close" onclick="closeModals()">Fechar</button>
        </div>
        <div class="tabela-wrapper">
            <table class="tabela">
                <thead><tr><th>Aluno</th><th>Professor</th><th>Ação</th></tr></thead>
                <tbody>
                    @foreach ($lixeira as $aluno)
                        <tr>
                            <td>{{ $aluno->nome }}</td>
                            <td>{{ $aluno->user->name }}</td>
                            <td class="acoes">
                                <form method="POST" action="{{ route('clientes.restaurar', $aluno->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn-restore" type="submit">Restaurar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL: DETALHES --}}
<div class="modal" id="modalDetalhes" onclick="if(event.target===this) closeModals()">
    <div class="modal-box">
        <img id="detalhe-foto" class="detail-avatar" alt="Foto do aluno">
        <div class="modal-header">
            <h3>Detalhes do Aluno</h3>
            <button class="btn-close" onclick="closeModals()">Fechar</button>
        </div>
        <div class="detail-row"><span class="label">Nome</span><span id="d-nome"></span></div>
        <div class="detail-row"><span class="label">Email</span><span id="d-email"></span></div>
        <div class="detail-row"><span class="label">Linguagem</span><span id="d-linguagem"></span></div>
        <div class="detail-row"><span class="label">Nível</span><span id="d-nivel"></span></div>
        <div class="detail-row"><span class="label">Curso</span><span id="d-curso"></span></div>
        <div class="detail-row"><span class="label">Professor</span><span id="d-professor"></span></div>
    </div>
</div>

<script>
    function openModal(id) {
        document.getElementById(id).style.display = 'flex';
    }
    function closeModals() {
        document.querySelectorAll('.modal').forEach(m => m.style.display = 'none');
    }
    function openDetails(nome, email, linguagem, nivel, curso, professor, foto) {
        document.getElementById('d-nome').textContent      = nome;
        document.getElementById('d-email').textContent     = email;
        document.getElementById('d-linguagem').textContent = linguagem;
        document.getElementById('d-nivel').textContent     = nivel;
        document.getElementById('d-curso').textContent     = curso;
        document.getElementById('d-professor').textContent = professor;
        const img = document.getElementById('detalhe-foto');
        if (foto) { img.src = foto; img.style.display = 'block'; }
        else { img.style.display = 'none'; }
        openModal('modalDetalhes');
    }

    document.addEventListener('DOMContentLoaded', function () {
        const menuOverlay = document.getElementById('menuModalOverlay');
        const menuToggle = document.getElementById('menuToggle');
        const menuClose = document.getElementById('menuModalClose');

        function openMenuModal() {
            menuOverlay.classList.add('is-open');
        }

        window.closeMenuModal = function () {
            menuOverlay.classList.remove('is-open');
        };

        menuToggle.addEventListener('click', openMenuModal);
        menuClose.addEventListener('click', closeMenuModal);

        menuOverlay.addEventListener('click', function (e) {
            if (e.target === menuOverlay) closeMenuModal();
        });
    });
</script>

</body>
</html>