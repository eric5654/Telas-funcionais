<?php
require_once 'Connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['loginEmail'] ?? null;
    $senha = $_POST['loginPassword'] ?? null;

    if ($email && $senha) {
        $pdo = Connect::getConection();
        $stmt = $pdo->prepare("SELECT id, nome, senha FROM individuo WHERE email = :email");
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            // Login bem-sucedido
            session_start();
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];

            $mensagem = urlencode("Login realizado com sucesso! Bem-vindo, " . $usuario['nome'] . ".");
            header('Location: loginconcluido.php?mensagem=' . $mensagem); // Redireciona para conclusao.html
            exit;
        } else {
            // Falha no login
            $mensagem = urlencode("Email ou senha incorretos.");
            header('Location: loginerro.php?mensagem=' . $mensagem); // Redireciona para erro.php
            exit;
        }
    } else {
        // Campos vazios
        $mensagem = urlencode("Preencha todos os campos.");
        header('Location: loginerro.php?mensagem=' . $mensagem); // Redireciona para erro.php
        exit;
    }
}
?>