<?php

include "config/config.php";


// Class Databse

class  Database
{

  public $pdo;


  // Construct Class
  public function __construct()
  {

    if (!isset($this->pdo)) {
      try {
        $link = new PDO('mysql:host=' . DB_HOST . '; dbname=' . DB_NAME, DB_USER, DB_PASS);
        $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $link->exec("SET CHARACTER SET utf8");
        $this->pdo  =  $link;
      } catch (PDOException $e) {
        die("Connection error..." . $e->getMessage());
      }
    }
  }
  public function getConnection()
  {
    return $this->pdo;
  }
  public function prepare($query)
  {
    return $this->pdo->prepare($query);
  }
  // Méthode pour exécuter une requête SQL
  public function query($sql)
  {
    return $this->pdo->query($sql);
  }
}
