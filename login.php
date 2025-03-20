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
            <label>Email</label>
            <input type="email" name="email" required placeholder="Coloque seu email">
            <label>Senha</label>
            <input type="password" name="senha" required placeholder="Coloque sua senha">
            <button type="submit">Entrar</button>
        </form>
    </div>
    
    <a href="index.php" class="back-arrow">&#8592;</a>
</body>
</html>

