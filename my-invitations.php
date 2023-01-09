<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white">
<header class="bg-[#393939] mb-20">
        <div class="flex flex-row h-16 p-4">
            <div class="basis-1/4 flex justify-center">
                <a href="index.php">
                <img src="img/logo_filmhub.png" alt="logo-filmhub">
                </a>
            </div>
            <form action="" class="basis-1/2 flex justify-center">
                <div class="flex flex-row w-5/6">
                    <div class="flex p-2 bg-[#7C7C7C]">
                        <img src="img/search.png" alt="logo-search" class="m-auto">
                    </div>
                    <input type="text" id="search-bar" class="w-full h-full bg-[#7C7C7C] p-3 text-white placeholder-white" placeholder="Rechercher sur Filmhub">
                </div>
            </form>
            <div class="flex flex-row basis-1/4 gap-5">
                <div>
                    <a href="login.php" class="text-white">Se connecter</a>
                </div>
                <div>
                    <a href="register.php" class="text-white">Inscrivez-vous !</a>
                </div>
            </div> 
        </div>
        <hr class="h-px bg-[#5F5F5F] border-0">
        <div class="flex flex-row justify-center gap-5 p-2">
            <a href="index.php" class="text-white">Accueil</a>
            <a href="#" class="text-white">Albums</a>
            <a href="#" class="text-white">Profils</a>
            <form id="filters" method="POST" class="border-2 border-[#5F5F5F]">
                <select name="genre" id="genre" class="bg-[#393939] text-white">
            
                </select>
                <button type="submit" id="btn" class="text-yellow-200">Go</button>
            </form>
        </div>
    </header>
    
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

</body>
</html>

