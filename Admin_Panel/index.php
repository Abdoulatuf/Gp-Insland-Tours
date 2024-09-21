<?php
include 'inc/header.php';
Session::CheckSession();
// Vérifiez si l'utilisateur est connecté
if (!Session::get('id')) {
  header("Location: login.php"); // Redirigez vers la page de connexion si non connecté
  exit();
}

// Vérifiez si un message d'alerte est présent dans la session
if (Session::get('logMsg')) {
  echo Session::get('logMsg'); // Affiche le message d'alerte
  Session::set('logMsg', null); // Réinitialiser le message après l'affichage
}
if (isset($_GET['remove'])) {
  $remove = filter_var($_GET['remove'], FILTER_VALIDATE_INT);
  if ($remove) {
    $removeReservation = $users->deleteReservationById($remove);
  }
}

if (isset($removeReservation)) {
  echo $removeReservation;
}
?>
<div class="container">
  <div class="card ">
    <div class="card-header">
      <h3><i class="fas fa-users mr-2"></i>Listes des circuits réservés <span class="float-right">Bienvenue! <strong>
            <span class="badge badge-lg badge-secondary text-white">
              <?php
              $username = Session::get('nom');
              if (isset($username)) {
                echo $username;
              }
              ?></span>
          </strong></span></h3>
    </div>
    <div class="card-body pr-2 pl-2">
      <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
          <tr>
            <th class="text-center">ID</th>
            <th class="text-center">Nom du circuit</th>
            <th class="text-center">Nom utilisateur</th>
            <th class="text-center">Mobile</th>
            <th class="text-center">Date de réservation</th>
            <th class="text-center">Lieux</th>
            <th class="text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $allReservations = $users->selectAllReservations();
          if ($allReservations) {
            $i = 0;
            foreach ($allReservations as $reservation) {
              $i++;
          ?>
              <tr class="text-center">
                <td><?php echo $i; ?></td>
                <td><?php echo $reservation->nom_circuit; ?></td>
                <td><?php echo $reservation->nom; ?> </td>
                <td><?php echo $reservation->mobile; ?></td>
                <td><span class="badge badge-lg badge-secondary text-white"><?php echo $users->formatDate($reservation->date); ?></span></td>
                <td><?php echo $reservation->lieu; ?></td>
                <td>
                  <a class="btn btn-success btn-sm" href="circuit.php.php?id=<?php echo $reservation->id; ?>">Vue</a>
                  <a onclick="return confirm('Êtes-vous sûr de vouloir supprimer ?')" class="btn btn-danger btn-sm" href="?remove=<?php echo $reservation->id; ?>">Supprimer</a>
                </td>
              </tr>
            <?php }
          } else { ?>
            <tr class="text-center">
              <td colspan="7">Pas de réservations disponibles !</td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php
include 'inc/footer.php';
?>