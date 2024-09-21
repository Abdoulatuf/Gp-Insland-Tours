<?php
include_once 'inc/header.php';
Session::CheckSession();

$db = new Database(); // Créez une instance de la classe Database
$actualite = new Actualite($db); // Créez une instance de la classe Actualite
$csrf_token = Session::generateCsrfToken();

// Vérification si un ID d'actualité est fourni
if (!isset($_GET['id'])) {
    echo "<div class='alert alert-danger'>Aucune actualité sélectionnée.</div>";
    exit();
}

$id_actualite = $_GET['id'];

// Récupération des détails de l'actualité à modifier
$currentActualite = $actualite->getActualiteById($id_actualite);
if (!$currentActualite) {
    echo "<div class='alert alert-danger'>Actualité non trouvée.</div>";
    exit();
}

// Traitement du formulaire de modification d'actualité
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        // Suppression de l'actualité
        if ($actualite->deleteActualite($id_actualite)) {
            echo "<div class='alert alert-success'>Actualité supprimée avec succès !</div>";
            header("Location: list_actualites.php"); // Rediriger vers la liste des actualités après suppression
            exit();
        } else {
            echo "<div class='alert alert-danger'>Erreur lors de la suppression de l'actualité.</div>";
        }
    } else {
        // Mise à jour de l'actualité
        $titre = $_POST['titre'];
        $contenu = $_POST['contenu'];
        $auteur = $_POST['auteur'];

        // Gestion de l'upload de l'image
        $imagePath = $currentActualite['image']; // Conserver l'image actuelle par défaut

        if (!empty($_FILES['image']['name'])) {
            $image = $_FILES['image'];
            $newImagePath = 'uploads/' . basename($image['name']); // Nouveau chemin où l'image sera enregistrée

            // Vérifiez si le fichier est une image
            $check = getimagesize($image['tmp_name']);
            if ($check !== false) {
                // Déplacez le fichier téléchargé dans le dossier "uploads"
                if (move_uploaded_file($image['tmp_name'], $newImagePath)) {
                    $imagePath = $newImagePath; // Mettre à jour le chemin de l'image si upload réussi
                } else {
                    echo "<div class='alert alert-danger'>Erreur lors de l'upload de l'image.</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Le fichier téléchargé n'est pas une image.</div>";
            }
        }

        // Mise à jour de l'actualité dans la base de données
        if ($actualite->updateActualite($id_actualite, $titre, $contenu, $imagePath, date('Y-m-d'), $auteur)) {
            echo "<div class='alert alert-success'>Actualité mise à jour avec succès !</div>";
        } else {
            echo "<div class='alert alert-danger'>Erreur lors de la mise à jour de l'actualité.</div>";
        }
    }
}
?>

<div class="container">
    <h2 class="mt-4 text-center">Modifier l'Actualité</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id_actualite; ?>" enctype="multipart/form-data">
        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">

        <div class="form-group">
            <label for="image" class="form-label">Image d'actualité :</label>
            <input type="file" class="form-control-file" accept="image/jpg, image/jpeg, image/png, image/webp" id="image" name="image">
            <small>Image actuelle : <img src="<?php echo htmlspecialchars($currentActualite['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="Image actuelle" style="width: 100px;"></small>
        </div>

        <div class="form-group">
            <label for="titre">Titre :</label>
            <input type="text" class="form-control" id="titre" name="titre" value="<?php echo htmlspecialchars($currentActualite['titre'], ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>

        <div class="form-group">
            <label for="contenu">Contenu :</label>
            <textarea class="form-control" id="contenu" name="contenu" rows="5" required><?php echo htmlspecialchars($currentActualite['contenu'], ENT_QUOTES, 'UTF-8'); ?></textarea>
        </div>

        <div class="form-group">
            <label for="auteur">Auteur :</label>
            <input type="text" class="form-control" id="auteur" name="auteur" value="<?php echo htmlspecialchars($currentActualite['auteur'], ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>

        <!-- Bouton pour supprimer l'actualité -->
        <button type="submit" name="delete" class="btn btn-danger">Supprimer</button>
    </form>
</div>

<?php include "inc/footer.php"; ?>