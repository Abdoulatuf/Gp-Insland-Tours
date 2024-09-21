<?php

include_once "inc/header.php"; // Inclure votre classe de connexion à la base de données
Session::CheckSession();

$db = Database::getInstance();
$conn = $db->getConnection(); // Obtenir la connexion PDO

// Vérifier la connexion
if (!$conn) {
    die("Échec de la connexion : Impossible d'obtenir la connexion.");
}

// Générer un token CSRF si ce n'est pas déjà fait
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Traitement du formulaire de réservation
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Vérifier le token CSRF
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die("Erreur CSRF : le token est invalide.");
    }

    // Récupérer les données du formulaire
    $circuit_name = $_POST['nom_circuit'];
    $nom = $_POST['nom'];
    $mobile = $_POST['mobile'];
    $date = $_POST['date'];
    $location = $_POST['lieu'];

    $stmt = $conn->prepare("INSERT INTO reservation (nom_circuit, nom, mobile, date, lieu) VALUES (:nom_circuit, :nom, :mobile, :date, :lieu)");

    // Lier les valeurs avec bindValue
    $stmt->bindValue(':nom_circuit', $circuit_name);
    $stmt->bindValue(':nom', $nom);
    $stmt->bindValue(':mobile', $mobile);
    $stmt->bindValue(':date', $date);
    $stmt->bindValue(':lieu', $location);

    // Exécuter la requête
    if ($stmt->execute()) {
        echo '<div class="alert alert-success">Réservation réussie !</div>';
    } else {
        echo '<div class="alert alert-danger">Erreur lors de la réservation : ' . $stmt->errorInfo()[2] . '</div>';
    }
}
// Vérifier si un ID de circuit a été passé
if (isset($_GET['id'])) {
    $circuitId = $_GET['id'];

    // Connexion à la base de données
    $db = Database::getInstance();
    $sql = "SELECT * FROM circuit WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':id', $circuitId);
    $stmt->execute();
    $circuit = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$circuit) {
        die("Circuit non trouvé.");
    }
} else {
    die("ID de circuit manquant.");
}
?>
<main class="main">
    <section class="hero section dark-background">
        <img src="assets/img/accueil-bg.jpg" alt="" data-aos="fade-in">
        <div style="width:450px; margin:0 auto;" data-aos="fade-up" data-aos-delay="100">
            <div class="card container">
                <div class="card-header">
                    <h3 class='text-center text-black'>Réservation d'un Circuit</h3>
                </div>
                <h2 class="text-black">Réservation pour <?php echo htmlspecialchars($circuit['nom_circuit']); ?></h2>
                <p class="text-black">Description : <?php echo htmlspecialchars($circuit['description']); ?></p>
                <p class="text-black">Lieu : <?php echo htmlspecialchars($circuit['lieu']); ?></p>
                <p class="text-black">Date : <?php echo htmlspecialchars($circuit['date']); ?></p>

                <!-- Formulaire de réservation -->
                <form action="" method="post">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <div class="form-group">
                        <label for="nom_circuit">Nom du circuit :</label>
                        <input type="text" id="nom_circuit" name="nom_circuit" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="lieu">Lieu :</label>
                        <input type="text" id="lieu" name="lieu" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="nom">Nom :</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>
                    <div class="form-group">
                        <label for="date">Date :</label>
                        <input type="date" id="date" name="date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email :</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="mobile">Téléphone :</label>
                        <input type="tel" class="form-control" id="moblie" name="mobile" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="register" class="btn btn-success">Réserver</button>
                    </div>
                </form>
            </div>

        </div>
    </section>
</main>



<?php include "inc/footer.php"; ?>