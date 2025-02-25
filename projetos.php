<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projetos</title>
    <link rel="stylesheet" href="./css/projetos.css">
</head>
<body>
    <header>
        <div class="container">
            <img src="./img/senai_technews.png" alt="SENAI Logo" class="logo">
            <nav>
                <ul class="itens">
                    <li><a href="senai.php">SENAI TAUBATÉ</a></li> 
                    <li><a href="index.php">CURSO</a></li>
                    <li><a href="noticias.php">NOTÍCIAS</a></li>
                    <li><a href="projetos.php">PROJETOS</a></li> 
                </ul>
            </nav>
        </div>
    </header>
    <h1>PROJETOS</h1>
    <div class="filtros">
        <button> TODAS AS DATAS </button>
        <input type="text" placeholder="Busca rápida">
        <button class="pesquisar">Pesquisar</button>
    </div>
    <main>
        <div class="projeto">
            <img src="./img/devexperiencefoto.jpg" alt="Dev Experience">
            <div class="overlay">
                <img id="devex" src="./img/logo/devexeperience.png" alt="Logo Dev Experience" />    
                <button class="saiba-mais">Saiba mais</button>
            </div>
        </div>
        <div class="projeto">
            <img src="./img/projetos/projeto2.png" alt="Projeto 2">
            <div class="overlay">
                <h2>Projetos de 2024</h2>
                <button class="saiba-mais">Saiba mais</button>
            </div>
        </div>
    </main>
</body>
</html>