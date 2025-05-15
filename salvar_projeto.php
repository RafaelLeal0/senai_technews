<?php
session_start();
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: adm.php');
    exit();
}

$titulo = $_POST['titulo'];
$descricao = $_POST['descricao'];
$ano = $_POST['ano'];

$imagem = file_get_contents($_FILES['imagem']['tmp_name']);

$tabela = ($ano === '2024') ? 'projetos2024' : 'projetos2025';

try {
    $stmt = $conn->prepare("INSERT INTO $tabela (titulo, descricao, imagem_projeto) VALUES (?, ?, ?)");
    $stmt->execute([$titulo, $descricao, $imagem]);

    $_SESSION['flash_success'] = 'Projeto publicado com sucesso!';
} catch (PDOException $e) {
    $_SESSION['flash_error'] = 'Erro ao publicar projeto: ' . $e->getMessage();
}

header('Location: adm.php');
exit();
