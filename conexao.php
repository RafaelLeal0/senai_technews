<?php
function conectarBanco() {
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "senai_technews";

    try {
        $pdo = new PDO(
            "mysql:host=$servidor;dbname=$banco;charset=utf8",
            $usuario, 
            $senha,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]
        );
        return $pdo;
    } catch (PDOException $e) {
        die("Falha na conexão: " . $e->getMessage());
    }
}

return conectarBanco(); // <- ESSA LINHA É CERTA
?>
