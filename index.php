<?php
include 'inc/header.php'; // Inclure l'en-tête

?>
<main class="main">

  <!-- Section Accueil-->
  <section id="accueil" class="hero section dark-background">
    <img src="assets/img/accueil-bg.jpg" alt="" data-aos="fade-in">
    <!-- Ajouter un bouton de profil et un bouton de déconnexion pour l'utilisateur connecté -->
    <div class="container">
      <!-- Message d'accueil pour l'utilisateur connecté -->

      <div class="row justify-content-center text-center" data-aos="fade-up" data-aos-delay="100">
        <div class="col-xl-6 col-lg-8">
          <h2>Visiter les comores entre mer, terre et legendes<span>.</span></h2>
          <p>Reserver <a href="reservation.php">ici</a></p>
        </div>
      </div>
      <div class="row gy-4 mt-5 justify-content-center" data-aos="fade-up" data-aos-delay="200">
        <div class="col-xl-2 col-md-4" data-aos="fade-up" data-aos-delay="300">
          <div class="icon-box">
            <i class="bi bi-binoculars"></i>
            <h3><a href="randonnee.php">Randonnee</a></h3>
          </div>
        </div>
        <div class="col-xl-2 col-md-4" data-aos="fade-up" data-aos-delay="400">
          <div class="icon-box">
            <i class="bi bi-water"></i>
            <h3><a href="plages.php?page=plage">Plages</a></h3>
          </div>
        </div>
        <div class="col-xl-2 col-md-4" data-aos="fade-up" data-aos-delay="500">
          <div class="icon-box">
            <i class="bi bi-buildings"></i>
            <h3><a href="patrimoine.php?page=patrimoine">Patrimoine</a></h3>
          </div>
        </div>
        <div class="col-xl-2 col-md-4" data-aos="fade-up" data-aos-delay="600">
          <div class="icon-box">
            <i class="bi bi-image-alt"></i>
            <h3><a href="montagne.php?page=montagne">Montagne</a></h3>
          </div>
        </div>
        <div class="col-xl-2 col-md-4" data-aos="fade-up" data-aos-delay="700">
          <div class="icon-box">
            <i class="bi bi-gem"></i>
            <h3><a href="art_culture.php?page=art_culture">Arts&Culture</a></h3>
          </div>
        </div>
      </div>

    </div>

  </section><!-- /Section Accueil -->

  <!-- Section A propos -->
  <section id="a_propos" class="about section">

    <div class="container mt-5" data-aos="fade-up" data-aos-delay="100">

      <h2 class="text-center">À Propos de Nous</h2>
      <div class="row mt-4">
        <div class="col-md-6">
          <h4>Notre Mission</h4>
          <p>
            Chez <strong>Island Tours</strong>, notre mission est de vous offrir les meilleures expériences de voyage à travers des circuits touristiques soigneusement sélectionnés. Nous croyons que chaque voyage est une opportunité de découvrir de nouvelles cultures, de rencontrer des gens formidables, et de créer des souvenirs inoubliables.
          </p>
          <h4>Notre Histoire</h4>
          <p>
            Fondé en 2024, <strong>Island Tours</strong> a commencé avec une simple idée : rendre le voyage accessible à tous. Depuis, nous avons élargi notre gamme de circuits pour inclure des destinations uniques et des expériences authentiques qui répondent aux besoins de chaque voyageur.
          </p>
          <h4>Pourquoi Choisir Nous ?</h4>
          <ul>
            <li>Circuits personnalisés adaptés à vos besoins.</li>
            <li>Équipe d'experts passionnés par le voyage.</li>
            <li>Assistance 24/7 pour garantir votre tranquillité d'esprit.</li>
            <li>Tarifs compétitifs et transparents.</li>
          </ul>
        </div>
        <div class="col-md-6">
          <img src="assets/img/23.png" alt="À Propos" class="img-fluid" style="border-radius: 10px;">
        </div>
      </div>

    </div>

  </section><!-- / Section A propos -->
  <section id="services" class="services section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Les Services</h2>
      <p>Découvrez nos service touristiques passionnants</p>
    </div><!-- End Section Title -->

    <div class="container">
      <div class="row gy-4">

        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
          <div class="service-item position-relative">
            <div class="icon">
              <i class="bi bi-globe"></i>
            </div>
            <h3>Circuits Patrimoine Culturel</h3>
            <p>Plongez-vous dans la riche histoire et la culture de nos destinations avec des visites guidées de monuments historiques et de musées.</p>
          </div>
        </div><!-- Fin Élément de Service -->

        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
          <div class="service-item position-relative">
            <div class="icon">
              <i class="bi bi-hiking"></i>
            </div>
            <h3>Circuits de Randonnée d'Aventure</h3>

            <p>Rejoignez-nous pour des randonnées passionnantes à travers des paysages à couper le souffle, parfaits pour les amateurs de nature et les aventuriers.</p>
          </div>
        </div><!-- Fin Élément de Service -->

        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
          <div class="service-item position-relative">
            <div class="icon">
              <i class="bi bi-boat"></i>
            </div>
            <h3>Circuits en Bateau Panoramiques</h3>
            <p>Découvrez la beauté de nos voies navigables avec des circuits en bateau relaxants qui offrent des vues à couper le souffle et des rencontres uniques avec la faune.</p>
          </div>
        </div><!-- Fin Élément de Service -->

        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
          <div class="service-item position-relative">
            <div class="icon">
              <i class="bi bi-camera"></i>
            </div>
            <h3>Ateliers de Photographie</h3>
            <p>Capturez la beauté de nos destinations avec des ateliers de photographie animés par des experts, conçus pour tous les niveaux.</p>
          </div>
        </div><!-- Fin Élément de Service -->

        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
          <div class="service-item position-relative">
            <div class="icon">
              <i class="bi bi-people"></i>
            </div>
            <h3>Circuits de Groupe</h3>
            <p>Rejoignez nos circuits de groupe pour une expérience amusante et sociale, parfaite pour rencontrer de nouveaux amis tout en explorant ensemble.</p>
          </div>
        </div><!-- Fin Élément de Service -->

        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
          <div class="service-item position-relative">
            <div class="icon">
              <i class="bi bi-restaurant"></i>
            </div>
            <h3>Expériences Culinaires</h3>
            <p>Savourez les saveurs locales avec nos circuits culinaires qui incluent des dégustations, des cours de cuisine et des visites de marchés locaux.</p>
          </div>
        </div><!-- Fin Élément de Service -->

      </div>
  </section>
  <section id="sites" class="portfolio section">
    <!-- Section Titre -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Sites</h2>
      <p>Consultez les sites</p>
    </div><!-- fin Section Titre -->

    <?php
    // Connexion à la base de données
    $db = Database::getInstance();
    $sql = "SELECT * FROM circuit";
    $stmt = $db->query($sql);
    $circuits = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="container">
      <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
        <!-- Sites Filters -->
        <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
          <li data-filter="*" class="filter-active" onclick="filterCircuits('')">Tous</li>
          <li data-filter=".filter-anjouan" onclick="filterCircuits('anjouan')">Anjouan</li>
          <li data-filter=".filter-moheli" onclick="filterCircuits('moheli')">Moheli</li>
          <li data-filter=".filter-grand-comores" onclick="filterCircuits('grand-comores')">Grand-Comores</li>
        </ul><!-- Fin sites Filters -->

        <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
          <?php if (empty($circuits)): ?>
            <div class="col-12 text-center">
              <p>Aucun site disponible pour le moment.</p>
            </div>
          <?php else: ?>
            <?php foreach ($circuits as $circuit): ?>
              <div class="col-lg-4 col-md-6 portfolio-item isotope-item 
                            <?php
                            // Définir la classe de filtrage en fonction du lieu
                            if ($circuit['lieu'] == 'anjouan') {
                              echo 'filter-anjouan';
                            } elseif ($circuit['lieu'] == 'Moheli') {
                              echo 'filter-moheli';
                            } elseif ($circuit['lieu'] == 'Grande-Comore') {
                              echo 'filter-grand-comores';
                            }
                            ?>">
                <!-- Affichage de l'image du circuit -->
                <img src="./uploads/<?php echo htmlspecialchars($circuit['image']); ?>" class="img-fluid" alt="<?php echo htmlspecialchars($circuit['nom_circuit']); ?>">
                <div class="portfolio-info">
                  <!-- Nom du circuit -->
                  <h4><?php echo htmlspecialchars($circuit['nom_circuit']); ?></h4>
                  <!-- Description du circuit -->
                  <p><?php echo htmlspecialchars($circuit['description']); ?></p>
                  <p class="card-text"><small class="text-muted">Lieu : <?php echo htmlspecialchars($circuit['lieu']); ?></small></p>
                  <p class="card-text"><small class="text-muted">Date : <?php echo htmlspecialchars($circuit['date']); ?></small></p>
                  <a href="./uploads/<?php echo htmlspecialchars($circuit['image']); ?>" title="<?php echo htmlspecialchars($circuit['nom_circuit']); ?>" data-gallery="portfolio-gallery-app" class="glightbox preview-link">
                    <i class="bi bi-zoom-in"></i>
                  </a>
                  <a href="portfolio-details.php?id=<?php echo $circuit['id']; ?>" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div><!-- Fin Portfolio Item -->
            <?php endforeach; ?>
          <?php endif; ?>
        </div><!-- Fin des sites -->
      </div>
    </div>
  </section>
  </div><!-- Fin des sites -->
  </div>
  </div>
  </section>

  <!-- /Sites Section -->
  <?php

  // Inclure les fichiers nécessaires
  require_once 'classes/Actualite.php'; // Remplacez par le chemin correct

  // Créer une instance de la classe ActualiteDisplay
  $actualites = new Actualite($db);

  // Afficher toutes les actualités
  $actualites->getAllActualites();
  $sql = "SELECT * FROM actualites ORDER BY date_publication DESC";
  $stmt = $db->getConnection()->prepare($sql);
  $stmt->execute();
  $actualites = $stmt->fetchAll(PDO::FETCH_ASSOC);

  ?>
  <!-- Actualite Section -->
  <section id="actualite" class="actualites">
    <div class="container my-5">
      <h2 class="text-center">Actualités</h2>
      <div class="row">
        <?php if ($actualites) { ?>
          <?php foreach ($actualites as $actualite) { ?>
            <div class="col-md-4 mb-4">
              <div class="card h-100">
                <?php if (empty($actualite->image)) { ?>
                  <img src="<?php echo htmlspecialchars($actualite['image']); ?>" class="card-img-top" alt="Image de l'actualité">
                <?php } else { ?>
                  <img src="uploads/images.jpeg" class="card-img-top" alt="Image par défaut">
                <?php } ?>
                <div class="card-body">
                  <h5 class="card-title"><?php echo htmlspecialchars($actualite['titre']); ?></h5>
                  <p class="card-text">
                    <?php echo htmlspecialchars(substr($actualite['contenu'], 0, 100)); ?>...
                  </p>
                  <a href="voir_actualite.php?id=<?php echo $actualite['id']; ?>" class="btn btn-primary">Lire plus</a>
                </div>
                <div class="card-footer text-muted">
                  Publié le <?php echo date('d/m/Y', strtotime($actualite['date_publication'])); ?>
                </div>
              </div>
            </div>
          <?php } ?>
        <?php } else { ?>
          <p class="text-center">Aucune actualité disponible pour le moment.</p>
        <?php } ?>
      </div>
    </div>
  </section>

  <!-- Contact Section -->
  <section id="contact" class="contact section">

    <!-- Titre de la section -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Contact</h2>
      <p>Contactez-nous</p>
    </div><!-- Fin du titre de la section -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="row gy-4">
        <div class="col-lg-4">
          <!-- Information de contact : Adresse -->
          <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
            <i class="bi bi-geo-alt flex-shrink-0"></i>
            <div>
              <h3>Adresse</h3>
              <p>Coulee de lave, moroni</p>
            </div>
          </div><!-- Fin de l'info sur l'adresse -->

          <!-- Information de contact : Téléphone -->
          <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
            <i class="bi bi-telephone flex-shrink-0"></i>
            <div>
              <h3>Appelez-nous</h3>
              <p>+269 3772424</p>
            </div>
          </div><!-- Fin de l'info sur le téléphone -->

          <!-- Information de contact : Email -->
          <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
            <i class="bi bi-envelope flex-shrink-0"></i>
            <div>
              <h3>Envoyez-nous un email</h3>
              <p>IslandTours@gmail.com</p>
            </div>
          </div><!-- Fin de l'info sur l'email -->

        </div>

        <div class="col-lg-8">
          <!-- Formulaire de contact -->
          <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
            <div class="row gy-4">

              <!-- Champ pour le nom -->
              <div class="col-md-6">
                <input type="text" name="nom" class="form-control" placeholder="Votre nom" required="">
              </div>

              <!-- Champ pour l'email -->
              <div class="col-md-6 ">
                <input type="email" class="form-control" name="email" placeholder="Votre email" required="">
              </div>

              <!-- Champ pour le sujet -->
              <div class="col-md-12">
                <input type="text" class="form-control" name="subject" placeholder="Sujet" required="">
              </div>

              <!-- Champ pour le message -->
              <div class="col-md-12">
                <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
              </div>

              <!-- Bouton pour envoyer le formulaire -->
              <div class="col-md-12 text-center">
                <div class="loading">Chargement</div>
                <div class="error-message bg-success"></div>
                <div class="sent-message">Votre message a été envoyé. Merci !</div>
                <button type="submit">Envoyer le message</button>
              </div>
            </div>
          </form><!-- Fin du formulaire de contact -->
        </div>
      </div>
    </div>
  </section><!-- Fin de la section Contact -->
</main>

<?php
include "inc/footer.php";
?>