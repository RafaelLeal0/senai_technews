<?php
session_start();
require_once 'conexao.php'; // Garanta que o caminho está correto

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $ano = $_POST['ano'];
    
    // Processar upload da imagem
    $imagem = file_get_contents($_FILES['imagem']['tmp_name']);
    
    // Determinar a tabela correta
    $tabela = ($ano == '2024') ? 'projetos2024' : 'projetos2025';
    
    try {
        // Usando a variável $conn do arquivo de conexão
        $stmt = $conn->prepare("INSERT INTO $tabela (titulo, descricao, imagem_projeto) VALUES (?, ?, ?)");
        $stmt->execute([$titulo, $descricao, $imagem]);
        
        header('Location: adm.php?success=1');
    } catch (PDOException $e) {
        die("Erro ao salvar projeto: " . $e->getMessage());
    }
}
?>