<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SENAI TechNews</title>
    <style>
        * {
             margin: 0; 
             padding: 0; 
             box-sizing: border-box; 
            }

        body { 
            display: flex; 
            height: 100vh; 
            font-family: Arial, sans-serif; }

        .left { 
            width: 50%; 
            background:  linear-gradient(rgba(66, 66, 66, 0.5), rgba(66, 66, 66, 0.5)),  url('./img/senai-image.png') no-repeat center center/cover; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            color: white; 
            text-align: center; 
        }
        
        .left h1 { 
            font-size: 24px; 
        }

        .left span { 
            color: red; 
            font-weight: bold; 
        }
        
        .right { 
            width: 50%; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            background: white; 
            flex-direction: column; }
        
        .logo { 
            margin-top: -100px;
            margin-bottom:60px;
            width: 220px;
            height: auto;
        }

        form { 
            width: 80%; 
            max-width: 400px;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input { 
            width: 100%;
            padding: 10px; 
            margin-bottom: 10px; 
            border: 1px solid #800000; 
            border-radius: 5px; 
        }
        
        label { 
           margin-bottom: -10px;
        }

        button {
            width: 100%; 
            padding: 10px; 
            background: #800000; 
            color: white; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; }

        button:hover { 
            background: #600000; 
        }

        .error { 
            color: red; 
        }
    </style>
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
</body>
</html>
