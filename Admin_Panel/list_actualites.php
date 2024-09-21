<?php
include_once 'inc/header.php';
Session::CheckSession();

$db = new Database(); // Créez une instance de la classe Database
$actualite = new Actualite($db); // Créez une instance de la classe Actualite

// Récupération des actualités
$actualites = $actualite->getAllActualites(); // Méthode à créer pour récupérer toutes les actualités
?>

<div class="container">
    <h2 class="mt-4 text-center">Liste des Actualités</h2>

    <?php if ($actualites): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Contenu</th>
                    <th>Auteur</th>
                    <th>Date</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($actualites as $actualite): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($actualite['id'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($actualite['titre'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($actualite['contenu'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($actualite['auteur'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo date('d/m/Y', strtotime($actualite['date_publication'])); ?></td>
                        <td><img src="<?php echo htmlspecialchars($actualite['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="Image" style="width: 100px;"></td>
                        <td>
                            <a href="actualite.php?id=<?php echo $actualite['id']; ?>" class="btn btn-warning">Modifier</a>
                            <form method="post" action="delete_actualite.php" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $actualite['id']; ?>">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette actualité ?');">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">Aucune actualité disponible.</div>
    <?php endif; ?>
</div>

<?php include "inc/footer.php"; ?>