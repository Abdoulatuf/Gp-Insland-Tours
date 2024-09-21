<?php
class Session
{
    // Initialiser la session
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

    // Vérifier si l'utilisateur est connecté
    public static function checkSession()
    {
        if (self::get('id') == false) {
            header("Location: login.php"); // Redirige vers la page de connexion
            exit();
        }
    }

    // Détruire la session
    public static function destroy()
    {
        session_destroy();
        header("Location: index.php"); // Redirige vers la page de connexion
        exit();
    }

    // Récupérer une valeur de session
    public static function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        return false;
    }

    // Définir une valeur de session
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    // Générer un jeton CSRF
    public static function generateCsrfToken()
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Génère un jeton aléatoire
        }
        return $_SESSION['csrf_token'];
    }

    // Vérifier le jeton CSRF
    public static function verifyCsrfToken($token)
    {
        if (isset($_SESSION['csrf_token']) && $token === $_SESSION['csrf_token']) {
            return true;
        }
        return false;
    }
}
