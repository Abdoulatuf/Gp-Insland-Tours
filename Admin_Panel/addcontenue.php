<?php
include "inc/header.php";


// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $page = $_POST['page'];
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $image = $_POST['image'];

    // Choisir la table en fonction de la page sélectionnée
    switch ($page) {
        case 'randonnee':
            $table = 'randonnee';
            break;
        case 'plage':
            $table = 'plage';
            break;
        case 'patrimoine':
            $table = 'patrimoine';
            break;
        case 'art_culture':
            $table = 'art_culture';
            break;
        default:
            $table = 'circuit';
            break;
    }

    // Insertion des données dans la table appropriée
    $sql = "INSERT INTO $table (titre, description, image) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $titre, $description, $image);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Contenu ajouté avec succès à la page " . ucfirst($page) . "!</div>";
    } else {
        echo "<div class='alert alert-danger'>Erreur lors de l'ajout du contenu : " . $conn->error . "</div>";
    }

    $stmt->close();
}
?>

<div class="container mt-5">
    <h2 class="mb-4">Ajouter du Contenu</h2>
    <form method="post" action="">
        <div class="mb-3">
            <label for="page" class="form-label">Page</label>
            <select class="form-select" id="page" name="page" required>
                <option value="randonnee">Randonnée</option>
                <option value="plage">Plage</option>
                <option value="patrimoine">Patrimoine</option>
                <option value="art_culture">Arts & Culture</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" class="form-control" id="titre" name="titre" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
        </div>
        <div class="form-group mb-3 ">
            <label for="image" class="form-label">Image du circuit:</label>
            <input type="file" class="form-control-file" accept="image/jpg, image/jpeg, image/png, image/webp" id="image" name="image" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>

<?php include "inc/footer.php"; ?>