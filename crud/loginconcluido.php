<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Concluído</title>
    <link href="src/css/index.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .login-conclusao-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }

        .login-conclusao-mensagem {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .login-conclusao-botao {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }
    </style>
</head>
<body class="body-custom">
    <div class="login-conclusao-container">
        <div class="login-conclusao-mensagem">
            <?php
                // Exibe a mensagem de login concluído recebida via GET
                if (isset($_GET['mensagem'])) {
                    echo urldecode($_GET['mensagem']);
                } else {
                    echo "Login realizado com sucesso!";
                }
            ?>
        </div>
        <a href="index.html" class="login-conclusao-botao">Ir para a página principal</a>
    </div>
</body>
</html>