<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erro</title>
    <link href="src/css/index.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .erro-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }

        .erro-mensagem {
            font-size: 24px;
            color: red;
            margin-bottom: 20px;
        }

        .erro-botao {
            padding: 10px 20px;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }
    </style>
</head>
<body class="body-custom">
    <div class="erro-container">
        <div class="erro-mensagem">
            <?php
                // Exibe a mensagem de erro recebida via GET
                if (isset($_GET['mensagem'])) {
                    echo urldecode($_GET['mensagem']);
                } else {
                    echo "Ocorreu um erro. Tente novamente.";
                }
            ?>
        </div>
        <a href="index.html" class="erro-botao">Voltar para a página inicial</a>
    </div>
</body>
</html>