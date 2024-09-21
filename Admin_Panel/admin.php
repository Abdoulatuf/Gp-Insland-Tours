<?php
include 'inc/header.php';

// Vérifie si l'utilisateur est connecté
Session::CheckSession();

// Affiche les messages de log et d'erreur
$logMsg = Session::get('logMsg');
if (isset($logMsg)) {
    echo $logMsg;
}
$msg = Session::get('msg');
if (isset($msg)) {
    echo $msg;
}
Session::set("msg", NULL);
Session::set("logMsg", NULL);

// Suppression d'un utilisateur
if (isset($_GET['remove'])) {
    $remove = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['remove']);
    $removeUser = $users->deleteUserById($remove);
}

// Affiche le message de suppression si disponible
if (isset($removeUser)) {
    echo $removeUser;
}

// Désactivation d'un utilisateur
if (isset($_GET['deactive'])) {
    $deactive = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['deactive']);
    $deactiveId = $users->userDeactiveByAdmin($deactive);
}

// Affiche le message de désactivation si disponible
if (isset($deactiveId)) {
    echo $deactiveId;
}

// Activation d'un utilisateur
if (isset($_GET['active'])) {
    $active = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['active']);
    $activeId = $users->userActiveByAdmin($active);
}

// Affiche le message d'activation si disponible
if (isset($activeId)) {
    echo $activeId;
}
?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3><i class="fas fa-users mr-2"></i>Liste des utilisateurs <span class="float-right">Bienvenue! <strong>
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
                        <th class="text-center">Nom</th>
                        <th class="text-center">Nom d'utilisateur</th>
                        <th class="text-center">Adresse email</th>
                        <th class="text-center">Mobile</th>
                        <th class="text-center">Statut</th>
                        <th class="text-center">Créé</th>
                        <th width='25%' class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Récupère tous les utilisateurs
                    $allUser = $users->selectAllUserData();

                    // Vérifie si des utilisateurs existent
                    if ($allUser) {
                        $i = 0;
                        foreach ($allUser as  $value) {
                            $i++;
                    ?>
                            <tr class="text-center"
                                <?php if (Session::get("id") == $value->id) {
                                    echo "style='background:#d9edf7' ";
                                } ?>>

                                <td><?php echo $i; ?></td>
                                <td><?php echo $value->nom; ?></td>
                                <td><?php echo $value->prenom; ?> <br>
                                    <?php if ($value->roleid  == '1') {
                                        echo "<span class='badge badge-lg badge-info text-white'>Admin</span>";
                                    } elseif ($value->roleid == '2') {
                                        echo "<span class='badge badge-lg badge-dark text-white'>Utilisateur</span>";
                                    } ?></td>
                                <td><?php echo $value->email; ?></td>

                                <td><span class="badge badge-lg badge-secondary text-white"><?php echo $value->mobile; ?></span></td>
                                <td>
                                    <?php if ($value->isActive == '0') { ?>
                                        <span class="badge badge-lg badge-info text-white">Actif</span>
                                    <?php } else { ?>
                                        <span class="badge badge-lg badge-danger text-white">Désactivé</span>
                                    <?php } ?>
                                </td>
                                <td><span class="badge badge-lg badge-secondary text-white"><?php echo $users->formatDate($value->created_at);  ?></span></td>

                                <td>
                                    <?php if (Session::get("roleid") == '1') { ?>
                                        <a class="btn btn-info btn-sm" href="profile.php?id=<?php echo $value->id; ?>">Modifier</a>
                                        <a onclick="return confirm('Êtes-vous sûr de vouloir supprimer ?')" class="btn btn-danger
                    <?php if (Session::get("id") == $value->id) {
                                            echo "disabled";
                                        } ?>
                             btn-sm" href="?remove=<?php echo $value->id; ?>">Supprimer</a>

                                        <?php if ($value->isActive == '0') {  ?>
                                            <a onclick="return confirm('Êtes-vous sûr de vouloir désactiver ?')" class="btn btn-warning
                       <?php if (Session::get("id") == $value->id) {
                                                echo "disabled";
                                            } ?>
                                btn-sm" href="?deactive=<?php echo $value->id; ?>">Désactiver</a>
                                        <?php } elseif ($value->isActive == '1') { ?>
                                            <a onclick="return confirm('Êtes-vous sûr de vouloir activer ?')" class="btn btn-secondary
                       <?php if (Session::get("id") == $value->id) {
                                                echo "disabled";
                                            } ?>
                                     
                                btn-sm" href="?active=<?php echo $value->id; ?>">Activer</a>
                                        <?php } ?>
                                </td>
                            </tr>
                        <?php } else { ?>
                            <tr class="text-center">
                                <td colspan="8">Aucun utilisateur disponible !</td>
                            </tr>
                <?php }
                                }
                            } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
include 'inc/footer.php';
?>