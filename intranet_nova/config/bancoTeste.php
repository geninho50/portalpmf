<?php
// Configuração do Banco de Dados PostgreSQL

//cria class para armazenar os dados do banco que sera chamado
class Database {
    private $host     = '127.0.0.1';
    private $dbname   = 'portal_pmf';
    private $username = 'postgres';
    private $password = '#Pmf@48';
    private $port     = '5432';
    private $pdo;

    //cosntrutor do banco, pega os dadso definidos e tenta criar coneção

    public function __construct() {
        try {
            //dsn recebe os valores instanciados anteriormente
            $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->dbname};user={$this->username};password={$this->password}";
            $this->pdo = new PDO($dsn);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->pdo->exec("SET NAMES 'UTF8'");
        } catch (PDOException $e) {
            die("Erro na conexão com o banco de dados: " . $e->getMessage());
        }
    }

    //inicia a coneção, e a chamada para fazer a ponte
    public function getConnection() {
        return $this->pdo;
    }

    public function query($sql, $params = []) {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            error_log("Erro na query: " . $e->getMessage());
            throw $e;
        }
    }

    //fetch e usado para recuperar dadso no banco de dados
    public function fetchAll($sql, $params = []) {
        return $this->query($sql, $params)->fetchAll();
    }

    public function fetch($sql, $params = []) {
        return $this->query($sql, $params)->fetch();
    }

    public function execute($sql, $params = []) {
        return $this->query($sql, $params);
    }

    public function lastInsertId() {
        return $this->pdo->lastInsertId();
    }

    public function beginTransaction() {
        return $this->pdo->beginTransaction();
    }

    public function commit() {
        return $this->pdo->commit();
    }

    public function rollback() {
        return $this->pdo->rollback();
    }
}

// Instância global do banco de dados
$database = new Database();
$pdo = $database->getConnection();
?>
