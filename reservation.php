<?php
include "inc/header.php";
//Vérifier si l'utilisateur est connecté
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
    $circuit_name = trim($_POST['nom_circuit']);
    $nom = trim($_POST['nom']);
    $mobile = trim($_POST['mobile']);
    $date = $_POST['date'];
    $location = trim($_POST['lieu']);

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

?>


<main class="main">
    <section class="hero section dark-background">
        <img src="assets/img/accueil-bg.jpg" alt="" data-aos="fade-in">
        <div style="width:450px; margin:0 auto;" data-aos="fade-up" data-aos-delay="100">
            <div class="card container">
                <div class="card-header">
                    <h3 class='text-center text-black'>Réserver un Circuit</h3>
                </div>
                <div class="card-body">

                    <form action="" method="post">
                        <div class="form-group">
                            <label for="nom_circuit">Nom du circuit :</label>
                            <input type="text" id="nom_circuit" name="nom_circuit" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="nom">Votre nom :</label>
                            <input type="text" name="nom" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="mobile">Numéro de téléphone :</label>
                            <input type="text" name="mobile" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="date">Date :</label>
                            <input type="date" id="date" name="date" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="lieu">Lieu :</label>
                            <input type="text" id="lieu" name="lieu" class="form-control" required>
                        </div>
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                        <div class="form-group">
                            <button type="submit" name="register" class="btn btn-success">Réserver</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<style>
    .form-group {
        margin-bottom: 15px;
        /* Ajoute de l'espace entre les champs */
    }
</style>



<?php include "inc/footer.php"; ?>