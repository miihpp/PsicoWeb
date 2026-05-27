<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

$nome_usuario = $_SESSION['nome_usuario'];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Início | Paciente </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
</head>

<body>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: system-ui, 'Segoe UI', 'Roboto', 'Helvetica Neue', sans-serif;
            background: url(./img/BGTCC.png) no-repeat center center fixed;
            background-size: cover;
            color: var(--texto-principal);
            line-height: 1.5;
            min-height: 100vh;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
        }

        .site-wrapper {
            position: relative;
            z-index: 2;
            max-width: 1280px;
            margin: 0 auto;
            padding: 2rem 2rem 3rem;
        }

        :root {
            --verde-principal: #4CAF8C;
            --verde-escuro: #2E8B57;
            --verde-claro: #A8E6CF;
            --verde-suave: #E8F5F0;

            --roxo-principal: #9B7BB5;
            --roxo-escuro: #6B4E8A;
            --roxo-claro: #D4C5E8;
            --roxo-suave: #F3EDF8;

            --laranja-principal: #F4A261;
            --laranja-escuro: #E76F51;
            --laranja-claro: #FFD6B5;
            --laranja-suave: #FFF4E8;

            --branco: #FFFFFF;
            --cinza-claro: #F5F7FA;
            --cinza-medio: #CFD8DC;
            --cinza-escuro: #455A64;
            --texto-principal: #2C3E50;
            --texto-secundario: #546E7A;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--verde-escuro);
        }

        .logo-area {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .logo-img {
            height: 58px;
            width: auto;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.05));
        }

        .logo-text {
            font-size: 1.6rem;
            font-weight: 600;
            letter-spacing: -0.3px;
            background: linear-gradient(135deg, var(--verde-escuro) 0%, var(--roxo-principal) 100%);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
        }

        .nav-links {
            display: flex;
            gap: 1.8rem;
        }

        .nav-links a {
            text-decoration: none;
            font-weight: 500;
            color: var(--texto-secundario);
            transition: color 0.2s;
            font-size: 1rem;
        }

        .nav-links a:hover {
            color: var(--verde-principal);
        }

        .card {
            background: var(--branco);
            border-radius: 32px;
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.05), 0 2px 4px rgba(0, 0, 0, 0.02);
            padding: 1.8rem 2rem;
            transition: transform 0.2s ease, box-shadow 0.2s;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 30px -12px rgba(0, 0, 0, 0.1);
        }

        .hero-section {
            margin-bottom: 2.5rem;
            background: linear-gradient(120deg, var(--branco) 0%, var(--roxo-suave) 100%);
            border-left: 8px solid var(--roxo-principal);
        }

        .welcome-badge {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--texto-principal);
        }

        .welcome-badge span {
            background: linear-gradient(130deg, var(--roxo-principal), var(--laranja-escuro));
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
        }

        .intro-text {
            font-size: 1.1rem;
            color: var(--texto-secundario);
            max-width: 85%;
            margin-top: 0.75rem;
        }

        .grid-ideias {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin: 2.5rem 0;
        }

        .ideia-card {
            background: var(--branco);
            border-radius: 28px;
            transition: all 0.2s;
            border: 1px solid var(--verde-claro);
            background-color: var(--branco);
        }

        .ideia-card .card-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.2rem;
        }

        .icone-wrapper {
            width: 52px;
            height: 52px;
            background: var(--verde-suave);
            border-radius: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            font-weight: 500;
            color: var(--verde-principal);
        }

        .ideia-card h3 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--roxo-escuro);
        }

        .ideia-card p {
            color: var(--texto-secundario);
            margin: 0.8rem 0 1.2rem;
        }

        .btn-acao {
            display: inline-flex;
            align-items: center;
            background-color: var(--verde-principal);
            color: white;
            padding: 0.65rem 1.4rem;
            border-radius: 60px;
            font-weight: 600;
            text-decoration: none;
            transition: 0.2s, transform 0.1s;
            border: none;
            font-size: 0.9rem;
            cursor: pointer;
        }

        .btn-acao:hover {
            background-color: var(--verde-escuro);
            transform: scale(0.98);
        }

        .btn-secundario {
            background-color: var(--verde-principal);
        }

        .btn-secundario:hover {
            background-color: var(--verde-escuro);
        }

        .tabela-destaque {
            background: var(--laranja-suave);
            border-radius: 32px;
            margin-top: 2rem;
            border-right: 4px solid var(--laranja-principal);
        }

        .flex-info {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 1.5rem;
        }

        .info-texto {
            flex: 2;
        }

        .info-texto p {
            margin-top: 0.5rem;
            color: var(--cinza-escuro);
        }

        .exemplo-mini {
            flex: 1;
            background: var(--branco);
            padding: 1rem 1.5rem;
            border-radius: 24px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.03);
            border: 1px solid var(--roxo-principal);
        }

        .exemplo-mini h4 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.6rem;
            color: var(--laranja-escuro);
        }

        .tabela-exemplo {
            font-size: 0.85rem;
            width: 100%;
            border-collapse: collapse;
        }

        .tabela-exemplo td,
        .tabela-exemplo th {
            padding: 0.3rem 0.2rem;
            border-bottom: 1px dashed var(--cinza-medio);
            text-align: left;
        }

        footer {
            margin-top: 3.5rem;
            text-align: center;
            font-size: 0.85rem;
            color: var(--cinza-escuro);
            border-top: 1px solid var(--cinza-medio);
            padding-top: 2rem;
        }

        @media (max-width: 700px) {
            .site-wrapper {
                padding: 1.2rem;
            }

            .welcome-badge {
                font-size: 1.6rem;
            }

            .intro-text {
                max-width: 100%;
            }

            .flex-info {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        .user-name {
            font-weight: 800;
            background: linear-gradient(145deg, var(--verde-escuro), var(--roxo-principal));
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
        }
    </style>

    <div class="site-wrapper">
        <div class="top-bar">
            <div class="logo-area">
                <img src="img/LogoTCC.png" alt="Logo" class="logo-img"
                    onerror="this.onerror=null; this.src=&#39;data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20100%20100%22%3E%3Ccircle%20cx%3D%2250%22%20cy%3D%2250%22%20fill%3D%22%234CAF8C%22%20r%3D%2245%22%2F%3E%3Ctext%20x%3D%2250%25%22%20y%3D%2250%25%22%20dominant-baseline%3D%22middle%22%20text-anchor%3D%22middle%22%20fill%3D%22white%22%20font-size%3D%2240%22%3ET%3C%2Ftext%3E%3C%2Fsvg%3E&#39;">
                <span class="logo-text">Bem Vindo!</span>
            </div>
            <div class="nav-links">
                <a href="painel.php">Início</a>
                <a href="#">Minhas Tabelas</a>
                <a href="#">Perfil</a>
                <a href="logout.php">Sair</a>
            </div>
        </div>

        <div class="card hero-section">
            <div class="welcome-badge">
                Bem vindo, <span class="user-name"><?php echo htmlspecialchars($nome_usuario); ?></span>
            </div>
            <div class="intro-text">
                Este espaço foi criado para apoiar a sua jornada terapêutica.
                O registro de sentimentos e emoções fortalece o autoconhecimento e auxilia seu psicólogo
                a conduzir as sessões com mais profundidade e acolhimento, evitando que o paciente esqueça seus
                pensamentos.
                Abaixo você encontra ideias e ferramentas para começar.
            </div>
        </div>

        <h2 style="font-size: 1.6rem; margin-bottom: 0.5rem; color: var(--roxo-escuro);">Ferramentas e recursos</h2>
        <p style="margin-bottom: 1.5rem; color: var(--texto-secundario);">Explore atividades que promovem o registro
            emocional e a comunicação com seu terapeuta.</p>

        <div class="grid-ideias">
            <div class="ideia-card card">
                <div class="card-header">
                    <div class="icone-wrapper"><i class="bx bx-table"></i></div>
                    <h3>Registro de Pensamentos</h3>
                </div>
                <p>Crie registros diários ou semanais das suas emoções. Identifique gatilhos, intensidade e contexto.
                </p>
                <a href="file:///H:/Carol%20e%20Rafa%203ds/TCC/Images/INDEX.html#" class="btn-acao"
                    id="btnTabelaSentimentos">Construir tabela</a>
            </div>

            <div class="ideia-card card">
                <div class="card-header">
                    <div class="icone-wrapper"><i class="bx bx-bar-chart-alt-2"></i></div>
                    <h3>Evolução emocional</h3>
                </div>
                <p>Visualize a frequência dos sentimentos ao longo da semana. Compare padrões e compartilhe com seu
                    psicólogo para direcionar o foco da conversa.</p>
                <a href="file:///H:/Carol%20e%20Rafa%203ds/TCC/Images/INDEX.html#" class="btn-acao btn-secundario">Ver
                    indicadores</a>
            </div>

            <div class="ideia-card card">
                <div class="card-header">
                    <div class="icone-wrapper"><i class="bx bx-edit"></i></div>
                    <h3>Diário Terapêutico</h3>
                </div>
                <p>Registre pensamentos automáticos. Associe a sentimentos específicos para aprofundar a compreensão do
                    seu processo terapêutico.</p>
                <a href="file:///H:/Carol%20e%20Rafa%203ds/TCC/Images/INDEX.html#" class="btn-acao">Acessar diário</a>
            </div>
        </div>

        <div class="card tabela-destaque">
            <div class="flex-info">
                <div class="info-texto">
                    <h3 style="color: var(--laranja-escuro); font-size: 1.5rem;">Como usar o seu registro de
                        pensamentos?</h3>
                    <p>Anote situação, pensamento associado, sentimento e comportamento.
                        Seu psicólogo terá acesso a essa tabela, um mapa claro do seu momento emocional,
                        facilitando suas consultas</p>
                    <a href="file:///H:/Carol%20e%20Rafa%203ds/TCC/Images/INDEX.html#" class="btn-acao"
                        style="background-color: var(--laranja-principal); margin-top: 0.8rem; display: inline-block;">Criar
                        minha tabela</a>
                </div>
                <div class="exemplo-mini">
                    <h4>Exemplo rápido</h4>
                    <table class="tabela-exemplo">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Situação</th>
                                <th>Pensamento</th>
                                <th>Sentimento</th>
                                <th>Comportamento</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Segunda</td>
                                <td>Briga</td>
                                <td>Por que isso aconreceu?</td>
                                <td>tristeza</td>
                                <td>chorar</td>
                            </tr>
                            <tr>
                                <td>Terça</td>
                                <td>Nota baixa</td>
                                <td>Sou ruim</td>
                                <td>tristeza</td>
                                <td>me isolar</td>
                            </tr>
                            <tr>
                                <td>Quarta</td>
                                <td>Vestibular</td>
                                <td>Não vou passar</td>
                                <td>insegurança</td>
                                <td>chorar</td>
                            </tr>
                        </tbody>
                    </table>
                    <p style="font-size:0.75rem; margin-top: 0.5rem;">* preencha conforme sua rotina</p>
                </div>
            </div>
        </div>

        <footer>
            <p>Psicoweb · Apoio ao autocuidado e à comunicação terapêutica</p>
            <p style="margin-top: 0.3rem;">Lembre-se: o que você registra fortalece seu vínculo com seu terapeuta!</p>
        </footer>
    </div>

    <script>
        (function () {

            let nomeUsuario = null;

            const possiveisChaves = ['userName', 'nomeUsuario', 'nome', 'usuario_nome', 'nome_paciente', 'patientName'];
            for (let chave of possiveisChaves) {
                const valorStorage = localStorage.getItem(chave);
                if (valorStorage && valorStorage.trim() !== "") {
                    nomeUsuario = valorStorage.trim();
                    break;
                }
                const valorSession = sessionStorage.getItem(chave);
                if (valorSession && valorSession.trim() !== "") {
                    nomeUsuario = valorSession.trim();
                    break;
                }
            }

            if (!nomeUsuario && typeof window !== 'undefined') {
                if (window.nomeDoUsuario && typeof window.nomeDoUsuario === 'string' && window.nomeDoUsuario.trim() !== "") {
                    nomeUsuario = window.nomeDoUsuario;
                } else if (window.usuarioLogado && typeof window.usuarioLogado === 'object' && window.usuarioLogado.nome) {
                    nomeUsuario = window.usuarioLogado.nome;
                } else if (window.dadosCadastro && window.dadosCadastro.nome) {
                    nomeUsuario = window.dadosCadastro.nome;
                }
            }

            if (!nomeUsuario) {
                const getCookie = (name) => {
                    const value = `; ${document.cookie}`;
                    const parts = value.split(`; ${name}=`);
                    if (parts.length === 2) return parts.pop().split(';').shift();
                    return null;
                };
                const cookieNome = getCookie('nome_usuario') || getCookie('username') || getCookie('user');
                if (cookieNome && cookieNome.trim() !== "") {
                    nomeUsuario = cookieNome;
                }
            }

            if (!nomeUsuario) {
                const metaNome = document.querySelector('meta[name="user-name"]');
                if (metaNome && metaNome.getAttribute('content')) {
                    nomeUsuario = metaNome.getAttribute('content');
                }
            }

            if (!nomeUsuario || nomeUsuario === "" || nomeUsuario === "Usuário") {
                const cadastroExistente = localStorage.getItem('cadastro_completo') === 'true';
                const nomeFallback = "Paciente";
                nomeUsuario = nomeFallback;

                if (window.cadastroNome && typeof window.cadastroNome === 'string' && window.cadastroNome.trim() !== "") {
                    nomeUsuario = window.cadastroNome;
                }

                else if (localStorage.getItem('usuario_atual')) {
                    try {
                        const userObj = JSON.parse(localStorage.getItem('usuario_atual'));
                        if (userObj && userObj.nome) nomeUsuario = userObj.nome;
                    } catch (e) { }
                }
            }

            if (nomeUsuario) {
                nomeUsuario = nomeUsuario.trim();
            }

            const userNameSpan = document.getElementById('userNameDisplay');
            if (userNameSpan) {
                userNameSpan.textContent = nomeUsuario;
            }

            document.title = `Início | ${nomeUsuario} - Registro Terapêutico`;

            const btnTabela = document.getElementById('btnTabelaSentimentos');
            if (btnTabela) {
                btnTabela.addEventListener('click', (e) => {
                    e.preventDefault();
                    alert(`Vamos começar, ${nomeUsuario}! Essa página ainda esta em desenvolvimento.`);
                });
            }

            const botoesSecundarios = document.querySelectorAll('.btn-acao, .btn-acao.btn-secundario');
            botoesSecundarios.forEach(btn => {
                if (btn.id !== 'btnTabelaSentimentos') {
                    btn.addEventListener('click', (e) => {
                        e.preventDefault();
                        alert(`Vamos começar, ${nomeUsuario}! Essa página ainda esta em desenvolvimento.`);
                    });
                }
            });

            const btnPrimeiraTabela = document.querySelector('.tabela-destaque .btn-acao');
            if (btnPrimeiraTabela) {
                btnPrimeiraTabela.addEventListener('click', (e) => {
                    e.preventDefault();
                    alert(`Vamos começar, ${nomeUsuario}! Essa página ainda esta em desenvolvimento.`);
                });
            }
        })();
    </script>

</body>

</html>