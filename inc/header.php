<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath . "/../lib/Session.php";
include_once "classes/Actualite.php";
include_once "classes/Users.php";
Session::init();
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    Session::destroy();
}
/*
$filepath = realpath(dirname(__FILE__));
spl_autoload_register(function ($classes) use ($filepath) {
    include_once $filepath . "/classes/" . $classes . ".php";
});*/


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

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

            <a href="index.php" class="logo d-flex align-items-center me-auto me-lg-0">
                <!-- <img src="assets/img/Island.png" alt=""> -->
                <h1 class="sitename">Island Tours</h1>
                <span>.</span>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="index.php#accueil" class="active">Accueil<br></a></li>
                    <li><a href="index.php#a_propos">A propos</a></li>
                    <li><a href="index.php#services">Services</a></li>
                    <li><a href="index.php#sites">Sites</a></li>
                    <li><a href="index.php#actualite">Actualité</a></li>
                    <li><a href="index.php#contact">Contact</a></li>

                    <?php if (Session::get('roleid') == '1') : // Vérifiez si l'utilisateur est un administrateur 
                    ?>
                        <li><a href="Admin_Panel/index.php" class="text-warning"><i class="bi bi-shield-lock"></i> Admin</a></li>
                    <?php endif; ?>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <!-- Dropdown pour la connexion et l'inscription -->
            <div class="dropdown">
                <button class="btn-getstarted dropdown-toggle text-black" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-card-list">Menu</i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <?php if (Session::get('id') == TRUE) { ?>
                        <li><a class="dropdown-item" href="profile.php?id=<?php echo Session::get("id"); ?>"><i class="bi bi-person-circle"></i> <?php
                                                                                                                                                    if (isset($_SESSION['id'])) {
                                                                                                                                                        echo htmlspecialchars($_SESSION['nom']);
                                                                                                                                                    } ?></a></li>
                        <li><a class="dropdown-item" href="?action=logout"><i class="bi bi-box-arrow-right"></i> Déconnexion</a></li>
                    <?php } else { ?>
                        <li><a class="dropdown-item" href="login.php"><i class="bi bi-person-fill"></i> Se connecter</a></li>
                        <li><a class="dropdown-item" href="register.php"><i class="bi bi-person-plus-fill"></i> S'inscrire</a></li>
                    <?php }; ?>
                </ul>
            </div>

        </div>
    </header>