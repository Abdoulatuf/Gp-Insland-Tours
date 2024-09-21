<?php
include 'inc/header.php'; // Inclure l'en-tête
Session::CheckSession(); // Vérifier si l'utilisateur est connecté
$csrf_token = Session::generateCsrfToken();

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Générer un nouveau token
}
// Créer une connexion à la base de données
$db = new Database();

// Vérifier la connexion
if (!$db) {
    die("Échec de la connexion : Impossible d'obtenir la connexion.");
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier le token CSRF
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die("Erreur CSRF : le token est invalide.");
    }

    // Récupérer les données du formulaire
    $nom_circuit = trim($_POST['nom_circuit']);
    $lieux = trim($_POST['lieux']);
    $date = $_POST['date'];
    $page = $_POST['page'];
    $description = trim($_POST['description']);

    // Gestion de l'image
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $imageTmpPath = $_FILES['image']['tmp_name'];
        $imageName = $_FILES['image']['name'];
        $uploadFileDir = './uploads/';
        $dest_path = $uploadFileDir . basename($imageName);

        // Déplacer le fichier téléchargé vers le répertoire de destination
        if (move_uploaded_file($imageTmpPath, $dest_path)) {
            // Image téléchargée avec succès
            $msg = "Image téléchargée avec succès.";
        } else {
            $msg = "Erreur lors du téléchargement de l'image.";
        }
    } else {
        $msg = "Aucune image téléchargée ou erreur d'upload.";
    }

    // Préparer la requête d'insertion
    $conn = $db->getConnection(); // Obtenir la connexion PDO
    $query = "INSERT INTO circuit (nom_circuit, lieu, date, page, description, image) VALUES (:nom_circuit, :lieu, :date, :page, :description, :image)";
    $stmt = $conn->prepare($query); // Utiliser l'objet PDO pour préparer la requête
    // Lier les valeurs avec bindValue
    $stmt->bindValue(':nom_circuit', $nom_circuit);
    $stmt->bindValue(':lieu', $lieux);
    $stmt->bindValue(':date', $date);
    $stmt->bindValue(':page', $page);
    $stmt->bindValue(':description', $description);
    $stmt->bindValue(':image', $imageName);

    // Exécuter la requête
    if ($stmt->execute()) {
        $msg = "Circuit ajouté avec succès.";
    } else {
        $msg = "Erreur lors de l'ajout du circuit : " . $stmt->errorInfo()[2];
    }
}

// Afficher le message
if (isset($msg)) {
    echo "<div class='alert alert-info'>$msg</div>";
}
?>

<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-dark">
            <h2 class="text-center  text-light">Ajouter un circuit</h2>
        </div>
        <?php if (isset($msg)) echo $msg; ?>
        <div class="card-body">
            <form method="post" action="" enctype="multipart/form-data">
                <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                <div class="form-group ">
                    <label for="image" class="form-label">Image du circuit:</label>
                    <input type="file" class="form-control-file" accept="image/jpg, image/jpeg, image/png, image/webp" id="image" name="image" required>
                </div>
                <div class="form-group">
                    <label for="nom_circuit">Nom du circuit:</label>
                    <input type="text" class="form-control" id="nom_circuit" name="nom_circuit" required>
                </div>
                <div class="form-group">
                    <label for="lieu">Lieu:</label>
                    <input type="text" class="form-control" id="lieu" name="lieux" required>
                </div>
                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" class="form-control" id="date" name="date" required>
                </div>
                <div class="mb-3">
                    <label for="page" class="form-label">Page</label>
                    <select class="form-select" id="page" name="page" required>
                        <option value="randonnee">Randonnée</option>
                        <option value="plage">Plage</option>
                        <option value="patrimoine">Patrimoine</option>
                        <option value="montage">Montage</option>
                        <option value="art_culture">Arts & Culture</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Description :</label>
                    <textarea class="form-control" name="description" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
        </div>
    </div>
</div>

<?php
include 'inc/footer.php';

?>