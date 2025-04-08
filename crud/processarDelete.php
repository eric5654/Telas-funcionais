<?php
require_once 'connect.php';
require_once 'individuo.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        
        $conn = Connect::getConection();

        
        $stmt = $conn->prepare("DELETE FROM individuo WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

      
        if ($stmt->execute()) {
          
            header("Location: system.php");
            exit();
        } else {
            echo "Erro ao deletar usuário.";
        }
    } catch (PDOException $e) {
        echo "Erro ao deletar usuário: " . $e->getMessage();
        exit();
    }
} else {
    echo "ID do usuário não fornecido.";
    if ($individuo->delete($id)) {
        echo "Usuário deletado com sucesso.";
        header("Location: system.php");
        exit();
    } else {
        echo "Erro ao deletar usuário: " . $individuo->fail;
    }
    
}
?>
