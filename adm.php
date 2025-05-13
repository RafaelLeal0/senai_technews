<?php
session_start();
if (!isset($_SESSION['professor'])) {
    header('Location: login.php');
    exit();
}

require_once 'conexao.php';

try {
    $stmtNoticias = $conn->query("
        SELECT n.*, p.nome AS autor
        FROM noticias n
        INNER JOIN professores p ON n.id_professor = p.id_professor
        ORDER BY data_publicacao DESC
    ");
    $noticias = $stmtNoticias->fetchAll();
} catch (PDOException $e) {
    die("Erro ao buscar notícias: " . $e->getMessage());
}

try {
    $stmtProjetos = $conn->query("
    SELECT *, 2024 AS ano FROM projetos2024
    UNION ALL
    SELECT *, 2025 AS ano FROM projetos2025
    ORDER BY ano DESC, id_projeto DESC
");
    $projetos = $stmtProjetos->fetchAll();
} catch (PDOException $e) {
    die("Erro ao buscar projetos: " . $e->getMessage());
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
    <link rel="icon" type="image/png" href="./img/logo/logotop.png">
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

    <section id="noticias-admin">
        <h2>Notícias Cadastradas</h2>
        <div class="masonry-layout admin-layout">
            <?php foreach ($noticias as $noticia): ?>
            <div class="card-noticia">
                <div class="categoria <?= strtolower(str_replace(' ', '-', $noticia['categoria'])) ?>">
                <?= htmlspecialchars($noticia['categoria']) ?>
                </div>
                <h3><?= htmlspecialchars($noticia['titulo']) ?></h3>
                <p><?= nl2br(htmlspecialchars($noticia['conteudo'])) ?></p>
                <div class="rodape-card">
                <span class="autor"><?= htmlspecialchars($noticia['autor']) ?></span>
                <span class="data"><?= date('d/m/Y H:i', strtotime($noticia['data_publicacao'])) ?></span>
                </div>

                <button class="btn-edit-noticia" data-id="<?= $noticia['id_noticia'] ?>">
                    <i class="fas fa-edit"></i>
                </button>

                <button class="btn-delete" data-id="<?= $noticia['id_noticia'] ?>">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section id="projetos-admin">
        <h2>Projetos Cadastrados (2024 e 2025)</h2>
        <div class="masonry-layout admin-layout">
            <?php foreach ($projetos as $projeto): ?>
            <div class="card-noticia">
                
                <h3><?= htmlspecialchars($projeto['titulo']) ?></h3>
                <?php if (!empty($projeto['imagem_projeto'])): 
                    $finfo  = new finfo(FILEINFO_MIME_TYPE);
                    $mime   = $finfo->buffer($projeto['imagem_projeto']);
                    $base64 = base64_encode($projeto['imagem_projeto']);
                ?>
                    <img 
                    src="data:<?= $mime ?>;base64,<?= $base64 ?>" 
                    alt="<?= htmlspecialchars($projeto['titulo']) ?>" 
                    class="imagem-projeto"
                    >
                <?php endif; ?>

                <?php if (!empty($projeto['noticia_titulo']) && !empty($projeto['noticia_conteudo'])): ?>
                <div class="card-noticia-destaque">
                    <h4><?= htmlspecialchars($projeto['noticia_titulo']) ?></h4>
                    <p><?= nl2br(htmlspecialchars($projeto['noticia_conteudo'])) ?></p>
                </div>
                <?php endif; ?>

                <p><?= nl2br(htmlspecialchars($projeto['descricao'])) ?></p>
                <div class="rodape-card">
                    <span class="data">Ano: <?= htmlspecialchars($projeto['ano']) ?></span>
                </div>

                <button class="btn-edit-projeto" data-id="<?= $projeto['id_projeto'] ?>">
                    <i class="fas fa-edit"></i>
                </button>

                <button class="btn-delete-projeto" data-id="<?= $projeto['id_projeto'] ?>">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <div id="modal-noticia" class="modal">
        <div class="modal-conteudo">
            <span class="fechar">&times;</span>
            <h2>Publicar Nova Notícia</h2>
            <form method="POST" action="salvar_noticia.php">
                
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


    <div id="modal-edit-noticia" class="modal">
        <div class="modal-conteudo">
            <span class="fechar">&times;</span>
            <h2>Editar Notícia</h2>
            <form id="form-edit-noticia">
            <input type="hidden" name="id_noticia" id="edit-noticia-id">
            <div class="form-group">
                <label>Título</label>
                <input type="text" name="titulo" id="edit-noticia-titulo" required>
            </div>
            <div class="form-group">
                <label>Conteúdo</label>
                <textarea name="conteudo" id="edit-noticia-conteudo" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn-publicar">Salvar</button>
            </form>
        </div>
    </div>

    <div id="modal-edit-projeto" class="modal">
    <div class="modal-conteudo">
        <span class="fechar">&times;</span>
        <h2>Editar Projeto</h2>
        <form id="form-edit-projeto" enctype="multipart/form-data">
        <input type="hidden" name="id_projeto" id="edit-projeto-id">
        <div class="form-group">
            <label>Título</label>
            <input type="text" name="titulo" id="edit-projeto-titulo" required>
        </div>
        <div class="form-group">
            <label>Descrição</label>
            <textarea name="descricao" id="edit-projeto-descricao" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label>Imagem (substituir)</label>
            <input type="file" name="imagem" id="edit-projeto-imagem" accept="image/*">
        </div>
        <button type="submit" class="btn-publicar">Salvar</button>
        </form>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php

        $flashSuccess = $_SESSION['flash_success'] ?? null;
        $flashError   = $_SESSION['flash_error']   ?? null;
        unset($_SESSION['flash_success'], $_SESSION['flash_error']);
        ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <?php if ($flashSuccess): ?>
        <script>
        Swal.fire({
            icon: 'success',
            title: '<?= addslashes($flashSuccess) ?>',
            showConfirmButton: false,
            timer: 2000
        });
        </script>
        <?php endif; ?>
        <?php if ($flashError): ?>
        <script>
        Swal.fire({
            icon: 'error',
            title: '<?= addslashes($flashError) ?>'
        });
        </script>
    <?php endif; ?>


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
            
            btn.onclick = function (e) {
                e.preventDefault();
                modal.style.display = "block";
            }

            span.onclick = function () {
                modal.style.display = "none";
            }

            window.onclick = function (event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        }

        setupModal(btnNoticia, modalNoticia);
        setupModal(btnProjeto, modalProjeto);

        // Deleção de notícias
        function setupDelete(buttonClass, deleteUrl, itemType) {
            document.querySelectorAll(buttonClass).forEach(btn => {
                btn.addEventListener('click', () => {
                    const id = btn.dataset.id;
                    Swal.fire({
                        title: `Tem certeza?`,
                        text: `Este ${itemType} será excluído permanentemente.`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Sim, excluir',
                        cancelButtonText: 'Não, cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(deleteUrl, {
                                method: 'POST',
                                headers: { 'Content-Type': 'application/json' },
                                body: JSON.stringify({ [`id_${itemType}`]: id })
                            })
                            .then(res => res.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire('Excluído!', `O ${itemType} foi removido com sucesso.`, 'success')
                                        .then(() => location.reload());
                                } else {
                                    Swal.fire('Erro', `Não foi possível excluir o ${itemType}.`, 'error');
                                }
                            })
                            .catch(() => {
                                Swal.fire('Erro', 'Falha na comunicação com o servidor.', 'error');
                            });
                        }
                    });
                });
            });
        }

        setupDelete('.btn-delete', 'delete_noticia.php', 'noticia');
        setupDelete('.btn-delete-projeto', 'delete_projeto.php', 'projeto');

        // Edição de notícias e projetos
        function setupEdit(buttonSelector, modalId, formId, fetchUrl, fieldsMapper) {
            const modal = document.getElementById(modalId);
            const form = document.getElementById(formId);
            const close = modal.querySelector('.fechar');

            // Fecha modal
            close.onclick = () => modal.style.display = 'none';
            window.onclick = e => { if (e.target == modal) modal.style.display = 'none'; };

            document.querySelectorAll(buttonSelector).forEach(btn => {
                btn.onclick = e => {
                    e.preventDefault();
                    const id = btn.dataset.id;
                    fetch(fetchUrl + '?id=' + id)
                        .then(r => r.json())
                        .then(data => {
                            fieldsMapper(data);
                            modal.style.display = 'block';
                        });
                };
            });

            form.onsubmit = e => {
                e.preventDefault();
                const formData = new FormData(form);
                fetch(fetchUrl, {
                    method: 'POST',
                    body: formData
                })
                .then(r => r.json())
                .then(resp => {
                    if (resp.success) {
                        Swal.fire({
                            icon: 'success',
                            title: resp.message || 'Atualizado com sucesso!',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => location.reload());
                    } else {
                        Swal.fire('Erro', resp.message || 'Não foi possível atualizar.', 'error');
                    }
                });
            };
        }

        // Configura editar notícia
        setupEdit(
            '.btn-edit-noticia',
            'modal-edit-noticia',
            'form-edit-noticia',
            'edit_noticia.php',
            data => {
                document.getElementById('edit-noticia-id').value = data.id_noticia;
                document.getElementById('edit-noticia-titulo').value = data.titulo;
                document.getElementById('edit-noticia-conteudo').value = data.conteudo;
            }
        );

        // Configura editar projeto
        setupEdit(
            '.btn-edit-projeto',
            'modal-edit-projeto',
            'form-edit-projeto',
            'edit_projeto.php',
            data => {
                document.getElementById('edit-projeto-id').value = data.id_projeto;
                document.getElementById('edit-projeto-titulo').value = data.titulo;
                document.getElementById('edit-projeto-descricao').value = data.descricao;
            }
        );
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
                        <h4><a href="logout.php" style="color: white; text-decoration: none;">Sair</a></h4>
                        <h4><a href="cadastro.php" style="color: white; text-decoration: none;">Cadastrar</a></h4>
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