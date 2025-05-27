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

$tabelasPermitidas = [
    2024 => 'projetos2024',
    2025 => 'projetos2025'
];

if (!array_key_exists($ano, $tabelasPermitidas)) {
    echo json_encode([
        'success' => false,
        'message' => 'Ano inválido'
    ]);
    exit;
}

$tabela = $tabelasPermitidas[$ano];

try {
    $sql  = "DELETE FROM {$tabela} WHERE id_projeto = ?";
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
