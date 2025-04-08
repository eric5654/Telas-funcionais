<?php
class Connect {
    
        private const HOST = 'localhost';
        private const DBNAME = 'test';
        private const USER = 'root';
        private const PASS = '';
    public static $pdo;

    public static function getConection() {
        if (!isset(self::$pdo)) {
            try {
            
                self::$pdo = new PDO("mysql:host=" . self::HOST . ";dbname=" . self::DBNAME, self::USER, self::PASS);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erro ao conectar ao banco de dados: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
?>
