<?php
// Inclure la connexion à la base de données
require_once '../classes/Database.php'; // Votre fichier de classe Database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Récupérer les données du formulaire
  $nom = $_POST['nom'];
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];

  try {
    // Se connecter à la base de données
    $db = new Database();
    $pdo = $db->getConnection();

    // Requête SQL pour insérer les données dans la table `contacts`
    $sql = "INSERT INTO contact (nom, email, subject, message) VALUES (:nom, :email, :subject, :message)";
    $stmt = $pdo->prepare($sql);

    // Lier les valeurs
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':subject', $subject);
    $stmt->bindParam(':message', $message);

    // Exécuter la requête
    if ($stmt->execute()) {
      echo "Votre message a été envoyé avec succès.";
    } else {
      echo "Erreur lors de l'envoi du message.";
    }
  } catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
  }
}
