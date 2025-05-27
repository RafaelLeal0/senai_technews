<?php
require_once 'conexao.php';

if (!isset($conn)) {
    die("Erro: Conexão com o banco de dados não foi estabelecida.");
}

try {
    $stmt = $conn->query("
        SELECT n.*, p.nome AS autor
        FROM noticias n
        INNER JOIN professores p ON n.id_professor = p.id_professor
        ORDER BY data_publicacao DESC
    ");

    $noticias = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Erro ao buscar notícias: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notícias</title>
    <link rel="stylesheet" href="./css/notic.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="icon" type="image/png" href="./img/logo/logotop.png">
    <script src="noticias.js" defer></script>
</head>

<body>
    <header>
        <div class="container">
            <a href="index.php">
                <img src="./img/senai_technews.png" alt="SENAI Logo" class="logo">
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

    <section id="noticias-manuais">
        <div class="masonry-layout">
            <?php foreach ($noticias as $noticia): ?>
                <div class="card-noticia">
                    <div class="categoria <?= strtolower(str_replace(' ', '-', $noticia['categoria'])) ?>">
                        <?= htmlspecialchars($noticia['categoria']) ?>
                    </div>
                    <h3><?= htmlspecialchars($noticia['titulo']) ?></h3>
                    <p>
                        <?=
                            nl2br(
                                preg_replace(
                                    '/(https?:\/\/[^\s]+)/',
                                    '<a href="$1" target="_blank">$1</a>',
                                    htmlspecialchars($noticia['conteudo'])
                                )
                            )
                            ?>
                    </p>
                    <div class="rodape-card">
                        <span class="autor"><?= htmlspecialchars($noticia['autor']) ?></span>
                        <span class="data"><?= date('d/m/Y H:i', strtotime($noticia['data_publicacao'])) ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <div class="container-news">
        <h1>Notícias em Destaque</h1>
        <div class="search-bar">
            <input type="text" id="search-input" placeholder="Buscar notícias...">
            <button id="search-button"><i class="fas fa-search"></i> Buscar</button>
        </div>
        <div class="category-filter"></div>
        <div class="masonry-container" id="news-container"></div>
    </div>

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
                            <li><a href="https://www.linkedin.com/in/gustavo-henrique-a538592b7/">Gustavo Henrique</a>
                            </li>
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
            <a>Copyright 2025 © Todos os direitos reservados.</a>
        </div>
    </footer>
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
</body>

</html>