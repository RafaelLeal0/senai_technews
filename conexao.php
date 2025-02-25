<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "senai_technews";

try {
    $conexao = new PDO("mysql:host=$servidor;dbname=$banco;charset=utf8", $usuario, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conectado com sucesso!";
} catch (PDOException $e) {
    die("Falha na conexão: " . $e->getMessage());
}
?>
