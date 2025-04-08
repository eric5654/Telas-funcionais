<?php

class Individuo {
    private $nome;
    private $telefone;
    private $email;
    private $senha;
    public $fail;

    public function __construct($nome, $telefone, $email, $senha) {
        $this->nome = $nome;
        $this->telefone = $telefone;
        $this->email = $email;
        $this->senha = $senha;
    }

    public function insert(): bool {
        $pdo = Connect::getConection();

        if ($this->checado()) {
            if ($this->registroUnico()) {
                $this->fail = "Telefone ou email já cadastrados.";
                return false;
            }

            try {
                $res = $pdo->prepare("INSERT INTO individuo (nome, telefone, email, senha) VALUES (:nome, :telefone, :email, :senha)");
                $res->bindValue(':nome', $this->nome);
                $res->bindValue(':telefone', $this->telefone);
                $res->bindValue(':email', $this->email);
                $res->bindValue(':senha', password_hash($this->senha, PASSWORD_DEFAULT));
                return $res->execute();
            } catch (PDOException $e) {
                $this->fail = "Erro ao inserir no banco de dados: " . $e->getMessage();
                return false;
            }
        }
        return false;
    }

    public function registroUnico(): bool {
        $pdo = Connect::getConection();
        $res = $pdo->prepare("SELECT * FROM individuo WHERE telefone = :telefone OR email = :email");
        $res->bindValue(':telefone', $this->telefone);
        $res->bindValue(':email', $this->email);
        $res->execute();

        return $res->rowCount() > 0;
    }

    public function checado(): bool {
        if (empty($this->nome) || empty($this->telefone) || empty($this->email) || empty($this->senha)) {
            $this->fail = "Todos os campos são obrigatórios.";
            return false;
        }

        if (strlen($this->nome) > 45) {
            $this->fail = "O nome deve ter no máximo 45 caracteres.";
            return false;
        }

        // Limpa o telefone removendo caracteres não numéricos
        $this->telefone = preg_replace('/[^0-9]/', '', $this->telefone);

        if (!preg_match('/^[0-9]{10,11}$/', $this->telefone)) {
            $this->fail = "O telefone deve conter apenas números e ter 10 ou 11 dígitos.";
            return false;
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->fail = "O email fornecido não é válido.";
            return false;
        }

        if (strlen($this->senha) < 6) {
            $this->fail = "A senha deve ter no mínimo 6 caracteres.";
            return false;
        }

        return true;
    }

    public static function getAll() {
        $pdo = Connect::getConection();
        try {
            $res = $pdo->query("SELECT * FROM individuo");
            return $res->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ["erro" => "Erro ao buscar dados: " . $e->getMessage()];
        }
    }
}
?>