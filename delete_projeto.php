<?php
header('Content-Type: application/json');
require_once 'conexao.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['id_projeto'])) {
    echo json_encode(['success' => false, 'message' => 'ID do projeto não fornecido']);
    exit;
}

$idProjeto = $data['id_projeto'];

try {
    $stmt2024 = $conn->prepare("SELECT * FROM projetos2024 WHERE id_projeto = ?");
    $stmt2024->execute([$idProjeto]);

    if ($stmt2024->rowCount() > 0) {
        $stmtDelete = $conn->prepare("DELETE FROM projetos2024 WHERE id_projeto = ?");
    } else {
        $stmt2025 = $conn->prepare("SELECT * FROM projetos2025 WHERE id_projeto = ?");
        $stmt2025->execute([$idProjeto]);

        if ($stmt2025->rowCount() > 0) {
            $stmtDelete = $conn->prepare("DELETE FROM projetos2025 WHERE id_projeto = ?");
        } else {
            echo json_encode(['success' => false, 'message' => 'Projeto não encontrado']);
            exit;
        }
    }

    if ($stmtDelete->execute([$idProjeto])) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao excluir']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>