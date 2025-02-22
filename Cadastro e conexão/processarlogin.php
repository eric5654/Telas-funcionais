<?php
require_once 'Connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['loginEmail'] ?? null;
    $senha = $_POST['loginPassword'] ?? null;

    if ($email && $senha) {
        $pdo = Connect::getConection();
        $stmt = $pdo->prepare("SELECT * FROM individuo WHERE email = :email");
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            echo "Login bem-sucedido!";
        } else {
            echo "Email ou senha incorretos.";
        }
    } else {
        echo "Preencha todos os campos.";
    }
}
?>
