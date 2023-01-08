<?php

session_start();

require_once 'classes/connection.php';
require_once 'classes/album.php';
require_once 'classes/invitation.php';
require_once 'classes/user.php';

$connection = new Connection();
$invitations = $connection->getWaitingInvitations($_SESSION['id']);

if(isset($_GET['action']) && isset($_GET['invitation_id'])){
    $action = $_GET['action'];
    $invitation_id = $_GET['invitation_id'];
    $connection = new Connection();
    if($action == 'accept'){
        $connection->acceptInvite($invitation_id);
    }elseif ($action == 'decline'){
        $connection->declineInvite($invitation_id);
    }
}

?>

<h2>Invitations</h2>

<?php
    if($invitations !== null){
        foreach ($invitations as $invitation){
            echo $invitation['sender_id']; ?>
            <a href="my-invitations.php?action=accept&invitation_id=<?php echo $invitation['id'] ?>">Accepter</a>
            <a href="my-invitations.php?action=decline&invitation_id=<?php echo $invitation['id'] ?>">Refuser</a>
        <?php }
    }
?>


