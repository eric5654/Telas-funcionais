<?php
require_once 'Connect.php';
require_once 'Individuo.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['registerName'] ?? null;
    $telefone = $_POST['registerPhone'] ?? null;
    $email = $_POST['registerEmail'] ?? null;
    $cpf = $_POST['registerCPF'] ?? null;
    $senha = $_POST['registerPassword'] ?? null;

    if ($nome && $telefone && $email && $cpf && $senha) {
        $individuo = new Individuo($nome, $telefone, $email, $cpf, $senha);

        if ($individuo->insert()) {
            echo "Cadastro realizado com sucesso!";
        } else {
            echo "Erro no cadastro: " . $individuo->fail;
        }
    } else {
        echo "Todos os campos são obrigatórios.";
    }
}
?>
