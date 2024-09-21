<?php
include 'inc/header.php';
Session::CheckLogin();
$csrf_token = Session::generateCsrfToken();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {

  $register = $users->userRegistration($_POST);
}

if (isset($register)) {
  echo $register;
}


?>


<div class="card ">
  <div class="card-header">
    <h3 class='text-center'>Enregistrement de l'utilisateur</h3>
  </div>
  <div class="cad-body">



    <div style="width:600px; margin:0px auto">

      <form class="" action="" method="post">
        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
        <div class="form-group pt-3">
          <label for="name">Votre nom</label>
          <input type="text" name="name" class="form-control">
        </div>
        <div class="form-group">
          <label for="username">Votre nom d'utilisateur</label>
          <input type="text" name="username" class="form-control">
        </div>
        <div class="form-group">
          <label for="email">Adresse email</label>
          <input type="email" name="email" class="form-control">
        </div>
        <div class="form-group">
          <label for="mobile">Numero de telephone</label>
          <input type="text" name="mobile" class="form-control">
        </div>
        <div class="form-group">
          <label for="password">Mots de passe</label>
          <input type="password" name="password" class="form-control">
          <input type="hidden" name="roleid" value="2" class="form-control">
        </div>
        <div class="form-group">
          <button type="submit" name="register" class="btn btn-success">Enregistrer</button>
        </div>


      </form>
    </div>


  </div>
</div>



<?php
include 'inc/footer.php';

?>