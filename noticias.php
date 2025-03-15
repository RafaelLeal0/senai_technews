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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700&display=swap" rel="stylesheet">
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
        <section class="news-grid">
            <div class="news-item">
                <img src="./img/dss.jpg" alt="Notícia 1">
                <div class="news-content">
                    <h3>Desenvolvimento de Sistemas: Carreira em Alta na Tecnologia!</h3>
                    <p>Com a demanda por tecnologia em alta, profissionais de Análise e Desenvolvimento de Sistemas estão cada vez mais valorizados.</p>
                </div>
            </div>
            
            <div class="news-item2">
                <img src="./img/dsss.jpg" alt="Notícia 2">
                <div class="news-content">
                    <h3>O Futuro das Profissões: Técnico em Desenvolvimento de Sistemas na Indústria 4.0</h3>
                    <p>Na Indústria 4.0, a digitalização e a automação tornam o Técnico em Desenvolvimento de Sistemas essencial.</p>
                </div>
            </div>
        </section>
    </main>
</body>
</html>

<button id="topBtn"><i class="fa-solid fa-arrow-up"></i></button>
<script>
let topBtn = document.getElementById("topBtn");

window.onscroll = function() {
    if (document.documentElement.scrollTop > 200) {
        topBtn.style.display = "block";
    } else {
        topBtn.style.display = "none";
    }
};

topBtn.onclick = function() {
    window.scrollTo({ top: 0, behavior: "smooth" });
};
</script>
<style>
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
</style>
