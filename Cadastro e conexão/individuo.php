<?php
class Individuo {
    private $nome;
    private $telefone;
    private $email;
    private $cpf;
    private $senha;
    public $fail;

    public function __construct($nome, $telefone, $email, $cpf, $senha) {
        $this->nome = $nome;
        $this->telefone = $telefone;
        $this->email = $email;
        $this->cpf = $cpf;
        $this->senha = $senha;
    }

    public function insert(): bool {
        $pdo = Connect::getConection();

        if ($this->checado()) {
            if ($this->registroUnico()) {
                $this->fail = "Telefone, email ou CPF já cadastrados.";
                return false;
            }

            try {
                $res = $pdo->prepare("INSERT INTO individuo (nome, telefone, email, cpf, senha) VALUES (:nome, :telefone, :email, :cpf, :senha)");
                $res->bindValue(':nome', $this->nome);
                $res->bindValue(':telefone', $this->telefone);
                $res->bindValue(':email', $this->email);
                $res->bindValue(':cpf', $this->cpf);
                $res->bindValue(':senha', password_hash($this->senha, PASSWORD_DEFAULT)); // Hash da senha para segurança
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
        $res = $pdo->prepare("SELECT * FROM individuo WHERE telefone = :telefone OR email = :email OR cpf = :cpf");
        $res->bindValue(':telefone', $this->telefone);
        $res->bindValue(':email', $this->email);
        $res->bindValue(':cpf', $this->cpf);
        $res->execute();

        return $res->rowCount() > 0;
    }

    public function checado(): bool {
        if (empty($this->nome) || empty($this->telefone) || empty($this->email) || empty($this->cpf) || empty($this->senha)) {
            $this->fail = "Todos os campos são obrigatórios.";
            return false;
        }

        if (strlen($this->nome) > 45) {
            $this->fail = "O nome deve ter no máximo 45 caracteres.";
            return false;
        }

        if (!preg_match('/^[0-9]{10,11}$/', $this->telefone)) {
            $this->fail = "O telefone deve ter entre 10 e 11 dígitos numéricos.";
            return false;
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->fail = "O email fornecido não é válido.";
            return false;
        }

        if (!preg_match('/^[0-9]{11}$/', $this->cpf)) {
            $this->fail = "O CPF deve conter exatamente 11 dígitos numéricos.";
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
