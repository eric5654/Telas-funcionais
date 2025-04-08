<?php
require_once 'Connect.php';

$email = 'admin@gmail.com'; // Substitua pelo email desejado
$senha = '12345678'; // Substitua pela senha desejada

$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

$pdo = Connect::getConection();
$stmt = $pdo->prepare("INSERT INTO admin (email, senha, nome) VALUES (:email, :senha, 'Administrador Padrão')");
$stmt->bindValue(':email', $email);
$stmt->bindValue(':senha', $senha_hash);

if ($stmt->execute()) {
    echo "Administrador padrão criado com sucesso!";
} else {
    echo "Erro ao criar administrador padrão.";
}
?>