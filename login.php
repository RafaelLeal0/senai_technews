<?php
session_start();

require_once "conexao.php";
$pdo = conectarBanco();

// Processar formulário de login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $codigo_acesso = $_POST['codigo_acesso'] ?? '';

    try {
        $stmt = $pdo->prepare("SELECT * FROM professores WHERE email = ? AND senha = ? AND codigo_acesso = ?");
        $stmt->execute([$email, $senha, $codigo_acesso]);
        $professor = $stmt->fetch();

        if ($professor) {
            $_SESSION['professor'] = [
                'id' => $professor['id_professor'],
                'nome' => $professor['nome'],
                'email' => $professor['email']
            ];
            header('Location: adm.php');
            exit();
        } else {
            $erro = "Credenciais inválidas! Verifique email, senha e código de acesso.";
        }
    } catch (PDOException $e) {
        $erro = "Erro no login: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SENAI TechNews</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="./img/logo/logotop.png">
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>
    <div class="left">
        <h1>BEM VINDO AO <br><span>SENAI TECHNEWS</span></h1>
    </div>
    <div class="right">
        <img src="./img/senai_technews.png" class="logo" alt="SENAI Logo">
        <form method="POST" action="">
            <?php if (isset($erro)): ?>
                <div class="erro"><?= $erro ?></div>
            <?php endif; ?>

            <label>Email</label>
            <input type="email" name="email" required placeholder="Coloque seu email">
            
            <label>Senha</label>
            <input type="password" name="senha" required placeholder="Coloque sua senha">
            
            <label>Código de Acesso</label>
            <input type="text" name="codigo_acesso" required placeholder="Insira o código de acesso">

            <div class="forgot-password">
                <a href="recuperar_senha.php">Esqueceu a senha?</a>
            </div>

            <button type="submit" id="botao-entrar">Entrar</button>
        </form>
    </div>
    
    <a href="index.php" class="back-arrow">&#8592;</a>
</body>
</html>