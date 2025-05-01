<?php
session_start();

// Verifica se o professor está logado
if (!isset($_SESSION['professor'])) {
    header('Location: login.php');
    exit();
}

require_once 'conexao.php'; // substitua pelo nome correto do seu arquivo de conexão com o banco

// Obtém os dados do formulário
$titulo = $_POST['titulo'] ?? '';
$conteudo = $_POST['conteudo'] ?? '';
$categoria = $_POST['categoria'] ?? '';
$id_professor = $_SESSION['professor']['id']; // ou outro nome real
$data_publicacao = date('Y-m-d H:i:s');

// Verifica se os dados obrigatórios foram preenchidos
if (empty($titulo) || empty($conteudo) || empty($categoria)) {
    echo "Preencha todos os campos!";
    exit();
}

// Prepara e executa a query de inserção
$sql = "INSERT INTO noticias (titulo, conteudo, categoria, id_professor, data_publicacao) 
        VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt->execute([$titulo, $conteudo, $categoria, $id_professor, $data_publicacao])) {
    echo "<script>alert('Notícia publicada com sucesso!'); window.location.href = 'adm.php';</script>";
} else {
    echo "Erro ao salvar a notícia.";
}
?>
