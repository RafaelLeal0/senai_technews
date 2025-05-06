<?php
require_once 'conexao.php';
session_start();

// Só professores logados podem excluir
if (!isset($_SESSION['professor'])) {
    http_response_code(401);
    echo json_encode(['success' => false]);
    exit;
}

// Recebe JSON
$data = json_decode(file_get_contents('php://input'), true);
$id = isset($data['id_noticia']) ? (int)$data['id_noticia'] : 0;

if ($id > 0) {
    try {
        $stmt = $conn->prepare("DELETE FROM noticias WHERE id_noticia = ?");
        $stmt->execute([$id]);
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}
