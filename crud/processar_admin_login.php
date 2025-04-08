<?php
require_once 'Connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['adminLoginEmail'] ?? null;
    $senha = $_POST['adminLoginPassword'] ?? null;

    if ($email && $senha) {
        $pdo = Connect::getConection();
        $stmt = $pdo->prepare("SELECT id, nome, senha FROM admin WHERE email = :email");
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin && password_verify($senha, $admin['senha'])) {
            // Login bem-sucedido
            session_start();
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_nome'] = $admin['nome'];

            // Redireciona para system.php
            header('Location: system.php');
            exit;
        } else {
            // Falha no login
            $mensagem = urlencode("Email ou senha incorretos.");
            header('Location: erro.php?mensagem=' . $mensagem);
            exit;
        }
    } else {
        // Campos vazios
        $mensagem = urlencode("Preencha todos os campos.");
        header('Location: erro.php?mensagem=' . $mensagem);
        exit;
    }
}
?>