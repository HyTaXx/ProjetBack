<?php

session_start();
require_once 'classes/connection.php';
require_once 'classes/user.php';
require_once 'classes/album.php';


$album_id = $_POST['album_id'];

$connection = new Connection();
$users = $connection->getAllUsers();
?>

<form method="POST" action="send_invitation.php">
    <input type="hidden" name="album_id" value="<?php echo $album_id ?>">
    <label for="recipient_id">Avec qui voulez-vous partager votre album?</label>
    <select name="recipient_id" >
        <?php foreach ($users as $user){ ?>
        <option value="<?php echo $user['id']; ?>"><?php echo $user['first_name'] ?></option>
        <?php } ?>
    </select>
    <button type="submit">Envoyer l'invitation</button>
</form>