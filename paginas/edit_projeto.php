<?php
require_once 'conexao.php';
session_start();
header('Content-Type: application/json');

try {
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
        $id = (int) $_GET['id'];

        // Se veio o ano pelo front‑end, usa direto
        if (isset($_GET['ano'])) {
            $ano = (int) $_GET['ano'];
            $tabela = "projetos{$ano}";
        } else {
            // Caso contrário, tenta descobrir dinamicamente
            $stmtFind = $conn->prepare(
                "SELECT 'projetos2024' AS tabela FROM projetos2024 WHERE id_projeto = ?
                 UNION ALL
                 SELECT 'projetos2025' AS tabela FROM projetos2025 WHERE id_projeto = ?"
            );
            $stmtFind->execute([$id, $id]);
            $found = $stmtFind->fetch(PDO::FETCH_ASSOC);

            if (!$found) {
                throw new Exception("Projeto não encontrado em nenhuma tabela.");
            }
            $tabela = $found['tabela'];
        }

        // Busca os dados do projeto na tabela correta
        $stmt = $conn->prepare("SELECT id_projeto, titulo, descricao FROM `{$tabela}` WHERE id_projeto = ?");
        $stmt->execute([$id]);
        $proj = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$proj) {
            throw new Exception("Falha ao recuperar dados do projeto.");
        }

        echo json_encode($proj);
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id        = (int) $_POST['id_projeto'];
        $titulo    = trim($_POST['titulo']);
        $descricao = trim($_POST['descricao']);

        // Se o front‑end informar ano, usa direto
        if (isset($_POST['ano'])) {
            $ano = (int) $_POST['ano'];
            $tabela = "projetos{$ano}";
        } else {
            // Senão, descobre dinamicamente
            $stmtFind = $conn->prepare(
                "SELECT 'projetos2024' AS tabela FROM projetos2024 WHERE id_projeto = ?
                 UNION ALL
                 SELECT 'projetos2025' AS tabela FROM projetos2025 WHERE id_projeto = ?"
            );
            $stmtFind->execute([$id, $id]);
            $found = $stmtFind->fetch(PDO::FETCH_ASSOC);

            if (!$found) {
                throw new Exception("Projeto não encontrado para atualização.");
            }
            $tabela = $found['tabela'];
        }

        // Monta o UPDATE
        $sql = "UPDATE `{$tabela}` SET titulo = :titulo, descricao = :descricao";
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

    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método não permitido.']);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
