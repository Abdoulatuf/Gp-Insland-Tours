<?php
include "inc/header.php";

// Créer une instance de la classe Database
$db = Database::getInstance();
$conn = $db->getConnection(); // Obtenir la connexion PDO

// Vérifier la connexion
if (!$conn) {
    die("Échec de la connexion : Impossible d'obtenir la connexion.");
}

// Récupérer les informations de l'utilisateur à partir de la base de données
$user_id = $_SESSION['id'];
$sql = "SELECT * FROM user WHERE id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':user_id', $user_id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifier si l'utilisateur existe
if (!$user) {
    die("Utilisateur non trouvé.");
}

// Récupérer le nombre de réservations de l'utilisateur
$reservationCountSql = "SELECT COUNT(*) as count FROM reservation WHERE id = :user_id";
$reservationStmt = $conn->prepare($reservationCountSql);
$reservationStmt->bindValue(':user_id', $user_id);
$reservationStmt->execute();
$reservationCount = $reservationStmt->fetch(PDO::FETCH_ASSOC)['count'];
?>

<main class="main">
    <section class="hero section dark-background">
        <img src="assets/img/accueil-bg.jpg" alt="" data-aos="fade-in">
        <div class="container my-5">
            <h1 class="text-center text-white">Mon Profil</h1>
            <div class="card mx-auto" style="max-width: 600px;">
                <div class="card-body">
                    <h5 class="card-title text-black"><?php echo htmlspecialchars($user['nom']); ?> <?php echo htmlspecialchars($user['prenom']); ?></h5>
                    <p class="card-text text-black">Email : <?php echo htmlspecialchars($user['email']); ?></p>
                    <p class="card-text text-black">Numéro de téléphone : <?php echo htmlspecialchars($user['mobile']); ?></p>
                    <p class="card-text text-black">Nombre de réservations : <?php echo htmlspecialchars($reservationCount); ?></p>
                    <div class="d-flex justify-content-between">
                        <a href="edit_profile.php" class="btn btn-primary">Modifier le profil</a>
                        <a href="changepass.php" class="btn btn-secondary">Changer le mot de passe</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
include "inc/footer.php";
?>