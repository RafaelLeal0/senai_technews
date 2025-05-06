<?php
session_start();
if (!isset($_SESSION['professor'])) {
    header('Location: login.php');
    exit();
}
require_once 'conexao.php';

$titulo        = $_POST['titulo']    ?? '';
$conteudo      = $_POST['conteudo']  ?? '';
$categoria     = $_POST['categoria'] ?? '';
$id_professor  = $_SESSION['professor']['id']; // ou 'id_professor', conforme sua session
$data_publicacao = date('Y-m-d H:i:s');

// Validação básica
if (empty($titulo) || empty($conteudo) || empty($categoria)) {
    $_SESSION['flash_error'] = 'Preencha todos os campos!';
    header('Location: adm.php');
    exit();
}

try {
    // Insere a notícia
    $sql = "INSERT INTO noticias 
              (titulo, conteudo, categoria, id_professor, data_publicacao) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$titulo, $conteudo, $categoria, $id_professor, $data_publicacao]);

    $_SESSION['flash_success'] = 'Notícia publicada com sucesso!';
} catch (PDOException $e) {
    $_SESSION['flash_error'] = 'Erro ao publicar notícia: ' . $e->getMessage();
}

header('Location: adm.php');
exit();
