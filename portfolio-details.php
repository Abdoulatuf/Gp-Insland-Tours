<?php
// Connexion à la base de données
$serveur = "localhost";
$utilisateur = "root";
$motdepasse = "";
$bdd = "db_circuit";

$connexion = new mysqli($serveur, $utilisateur, $motdepasse, $bdd);

// Vérification de la connexion
if ($connexion->connect_error) {
  die("Échec de la connexion : " . $connexion->connect_error);
}

// Récupération des détails du circuit depuis la base de données
$id_circuit = $_GET['id']; // Récupérer l'ID du circuit depuis l'URL
$requete = "SELECT * FROM circuit WHERE id = ?";
$stmt = $connexion->prepare($requete);
$stmt->bind_param("i", $id_circuit);
$stmt->execute();
$resultat = $stmt->get_result();
$circuit = $resultat->fetch_assoc();

// Fermeture de la connexion à la base de données
$connexion->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Reservation Circuits Touristique</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Gp
  * Template URL: https://bootstrapmade.com/gp-free-multipurpose-html-bootstrap-template/
  * Updated: Aug 15 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="portfolio-details-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center me-auto me-lg-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">Island Tours</h1>
        <span>.</span>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.php" class="active">Accueil<br></a></li>
          <li><a href="index.php#a_propos">A propos</a></li>
          <li><a href="index.php#services">Services</a></li>
          <li><a href="index.php#sites">Sites</a></li>
          <li><a href="index.php#actualite">Actualite</a></li>
          <li><a href="index.php#contact">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      <a class="btn-getstarted" href="index.php#a_propos">Commencer</a>

    </div>
  </header>
  <main class="main">

    <div class="page-title" data-aos="fade">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1></h1>
              <p class="mb-0"></p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <section id="portfolio-details" class="portfolio-details section">
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4">
          <div class="col-lg-8">
            <div class="portfolio-details-slider swiper init-swiper">
              <script type="application/json" class="swiper-config">
                {
                  "loop": true,
                  "speed": 600,
                  "autoplay": {
                    "delay": 5000
                  },
                  "slidesPerView": "auto",
                  "pagination": {
                    "el": ".swiper-pagination",
                    "type": "bullets",
                    "clickable": true
                  }
                }
              </script>

              <div class="swiper-wrapper align-items-center">
                <?php
                // Récupération des images du circuit depuis la base de données
                $images = explode(",", $circuit['image']);
                foreach ($images as $image) {
                  // Assurez-vous que le chemin d'accès à l'image est correct
                  $imagePath = './uploads/' . trim($image); // Ajustez le chemin selon votre structure de dossier
                  // Vérifiez si le fichier existe avant d'afficher
                  if (file_exists($imagePath)) {
                    echo '<div class="swiper-slide">';
                    echo '<img src="' . htmlspecialchars($imagePath) . '" alt="' . htmlspecialchars($circuit['nom_circuit']) . '">';
                    echo '</div>';
                  } else {
                    echo '<div class="swiper-slide">';
                    echo '<p>Image non disponible</p>'; // Message alternatif si l'image n'existe pas
                    echo '</div>';
                  }
                }
                ?>
              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="portfolio-info" data-aos="fade-up" data-aos-delay="200">
              <h3>Informations sur le circuit</h3>
              <ul>
                <li><strong>Nom</strong>: <?php echo $circuit['nom_circuit']; ?></li>
                <li><strong>Lieu</strong>: <?php echo $circuit['lieu']; ?></li>
                <li><strong>Date</strong>: <?php echo date('d M, Y', strtotime($circuit['date'])); ?></li>
              </ul>
            </div>
            <div class="portfolio-description" data-aos="fade-up" data-aos-delay="300">
              <h2>Description du circuit</h2>
              <p>
                Découvrez des paysages époustouflants et des expériences inoubliables à travers nos circuits soigneusement conçus. Chaque circuit est une opportunité de découvrir la culture locale, la gastronomie et l'hospitalité de notre région. Que vous soyez à la recherche d'une aventure en plein air ou d'une escapade relaxante, nous avons le circuit parfait pour vous.

              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <?php include_once "inc/footer.php" ?>