<?php
include_once 'inc/header.php';
Session::init();

// Vérifiez si l'utilisateur est connecté
if (!Session::get('id')) {
    header("Location: login.php"); // Redirigez vers la page de connexion si non connecté
    exit();
}

$db = new Database(); // Créez une instance de la classe Database
$message = new Message($db); // Créez une instance de la classe Message

// Récupérer les messages de la base de données
$messages = $message->getAllMessages();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer l'ID du message à supprimer
    $message_id = $_POST['message_id'];

    if ($message_id) {
        // Requête SQL pour supprimer le message
        $sql = "DELETE FROM contact WHERE id = :id";

        // Préparer et exécuter la requête
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $message_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            // Redirection après la suppression
            header("Location: messages.php?success=Message supprimé");
            exit();
        } else {
            echo "Erreur lors de la suppression du message.";
        }
    }
}
?>

<div class="container bg-light">
    <h2 class="mt-4 text-center">Messages Reçus</h2>

    <?php if ($messages) { ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Sujet</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($messages as $message) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($message->nom); ?></td>
                        <td><?php echo htmlspecialchars($message->email); ?></td>
                        <td><?php echo htmlspecialchars($message->subject); ?></td>
                        <td><?php echo htmlspecialchars($message->message); ?></td>
                        <td><?php echo htmlspecialchars($message->created_at); ?></td>
                        <td>
                            <!-- Bouton Supprimer -->
                            <form action="" method="POST" style="display:inline;">
                                <input type="hidden" name="message_id" value="<?php echo $message->id; ?>">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce message ?');">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center">Aucun message reçu.</p>
    <?php } ?>
</div>


<?php include_once "inc/footer.php"; ?>