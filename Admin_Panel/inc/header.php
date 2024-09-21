<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath . "/../lib/Session.php";
Session::init();

spl_autoload_register(function ($classes) {
  include 'classes/' . $classes . ".php";
});

$users = new Users();
?>

<!DOCTYPE html>
<html lang="en" dir="auto">

<head>
  <meta charset="utf-8">
  <title>Gestion des utilisateurs PHP CRUD</title>
  <link rel="stylesheet" href="assets/bootstrap.min.css">
  <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/style.css">
</head>

<body>
  <?php
  if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    Session::destroy();
  }
  ?>

  <div class="container">

    <nav class="navbar navbar-expand-md navbar-dark bg-dark card-header">
      <a class="navbar-brand" href="index.php"><i class="fas fa-home mr-2"></i>Dashboard</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav ml-auto">
          <?php if (Session::get('id') == TRUE) { ?>
            <?php if (Session::get('roleid') == '1') { ?>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-users mr-2"></i>Listes
                </a>
                <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                  <a class="nav-link" role="button" href="admin.php"><i class="fas fa-users mr-2"></i>utilisateur</a>
                  <a class="nav-link" role="button" href="list_actualites.php"><i class="fa fa-cogs mr-2"></i> Actualite</a>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link " href="modifier.php"><i class=" fa fa-cogs mr-2"></i>Modifier circuit</a>


              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-plus-circle mr-2"></i>Ajouter
                </a>
                <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item nav-link bg-dark" href="addUsers.php">Ajouter un utilisateur</a>
                  <a class="dropdown-item nav-link bg-dark" href="addCircuit.php">Ajouter un circuit</a>
                  <a class="dropdown-item nav-link bg-dark" href="addactualite.php?id=<?php echo Session::get("id"); ?>">Ajouter une actualité</a>
                </div>
              </li>
            <?php } ?>
            <li class="nav-item">
              <a class="nav-link" href="profile.php?id=<?php echo Session::get("id"); ?>"><i class="fab fa-500px mr-2"></i>Profile</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="messages.php"><i class="fas fa-envelope mr-2"></i>Messages</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?action=logout"><i class="fas fa-sign-out-alt mr-2"></i>Se déconnecter</a>
            </li>

            <!-- Lien vers la page d'accueil utilisateur -->
            <li class="nav-item">
              <a class="nav-link" href="../index.php"><i class="fas fa-arrow-circle-left mr-2"></i>Accueil</a>
            </li>

          <?php } else { ?>
            <li class="nav-item">
              <a class="nav-link" href="login.php?id=<?php echo Session::get("id"); ?>"><i class="fas fa-sign-in-alt mr-2"></i>Connexion</a>
            </li>
          <?php } ?>
        </ul>
      </div>
    </nav>
  </div>