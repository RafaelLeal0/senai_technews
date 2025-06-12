<?php
session_start();
if (!isset($_SESSION['professor'])) {
    header('Location: login.php');
    exit();
}

require_once 'conexao.php';

$anosExistentes = [];
try {
    $stmtTables = $conn->query("SHOW TABLES LIKE 'projetos____'");
    $tabelas = $stmtTables->fetchAll(PDO::FETCH_COLUMN, 0); 

    foreach ($tabelas as $tabela) {
        if (preg_match('/^projetos(\d{4})$/', $tabela, $m)) {
            $anosExistentes[] = intval($m[1]);
        }
    }
    rsort($anosExistentes, SORT_NUMERIC);
} catch (PDOException $e) {
    $anosExistentes = [];
}
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
    $projetos = [];

    // Para cada ano encontrado em $anosExistentes, faz SELECT nessa tabela
    foreach ($anosExistentes as $anoSessao) {
        $tabela = "projetos{$anoSessao}";

        // 1) Verifica se a tabela realmente existe (redundante, pois $anosExistentes já veio de SHOW TABLES)
        $stmtCheck = $conn->query("SHOW TABLES LIKE '{$tabela}'");
        if ($stmtCheck->rowCount() === 0) {
            // se a tabela não existir (por segurança), pula para o próximo ano
            continue;
        }

        // 2) Consulta todos os projetos daquela tabela, adicionando a coluna “ano”
        $sql = "SELECT *, {$anoSessao} AS ano FROM `{$tabela}`";
        $stmt = $conn->query($sql);
        $linhas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // 3) Junta no array geral
        if ($linhas) {
            $projetos = array_merge($projetos, $linhas);
        }
    }

    // 4) Ordena o array $projetos por ano DESC e, em caso de empate, por id_projeto DESC
    usort($projetos, function($a, $b) {
        if ($a['ano'] === $b['ano']) {
            return $b['id_projeto'] <=> $a['id_projeto'];
        }
        return $b['ano'] <=> $a['ano'];
    });

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
    <link rel="stylesheet" href="../css/adm.css">
    <link rel="icon" type="image/png" href="../img/logo/logotop.png">
    <style>
        .btn-danger {
            background-color: #cc1c0c;
            color: #fff;
            border: none;
        }
        .btn-danger:hover {
            background-color: #a50f09;
        }
        .modal-conteudo hr {
            margin: 20px 0;
            border: 0;
            border-top: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <main class="admin-container">
        <h1 class="welcome-message">Bem-vindo administrador: <?= htmlspecialchars($professor['nome']) ?></h1>

        <div class="admin-actions">
            <a href="#" class="action-card">
                <i class="fas fa-upload"></i>
                <h2>Fazer upload de projeto</h2>
            </a>

            <a href="#" class="action-card" id="btn-criar-sessao">
                <i class="fas fa-folder-plus"></i>
                <h2>Criar/Excluir Sessão</h2>
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
                    <span class="leia-mais">Leia mais</span>
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
        <h2>Projetos Cadastrados</h2>
        <div class="masonry-layout admin-layout">
            <?php foreach ($projetos as $projeto): ?>
                <div class="card-noticia">
                    <h3><?= htmlspecialchars($projeto['titulo']) ?></h3>
                    <?php if (!empty($projeto['imagem_projeto'])):
                        $finfo = new finfo(FILEINFO_MIME_TYPE);
                        $mime = $finfo->buffer($projeto['imagem_projeto']);
                        $base64 = base64_encode($projeto['imagem_projeto']);
                    ?>
                        <img src="data:<?= $mime ?>;base64,<?= $base64 ?>"
                             alt="<?= htmlspecialchars($projeto['titulo']) ?>"
                             class="imagem-projeto">
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

                    <button class="btn-edit-projeto" data-id="<?= $projeto['id_projeto'] ?>" data-ano="<?= $projeto['ano'] ?>">
                        <i class="fas fa-edit"></i>
                    </button>

                    <button class="btn-delete-projeto"
                            data-id="<?= $projeto['id_projeto'] ?>"
                            data-ano="<?= $projeto['ano'] ?>">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Modal para Criar e Excluir Sessão -->
<!-- Modal para Criar e Excluir Sessão -->
<div id="modal-criar-sessao" class="modal">
    <div class="modal-conteudo">
        <span class="fechar">&times;</span>

        <!-- 1) Seção: Criar Nova Sessão -->
        <h2>Criar Nova Sessão</h2>
        <form method="POST" action="criar_sessao.php" enctype="multipart/form-data">
            <div class="form-group">
                <label>Ano da Sessão:</label>
                <input type="number"
                       name="ano_sessao"
                       min="2000"
                       max="2100"
                       step="1"
                       required
                       placeholder="Ex.: 2026">
            </div>

            <div class="form-group">
                <label>Imagem de Fundo (PNG/JPG):</label>
                <input type="file"
                       name="imagem_fundo"
                       accept="image/png, image/jpeg"
                       required>
            </div>

            <button type="submit" class="btn-publicar">Criar Sessão</button>
        </form>

        <hr>

        <!-- 2) Seção: Excluir Sessão (permanece igual) -->
        <h2>Excluir Sessão</h2>
            <?php if (count($anosExistentes) === 0): ?>
                <p>Não há sessões disponíveis para excluir.</p>
            <?php else: ?>
                <form method="POST" action="excluir_sessao.php">
                    <div class="form-group">
                        <label>Selecione o ano da sessão a excluir:</label>
                        <select name="ano_excluir" required>
                            <option value="" disabled selected>Escolha o ano</option>
                            <?php foreach ($anosExistentes as $anoSessao): ?>
                                <option value="<?= htmlspecialchars($anoSessao) ?>">
                                    <?= htmlspecialchars($anoSessao) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn-publicar btn-danger">
                        Excluir Sessão
                    </button>
                </form>
            <?php endif; ?>

        </div>
    </div>


    <!-- Modal para Publicar Nova Notícia -->
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

    <!-- Modal para Publicar Novo Projeto -->
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
                        <?php if (count($anosExistentes) === 0): ?>
                            <option value="" disabled>Não há sessões disponíveis</option>
                        <?php else: ?>
                            <?php foreach ($anosExistentes as $anoSessao): ?>
                                <option value="<?= htmlspecialchars($anoSessao) ?>">
                                    <?= htmlspecialchars($anoSessao) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <button type="submit" class="btn-publicar">Publicar Projeto</button>
            </form>
        </div>
    </div>

    <!-- Modais de edição (notícia e projeto) continuam inalterados -->
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
    <script>
        if ("<?= $flashSuccess ?>") {
            Swal.fire({
                icon: 'success',
                title: '<?= addslashes($flashSuccess) ?>',
                showConfirmButton: false,
                timer: 2000
            });
        }
        if ("<?= $flashError ?>") {
            Swal.fire({
                icon: 'error',
                title: '<?= addslashes($flashError) ?>'
            });
        }
    </script>

    <script>
        function setupModal(btn, modal) {
            const span = modal.getElementsByClassName("fechar")[0];
            btn.addEventListener("click", e => {
                e.preventDefault();
                modal.style.display = "block";
            });
            span.addEventListener("click", () => {
                modal.style.display = "none";
            });
            window.addEventListener("click", e => {
                if (e.target === modal) modal.style.display = "none";
            });
        }

        const btnNoticia = document.querySelector(".fa-newspaper").closest("a");
        const modalNoticia = document.getElementById("modal-noticia");
        const btnProjeto = document.querySelector(".fa-upload").closest("a");
        const modalProjeto = document.getElementById("modal-projeto");
        const btnCriarSessao = document.getElementById("btn-criar-sessao");
        const modalCriarSessao = document.getElementById("modal-criar-sessao");

        setupModal(btnNoticia, modalNoticia);
        setupModal(btnProjeto, modalProjeto);
        setupModal(btnCriarSessao, modalCriarSessao);

        function setupDelete(buttonClass, deleteUrl, itemType) {
            document.querySelectorAll(buttonClass).forEach(btn => {
                btn.addEventListener("click", () => {
                    const id = btn.dataset.id;
                    Swal.fire({
                        title: "Tem certeza?",
                        text: `Este ${itemType} será excluído permanentemente.`,
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Sim, excluir",
                        cancelButtonText: "Não, cancelar"
                    }).then(result => {
                        if (!result.isConfirmed) return;
                        const payload = { [`id_${itemType}`]: id };
                        if (itemType === "projeto") payload.ano = parseInt(btn.dataset.ano, 10);
                        fetch(deleteUrl, {
                            method: "POST",
                            headers: { "Content-Type": "application/json" },
                            body: JSON.stringify(payload)
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) Swal.fire("Excluído!", `O ${itemType} foi removido com sucesso.`, "success").then(() => location.reload());
                            else Swal.fire("Erro", data.message || `Não foi possível excluir o ${itemType}.`, "error");
                        })
                        .catch(() => Swal.fire("Erro", "Falha na comunicação com o servidor.", "error"));
                    });
                });
            });
        }

        setupDelete(".btn-delete", "delete_noticia.php", "noticia");
        setupDelete(".btn-delete-projeto", "delete_projeto.php", "projeto");

        function setupEdit(buttonSelector, modalId, formId, fetchUrl, fieldsMapper) {
            const modal = document.getElementById(modalId);
            const form = document.getElementById(formId);
            const close = modal.querySelector(".fechar");
            close.addEventListener("click", () => modal.style.display = "none");
            window.addEventListener("click", e => {
                if (e.target === modal) modal.style.display = "none";
            });
            document.querySelectorAll(buttonSelector).forEach(btn => {
                btn.addEventListener("click", e => {
                    e.preventDefault();
                    const id = btn.dataset.id;
                    const ano = btn.dataset.ano;
                    fetch(`${fetchUrl}?id=${id}&ano=${ano}`)
                        .then(r => r.json())
                        .then(data => {
                            fieldsMapper(data);
                            modal.style.display = "block";
                        });
                });
            });
            form.addEventListener("submit", e => {
                e.preventDefault();
                const formData = new FormData(form);
                fetch(fetchUrl, { method: "POST", body: formData })
                .then(r => r.json())
                .then(resp => {
                    if (resp.success) Swal.fire({ icon: "success", title: resp.message, timer: 1500, showConfirmButton: false }).then(() => location.reload());
                    else Swal.fire("Erro", resp.message, "error");
                })
                .catch(() => Swal.fire("Erro", "Falha na comunicação com o servidor.", "error"));
            });
        }

        setupEdit(
            ".btn-edit-noticia",
            "modal-edit-noticia",
            "form-edit-noticia",
            "edit_noticia.php",
            data => {
                document.getElementById("edit-noticia-id").value = data.id_noticia;
                document.getElementById("edit-noticia-titulo").value = data.titulo;
                document.getElementById("edit-noticia-conteudo").value = data.conteudo;
            }
        );

        setupEdit(
            ".btn-edit-projeto",
            "modal-edit-projeto",
            "form-edit-projeto",
            "edit_projeto.php",
            data => {
                document.getElementById("edit-projeto-id").value = data.id_projeto;
                document.getElementById("edit-projeto-titulo").value = data.titulo;
                document.getElementById("edit-projeto-descricao").value = data.descricao;
            }
        );

        document.querySelectorAll(".card-noticia .leia-mais").forEach(link => {
            link.addEventListener("click", () => {
                const p = link.previousElementSibling;
                p.classList.toggle("expanded");
                link.textContent = p.classList.contains("expanded") ? "Leia menos" : "Leia mais";
            });
        });

        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll(".card-noticia").forEach(card => {
                const p = card.querySelector("p");
                const leiaMais = card.querySelector(".leia-mais");
                const clone = p.cloneNode(true);
                clone.style.maxHeight = "none";
                clone.style.position = "absolute";
                clone.style.visibility = "hidden";
                clone.style.pointerEvents = "none";
                clone.style.width = getComputedStyle(p).width;
                card.appendChild(clone);
                if (clone.offsetHeight <= p.offsetHeight && leiaMais) leiaMais.style.display = "none";
                card.removeChild(clone);
            });
        });
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
                            <li><a href="https://www.linkedin.com/in/samuel-boaz-gon%c3%a7alves/">Samuel Boaz</a></li>
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
