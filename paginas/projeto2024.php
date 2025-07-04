<?php
require_once 'conexao.php';

$projetos2024 = [];
try {
    $stmt = $conn->query("SELECT * FROM projetos2024");
    $projetos2024 = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Erro ao carregar projetos: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projetos</title>
    <link rel="stylesheet" href="../css/projetoquatro.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@latest/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="icon" type="image/png" href="../img/logo/logotop.png">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        .page-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .content {
            flex: 1;
        }
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body>
    <div class="page-wrapper">
        <header>
            <div class="container">
                <a href="../index.php">
                    <img src="../img/senai_technews.png" alt="SENAI Logo" class="logo">
                </a>
                <div class="menu-icon" id="menuIcon" aria-label="Abrir menu" tabindex="0">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <nav id="mainNav">
                    <ul class="itens">
                        <li><a href="inicio.php">CURSO</a></li>
                        <li><a href="senai.php">SENAI TAUBATÉ</a></li>
                        <li><a href="noticias.php">NOTÍCIAS</a></li>
                        <li><a href="projetos.php">PROJETOS</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        <main class="content">
            <a href="projetos.php" class="btn-voltar" title="Voltar para Projetos">
                <i class="bi bi-arrow-left"></i>
            </a>

            <section class="projetos-2024-db">
                <div class="header-projetos">
                    <h2>2024</h2>
                    <p>Projetos desenvolvidos pelos alunos do SENAI Taubaté</p>
                </div>

                <div class="projetos-grid">
                    <?php foreach ($projetos2024 as $projeto): ?>
                        <?php
                        $finfo  = new finfo(FILEINFO_MIME_TYPE);
                        $mime   = $finfo->buffer($projeto['imagem_projeto']);
                        $base64 = base64_encode($projeto['imagem_projeto']);
                        ?>
                        <div class="projeto-item" style="background-image: url('data:<?= $mime ?>;base64,<?= $base64 ?>')">
                            <div class="projeto-overlay">
                                <h3><?= htmlspecialchars($projeto['titulo']) ?></h3>
                                <p><?= htmlspecialchars($projeto['descricao']) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        </main>

        <footer>
            <div class="social-bar">
                <a href="https://www.facebook.com/senaisaopaulo"><i class="fab fa-facebook-f"></i></a>
                <a href="https://twitter.com/senaisaopaulo"><i class="fab fa-twitter"></i></a>
                <a href="https://www.youtube.com/channel/UCaz1BMUVug86pd_uS598X1A"><i class="fab fa-youtube"></i></a>
                <a href="https://www.linkedin.com/school/senai-sp/"><i class="fab fa-linkedin-in"></i></a>
                <a href="https://www.instagram.com/senai.sp"><i class="fab fa-instagram"></i></a>
                <a href="https://api.whatsapp.com/send?phone=551133220050"><i class="fab fa-whatsapp"></i></a>
            </div>

            <div class="footer">
                <div class="container">
                    <div class="row">
                        <div class="footer-col">
                            <h4>Desenvolvedores</h4>
                            <ul>
                                <li><a href="https://www.linkedin.com/in/andrey-montibeller/">Andrey Montibeller</a></li>
                                <li><a href="https://www.linkedin.com/in/gustavo-henrique-a538592b7/">Gustavo Henrique</a></li>
                                <li><a href="https://www.linkedin.com/in/rafael-leal-6569252b8/">Rafael Leal</a></li>
                                <li><a href="https://www.linkedin.com/in/rian-eduardo-9287512b7/">Rian Eduardo</a></li>
                                <li><a href="https://www.linkedin.com/in/samuel-boaz-gon%C3%A7alves/">Samuel Boaz</a></li>
                            </ul>
                        </div>
                        <div class="footer-col">
                            <h4>Professores</h4>
                            <ul>
                                <li><a href="./prof.php">Wesley Fioreze</a></li>
                                <li><a href="./prof.php">Luis Cardoso</a></li>
                                <li><a href="./prof.php#">Greggori Bossolan</a></li>
                                <li><a href="./prof.php">Gleise Rosa</a></li>
                                <li><a href="./prof.php">Lucas Machado</a></li>
                            </ul>
                        </div>
                        <div class="footer-col">
                            <h4><a href="./login.php" style="color: white; text-decoration: none;">Entrar</a></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="social-bar">
                <span>Copyright 2025 © Todos os direitos reservados.</span>
            </div>
        </footer>

    </div>

    <script>
        const menuIcon = document.getElementById('menuIcon');
        const nav = document.getElementById('mainNav');
        menuIcon.addEventListener('click', () => {
            nav.classList.toggle('active');
        });
        document.addEventListener('click', function (e) {
            if (!nav.contains(e.target) && !menuIcon.contains(e.target)) {
                nav.classList.remove('active');
            }
        });
    </script>
    <style>
        .btn-voltar {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #cc1c0c;
            padding: 10px 18px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            font-size: 2rem;
            position: absolute;
            top: 170px;
            left: 120px;
            transition: background 0.2s;
            z-index: 1002;
        }
        .btn-voltar:hover {
            background: #a50f09;
            color: #fff;
        }
        @media (max-width: 900px) {
            .btn-voltar {
                margin-top: 130px;
                margin-left: 8px;
                font-size: 2rem;
                padding: 8px 14px;
            }
        }
    </style>
</body>
</html>
