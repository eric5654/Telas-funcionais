<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conclusão</title>
    <link href="src/css/index.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .conclusao-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }

        .conclusao-mensagem {
            font-size: 24px;
            margin-bottom: 20px;
            color: red; /* Adicionado para tornar o texto vermelho */
        }

        .conclusao-botao {
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
    <div class="conclusao-container">
        <div class="conclusao-mensagem">
            <?php
                // Exibe a mensagem de conclusão recebida via GET
                if (isset($_GET['mensagem'])) {
                    echo urldecode($_GET['mensagem']);
                } else {
                    echo "Cadastro bem sucedido!";
                }
            ?>
        </div>
        <a href="index.html" class="conclusao-botao">Voltar para a página inicial</a>
    </div>
</body>
</html>