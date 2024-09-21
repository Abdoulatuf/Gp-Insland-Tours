<?php
include "inc/header.php";
Session::CheckSession(); // Vérifier si l'utilisateur est connecté

// Connexion à la base de données
$database = new Database();
$conn = $database->pdo;

// Modifier le circuit
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
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
    $stmt->bindValue(6, $id, PDO::PARAM_INT); // Spécifiez le type pour l'ID
    $result = $stmt->execute();

    if ($result) {
        $msg = "Circuit mis à jour avec succès.";
    } else {
        $msg = "Erreur lors de la mise à jour.";
    }
}

// Supprimer le circuit
if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    // Requête pour supprimer les données
    $query = "DELETE FROM circuit WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(1, $id, PDO::PARAM_INT); // Spécifiez le type pour l'ID

    if ($stmt->execute()) {
        $msg = "Circuit supprimé avec succès.";
    } else {
        $msg = "Erreur lors de la suppression.";
    }
}

// Récupérer tous les circuits
$query = "SELECT * FROM circuit";
$result = $conn->query($query);
?>

<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-dark">
            <h2 class="text-center text-light">Gestion des Circuits</h2>
        </div>

        <?php if (isset($msg)) : ?>
            <div class='alert alert-info'><?php echo htmlspecialchars($msg); ?></div>
        <?php endif; ?>

        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom du Circuit</th>
                        <th>Lieu</th>
                        <th>Date</th>
                        <th>Page</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['nom_circuit']); ?></td>
                            <td><?php echo htmlspecialchars($row['lieu']); ?></td>
                            <td><?php echo htmlspecialchars($row['date']); ?></td>
                            <td><?php echo htmlspecialchars($row['page']); ?></td>
                            <td><?php echo htmlspecialchars($row['description']); ?></td>
                            <td>
                                <!-- Bouton Modifier -->
                                <a class="btn btn-primary btn-sm" href="modifcircuit.php?id=<?php echo htmlspecialchars($row['id']); ?>">Modifier</a>

                                <!-- Formulaire Supprimer -->
                                <form action="" method="POST" style="display:inline-block;">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                    <button type="submit" name="delete" class="btn btn-danger btn-sm">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    <?php if ($result->rowCount() == 0): ?>
                        <tr>
                            <td colspan='7' class='text-center'>Aucun circuit disponible.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
$conn = null;
include "inc/footer.php";
?>