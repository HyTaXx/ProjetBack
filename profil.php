<?php
session_start();
require_once 'classes/connection.php';
require_once 'classes/user.php';
require_once 'classes/album.php';

$connection = new Connection();
$user = $connection->getUserProfile($_GET['id']);
$albums = $connection->getPublicAlbums($_GET['id']);
$likedalbums = $connection->getLikedAlbums($_GET['id']);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body class="bg-black text-white flex flex-col justify-center">
<header class="bg-[#393939]">
        <div class="flex flex-row h-16 p-4 place-content-around">
            <div class="basis-1/4 flex justify-center">
                <a href="index.php">
                <img src="img/logo_filmhub.png" alt="logo-filmhub">
                </a>
            </div>
            <div class="flex flex-row basis-1/4 gap-5">
                <div class="flex">
                    <?php if(isset($_SESSION['id'])){ ?>
                    <a href="deco.php?id=<?php echo $_SESSION['id'] ?>" class="text-white m-auto">Déconnexion</a>
                    <?php }else{ ?>
                    <a href="register.php" class="text-white">Inscrivez-vous !</a>
                    <?php } ?>

                </div>
            </div> 
        </div>
        <hr class="h-px bg-[#5F5F5F] border-0">
        <div class="flex flex-row justify-center gap-5 p-2">
            <a href="index.php" class="text-white">Accueil</a>
            <?php if(isset($_SESSION["id"])){
                $id = $_SESSION["id"];
                echo "<a href='my-albums.php?id=$id' class='text-white'>Album</a>";
                } else {
                    echo "<a href='login.php' class='text-white'>Album</a>";
                    }
            ?>

            <?php if(isset($_SESSION["id"])){
                $id = $_SESSION["id"];
                echo "<a href='profil.php?id=$id' class='text-white'>Profil</a>";
                } else {
                    echo "<a href='login.php' class='text-white'>Profil</a>";
                    }
            ?>
        </div>
    </header>
    <section class="w-[80%] m-auto pt-20">
        <h1 class="text-2xl pb-4">Profil de <strong><?php echo $user['first_name'] . ' ' . $user['last_name'] ?></strong> </h1>
            <h1>Albums Publics :</h1>

            <?php foreach ($albums as $album){?>
                <h2> <?php echo $album['album_name']; ?> </h2>
            <?php } ?>

            <?php foreach ($likedalbums as $likedalbum){ ?>
                <h2> <?php echo $likedalbum['album_name']; ?></h2>
            <?php } ?>

    </section>

        <?php

        $sharedalbums = $connection->getAcceptedInvitations($_GET['id']);
        $connection = new Connection();

        if($sharedalbums){
            foreach ($sharedalbums as $sharedalbum){
                $getalbum = $connection->getSharedAlbum();
                foreach ($getalbum as $getsinglealbum){
                    echo $getsinglealbum['album_name'];
                }
            }
        }

        ?>
</body>
</html>