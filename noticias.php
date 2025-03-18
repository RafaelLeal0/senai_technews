<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/notic.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="noticias.js" defer></script>
</head>

<body>

<header>
    <div class="container">
        <img src="./img/senai_technews.png" alt="SENAI Logo" class="logo">
        <nav>
            <ul class="itens">
                <li><a href="index.php">CURSO</a></li>
                <li><a href="senai.php">SENAI TAUBATÉ</a></li> 
                <li><a href="noticias.php">NOTÍCIAS</a></li>
                <li><a href="projetos.php">PROJETOS</a></li> 
            </ul>
        </nav>
    </div>
</header>

<h1>NOTÍCIAS</h1>

<div class="filtros">
    <button> TODAS AS DATAS </button>
    <input type="text" placeholder="Busca rápida">
    <button class="pesquisar">Pesquisar</button>
</div>

<section class="news-grid" id="news-container">
    <!-- As notícias serão inseridas aqui via JavaScript -->
</section>

<footer>
    <div class="social-bar">
        <a href="https://www.facebook.com/senaisaopaulo"><i class="fab fa-facebook-f"></i></a>
        <a href="https://twitter.com/senaisaopaulo"><i class="fab fa-twitter"></i></a>
        <a href="https://www.youtube.com/channel/UCaz1BMUVug86pd_uS598X1A"><i class="fab fa-youtube"></i></a>
        <a href="https://www.linkedin.com/school/senai-sp/"><i class="fab fa-linkedin-in"></i></a>
        <a href="https://www.instagram.com/senai.sp"><i class="fab fa-instagram"></i></a>
        <a href="https://api.whatsapp.com/send?phone=551133220050"><i class="fab fa-whatsapp"></i></a>
    </div>

    <div class="social-bar">
        <a>Copyright 2025 © Todos os direitos reservados.</a>
    </div>
</footer>

<!-- Botão para voltar ao topo -->
<button id="topBtn"><i class="fa-solid fa-arrow-up"></i></button>


<style>
/* Botão de voltar ao topo */
#topBtn {
    display: none;
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: #d32f2f;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 50%;
    cursor: pointer;
    font-size: 20px;
}

/* Grid de notícias */
.news-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    padding: 20px;
}

/* Estilo do card de notícia */
.news-item {
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.news-item img {
    width: 100%;
    height: 180px;
    object-fit: cover;
}

.news-content {
    padding: 15px;
}

.news-content h3 {
    font-size: 18px;
    margin-bottom: 10px;
}

.news-content p {
    font-size: 14px;
    color: #333;
}

.news-content a {
    display: block;
    margin-top: 10px;
    color: #d32f2f;
    font-weight: bold;
    text-decoration: none;
}
</style>

</body>
</html>
