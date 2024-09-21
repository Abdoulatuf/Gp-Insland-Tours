<?php include 'inc/header.php';
$csrf_token = Session::generateCsrfToken();

// Créer une connexion à la base de données
$db = Database::getInstance();
$conn = $db->getConnection();

// Vérifier la connexion
if (!$conn) {
    die("Échec de la connexion : Impossible d'obtenir la connexion.");
}

// Créer une instance de la classe User
$users = new Users($db);

// Traitement du formulaire de connexion
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $logResult = $users->userLoginAuthentication($_POST);

    if ($logResult) {
        echo $logResult; // Affiche le message de succès ou d'erreur
    }
}
?>

<main class="main">
    <section class="hero section dark-background">
        <img src="assets/img/accueil-bg.jpg" alt="" data-aos="fade-in">
        <div class="container card" data-aos="fade-up" data-aos-delay="100" style="max-width: 450px; margin: auto;">
            <div class="card-header bg-light">
                <h3 class='text-center text-black'><i class="fas fa-sign-in-alt mr-2"></i>Connexion utilisateur</h3>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <div class="form-group">
                        <label for="mobile">Numéro de téléphone</label>
                        <input type="text" name="mobile" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="login" class="btn btn-success btn-block">Connecter</button>
                    </div>
                </form>

                <!-- Lien vers le mot de passe oublié et inscription -->
                <div class="text-center">
                    <p><a href="forgot_pass.php" class="text-primary">Mot de passe oublié ?</a></p>
                    <p>Vous n'avez pas de compte ? <a href="register.php" class="text-success">Inscrivez-vous</a></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Styles CSS pour le formulaire -->
    <style>
        .form-control {
            width: 100%;
        }
    </style>
</main>

<?php include 'inc/footer.php'; ?>