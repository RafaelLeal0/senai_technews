<?php
session_start();
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: adm.php');
    exit();
}

$titulo    = $_POST['titulo']    ?? '';
$descricao = $_POST['descricao'] ?? '';
$ano       = $_POST['ano']       ?? '';

// Validação básica
if (empty($titulo) || empty($descricao) || empty($ano)) {
    $_SESSION['flash_error'] = 'Todos os campos são obrigatórios.';
    header('Location: adm.php');
    exit();
}

// Aqui montamos dinamicamente o nome da tabela
$tabela = "projetos{$ano}";

try {
    // Opcional: Verifica se a tabela realmente existe
    $stmtCheck = $conn->query("SHOW TABLES LIKE '{$tabela}'");
    if ($stmtCheck->rowCount() === 0) {
        throw new Exception("A tabela {$tabela} não existe.");
    }

    // Lê o conteúdo bruto do arquivo de imagem
    $imagem = file_get_contents($_FILES['imagem']['tmp_name']);

    // Prepara e executa o INSERT na tabela correta
    $sql  = "INSERT INTO `{$tabela}` (titulo, descricao, imagem_projeto) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$titulo, $descricao, $imagem]);

    $_SESSION['flash_success'] = "Projeto publicado com sucesso em {$ano}!";
} catch (PDOException $e) {
    $_SESSION['flash_error'] = 'Erro ao publicar projeto: ' . $e->getMessage();
} catch (Exception $e) {
    $_SESSION['flash_error'] = 'Erro: ' . $e->getMessage();
}

header('Location: adm.php');
exit();
