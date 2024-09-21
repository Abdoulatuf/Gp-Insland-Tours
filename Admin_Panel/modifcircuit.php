<?php
include "inc/header.php";
Session::CheckSession(); // Vérifier si l'utilisateur est connecté

// Connexion à la base de données
$database = new Database();
$conn = $database->pdo;

// Récupérer l'ID du circuit à modifier depuis l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("Location: gestion_circuits.php");
    exit;
}

// Récupérer les détails du circuit depuis la base de données
$query = "SELECT * FROM circuit WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bindValue(1, $id, PDO::PARAM_INT);
$stmt->execute();
$circuit = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifier si le formulaire de modification a été soumis
if (isset($_POST['edit'])) {
    $nom_circuit = $_POST['nom_circuit'];
    $lieux = $_POST['lieu'];
    $date = $_POST['date'];
    $page = $_POST['page'];
    $description = $_POST['description'];

    // Requête pour mettre à jour les données
    $query = "UPDATE circuit SET nom_circuit = ?, lieu = ?, date = ?, page = ?, description = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(1, $nom_circuit);
    $stmt->bindValue(2, $lieux);
    $stmt->bindValue(3, $date);
    $stmt->bindValue(4, $page);
    $stmt->bindValue(5, $description);
    $stmt->bindValue(6, $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $msg = "Circuit mis à jour avec succès.";
    } else {
        $msg = "Erreur lors de la mise à jour.";
    }
}
?>

<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-dark">
            <h2 class="text-center text-light">Modifier le Circuit</h2>
        </div>

        <?php if (isset($msg)) : ?>
            <div class='alert alert-info'><?php echo htmlspecialchars($msg); ?></div>
        <?php endif; ?>

        <div class="card-body">
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="nom_circuit" class="form-label">Nom du circuit</label>
                    <input type="text" class="form-control" name="nom_circuit" value="<?php echo htmlspecialchars($circuit['nom_circuit']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="lieux" class="form-label">Lieu</label>
                    <input type="text" class="form-control" name="lieu" value="<?php echo htmlspecialchars($circuit['lieu']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" class="form-control" name="date" value="<?php echo htmlspecialchars($circuit['date']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="page" class="form-label">Page</label>
                    <select class="form-select" id="page" name="page" required>
                        <?php
                        $pages = ['randonnee', 'plage', 'patrimoine', 'art_culture', 'montagne'];
                        foreach ($pages as $p) {
                            echo '<option value="' . htmlspecialchars($p) . '" ' . ($circuit['page'] == $p ? 'selected' : '') . '>' . ucfirst($p) . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" name="description" required><?php echo htmlspecialchars($circuit['description']); ?></textarea>
                </div>
                <button type="submit" name="edit" class="btn btn-primary">Sauvegarder les modifications</button>
            </form>
        </div>
    </div>
</div>

<?php
$conn = null;
include "inc/footer.php";
?>