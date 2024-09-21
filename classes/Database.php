<?php

// Class Databse
class Database
{
    public $pdo;
    private static $instance = null;

    // Constructeur pour initialiser la connexion PDO
    public function __construct()
    {
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=db_circuit", "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    // Singleton pour éviter plusieurs connexions
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    // Méthode pour obtenir la connexion PDO
    public function getConnection()
    {
        return $this->pdo;
    }

    // Méthode pour préparer une requête SQL
    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }

    // Méthode pour exécuter une requête SQL
    public function query($sql)
    {
        return $this->pdo->query($sql);
    }
}
