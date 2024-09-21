<?php
include 'inc/header.php';
Session::CheckLogin();
$csrf_token = Session::generateCsrfToken();

// Exemple d'utilisation dans un script de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = [
    'mobile' => $_POST['mobile'],
    'password' => $_POST['password']
  ];

  $message = $users->userLoginAuthentication($data);
  echo $message; // Affiche le message d'alerte
}



?>
<div class="container">
  <div class="card ">
    <div class="card-header bg-light">
      <h3 class='text-center'><i class="fas fa-sign-in-alt mr-2"></i>Connexion administrateur</h3>
    </div>
    <div class="card-body">


      <div style="width:450px; margin:0px auto">

        <form class="" action="" method="post">
          <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
          <div class="form-group">
            <label for="mobile">Numero de telephone</label>
            <input type="text" name="mobile" class="form-control">
          </div>
          <div class="form-group">
            <label for="password">Mots de passe</label>
            <input type="password" name="password" class="form-control">
          </div>
          <div class="form-group">
            <button type="submit" name="login" class="btn btn-success">connecter</button>
          </div>


        </form>
      </div>


    </div>
  </div>
</div>
<?php
include 'inc/footer.php';

?>