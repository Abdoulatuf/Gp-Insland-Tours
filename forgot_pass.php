<?php include 'inc/header.php';
// Créer une connexion à la base de données
$db = Database::getInstance();
$conn = $db->getConnection();

// Créer une instance de la classe User
$users = new Users($db);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $resetResult = $users->sendPasswordResetLink($_POST['email_or_mobile']);
    echo $resetResult;
}
?>

<main class="main">
    <section class="hero section dark-background">
        <div class="container card" style="max-width: 450px; margin: auto;">
            <div class="card-header bg-light">
                <h3 class='text-center text-black'><i class="fas fa-unlock-alt mr-2"></i>Réinitialisation du mot de passe</h3>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="email_or_mobile">Email ou Numéro de téléphone</label>
                        <input type="text" name="email_or_mobile" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Envoyer le lien de réinitialisation</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

<?php include 'inc/footer.php'; ?>