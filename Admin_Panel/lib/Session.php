<?php

// Nom de la classe : Session
class Session
{
  // Méthode pour démarrer la session
  public static function init()
  {
    if (version_compare(phpversion(), '5.4.0', '<')) {
      if (session_id() == '') {
        session_start();
      }
    } else {
      if (session_status() == PHP_SESSION_NONE) {
        session_start();
      }
    }
  }

  // Méthode pour définir une variable de session
  public static function set($key, $val)
  {
    $_SESSION[$key] = self::sanitize($val); // Sanitize la valeur pour éviter les attaques XSS
  }

  // Méthode pour obtenir une variable de session
  public static function get($key)
  {
    return isset($_SESSION[$key]) ? $_SESSION[$key] : null; // Retourne null si la clé n'existe pas
  }

  // Méthode pour détruire la session (déconnexion de l'utilisateur)
  public static function destroy()
  {
    session_unset(); // Détruire toutes les variables de session
    session_destroy(); // Détruire la session
    header('Location: login.php'); // Rediriger vers la page de connexion
    exit(); // Arrêter l'exécution après la redirection
  }

  // Méthode pour vérifier si la session est active
  public static function CheckSession()
  {
    if (self::get('login') == FALSE) {
      session_destroy(); // Détruire la session si l'utilisateur n'est pas connecté
      header('Location: login.php'); // Rediriger vers la page de connexion
      exit(); // Arrêter l'exécution après la redirection
    }
  }

  // Méthode pour vérifier si l'utilisateur est déjà connecté
  public static function CheckLogin()
  {
    if (self::get("login") == TRUE) {
      header('Location: index.php'); // Rediriger vers la page d'accueil si l'utilisateur est connecté
      exit(); // Arrêter l'exécution après la redirection
    }
  }
  // Méthode pour nettoyer les données (protection contre les attaques XSS)
  private static function sanitize($data)
  {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8'); // Échapper les caractères spéciaux
  }

  // Méthode pour générer un token CSRF
  public static function generateCsrfToken()
  {
    if (empty($_SESSION['csrf_token'])) {
      $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Générer un token aléatoire
    }
    return $_SESSION['csrf_token'];
  }

  // Méthode pour vérifier le token CSRF
  public static function verifyCsrfToken($token)
  {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token); // Vérifier le token
  }
}
