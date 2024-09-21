<?php

include 'lib/Database.php';
include_once 'lib/Session.php';


class Users
{
  // Propriété de base de données
  private $db;

  // Méthode base de données __construct
  public function __construct()
  {
    $this->db = new Database();
  }

  // Méthode de format de date
  public function formatDate($date)
  {
    $strtime = strtotime($date);
    return date('Y-m-d H:i:s', $strtime);
  }

  // existance du numero de telephone
  public function checkExistMobile($mobile)
  {
    $sql = "SELECT mobile from  user WHERE mobile = :mobile";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':mobile', $mobile);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }

  // Méthode d'enregistrement des utilisateurs
  public function userRegistration($data)
  {
    $nom = $data['nom'];
    $prenom = $data['prenom'];
    $email = $data['email'];
    $mobile = $data['mobile'];
    $password = $data['password'];
    $roleid = $data['roleid'];


    if ($nom == "" || $prenom == "" || $email === "" || $mobile == "" || $password == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Erreur !</strong> S\'il vous plaît, le champ d\'enregistrement de l\'utilisateur ne doit pas être vide !</div>';
      return $msg;
    } elseif (strlen($prenom) < 2) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Erreur !</strong> Le nom d\'utilisateur est trop court, au moins 2 caractères !</div>';
      return $msg;
    } elseif (filter_var($mobile, FILTER_SANITIZE_NUMBER_INT) == FALSE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Erreur !</strong> Entrez uniquement les caractères numériques pour le champ Numéro de mobile !</div>';
      return $msg;
    } elseif (strlen($password) < 5) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Erreur !</strong> Mot de passe d\'au moins 6 caractères !</div>';
      return $msg;
    } elseif (!preg_match("#[0-9]+#", $password)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Erreur !</strong> Votre mot de passe doit contenir au moins 1 chiffre !</div>';
      return $msg;
    } elseif (!preg_match("#[a-z]+#", $password)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Erreur !</strong> Votre mot de passe doit contenir au moins une lettre !</div>';
      return $msg;
    } elseif (filter_var($mobile, FILTER_VALIDATE_INT === FALSE)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Erreurr !</strong> Numero de telephone invalide !</div>';
      return $msg;
    } elseif ($mobile == TRUE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Erreur !</strong> Ce numero existe déjà, veuillez essayer un autre numéro... !</div>';
      return $msg;
    } else {

      $sql = "INSERT INTO user(nom, prenom, email, password, mobile, roleid) VALUES(:nom, :prenom, :email, :password, :mobile, :roleid)";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':nom', $nom);
      $stmt->bindValue(':prenom', $prenom);
      $stmt->bindValue(':email', $email);
      $stmt->bindValue(':password', SHA1($password));
      $stmt->bindValue(':mobile', $mobile);
      $stmt->bindValue(':roleid', $roleid);
      $result = $stmt->execute();
      if ($result) {
        $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Succès !</strong> Wow, vous vous êtes inscrit avec succès !</div>';
        return $msg;
      } else {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Erreur !</strong> Quelque chose s\'est mal passé !</div>';
        return $msg;
      }
    }
  }

  // Ajouter un nouvel utilisateur par l'administrateur
  public function addNewUserByAdmin($data)
  {
    $nom = $data['nom'];
    $username = $data['prenom'];
    $email = $data['email'];
    $mobile = $data['mobile'];
    $roleid = $data['roleid'];
    $password = $data['password'];

    $checkEmail = $this->checkExistMobile($mobile);

    if ($nom == "" || $username == "" || $email == "" || $mobile == "" || $password == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Erreur !</strong> Les champs d\'entrée ne doivent pas être vides !</div>';
      return $msg;
    } elseif (strlen($username) < 3) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Erreur !</strong> Le nom d\'utilisateur est trop court, au moins 3 caractères !</div>';
      return $msg;
    } elseif (filter_var($mobile, FILTER_SANITIZE_NUMBER_INT) == FALSE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Erreur !</strong> Entrez uniquement des caractères numériques pour le champ du numéro de mobile !</div>';
      return $msg;
    } elseif (strlen($password) < 6) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Erreur !</strong> Le mot de passe doit contenir au moins 6 caractères !</div>';
      return $msg;
    } elseif (!preg_match("#[0-9]+#", $password)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Erreur !</strong> Votre mot de passe doit contenir au moins 1 chiffre !</div>';
      return $msg;
    } elseif (!preg_match("#[a-z]+#", $password)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Erreur !</strong> Votre mot de passe doit contenir au moins 1 lettre minuscule !</div>';
      return $msg;
    } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Erreur !</strong> Adresse email non valide !</div>';
      return $msg;
    } elseif ($checkEmail == TRUE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Erreur !</strong> L\'email existe déjà, veuillez essayer un autre email !</div>';
      return $msg;
    } else {
      $sql = "INSERT INTO user(nom, prenom, email, mobile, password, roleid) VALUES(:nom, :prenom, :email, :mobile, :password, :roleid)";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':nom', $nom);
      $stmt->bindValue(':prenom', $username);
      $stmt->bindValue(':email', $email);
      $stmt->bindValue(':password', SHA1($password));
      $stmt->bindValue(':mobile', $mobile);
      $stmt->bindValue(':roleid', $roleid);
      $result = $stmt->execute();
      if ($result) {
        $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Succès !</strong> Wow, vous vous êtes inscrit avec succès !</div>';
        return $msg;
      } else {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Erreur !</strong> Quelque chose s\'est mal passé !</div>';
        return $msg;
      }
    }
  }

  // Sélectionner toute la méthode utilisateur
  public function selectAllUserData()
  {
    $sql = "SELECT * FROM user ORDER BY id DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  // Sélectionner toute la méthode des circuits
  public function selectAllReservations()
  {
    $sql = "SELECT * FROM reservation ORDER BY id DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  // Méthode d'authentification de connexion utilisateur
  public function userLoginAutho($mobile, $password)
  {
    $password = SHA1($password);
    $sql = "SELECT * FROM user WHERE mobile = :mobile and password = :password LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':mobile', $mobile);
    $stmt->bindValue(':password', $password);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_OBJ);
  }
  // Vérifier l'état du compte utilisateur
  public function CheckActiveUser($mobile)
  {
    $sql = "SELECT * FROM user WHERE mobile = :mobile and isActive = :isActive LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':mobile', $mobile);
    $stmt->bindValue(':isActive', 1);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_OBJ);
  }

  // Méthode d'authentification de connexion utilisateur
  public function userLoginAuthentication($data)
  {
    $mobile = $data['mobile'];
    $password = $data['password'];

    // Vérification si les champs sont vides
    if (empty($mobile) || empty($password)) {
      return $this->generateAlertMessage("Erreur ! Le numéro ou le mot de passe ne doivent pas être vides !", "danger");
    }

    // Vérification du format du numéro de téléphone
    if (!filter_var($mobile, FILTER_VALIDATE_INT)) {
      return $this->generateAlertMessage("Erreur ! Numéro de téléphone invalide !", "danger");
    }

    // Vérification de l'existence du numéro de téléphone
    $checkMobile = $this->checkExistMobile($mobile);
    if (!$checkMobile) {
      return $this->generateAlertMessage("Erreur ! Le numéro n'a pas été trouvé, utilisez Enregistrer le numéro ou le mot de passe s'il vous plaît !", "danger");
    }

    // Authentification de l'utilisateur
    $logResult = $this->userLoginAutho($mobile, $password);
    $chkActive = $this->CheckActiveUser($mobile);

    // Vérification si l'utilisateur est actif
    if ($chkActive) {
      return $this->generateAlertMessage("Erreur ! Désolé, votre compte est désactivé, contactez l'administrateur !", "danger");
    } elseif ($logResult) {
      // Initialisation de la session
      Session::init();
      Session::set('login', TRUE);
      Session::set('id', $logResult->id);
      Session::set('roleid', $logResult->roleid);
      Session::set('nom', $logResult->nom);
      Session::set('email', $logResult->email);
      Session::set('mobile', $logResult->mobile);
      Session::set('prenom', $logResult->prenom);
      Session::set('logMsg', $this->generateAlertMessage("Succès ! Vous êtes connecté avec succès !", "success"));

      echo "<script>location.href='index.php';</script>";
    } else {
      return $this->generateAlertMessage("Erreur ! Le numéro ou le mot de passe ne correspondent pas !", "danger");
    }
  }

  // Méthode pour générer un message d'alerte
  private function generateAlertMessage($message, $type)
  {
    $msg = '<div class="alert alert-' . htmlspecialchars($type) . ' alert-dismissible mt-3" id="flash-msg">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>' . htmlspecialchars($message) . '</strong>
              </div>';
    return $msg;
  }
  // Obtenir des informations sur un seul utilisateur par méthode d'identification
  public function getUserInfoById($userid)
  {
    $sql = "SELECT * FROM user WHERE id = :id LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $userid);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return $result;
    } else {
      return false;
    }
  }

  // Méthode pour mettre à jour les informations d'un utilisateur par son ID
  public function updateUserByIdInfo($userid, $data)
  {
    $nom = $data['nom']; // Récupère le nom de l'utilisateur
    $username = $data['prenom']; // Récupère le nom d'utilisateur
    $email = $data['email']; // Récupère l'email de l'utilisateur
    $mobile = $data['mobile']; // Récupère le numéro de mobile de l'utilisateur
    $roleid = $data['roleid']; // Récupère l'ID de rôle de l'utilisateur

    // Vérification des champs vides
    if ($nom == "" || $username == "" || $email == "" || $mobile == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Erreur !</strong> Les champs ne doivent pas être vides !</div>';
      return $msg; // Retourne un message d'erreur si un champ est vide

      // Vérification de la longueur du nom d'utilisateur
    } elseif (strlen($username) < 3) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Erreur !</strong> Le nom d\'utilisateur est trop court, au moins 3 caractères requis !</div>';
      return $msg; // Retourne un message d'erreur si le nom d'utilisateur est trop court

      // Vérification du format du numéro de mobile
    } elseif (filter_var($mobile, FILTER_SANITIZE_NUMBER_INT) == FALSE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Erreur !</strong> Entrez uniquement des caractères numériques pour le champ numéro de mobile !</div>';
      return $msg; // Retourne un message d'erreur si le numéro de mobile contient des caractères non numériques

      // Validation du format de l'email
    } elseif (filter_var($email, FILTER_VALIDATE_EMAIL === FALSE)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Erreur !</strong> Adresse email invalide !</div>';
      return $msg; // Retourne un message d'erreur si l'email n'est pas valide

    } else {
      // Préparation de la requête SQL pour mettre à jour les informations de l'utilisateur
      $sql = "UPDATE user SET
              nom = :nom,
              username = :prenom,
              email = :email,
              mobile = :mobile,
              roleid = :roleid
              WHERE id = :id";
      $stmt = $this->db->pdo->prepare($sql); // Prépare la requête SQL
      $stmt->bindValue(':nom', $nom); // Associe le nom de l'utilisateur
      $stmt->bindValue(':prenom', $username); // Associe le nom d'utilisateur
      $stmt->bindValue(':email', $email); // Associe l'email de l'utilisateur
      $stmt->bindValue(':mobile', $mobile); // Associe le numéro de mobile de l'utilisateur
      $stmt->bindValue(':roleid', $roleid); // Associe l'ID de rôle de l'utilisateur
      $stmt->bindValue(':id', $userid); // Associe l'ID de l'utilisateur
      $result = $stmt->execute(); // Exécute la requête SQL

      if ($result) { // Si la mise à jour réussit
        echo "<script>location.href='index.php';</script>"; // Redirection vers la page d'accueil
        Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Succès !</strong> Vos informations ont été mises à jour avec succès !</div>');
        // Message flash de succès indiquant que les informations de l'utilisateur ont été mises à jour

      } else { // Si la mise à jour échoue
        echo "<script>location.href='index.php';</script>"; // Redirection vers la page d'accueil
        Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Erreur !</strong> Les données n\'ont pas été insérées !</div>');
        // Message flash d'erreur indiquant que la mise à jour a échoué
      }
    }
  }


  // Supprimer l'utilisateur par méthode d'identification
  public function deleteUserById($remove)
  {
    $sql = "DELETE FROM user WHERE id = :id ";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $remove);
    $result = $stmt->execute();
    if ($result) {
      $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Succès !</strong> Compte utilisateur supprimé avec succès !</div>';
      return $msg;
    } else {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Erreur !</strong> Données non supprimées !</div>';
      return $msg;
    }
  }

  // Désactivation de l'utilisateur par l'administrateur
  public function userDeactiveByAdmin($deactive)
  {
    // Préparation de la requête SQL pour mettre à jour le statut d'activation de l'utilisateur
    $sql = "UPDATE user SET
          isActive=:isActive
          WHERE id = :id";

    $stmt = $this->db->pdo->prepare($sql); // Prépare la requête SQL
    $stmt->bindValue(':isActive', 1); // Associe la valeur 1 à :isActive (1 pourrait signifier désactivé dans ce contexte)
    $stmt->bindValue(':id', $deactive); // Associe l'ID de l'utilisateur à désactiver

    $result = $stmt->execute(); // Exécute la requête SQL

    if ($result) { // Si la requête réussit
      echo "<script>location.href='admin.php';</script>"; // Redirection vers la page index.php
      Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Succès !</strong> Le compte utilisateur a été désactivé avec succès !</div>');
      // Message flash de succès indiquant que le compte utilisateur a été désactivé avec succès
    } else { // Si la requête échoue
      echo "<script>location.href='admin.php';</script>"; // Redirection vers la page index.php
      Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Erreur !</strong> La désactivation a échoué !</div>');
      // Message flash d'erreur indiquant que la désactivation a échoué
    }
  }

  // Activation de l'utilisateur par l'administrateur
  public function userActiveByAdmin($active)
  {
    // Préparation de la requête SQL pour mettre à jour le statut d'activation de l'utilisateur
    $sql = "UPDATE user SET
          isActive=:isActive
          WHERE id = :id";

    $stmt = $this->db->pdo->prepare($sql); // Prépare la requête SQL
    $stmt->bindValue(':isActive', 0); // Associe la valeur 0 à :isActive (0 pourrait signifier activé dans ce contexte)
    $stmt->bindValue(':id', $active); // Associe l'ID de l'utilisateur à activer

    $result = $stmt->execute(); // Exécute la requête SQL

    if ($result) { // Si la requête réussit
      echo "<script>location.href='admin.php';</script>"; // Redirection vers la page index.php
      Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Succès !</strong> Le compte utilisateur a été activé avec succès !</div>');
      // Message flash de succès indiquant que le compte utilisateur a été activé avec succès
    } else { // Si la requête échoue
      echo "<script>location.href='admin.php';</script>"; // Redirection vers la page index.php
      Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Erreur !</strong> L\'activation a échoué !</div>');
      // Message flash d'erreur indiquant que l'activation a échoué
    }
  }

  // Supprimer la reservation par méthode d'identification
  public function deleteReservationById($remove)
  {
    $sql = "DELETE FROM reservation WHERE id = :id ";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $remove);
    $result = $stmt->execute();
    if ($result) {
      $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Succès !</strong> Reservation supprimé avec succès !</div>';
      return $msg;
    } else {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Erreur !</strong> Données non supprimées !</div>';
      return $msg;
    }
  }

  // Vérifier l'ancienne méthode de mot de passe
  public function CheckOldPassword($userid, $old_pass)
  {
    $old_pass = SHA1($old_pass);
    $sql = "SELECT password FROM admin WHERE password = :password AND id =:id";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':password', $old_pass);
    $stmt->bindValue(':id', $userid);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }
  // Changer le passe utilisateur par identifiant
  public  function changePasswordBysingelUserId($userid, $data)
  {

    $old_pass = $data['old_password'];
    $new_pass = $data['new_password'];


    if ($old_pass == "" || $new_pass == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Erreur !</strong> Le champ du mot de passe ne doit pas être vide !</div>';
      return $msg;
    } elseif (strlen($new_pass) < 6) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Erreur !</strong> Le nouveau mot de passe doit contenir au moins 6 caractères !</div>';
      return $msg;
    }

    $oldPass = $this->CheckOldPassword($userid, $old_pass);
    if ($oldPass == FALSE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
     <strong>Erreur !</strong> L\'ancien mot de passe ne correspond pas !</div>';
      return $msg;
    } else {
      $new_pass = SHA1($new_pass);
      $sql = "UPDATE admin SET

            password=:password
            WHERE id = :id";

      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':password', $new_pass);
      $stmt->bindValue(':id', $userid);
      $result =   $stmt->execute();

      if ($result) {
        echo "<script>location.href='index.php';</script>";
        Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Succès !</strong> Bonne nouvelle, mot de passe modifié avec succès !</div>');
      } else {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Erreur !</strong> Le mot de passe n\'a pas changé !</div>';
        return $msg;
      }
    }
  }
}

class Message
{
  private $db;

  public function __construct($db)
  {
    $this->db = $db;
  }

  // Fonction pour récupérer tous les messages
  public function getAllMessages()
  {
    try {
      $stmt = $this->db->getConnection()->prepare("SELECT * FROM contact ORDER BY created_at DESC");
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_OBJ); // Retourner les résultats sous forme d'objets
    } catch (PDOException $e) {
      echo "Erreur: " . $e->getMessage();
      return false;
    }
  }
}

class Actualite
{
  private $db;

  // Constructeur pour initialiser la connexion à la base de données
  public function __construct($db)
  {
    $this->db = $db;
  }

  // Méthode pour récupérer toutes les actualités
  public function getAllActualites()
  {
    $sql = "SELECT * FROM actualites"; // Requête SQL pour récupérer toutes les actualités
    $stmt = $this->db->query($sql); // Exécute la requête

    if ($stmt) {
      return $stmt->fetchAll(PDO::FETCH_ASSOC); // Utiliser fetchAll() pour récupérer toutes les actualités sous forme de tableau associatif
    } else {
      return []; // Retourner un tableau vide si aucune actualité n'est trouvée ou en cas d'erreur
    }
  }
  public function getActualiteById($id)
  {
    $stmt = $this->db->prepare("SELECT * FROM actualites WHERE id = ?");
    $stmt->execute([$id]); // Exécutez la requête avec le paramètre ID

    if ($stmt->rowCount() > 0) {
      return $stmt->fetch(PDO::FETCH_ASSOC); // Retourne les détails de l'actualité
    } else {
      return null; // Retourne null si aucune actualité n'est trouvée
    }
  }
  // Méthode pour ajouter une nouvelle actualité
  public function addActualite($titre, $contenu, $image, $date_publication)
  {
    $query = "INSERT INTO actualites (titre, contenu, image, date_publication) VALUES (?, ?, ?, ?)";
    $stmt = $this->db->getConnection()->prepare($query); // Assurez-vous d'utiliser getConnection()

    // Lier les paramètres
    $stmt->bindParam(1, $titre);
    $stmt->bindParam(2, $contenu);
    $stmt->bindParam(3, $image);
    $stmt->bindParam(4, $date_publication);

    return $stmt->execute(); // Exécute la requête et retourne le résultat
  }

  // Méthode pour supprimer une actualité par ID
  public function deleteActualite($id)
  {
    $query = "DELETE FROM actualites WHERE id = :id";
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(":id", $id); // Lier le paramètre ID

    return $stmt->execute(); // Exécute la requête et retourne le résultat
  }

  // Méthode pour mettre à jour une actualité
  //Méthode pour mettre à jour une actualité par son ID
  public function updateActualite($id, $titre, $contenu, $imagePath, $date_publication, $auteur)
  {
    try {
      // Requête de mise à jour
      $query = "UPDATE actualites SET titre = :titre, contenu = :contenu, image = :image, date_publication = :date_publication, auteur = :auteur WHERE id = :id";
      $stmt = $this->db->pdo->prepare($query);

      // Liaison des paramètres
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);
      $stmt->bindValue(':titre', $titre, PDO::PARAM_STR);
      $stmt->bindValue(':contenu', $contenu, PDO::PARAM_STR);
      $stmt->bindValue(':image', $imagePath, PDO::PARAM_STR);
      $stmt->bindValue(':date_publication', $date_publication, PDO::PARAM_STR);
      $stmt->bindValue(':auteur', $auteur, PDO::PARAM_STR);

      // Exécuter la requête
      $stmt->execute();

      return true;
    } catch (PDOException $e) {
      // Capture et affiche l'erreur pour un diagnostic plus facile
      echo "Erreur lors de la mise à jour de l'actualité : " . $e->getMessage();
      return false;
    }
  }
}
