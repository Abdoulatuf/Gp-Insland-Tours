<?php

class Actualite
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Méthode pour récupérer toutes les actualités
    public function getAllActualites()
    {
        $sql = "SELECT * FROM actualites ORDER BY date_publication DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ); // Retourne un tableau d'objets
    }
    public function getActualiteById($id)
    {
        $query = "SELECT * FROM actualites WHERE id = :id LIMIT 1";
        $stmt = $this->db->pdo->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Récupérer l'actualité sous forme de tableau associatif
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result : false;  // Retourner l'actualité ou false si non trouvée
    }
}
