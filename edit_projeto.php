<?php
require_once 'conexao.php';
header('Content-Type: application/json');

try {
  // 1) GET: busca dados atuais para popular o form
  if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    // Tenta em 2024
    $stmt = $conn->prepare("SELECT id_projeto, titulo, descricao, 2024 AS ano 
                              FROM projetos2024 WHERE id_projeto = ?");
    $stmt->execute([$id]);
    $proj = $stmt->fetch(PDO::FETCH_ASSOC);

    // Se não achou, tenta em 2025
    if (!$proj) {
      $stmt = $conn->prepare("SELECT id_projeto, titulo, descricao, 2025 AS ano 
                                FROM projetos2025 WHERE id_projeto = ?");
      $stmt->execute([$id]);
      $proj = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    if (!$proj) {
      throw new Exception("Projeto não encontrado.");
    }

    echo json_encode($proj);
    exit;
  }

  // 2) POST: aplica o update
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id        = (int) $_POST['id_projeto'];
    $titulo    = trim($_POST['titulo']);
    $descricao = trim($_POST['descricao']);
    $ano       = isset($_POST['ano']) ? (int) $_POST['ano'] : null;

    if (!$ano || !in_array($ano, [2024,2025])) {
      throw new Exception("Ano inválido.");
    }

    // Define a tabela certa
    $table = ($ano === 2024) ? 'projetos2024' : 'projetos2025';

    // Monta o SQL básico
    $sql = "UPDATE $table SET titulo = :titulo, descricao = :descricao";

    // Se veio arquivo de imagem, anexa ao update
    $params = [
      ':titulo'    => $titulo,
      ':descricao' => $descricao,
      ':id'        => $id
    ];
    if (!empty($_FILES['imagem']['tmp_name'])) {
      $bin = file_get_contents($_FILES['imagem']['tmp_name']);
      $sql .= ", imagem_projeto = :img";
      $params[':img'] = $bin;
    }
    $sql .= " WHERE id_projeto = :id";

    $upd = $conn->prepare($sql);
    $success = $upd->execute($params);

    echo json_encode([
      'success' => (bool) $success,
      'message' => $success
        ? 'Projeto atualizado com sucesso!'
        : 'Falha ao atualizar o projeto.'
    ]);
    exit;
  }

  // Se chegou aqui, método não suportado
  http_response_code(405);
  echo json_encode(['success'=>false,'message'=>'Método não permitido.']);

} catch (Exception $e) {
  http_response_code(500);
  echo json_encode(['success'=>false,'message'=> $e->getMessage()]);
}
