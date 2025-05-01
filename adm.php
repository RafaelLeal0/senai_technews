<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['professor'])) {
    header('Location: login.php');
    exit();
}

$professor = $_SESSION['professor'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo - SENAI TechNews</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="./css/adm.css">
</head>

<body>
    <main class="admin-container">
        <h1 class="welcome-message">Bem-vindo administrador: <?= htmlspecialchars($professor['nome']) ?></h1>
        
        <div class="admin-actions">
            <a href="#" class="action-card">
                <i class="fas fa-upload"></i>
                <h2>Fazer upload de projeto</h2>
            </a>
            
            <a href="#" class="action-card">
                <i class="fas fa-newspaper"></i>
                <h2>Fazer upload de notícia</h2>
            </a>
        </div>
    </main>

    <!-- Adicione antes do footer -->
    <div id="modal-noticia" class="modal">
        <div class="modal-conteudo">
            <span class="fechar">&times;</span>
            <h2>Publicar Nova Notícia</h2>
            <form method="POST" action="salvar_noticia.php">
                <input type="hidden" name="autor_id" value="<?= $_SESSION['professor']['id_professor'] ?>">
                
                <div class="form-group">
                    <label>Título:</label>
                    <input type="text" name="titulo" required>
                </div>

                <div class="form-group">
                    <label>Conteúdo:</label>
                    <textarea name="conteudo" rows="5" required></textarea>
                </div>

                <div class="form-group">
                    <label>Categoria:</label>
                    <select name="categoria" required>
                        <option value="Projetos de alunos">Projetos de alunos</option>
                        <option value="Projetos para a escola">Projetos para a escola</option>
                        <option value="Eventos">Eventos</option>
                    </select>
                </div>

                <button type="submit" class="btn-publicar">Publicar Notícia</button>
            </form>
        </div>
    </div>

    <div id="modal-projeto" class="modal">
        <div class="modal-conteudo">
            <span class="fechar">&times;</span>
            <h2>Publicar Novo Projeto</h2>
            <form method="POST" action="salvar_projeto.php" enctype="multipart/form-data">
                <input type="hidden" name="id_professor" value="<?= $_SESSION['professor']['id_professor'] ?>">
                
                <div class="form-group">
                    <label>Título:</label>
                    <input type="text" name="titulo" required>
                </div>

                <div class="form-group">
                    <label>Descrição:</label>
                    <textarea name="descricao" rows="5" required></textarea>
                </div>

                <div class="form-group">
                    <label>Imagem do Projeto:</label>
                    <input type="file" name="imagem" accept="image/*" required>
                </div>

                <div class="form-group">
                    <label>Ano do Projeto:</label>
                    <select name="ano" required>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                    </select>
                </div>

                <button type="submit" class="btn-publicar">Publicar Projeto</button>
            </form>
        </div>
    </div>

    <script>
        // Controle do modal de notícias
        const modalNoticia = document.getElementById('modal-noticia');
        const btnNoticia = document.querySelector('.fa-newspaper').closest('a');

        // Controle do modal de projetos
        const modalProjeto = document.getElementById('modal-projeto');
        const btnProjeto = document.querySelector('.fa-upload').closest('a');

        // Função genérica para abrir/fechar modais
        function setupModal(btn, modal) {
            const span = modal.getElementsByClassName("fechar")[0];
            
            btn.onclick = function(e) {
                e.preventDefault();
                modal.style.display = "block";
            }

            span.onclick = function() {
                modal.style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        }

        setupModal(btnNoticia, modalNoticia);
        setupModal(btnProjeto, modalProjeto);
    </script>

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
                        <li><a href="./prof.php">Greggori Bossolan</a></li>
                        <li><a href="./prof.php">Gleise Rosa</a></li>
                        <li><a href="./prof.php">Lucas Machado</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>
                        <a href="logout.php" style="color: white; text-decoration: none;">Sair</a>
                        <a href="cadastro.php" style="color: white; text-decoration: none;">Cadastrar administrador</a>
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