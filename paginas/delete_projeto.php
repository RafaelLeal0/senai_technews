<?php
header('Content-Type: application/json');
require_once 'conexao.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['id_projeto'], $data['ano'])) {
    echo json_encode([
        'success' => false,
        'message' => 'ID do projeto ou ano não fornecido'
    ]);
    exit;
}

$idProjeto = (int) $data['id_projeto'];
$ano       = (int) $data['ano'];

// Monta o nome da tabela dinamicamente
$tabela = "projetos{$ano}";

try {
    // 1) Verifica se a tabela existe
    $stmtCheck = $conn->query("SHOW TABLES LIKE '{$tabela}'");
    if ($stmtCheck->rowCount() === 0) {
        echo json_encode([
            'success' => false,
            'message' => "Sessão/ano {$ano} não existe"
        ]);
        exit;
    }

    // 2) Prepara e executa o DELETE
    $sql  = "DELETE FROM `{$tabela}` WHERE id_projeto = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt->execute([$idProjeto])) {
        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Projeto não encontrado no ano informado'
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Erro ao executar exclusão'
        ]);
    }

} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Erro de banco de dados: ' . $e->getMessage()
    ]);
}
