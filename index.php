<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SENAI Tech News</title>
  <link rel="stylesheet" href="./css/inic.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@latest/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700&display=swap" rel="stylesheet">
  <link rel="icon" type="image/png" href="./img/logo/logotop.png">
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
  <section class="intro-section">
    <div class="intro-text">
      <h3><span class="highlight">SENAI</span> <span class="highlight-red">TechNews</span> – O futuro da tecnologia
        começa com a informação certa!</h3>
    </div>
    <div class="intro-images">
      <img src="./img/senai-escola.jpg" alt="Imagem SENAI" class="tilted-img">
      <img src="./img/estudantes.jpg" alt="Imagem Código" class="tilted-img">
      <img src="./img/codigo.jpg" alt="Imagem Código" class="tilted-img">
    </div>
  </section>

  <main class="container1">
    <div class="content1">
      <h2 class="section-title">SENAI TECHNEWS</h2>

      <p>Este site foi desenvolvido como parte do curso de Desenvolvimento de Sistemas no SENAI Taubaté, com o propósito
        de fornecer informações detalhadas sobre a formação, suas disciplinas, oportunidades e impactos no mercado de
        trabalho.</p>

      <p>Mais do que uma simples apresentação do curso, este espaço funciona como um repositório de conhecimento,
        reunindo conteúdos essenciais para alunos, ex-alunos e futuros profissionais.</p>

      <p>Aqui, é possível encontrar materiais de estudo, projetos desenvolvidos durante o curso, depoimentos de
        estudantes e professores, além de notícias e tendências do setor da tecnologia.</p>

      <p>Nosso objetivo é criar um ambiente de aprendizado contínuo, onde os visitantes possam se manter atualizados
        sobre as inovações da área, explorar diferentes caminhos dentro do universo do desenvolvimento de sistemas e se
        preparar para os desafios do mercado de trabalho. Seja você um estudante em busca de recursos para aprimorar
        seus conhecimentos ou alguém interessado em ingressar nesse campo promissor, este site foi feito para apoiar sua
        jornada na tecnologia.</p>
    </div>
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

  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      const destino = document.querySelector(this.getAttribute('href'));
      if (destino) {
        e.preventDefault();
        destino.scrollIntoView({
          behavior: 'smooth'
        });
      }
    });
  });

  window.addEventListener('load', () => {
    const imagens = document.querySelectorAll('.tilted-img');
    imagens.forEach((img, i) => {
      setTimeout(() => {
        img.style.opacity = 1;
        img.style.transform = 'translateY(0)';
      }, i * 300);
    });
  });

  window.addEventListener('DOMContentLoaded', () => {
    const titulo = document.querySelector('.intro-text h3');
    titulo.style.opacity = 1;
    titulo.style.transform = 'translateY(0)';
  });


</script>