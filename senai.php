<?php

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SENAI Taubaté</title>
    <link rel="stylesheet" href="<?php echo $css_path; ?>">
    <link rel="stylesheet" href="./css/senai.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700&xdisplay=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@latest/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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
        <div class="banner">
            <img src="./img/bunner_senaitaubate(png).png" alt="Banner" class="banner">
        </div>
   

    <main>
        <h1 class="titulo">SOBRE O SENAI TAUBATÉ</h1>
         
        <p class="descricao">O SENAI é um dos cinco maiores complexos de educação profissional do mundo e o maior da América Latina. A rede SENAI-SP engloba 92 unidades fixas, incluindo a escola SENAI Félix Guisard, localizada na cidade de Taubaté.</p>

        <p class="descricao">Oferecemos cursos para as qualificações de mecânica, metalurgia, eletricidade, eletrônica, automação, segurança do trabalho, logística, gestão, tecnologia da informação, em um ambiente de ensino projetado para oferecer capacitação profissional e especialização técnica. Contamos com laboratórios de metrologia, hidráulica, pneumática, impressão 3D, informática e oficinas de automobilística, soldagem, caldeiraria, mecânica geral, ferramentaria e plásticos.</p>

        <p class="descricao">O SENAI-SP tem a missão de impulsionar o aumento da competitividade da indústria por meio de ações de educação profissional, inovação, tecnologia, e empreendedorismo industrial. Com mais de 80 anos de atuação, o SENAI-SP supera 1 milhão de matrículas anuais, abrangendo desde cursos para a formação inicial profissional até a pós-graduação. São 90 unidades de formação profissional distribuídas em todo o estado de São Paulo, além de 78 escolas móveis, que levam soluções customizadas para a indústria.</p>
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
                        <li><a href="./prof.php">Wesley Fiorese</a></li>
                        <li><a href="./prof.php#">Greggori Bossolan</a></li>
                        <li><a href="./prof.php">Luis Cardoso</a></li>
                        <li><a href="#"></a></li>
                    </ul>
                </div>
                <div class="footer-col">
                <h4>
    <a href="./login.php" style="color: white; text-decoration: none;">Entrar</a>
</h4>

                </div>
            </div>
        </div>
    </div>
    <div class="social-bar">
    <a>Copyright 2025 © Todos os direitos reservados.</a>
    </div>
</footer>

</body>
</html>

<button id="topBtn"><i class="fa-solid fa-arrow-up"></i></button>
<script>
document.addEventListener("DOMContentLoaded", function() {
    let elements = document.querySelectorAll(".descricao, .titulo");
    
    function checkScroll() {
        elements.forEach((element) => {
            let position = element.getBoundingClientRect().top;
            let screenHeight = window.innerHeight;
            
            if (position < screenHeight - 50) {
                element.style.opacity = 1;
                element.style.transform = "translateY(0)";
            }
        });
    }
    
    window.addEventListener("scroll", checkScroll);
    checkScroll();
});

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
document.addEventListener("DOMContentLoaded", function() {
    let elements = document.querySelectorAll(".fade-in");
    
    function checkScroll() {
        elements.forEach((element) => {
            let position = element.getBoundingClientRect().top;
            let screenHeight = window.innerHeight;
            
            if (position < screenHeight - 50) {
                element.style.opacity = 1;
                element.style.transform = "translateY(0)";
            }
        });
    }
    
    window.addEventListener("scroll", checkScroll);
    checkScroll();
});


</script>
