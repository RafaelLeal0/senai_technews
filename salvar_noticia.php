<?php
session_start();
if (!isset($_SESSION['professor'])) {
    header('Location: login.php');
    exit();
}
require_once 'conexao.php';

$titulo = $_POST['titulo'] ?? '';
$conteudo = $_POST['conteudo'] ?? '';
$categoria = $_POST['categoria'] ?? '';
$id_professor = $_SESSION['professor']['id'];
$data_publicacao = date('Y-m-d H:i:s');

if (empty($titulo) || empty($conteudo) || empty($categoria)) {
    $_SESSION['flash_error'] = 'Preencha todos os campos!';
    header('Location: adm.php');
    exit();
}

try {
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
