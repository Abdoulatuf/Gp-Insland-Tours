<?php
include_once 'inc/header.php';
Session::CheckSession();

$db = new Database(); // Créez une instance de la classe Database
$actualite = new Actualite($db); // Créez une instance de la classe Actualite
$csrf_token = Session::generateCsrfToken();

// Traitement du formulaire d'ajout d'actualité
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'];
    $contenu = $_POST['contenu'];
    $auteur = $_POST['auteur'];

    // Gestion de l'upload de l'image
    $image = $_FILES['image'];
    $imagePath = './uploads/' . basename($image['name']); // Chemin où l'image sera enregistrée

    // Vérifiez si le fichier est une image
    $check = getimagesize($image['tmp_name']);
    if ($check !== false) {
        // Déplacez le fichier téléchargé dans le dossier "uploads"
        if (move_uploaded_file($image['tmp_name'], $imagePath)) {
            // Ajoutez l'actualité avec l'image
            if ($actualite->addActualite($titre, $contenu, $auteur, $imagePath)) {
                echo "<div class='alert alert-success'>Actualité ajoutée avec succès !</div>";
            } else {
                echo "<div class='alert alert-danger'>Erreur lors de l'ajout de l'actualité.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Erreur lors de l'upload de l'image.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Le fichier téléchargé n'est pas une image.</div>";
    }
}
?>

<div class="container">
    <h2 class="mt-4 text-center">Ajouter une Actualité</h2>

    <form method="post" action="" enctype="multipart/form-data">
        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
        <div class="form-group">
            <label for="image" class="form-label">Image d'actualité :</label>
            <input type="file" class="form-control-file" accept="image/jpg, image/jpeg, image/png, image/webp" id="image" name="image" required>
        </div>
        <div class="form-group">
            <label for="titre">Titre :</label>
            <input type="text" class="form-control" id="titre" name="titre" required>
        </div>
        <div class="form-group">
            <label for="contenu">Contenu :</label>
            <textarea class="form-control" id="contenu" name="contenu" rows="5" required></textarea>
        </div>
        <div class="form-group">
            <label for="auteur">Auteur :</label>
            <input type="text" class="form-control" id="auteur" name="auteur" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>

<?php include "inc/footer.php"; ?>