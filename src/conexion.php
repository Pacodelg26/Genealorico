<?php
require 'load-env.php';

class Conexion
{
    private $host;
    private $db;
    private $user;
    private $pass;
    private $charset;
    public $pdo;

    public function __construct()
    {
        $this->host = getenv('DB_HOST');
        $this->db = getenv('DB_NAME');
        $this->user = getenv('DB_USER');
        $this->pass = getenv('DB_PASS');
        $this->charset = 'utf8mb4';

        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}
