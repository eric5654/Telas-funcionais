<?php
require_once 'Connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $senha = $_POST['senha'];
    $confirmSenha = $_POST['confirmSenha'];

    if ($senha != $confirmSenha) {
        echo "As senhas não coincidem!";
        exit;
    }

    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    // Formatar e validar o número de telefone
    $telefone = preg_replace('/[^0-9]/', '', $telefone); // Remove caracteres não numéricos

    if (strlen($telefone) < 10 || strlen($telefone) > 11) {
        echo "Número de telefone inválido!";
        exit;
    }

    try {
        $conn = Connect::getConection();
        $query = "INSERT INTO individuo (nome, email, telefone, senha) VALUES (:nome, :email, :telefone, :senha)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':senha', $senhaHash);
        if ($stmt->execute()) {
            echo "Usuário cadastrado com sucesso!";
            header("Location: system.php");
            exit;
        } else {
            echo "Erro ao cadastrar o usuário.";
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>