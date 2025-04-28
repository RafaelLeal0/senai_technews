<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projetos</title>
    <link rel="stylesheet" href="./css/projetos.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@latest/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="icon" type="image/png" href="./img/logo/logotop.png">
</head>
<style>
body {
    font-family: 'Inter', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
    color: #333;
}

h1 {
    text-align: center;
    margin-top: 60px;
    font-size: 2.5rem;
    color:rgb(255, 255, 255);
    font-weight: 700;
}

.filtros {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
    margin: 30px auto;
    max-width: 800px;
}

.filtros button,
.filtros input {
    padding: 12px 20px;
    border: 1px solid #ccc;
    border-radius: 30px;
    font-size: 1rem;
    outline: none;
    transition: 0.3s ease;
}

.filtros input {
    flex: 1;
    min-width: 200px;
    max-width: 300px;
}

.filtros button:hover {
    background-color: #e5e5e5;
}

.pesquisar {
    background-color: #cc1c0c;
    color: white;
    border: none;
    cursor: pointer;
    font-weight: 600;
}

.pesquisar:hover {
    background-color: #a50f09;
}

main {
    padding: 0 20px 50px;
}

.projeto {
    position: relative;
    max-width: 600px;
    margin: 40px auto;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
    background-color: #fff;
}

.projeto:hover {
    transform: scale(1.01);
}

.projeto img {
    width: 100%;
    height: 400px;
    object-fit: cover;
    display: block;
}

.overlay {
    position: absolute;
    bottom: 0;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.6), transparent);
    color: white;
    width: 100%;
    padding: 30px 20px 20px;
    box-sizing: border-box;
    text-align: center;
}

.overlay h2 {
    margin-bottom: 10px;
    font-size: 1.5rem;
}

#devex {
    height: 100px;
    width: 120px;
    margin: 0 auto 15px;
    display: block;
}

.saiba-mais {
    background-color: #740904;
    color: #fff;
    border: none;
    border-radius: 20px;
    padding: 10px 25px;
    cursor: pointer;
    transition: 0.3s ease;
    font-weight: bold;
}

.saiba-mais:hover {
    background-color: #a0100c;
}

.projetos-senai {
    text-align: center;
    padding: 50px 20px;
}

.projetos-senai h2 {
    font-size: 2rem;
    color: #cc1c0c;
    margin-bottom: 30px;
}

.projetos-container {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
}

.projeto-card {
    background-color: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    max-width: 300px;
    text-align: center;
}

.projeto-card img {
    width: 200px;
    height: auto;
    margin-bottom: 15px;

}

.projeto-card ul {
    list-style: none;
    padding: 0;
    text-align: left;
    font-size: 0.9rem;
    color: #555;
}

.ano-projetos {
    display: flex;
    flex-direction: column;
    gap: 50px;
    padding: 50px 20px;
    background-color: #f0f0f0;
    text-align: center;
}

.ano-container {
    background-size: cover;
    background-position: center;
    padding: 100px 20px;
    color: #fff;
    position: relative;
}

.ano-container:nth-child(1) {
    background-image: url('../img/senai-escola.jpg');
}

.ano-container:nth-child(2) {
    background-image: url('../img/senai2025.jpg');
}

.ano-container h2 {
    font-size: 3rem;
    margin-bottom: 10px;
}

.ano-container p {
    font-size: 1.2rem;
    margin-bottom: 20px;
}

.ano-container .saiba-mais {
    background-color: #cc1c0c;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 20px;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.ano-container .saiba-mais:hover {
    background-color: #a50f09;
}

.secao-ano {
    background-color: white;
    border-radius: 10px;
    padding: 40px;
    margin: 40px 0;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.secao-ano h2 {
    color: #cc1c0c;
    font-size: 2.5rem;
    margin-bottom: 20px;
}

.secao-ano p {
    font-size: 1.2rem;
    margin-bottom: 30px;
    color: #555;
}

.secao-ano .saiba-mais {
    background-color: #cc1c0c;
    color: white;
    border: none;
    padding: 12px 30px;
    border-radius: 30px;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
    display: inline-block;
    margin-top: 20px;
}

.secao-ano .saiba-mais:hover {
    background-color: #a50f09;
}

@media screen and (max-width: 768px) {
    h1 {
        font-size: 2rem;
    }

    .projeto img {
        height: 250px;
    }

    .filtros {
        flex-direction: column;
    }

    .filtros input {
        width: 100%;
    }

    #devex {
        width: 100px;
        height: 80px;
    }
}

.section {
    position: relative;
    height: 100vh;
    width: 100%;
    color: white;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    background-size: cover;
    background-position: center;
    margin: 0; 
    padding: 0; 
    box-sizing: border-box; 
}

.section h1 {
    font-size: 6rem;
    margin: 0;
    font-weight: bold;
    margin-left: -800px;
}

.section p {
    font-size: 1.5rem;
    max-width: 600px;
    margin: 10px 0;
    margin-left: -700px;
}

.section .btn {
    border: 2px solid white;
    padding: 10px 20px;
    display: inline-block;
    margin-top: 20px;
    text-decoration: none;
    color: white;
    font-weight: bold;
    transition: background 0.3s, color 0.3s;
    margin-left: -920px;
}

.section .btn:hover {
    background: white;
    color: black;
}

.section-2024 {
    background-image: url('./img/senai-escola.jpg');
}

.section-2025 {
    background-image: url('./img/cod.jpg'); 
}

.section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.4); 
    z-index: 0;
}

.section * {
    position: relative;
    z-index: 1;
}

body {
    font-family: 'Inter', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
    color: #333;
}

header {
    display: flex;
    align-items: center;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.container {
    display: flex;
    align-items: center;
    width: 90%;
    max-width: 1200px;
    margin: auto;
}

.container img {
    width: 100px;
    height: 70px;
}

nav {
    display: flex;
    flex-grow: 1;
}

nav ul {
    list-style: none;
    display: flex;
    gap: 20px;
    padding: 0;
    margin: 0;
    justify-content: flex-start;
}

nav ul li {
    display: inline-block;
}

nav ul li a {
    text-decoration: none;
    color: #333;
    font-weight: 600;
    padding: 10px 20px;
    transition: all 0.3s ease-in-out;
    position: relative;
}

nav ul li a::after {
    content: "";
    position: absolute;
    width: 0;
    height: 2px;
    background-color: #cc1c0c;
    left: 50%;
    bottom: -5px;
    transition: width 0.3s ease-in-out, left 0.3s ease-in-out;
}

nav ul li a:hover {
    color: #cc1c0c;
    font-size: 105%;
}

nav ul li a:hover::after {
    width: 100%;
    left: 0;
}

.header-links {
    margin-left: auto;
}

.header-links a {
    margin-left: 15px;
    text-decoration: none;
    color: #333;
    font-weight: 600;
    position: relative;
    transition: color 0.3s ease-in-out, font-size 0.3s ease-in-out;
}

.header-links a::after {
    content: "";
    position: absolute;
    width: 0;
    height: 2px;
    background-color: #cc1c0c;
    left: 50%;
    bottom: -5px;
    transition: width 0.3s ease-in-out, left 0.3s ease-in-out;
}

.header-links a:hover {
    color: #cc1c0c;
    font-size: 110%;
}

.header-links a:hover::after {
    width: 100%;
    left: 0;
}

.banner {
    width: 100%;
    height: auto;
    display: block; 
    margin: 0 auto;
    max-width: 800px;
}

h1 {
    margin: 45px 0 20px 0;
    font-size: 2rem;
    color: rgb(255, 255, 255);
    text-align: center; 
}

.info {
    text-align: left;
}

.info h2 {
    margin: 0;
    font-size: 1.5rem;
    color: rgb(0, 0, 0);
}

.info p {
    margin-top: 5px;
    font-size: 1rem;
    color: #555;
}

.itens {
    margin-left: 200px;
}

.professor {
    display: flex;
    align-items: flex-start;
    gap: 20px;
}

.professor {
    display: flex;
    align-items: flex-start;
    gap: 20px;
}

.prof img{
    border-radius: 30px;
}

.link {
    margin-top: 10px;
    display: flex;
    gap: -20px;
    justify-content: flex-start; 
    align-items: center;
  }
  
  .link img {
    width: 30px;
    height: 30px;
    margin: 0; 
    transition: transform 0.3s ease;
    margin-left: 35px;
  }
  
  .link img:hover {
    transform: scale(1.2); 
  }
  .container{
  max-width: 1170px;
  margin:auto;
  }
  .row{
  display: flex;
  }
  ul{
  list-style: none;
  }
  .footer{
  background-color: #A01308;
    padding: 70px 0;
  }
  .footer-col{
   width: 25%;
   padding: 0 15px;
  }
  .footer-col h4{
  font-size: 18px;
  color: #ffffff;
  text-transform: capitalize;
  margin-bottom: 35px;
  font-weight: 500;
  position: relative;
    margin-right: 90px;
  }
  .footer-col h4::before{
  content: '';
  position: absolute;
  left:0;
  bottom: -10px;
  background-color: #ffffff;
  height: 2px;
  box-sizing: border-box;
  width: 50px;
  }
  .footer-col ul li:not(:last-child){
  margin-bottom: 10px;
  }
  .footer-col ul li a{
  font-size: 16px;
  text-transform: capitalize;
  color: #ffffff;
  text-decoration: none;
  font-weight: 300;
  color: #f6f6f6;
  display: block;
  transition: all 0.3s ease;
  }
  .footer-col ul li a:hover{
  color: #ffffff;
  padding-left: 8px;
  }
  .footer-col .social-links a{
  display: inline-block;
  height: 40px;
  width: 40px;
  background-color: rgba(255,255,255,0.2);
  margin:0 10px 10px 0;
  text-align: center;
  line-height: 40px;
  border-radius: 50%;
  color: #ffffff;
  transition: all 0.5s ease;
  }
  .footer-col .social-links a:hover{
  color: #24262b;
  background-color: #ffffff;
  }
  
  @media(max-width: 767px){
  .footer-col{
    width: 50%;
    margin-bottom: 30px;
  }
  }
  @media(max-width: 574px){
  .footer-col{
    width: 100%;
  }
  }
  .footer{
  background-color: #B91D32;
    padding: 30px 0;
  }
  .footer-col{
   padding: 0 40px;
  }
  .footer-col h4{
  font-size: 18px;
  color: #ffffff;
  text-transform: capitalize;
  margin-bottom: 35px;
  font-weight: 700;
  position: relative;
    margin-right: 90px;
  }
  .footer-col h4::before{
  content: '';
  position: absolute;
  left:0;
  bottom: -10px;
  background-color: #ffffff;
  height: 2px;
  box-sizing: border-box;
  width: 60px;
  }
  .footer-col ul li:not(:last-child){
  margin-bottom: 10px;
  }
  .footer-col ul li a{
  font-size: 16px;
  text-transform: capitalize;
  color: #ffffff;
  text-decoration: none;
  font-weight: 300;
  color: #f6f6f6;
  display: block;
  transition: all 0.10s ease;
    text-align: left;
  }
  
  .footer-col ul {
    text-align: left;
    padding: 0;
    margin: 0;
  }
  
  .footer-col ul li {
    text-align: left;
  }
  
  .footer-col ul li a:hover{
  color: #ffffff;
  padding-left: 8px;
  }
  .footer-col .social-links a{
  display: inline-block;
  height: 40px;
  width: 40px;
  background-color: rgba(255,255,255,0.2);
  margin:0 10px 10px 0;
  text-align: center;
  line-height: 0px;
  border-radius: 30px;
  color: #ffffff;
  transition: all 0.10s ease;
  }
  .footer-col .social-links a:hover{
  color: #24262b;
  background-color: #ffffff;
  }
  
  @media(max-width: 767px){
  .footer-col{
    width: 50%;
    margin-bottom: 30px;
  }
  }
  @media(max-width: 574px){
  .footer-col{
    width: 100%;
  }
  }
  .social-bar {
    background-color: #E30613;
    text-align: center;
    padding: 10px 0;
  }
  
  .social-bar a {
    display: inline-block;
    color: white;
    font-size: 20px;
    margin: 0 10px;
    transition: 0.3s;
  }
  
  .social-bar a:hover {
    color: #f1f1f1;
  }
  
  @media screen and (max-width: 1200px) {
    .section h1 {
        margin-left: -600px;
    }
    .section p {
        margin-left: -500px;
    }
    .section .btn {
        margin-left: -700px;
    }
}

@media screen and (max-width: 992px) {
    .section h1 {
        margin-left: -400px;
        font-size: 5rem;
    }
    .section p {
        margin-left: -300px;
    }
    .section .btn {
        margin-left: -500px;
    }
    
    .projetos-container {
        flex-direction: column;
        align-items: center;
    }
    
    .projeto-card {
        max-width: 80%;
    }
}

@media screen and (max-width: 768px) {
    .section h1 {
        margin-left: -200px;
        font-size: 4rem;
    }
    .section p {
        margin-left: -100px;
    }
    .section .btn {
        margin-left: -300px;
    }
    
    header .container {
        flex-direction: column;
        padding: 10px;
    }
    
    nav ul {
        flex-direction: column;
        gap: 5px;
        margin-top: 15px;
    }
    
    .header-links {
        margin-left: 0;
        margin-top: 15px;
    }
    
    .itens {
        margin-left: 0;
        text-align: center;
    }
    
    .professor {
        flex-direction: column;
        align-items: center;
    }
    
    .projeto img {
        height: 250px;
    }
    
    .filtros {
        flex-direction: column;
    }
    
    .filtros input {
        width: 100%;
    }
    
    #devex {
        width: 100px;
        height: 80px;
    }
    
    .footer-col {
        width: 100%;
        margin-bottom: 30px;
        text-align: center;
    }
    
    .footer-col h4::before {
        left: 50%;
        transform: translateX(-50%);
    }
    
    .footer-col ul {
        text-align: center;
    }
}

@media screen and (max-width: 576px) {
    .section h1 {
        margin-left: 0;
        font-size: 3rem;
        text-align: center;
    }
    .section p {
        margin-left: 0;
        text-align: center;
        padding: 0 20px;
    }
    .section .btn {
        margin-left: 0;
    }
    
    h1 {
        font-size: 1.8rem;
    }
    
    .projetos-senai h2 {
        font-size: 1.5rem;
    }
    
    .projeto-card {
        max-width: 100%;
    }
    
    .section {
        padding: 20px;
    }
    
    .section h1 {
        font-size: 2.5rem;
    }
    
    .section p {
        font-size: 1.2rem;
    }
    
    .footer-col {
        padding: 0 15px;
    }
}

@media screen and (max-width: 400px) {
    .section h1 {
        font-size: 2rem;
    }
    
    .section p {
        font-size: 1rem;
    }
    
    .btn {
        padding: 8px 16px;
        font-size: 0.9rem;
    }
    
    .projeto-card img {
        width: 150px;
    }
    
    .footer-col h4 {
        font-size: 16px;
    }
    
    .footer-col ul li a {
        font-size: 14px;
    }
}

</style>
<body>
    <header>
        <div class="container">
            <img src="./img/senai_technews.png" alt="SENAI Logo" class="logo">
            <nav>
                <ul class="itens">
                <li><a href="inicio.php">CURSO</a></li>
                    <li><a href="senai.php">SENAI TAUBATÉ</a></li> 
                    <li><a href="noticias.php">NOTÍCIAS</a></li>
                    <li><a href="projetos.php">PROJETOS</a></li> 
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <section class="projetos-senai">
            <h2>Projetos do SENAI - Taubaté</h2>
            <div class="projetos-container">
                <div class="projeto-card">
                    <img src="./img/2.png" alt="GameHub">
                    <ul>
                        <li>Uma empresa que trabalha na área de games.</li>
                        <li>Nosso foco é oferecer performance e curiosidades.</li>
                        <li>Plataformas e eventos sobre nossos jogos.</li>
                    </ul>
                </div>
                <div class="projeto-card">
                    <img src="./img/1.png" alt="GardenTech">
                    <ul>
                        <li>Proporcionar soluções inovadoras e tecnológicas para cultivo.</li>
                        <li>Promover sustentabilidade e eficiência ambiental.</li>
                        <li>Uso de sensores e automação de solo em hortas inteligentes.</li>
                    </ul>
                </div>
                <div class="projeto-card">
                    <img src="./img/3.png" alt="Essenza">
                    <ul>
                        <li>Uma marca de moda sofisticada que une elegância e qualidade.</li>
                        <li>Peças exclusivas voltadas para quem valoriza estilo e personalidade.</li>
                    </ul>
                </div>
            </div>
        </section>

        <div class="section section-2024">
        <h1>2024</h1>
        <p>Projetos feitos pelos alunos do</p> 
        <p>SENAI-Taubaté no ano de 2024</p>
        <a href="#" class="btn">Saiba mais</a>
    </div>

    <div class="section section-2025">
        <h1>2025</h1>
        <p>Projetos feitos pelos alunos do</p> 
        <p>SENAI-Taubaté no ano de 2025</p>
        <a href="#" class="btn">Saiba mais</a>
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