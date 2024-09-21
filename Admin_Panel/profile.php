<?php
include 'inc/header.php';
Session::CheckSession();
$csrf_token = Session::generateCsrfToken();

if (isset($_GET['id'])) {
  $userid = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['id']);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
  $updateUser = $users->updateUserByIdInfo($userid, $_POST);
}
if (isset($updateUser)) {
  echo $updateUser;
}




?>
<div class="container">
  <div class="card ">
    <div class="card-header">
      <h3>Profile utilisateur <span class="float-right"> <a href="index.php" class="btn btn-primary">Retour</a> </h3>
    </div>
    <div class="card-body">

      <?php
      $getUinfo = $users->getUserInfoById($userid);
      if ($getUinfo) {
      ?>
        <div style="width:600px; margin:0px auto">

          <form class="" action="" method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
            <div class="form-group">
              <label for="nom">Votre nom</label>
              <input type="text" name="nom" value="<?php echo $getUinfo->nom; ?>" class="form-control">
            </div>
            <div class="form-group">
              <label for="prenom">Ton nom d'utilisateur</label>
              <input type="text" name="prenom" value="<?php echo $getUinfo->prenom; ?>" class="form-control">
            </div>
            <div class="form-group">
              <label for="email">Adresse e-mail</label>
              <input type="email" id="email" name="email" value="<?php echo $getUinfo->email; ?>" class="form-control">
            </div>
            <div class="form-group">
              <label for="mobile">Numéro de portable</label>
              <input type="text" id="mobile" name="mobile" value="<?php echo $getUinfo->mobile; ?>" class="form-control">
            </div>

            <?php if (Session::get("roleid") == '1') { ?>

              <div class="form-group
              <?php if (Session::get("roleid") == '1' && Session::get("id") == $getUinfo->id) {
                echo "d-none";
              } ?>
              ">
                <div class="form-group">
                  <label for="sel1">Sélectionnez le rôle de l'utilisateur</label>
                  <select class="form-control" name="roleid" id="roleid">
                    <?php
                    if ($getUinfo->roleid == '1') { ?>
                      <option value="1" selected='selected'>Admin</option>
                      <option value="2">Utiisateur</option>
                    <?php } elseif ($getUinfo->roleid == '2') { ?>
                      <option value="1">Admin</option>
                      <option value="2" selected='selected'>Utilisateur</option>
                    <?php }  ?>
                  </select>
                </div>
              </div>

            <?php } else { ?>
              <input type="hidden" name="roleid" value="<?php echo $getUinfo->roleid; ?>">
            <?php } ?>
            <?php if (Session::get("id") == $getUinfo->id) { ?>

              <div class="form-group">
                <button type="submit" name="update" class="btn btn-success">Mise à jour</button>
                <a class="btn btn-primary" href="changepass.php?id=<?php echo $getUinfo->id; ?>">Modifier le mot de passe</a>
              </div>
            <?php } elseif (Session::get("roleid") == '1') { ?>


              <div class="form-group">
                <button type="submit" name="update" class="btn btn-success">Mis à jour</button>
                <a class="btn btn-primary" href="changepass.php?id=<?php echo $getUinfo->id; ?>">Modifier le mots de passe</a>
              </div>
            <?php } elseif (Session::get("roleid") == '2') { ?>


              <div class="form-group">
                <button type="submit" name="update" class="btn btn-success">Mis à jour</button>

              </div>

            <?php   } else { ?>
              <div class="form-group">

                <a class="btn btn-primary" href="index.php">Ok</a>
              </div>
            <?php } ?>


          </form>
        </div>

      <?php } else {

        header('Location:index.php');
      } ?>



    </div>
  </div>
</div>

<?php
include 'inc/footer.php';
?>