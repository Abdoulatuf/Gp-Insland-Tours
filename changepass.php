<?php
include 'inc/header.php';
Session::CheckSession();
$csrf_token = Session::generateCsrfToken();

if (isset($_GET['id'])) {
  $userid = (int)$_GET['id'];
}



if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['changepass'])) {
  $changePass = $users->changePasswordBysingelUserId($userid, $_POST);
}



if (isset($changePass)) {
  echo  $changePass;
}
?>

<main class="main">
  <section class="hero section dark-background">
    <img src="assets/img/accueil-bg.jpg" alt="" data-aos="fade-in">
    <div class="container card" data-aos="fade-up" data-aos-delay="100" style="width:450px; margin: auto;">
      <div class="card-header">
        <h3 class="text-black text-center">Changer votre mots de passe <span class="float-right"> <a href="profile.php?id=<?php  ?>" class="btn btn-primary">Back</a> </h3>
      </div>
      <div class="card-body" style="width:450px; margin: auto;">
        <div style="width:600px; margin:0px auto">

          <form class="" action="" method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
            <div class="form-group" style="width: 70%;">
              <label for="old_password">Ancien mots passe</label>
              <input type="password" name="old_password" class="form-control">
            </div>
            <div class="form-group" style="width: 70%;">
              <label for="new_password">Nouveau mots de passe</label>
              <input type="password" name="new_password" class="form-control">
            </div>


            <div class="form-group">
              <button type="submit" name="changepass" class="btn btn-success">Changer le mots de password</button>
            </div>


          </form>
        </div>


      </div>
    </div>
  </section>
</main>



<?php
include 'inc/footer.php';

?>