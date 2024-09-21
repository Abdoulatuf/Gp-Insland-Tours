<?php
include_once 'inc/header.php';
Session::CheckSession();

$db = new Database(); // Créez une instance de la classe Database
$actualite = new Actualite($db); // Créez une instance de la classe Actualite

// Récupérer l'ID de l'actualité depuis l'URL
$id = $_GET['id'] ?? null;

if ($id) {
    // Requête pour récupérer les détails de l'actualité
    $sql = "SELECT * FROM actualites WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $actualite = $stmt->fetch(PDO::FETCH_OBJ);

    if (!$actualite) {
        echo "Actualité non trouvée.";
        exit();
    }
} else {
    echo "ID d'actualité manquant.";
    exit();
}
?>

<div class="container my-5">
    <h2><?php echo htmlspecialchars($actualite->titre); ?></h2>

    <?php if (!empty($actualite->image)) { ?>
        <img src="<?php echo htmlspecialchars($actualite->image); ?>" class="img-fluid" alt="Image de l'actualité">
    <?php } ?>
    <p><?php echo nl2br(htmlspecialchars($actualite->contenu)); ?></p>
    <p class="text-muted">Publié le <?php echo date('d/m/Y', strtotime($actualite->date_publication)); ?></p>
</div>

<?php
include_once 'inc/footer.php';
?>