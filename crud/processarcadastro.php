<?php
require_once 'Connect.php';
require_once 'Individuo.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['registerName'] ?? null;
    $telefone = $_POST['registerPhone'] ?? null;
    $email = $_POST['registerEmail'] ?? null;
    $senha = $_POST['registerPassword'] ?? null;

    if ($nome && $telefone && $email && $senha) {
        $individuo = new Individuo($nome, $telefone, $email, $senha);

        if ($individuo->insert()) {
            // Redireciona para conclusao.html com mensagem de sucesso
            $mensagem = urlencode('<div class="alert alert-success"><i class="fas fa-check-circle"></i> Cadastro realizado com sucesso!</div>');
            header('Location: concluido.php?mensagem=' . $mensagem);
            exit;
        } else {
            // Redireciona para erro.html com mensagem de erro detalhada
            $mensagem = urlencode('<div class="alert alert-danger"><i class="fas fa-exclamation-triangle"></i> Erro ao realizar o cadastro: ' . $individuo->fail . '. Tente novamente.</div>');
            header('Location: erro.php?mensagem=' . $mensagem);
            exit;
        }
    } else {
        // Redireciona para erro.html com mensagem de erro detalhada
        $mensagem = urlencode('<div class="alert alert-warning"><i class="fas fa-exclamation-circle"></i> Por favor, preencha todos os campos do formulário corretamente.</div>');
        header('Location: erro.php?mensagem=' . $mensagem);
        exit;
    }
}
?>