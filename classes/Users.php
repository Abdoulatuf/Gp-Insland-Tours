<?php

include 'Database.php';
include_once 'lib/Session.php';
class Users
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function checkExistMobile($mobile)
    {
        $sql = "SELECT mobile from user WHERE mobile = :mobile";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':mobile', $mobile);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Méthode d'authentification
    public function userLoginAutho($mobile, $password)
    {
        $password = SHA1($password);
        $sql = "SELECT * FROM user WHERE mobile = :mobile AND password = :password LIMIT 1";
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
            Session::set('roleid', $logResult->roleid); // Récupérer le rôle
            Session::set('nom', $logResult->nom);
            Session::set('email', $logResult->email);
            Session::set('mobile', $logResult->mobile);
            Session::set('prenom', $logResult->prenom);
            Session::set('logMsg', $this->generateAlertMessage("Succès ! Vous êtes connecté avec succès !", "success"));

            // Redirection en fonction du rôle
            if ($logResult->roleid == 1) { // Supposons que 1 est pour administrateur
                echo "<script>location.href='Admin_Panel/index.php';</script>";
            } else {
                echo "<script>location.href='index.php';</script>";
            }
        } else {
            return $this->generateAlertMessage("Erreur ! Le numéro ou le mot de passe ne correspondent pas !", "danger");
        }
    }

    // Méthode de connexion
    public function login($user)
    {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['nom'];
        $_SESSION['email'] = $user['email'];
    }

    // Méthode d'inscription
    public function register($nom, $prenom, $email, $mobile, $password)
    {
        $query = "INSERT INTO user (nom, prenom, email, mobile, password, roleid) VALUES (:nom, :prenom, :email, :mobile, :password, 2)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":nom", $nom);
        $stmt->bindValue(":prenom", $prenom);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":mobile", $mobile);
        $stmt->bindValue(":password", SHA1($password));
        return $stmt->execute();
    }

    // Méthode de réinitialisation de mot de passe
    // Changer le passe utilisateur par identifiant
    public function changePasswordBysingelUserId($userid, $data)
    {
        $old_pass = $data['old_password'];
        $new_pass = $data['new_password'];

        if ($old_pass == "" || $new_pass == "") {
            return $this->generateAlertMessage("Erreur ! Le champ du mot de passe ne doit pas être vide !", "danger");
        } elseif (strlen($new_pass) < 6) {
            return $this->generateAlertMessage("Erreur ! Le nouveau mot de passe doit contenir au moins 6 caractères !", "danger");
        }

        $oldPass = $this->CheckOldPassword($userid, $old_pass);
        if ($oldPass == FALSE) {
            return $this->generateAlertMessage("Erreur ! L'ancien mot de passe ne correspond pas !", "danger");
        } else {
            $new_pass = SHA1($new_pass);
            $sql = "UPDATE user SET password = :password WHERE id = :id";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindValue(':password', $new_pass);
            $stmt->bindValue(':id', $userid);
            $result = $stmt->execute();

            if ($result) {
                echo "<script>location.href='index.php';</script>";
                Session::set('msg', $this->generateAlertMessage("Succès ! Bonne nouvelle, mot de passe modifié avec succès !", "success"));
            } else {
                return $this->generateAlertMessage("Erreur ! Le mot de passe n'a pas changé !", "danger");
            }
        }
    }

    private function generateAlertMessage($message, $type)
    {
        $msg = '<div class="alert alert-' . htmlspecialchars($type) . ' alert-dismissible mt-3" id="flash-msg">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>' . htmlspecialchars($message) . '</strong>
              </div>';
        return $msg;
    }
    // Méthode pour envoyer un lien de réinitialisation de mot de passe
    public function sendPasswordResetLink($email_or_mobile)
    {
        // Vérifier si l'utilisateur existe
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email_or_mobile OR mobile = :email_or_mobile");
        $stmt->bindParam(':email_or_mobile', $email_or_mobile);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // L'utilisateur existe, générer un token
            $token = bin2hex(random_bytes(50)); // Token sécurisé de 100 caractères
            $expiry_time = date('Y-m-d H:i:s', strtotime('+1 hour')); // Expiration dans 1 heure

            // Insérer le token et sa date d'expiration dans la base de données
            $stmt = $this->db->prepare("
                INSERT INTO password_resets (user_id, token, expiry_time)
                VALUES (:user_id, :token, :expiry_time)
            ");
            $stmt->bindParam(':user_id', $user['id']);
            $stmt->bindParam(':token', $token);
            $stmt->bindParam(':expiry_time', $expiry_time);
            $stmt->execute();

            // Construire le lien de réinitialisation
            $reset_link = "https://yourwebsite.com/reset_password.php?token=" . $token;

            // Envoyer le lien par email ou par SMS
            if (filter_var($email_or_mobile, FILTER_VALIDATE_EMAIL)) {
                // Envoyer par email
                $this->sendEmail($user['email'], "Réinitialisation de mot de passe", "
                    Bonjour, 
                    
                    Cliquez sur le lien suivant pour réinitialiser votre mot de passe :
                    $reset_link
                    
                    Ce lien expirera dans 1 heure.
                ");
                return "Un email avec le lien de réinitialisation du mot de passe a été envoyé.";
            } else {
                // Envoyer par SMS (vous devez configurer un service SMS)
                $this->sendSMS($user['mobile'], "Réinitialisez votre mot de passe : $reset_link");
                return "Un SMS avec le lien de réinitialisation du mot de passe a été envoyé.";
            }
        } else {
            // L'utilisateur n'existe pas
            return "Aucun compte trouvé avec cet email ou numéro de téléphone.";
        }
    }

    // Méthode pour envoyer un email (vous pouvez remplacer par votre propre méthode d'envoi d'email)
    private function sendEmail($to, $subject, $message)
    {
        // Utiliser mail() ou une bibliothèque comme PHPMailer pour envoyer l'email
        mail($to, $subject, $message);
    }

    // Méthode pour envoyer un SMS (nécessite un fournisseur de service SMS comme Twilio)
    private function sendSMS($mobile, $message)
    {
        // Utiliser un fournisseur de service SMS pour envoyer le message
        // Exemple avec Twilio, Nexmo, etc.
    }
}
