<?php
include 'inc/header.php';
Session::CheckSession();
$sId =  Session::get('roleid');
$csrf_token = Session::generateCsrfToken();
if ($sId === 1) { ?>

  <?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addUsers'])) {

    $userAdd = $users->addNewUserByAdmin($_POST);
  }

  if (isset($userAdd)) {
    echo $userAdd;
  }


  ?>

  <div class="container">
    <div class="card ">
      <div class="card-header">
        <h3 class='text-center'>Ajouter nouveau Utilisateur</h3>
      </div>
      <div class="cad-body">
        <div style="width:600px; margin:0px auto">
          <form class="" action="" method="post">
            <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
            <div class="form-group pt-3">
              <label for="nom">Nom</label>
              <input type="text" name="nom" class="form-control">
            </div>
            <div class="form-group">
              <label for="prenom">Prenom</label>
              <input type="text" name="prenom" class="form-control">
            </div>
            <div class="form-group">
              <label for="email">Adresse E-mail</label>
              <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group">
              <label for="mobile">Numero de telephone</label>
              <input type="text" name="mobile" class="form-control">
            </div>
            <div class="form-group">
              <label for="password">Mots de passe</label>
              <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
              <div class="form-group">
                <label for="sel1">Selectionner le Role utilisateur</label>
                <select class="form-control" name="roleid" id="roleid">
                  <option value="1">Admin</option>
                  <option value="2">Membre</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <button type="submit" name="addUser" class="btn btn-success">Enregistrer</button>
            </div>


          </form>
        </div>
      </div>
    </div>
  </div>
<?php
} else {

  header('Location:login.php');
}
?>

<?php
include 'inc/footer.php';

?>