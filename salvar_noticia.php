<?php
session_start();
require_once 'conexao.php'; // Arquivo que contém a conexão PDO com o banco de dados

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitiza e coleta os dados do POST
    $titulo = trim($_POST['titulo']);
    $conteudo = trim($_POST['conteudo']);
    $categoria = trim($_POST['categoria']);
    $professor_id = intval($_POST['professor_id']);

    // Verifica se todos os campos obrigatórios estão preenchidos
    if ($titulo && $conteudo && $categoria && $autor_id) {
        try {
            $stmt = $pdo->prepare("INSERT INTO noticias (titulo, conteudo, categoria, professor_id) VALUES (?, ?, ?, ?)");
            $stmt->execute([$titulo, $conteudo, $categoria, $professor_id]);

            // Redireciona com sucesso
            header("Location: adm.php?status=sucesso");
            exit;
        } catch (PDOException $e) {
            echo "Erro ao salvar notícia: " . $e->getMessage();
        }
    } else {
        echo "Todos os campos são obrigatórios.";
    }
} else {
    echo "Método inválido.";
}
