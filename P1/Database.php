<?php
require_once "DBGatos.php";

class Database {
    // valores padrões
    private $host = 'localhost';
    private $db_name = 'provap1';
    private $username = 'root';
    private $password = '';
    private $DBConn; // conexao com o banco

    // $DBConn = mysqli_connect($host, $db_name, $username, $password)

    public function __construct($servidor, $nomeBanco, $usuario, $senha) {
        $this->host = $servidor;
        $this->db_name = $nomeBanco;
        $this->username = $usuario;
        $this->password = $senha;
    }

    // criar a conexão
    public function getConnection() {
        $this->DBConn = null;
        try {
            // PDO(mysql:host=localhost;dbname=nome_database, "usuario", "senha")
            $this->DBConn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->DBConn->exec('set names utf8'); // permitir o uso de caracteres especiais
        }
        catch (PDOException $e) {
            error_log("Erro ao conectar-se ao banco: " .$e->getMessage());
            die("Falha na conexão. Por favor, tente novamente mais tarde.");
        }
        return $this->DBConn;
    }
}
?>