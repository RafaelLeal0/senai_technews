<?php
session_start();
require_once 'conexao.php'; // ajuste o caminho se necessário

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: adm.php');
    exit();
}

$titulo    = $_POST['titulo'];
$descricao = $_POST['descricao'];
$ano       = $_POST['ano'];

// Lê o conteúdo binário da imagem
$imagem = file_get_contents($_FILES['imagem']['tmp_name']);

// Seleciona tabela de acordo com o ano
$tabela = ($ano === '2024') ? 'projetos2024' : 'projetos2025';

try {
    // Insere os dados na tabela correta
    $stmt = $conn->prepare("INSERT INTO $tabela (titulo, descricao, imagem_projeto) VALUES (?, ?, ?)");
    $stmt->execute([$titulo, $descricao, $imagem]);

    $_SESSION['flash_success'] = 'Projeto publicado com sucesso!';
} catch (PDOException $e) {
    $_SESSION['flash_error'] = 'Erro ao publicar projeto: ' . $e->getMessage();
}

header('Location: adm.php');
exit();
