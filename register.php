<?php
include "inc/header.php";
include_once "classes/Database.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $email = trim($_POST['email']);
    $mobile = trim($_POST['mobile']);
    $password = $_POST['password'];

    // Appeler la méthode d'inscription
    if ($users->register($nom, $prenom, $email, $mobile, $password)) {
        echo "Inscription réussie ! Vous pouvez maintenant vous connecter.";
    } else {
        echo "Erreur lors de l'inscription. Veuillez réessayer.";
    }
}
?>
<main class="main">
    <section class=" hero section dark-background  ">
        <img src="assets/img/accueil-bg.jpg" alt="" data-aos="fade-in">
        <div class="container card" data-aos="fade-up" data-aos-delay="100" style="width:450px; margin: auto;">
            <div class="card-header">
                <h3 class='text-center text-black'><i class="fas fa-sign-in-alt mr-2 "></i>Inscription utilisateur</h3>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" name="nom" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom</label>
                        <input type="text" name="prenom" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Adresse email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="mobile">Numéro de téléphone</label>
                        <input type="text" name="mobile" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="register" class="btn btn-success">Enregistrer</button>
                    </div>
                </form>

            </div>
        </div>
    </section>
</main>


<?php include "inc/footer.php"; ?>