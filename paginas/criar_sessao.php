<?php
session_start();
require_once 'conexao.php';

// 1) Validações básicas de método e campo ano
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['flash_error'] = "Envio inválido.";
    header('Location: adm.php');
    exit();
}

if (!isset($_POST['ano_sessao'])) {
    $_SESSION['flash_error'] = "Ano da sessão não fornecido.";
    header('Location: adm.php');
    exit();
}

$ano = intval($_POST['ano_sessao']);
if ($ano < 2000 || $ano > 2100) {
    $_SESSION['flash_error'] = "Ano inválido. Digite um valor entre 2000 e 2100.";
    header('Location: adm.php');
    exit();
}

// 2) Verifica upload de fundo
if (!isset($_FILES['imagem_fundo']) || $_FILES['imagem_fundo']['error'] !== UPLOAD_ERR_OK) {
    $_SESSION['flash_error'] = "Falha no upload da imagem de fundo.";
    header('Location: adm.php');
    exit();
}

// Permitir apenas PNG e JPEG
$tmpName = $_FILES['imagem_fundo']['tmp_name'];
$mime    = mime_content_type($tmpName);
$ext     = null;

if ($mime === 'image/png') {
    $ext = 'png';
} elseif ($mime === 'image/jpeg' || $mime === 'image/jpg') {
    $ext = 'jpg';
} else {
    $_SESSION['flash_error'] = "Formato de imagem não suportado. Use PNG ou JPG.";
    header('Location: adm.php');
    exit();
}

// 3) Define onde salvar e qual nome usar
// Cria pasta “../img/sessoes” se não existir
$destDir = __DIR__ . "/../img/sessoes";
if (!is_dir($destDir)) {
    mkdir($destDir, 0755, true);
}

// Nome do arquivo: "sessao<ano>.ext" (ex: sessao2026.jpg)
$nomeArquivoFundo = "sessao{$ano}.{$ext}";
$caminhoCompleto  = "$destDir/$nomeArquivoFundo";

// Move upload para o destino final
if (!move_uploaded_file($tmpName, $caminhoCompleto)) {
    $_SESSION['flash_error'] = "Não foi possível salvar a imagem de fundo.";
    header('Location: adm.php');
    exit();
}

$tabela = "projetos{$ano}";

try {
    // 4) Verifica se a tabela já existe (por segurança)
    $stmtCheck = $conn->query("SHOW TABLES LIKE '{$tabela}'");
    if ($stmtCheck->rowCount() > 0) {
        $_SESSION['flash_error'] = "A sessão para o ano {$ano} já existe.";
        // Se quiser apagar a imagem que acabou de enviar, faça unlink($caminhoCompleto) aqui
        header('Location: adm.php');
        exit();
    }

    // 5) Cria a tabela replicando a estrutura de “projetos2025”
    $sqlCreate = "CREATE TABLE `{$tabela}` LIKE `projetos2025`;";
    $conn->exec($sqlCreate);

    // 6) Gera o arquivo PHP baseado em “projetocinco.php”
    $template = file_get_contents('projeto2025.php');
    if ($template === false) {
        throw new Exception("Erro ao ler o template projeto2025.php.");
    }

    $novoConteudo = str_replace(
        ['projetos2025', 'projeto2025', '>2025<'],
        ["projetos{$ano}", "projeto{$ano}", ">{$ano}<"],
        $template
    );
    file_put_contents("projeto{$ano}.php", $novoConteudo);

    // 7) (Opcional) Copiar CSS de projeto para projeto<ano>.css
    $cssOrigem  = "../css/projetocinco.css";
    $cssDestino = "../css/projeto{$ano}.css";
    if (file_exists($cssOrigem)) {
        copy($cssOrigem, $cssDestino);
    }

    $_SESSION['flash_success'] = "Sessão (ano {$ano}) criada com sucesso!";
    header('Location: adm.php');
    exit();

} catch (PDOException $e) {
    // Em caso de erro no BD, tenta apagar a imagem de fundo para não deixar lixo
    if (file_exists($caminhoCompleto)) {
        unlink($caminhoCompleto);
    }
    $_SESSION['flash_error'] = "Erro no banco de dados: " . $e->getMessage();
    header('Location: adm.php');
    exit();

} catch (Exception $e) {
    if (file_exists($caminhoCompleto)) {
        unlink($caminhoCompleto);
    }
    $_SESSION['flash_error'] = "Erro: " . $e->getMessage();
    header('Location: adm.php');
    exit();
}
