<?php
session_start();
require_once 'conexao.php';

if (!isset($_POST['ano_excluir'])) {
    $_SESSION['flash_error'] = "Ano da sessão não informado.";
    header('Location: adm.php');
    exit();
}

$anoExcluir = intval($_POST['ano_excluir']);
if ($anoExcluir < 2000 || $anoExcluir > 2100) {
    $_SESSION['flash_error'] = "Ano inválido.";
    header('Location: adm.php');
    exit();
}

$tabela = "projetos{$anoExcluir}";

try {
    // 1) Verifica se a tabela existe
    $stmtCheck = $conn->query("SHOW TABLES LIKE '{$tabela}'");
    if ($stmtCheck->rowCount() === 0) {
        $_SESSION['flash_error'] = "A sessão {$anoExcluir} não existe.";
        header('Location: adm.php');
        exit();
    }

    // 2) Dropa a tabela
    $conn->exec("DROP TABLE `{$tabela}`");

    // 3) Remove o arquivo PHP correspondente, se existir
    $arquivoPhp = __DIR__ . "/projeto{$anoExcluir}.php";
    if (file_exists($arquivoPhp)) {
        unlink($arquivoPhp);
    }

    // 4) Remove o CSS correspondente, se existir
    $arquivoCss = __DIR__ . "/../css/projeto{$anoExcluir}.css";
    if (file_exists($arquivoCss)) {
        unlink($arquivoCss);
    }

    // 5) Remove a(s) imagem(ns) da sessão, procurando em img/sessoes/
    $pastaImg = __DIR__ . "/../img/sessoes/";
    foreach (glob($pastaImg . "sessao{$anoExcluir}.*") as $img) {
        if (is_file($img)) {
            unlink($img);
        }
    }

    $_SESSION['flash_success'] = "Sessão (ano {$anoExcluir}) excluída com sucesso!";
    header('Location: adm.php');
    exit();

} catch (PDOException $e) {
    $_SESSION['flash_error'] = "Erro no banco de dados: " . $e->getMessage();
    header('Location: adm.php');
    exit();
} catch (Exception $e) {
    $_SESSION['flash_error'] = "Erro: " . $e->getMessage();
    header('Location: adm.php');
    exit();
}
