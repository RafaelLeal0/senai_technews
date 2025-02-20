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
</head>

<body>
<header>
            <div class="container">
                <img src="./img/senai_technews.png" alt="SENAI Logo" class="logo">
                <nav>
                    <ul>
                        <li><a href="#">SENAI Taubaté</a></li>
                        <li><a href="#">CURSO</a></li>
                        <li><a href="#">NOTÍCIAS</a></li>
                        <li><a href="#">EVENTOS</a></li>
                    </ul>
                </nav>
                <div class="header-links">
                    <a href="#">✉ Email</a>
                    <a href="#" class="login">🔒 Entrar</a>
                </div>
            </div>
        </header>
    
    <main class="container2">
        <h1>NOTÍCIAS</h1>
        
        <div class="filters">
            <select>
                <option>TODAS AS DATAS</option>
            </select>
            <select>
                <option>TODAS UNIDADES</option>
            </select>
            <select>
                <option>Categorias</option>
            </select>
            <input type="text" placeholder="Busca rápida">
            <button>Pesquisar</button>
        </div>
        
        <section class="news-grid">
            <div class="news-item">
                <img src="./img/dss.jpg" alt="Notícia 1">
                <div class="news-content">
                    <h3>Desenvolvimento de Sistemas: Carreira em Alta na Tecnologia!</h3>
                    <p>Com a demanda por tecnologia em alta, profissionais de Análise e Desenvolvimento de Sistemas estão cada vez mais valorizados.</p>
                </div>
            </div>
            
            <div class="news-item">
                <img src="noticia2.jpg" alt="Notícia 2">
                <div class="news-content">
                    <h3>O Futuro das Profissões: Técnico em Desenvolvimento de Sistemas na Indústria 4.0</h3>
                    <p>Na Indústria 4.0, a digitalização e a automação tornam o Técnico em Desenvolvimento de Sistemas essencial.</p>
                </div>
            </div>
        </section>
    </main>
</body>
</html>