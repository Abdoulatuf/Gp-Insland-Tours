<?php
include 'inc/header.php';
Session::CheckSession(); // Vérifier si l'utilisateur est connecté

// Utilisation du Singleton pour obtenir l'instance de la base de données
$db = Database::getInstance(); // Obtenir l'instance de la base de données

// Récupération des circuits plage
$sql = "SELECT * FROM circuit WHERE page = 'plage'";
$stmt = $db->prepare($sql);
$stmt->execute();
$circuits = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="main">
    <section class="hero section dark-background">
        <img src="assets/img/plage.jpeg" alt="" data-aos="fade-in">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <h2 class="text-center mt-4">Plages</h2>
            <p class="text-center">Détendez-vous sur les plus belles plages des Comores.</p>

            <div class="row mt-5" data-aos="fade-up" data-aos-delay="200">
                <?php if (!empty($circuits)) : ?>
                    <?php foreach ($circuits as $circuit) : ?>
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <?php
                                $imagePath = './uploads/' . htmlspecialchars($circuit['image']);
                                ?>
                                <div class="card-header">
                                    <img src="<?php echo $imagePath; ?>" style="position:initial!important" class="img-fluid" alt="<?php echo htmlspecialchars($circuit['nom_circuit']); ?>">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($circuit['nom_circuit']); ?></h5>
                                    <p class="card-text text-black"><?php echo htmlspecialchars($circuit['description']); ?></p>
                                    <p class="card-text"><small class="text-muted">Lieu : <?php echo htmlspecialchars($circuit['lieu']); ?></small></p>
                                    <p class="card-text"><small class="text-muted">Date : <?php echo htmlspecialchars($circuit['date']); ?></small></p>
                                    <a href="form_reservation.php?id=<?php echo $circuit['id']; ?>" class="btn btn-primary">Réserver</a> <!-- Bouton de réservation -->
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p class="text-center">Aucun circuit disponible pour le moment.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>

<?php
include 'inc/footer.php';
?>