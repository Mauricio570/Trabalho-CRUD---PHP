<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login do Sistema</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: white;
            padding: 30px 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 350px;
            text-align: center;
        }
        .icon {
            font-size: 50px;
            margin-bottom: 10px;
        }
        h2 {
            margin-bottom: 20px;
        }
        input {
            box-sizing: border-box;
            width: 95%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background: #28a745;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background: #218838;
        }
        .error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <div class="icon">👤</div>
        <h2>Login do Sistema</h2>
        <form method="POST" action="../login.php">
            <input type="text" name="usuario" placeholder="Usuário ou e-mail" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit">Entrar</button>
            <!-- mensagem de erro -->
            <?php
                session_start();

                // mensagem de erro é armazenada na sessão, dessa forma, verifica se existe uma mensagem para ser mostrada
                if (isset($_SESSION["erro"]))
                    // exibe a mensagem de erro 
                    echo ('<p class="error">'. $_SESSION["erro"] .'</p>');

                // apaga a variavel para impedir que seja exiba nas outras vezes que a página for carregada
                unset($_SESSION["erro"]);
            ?>
           
        </form>
    </div>
</body>
</html>