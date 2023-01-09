<?php
    session_start();
    require_once 'classes/connection.php';
    require_once 'classes/user.php';
    require_once 'classes/album.php';
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
<body class="bg-black text-white">
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
    <section class="m-auto flex flex-col w-[80%] pt-20">
    <h1 class="text-2xl font-bold">Mes Albums</h1>
    <div class="mt-8 mb-8">
        <a href="create-album.php" class="bg-yellow-700 p-1 text-black font-bold">Créer un album</a>
    </div>
    <?php
    $connection = new Connection();
    $req = $connection->getAlbums();

    
    if($req){
        foreach ($req as $album): ?>
        <h2 class="mt-8"><?php echo $album['album_name']?></h2>
        <img src="img/album.png" alt="album" class="w-[300px] h-[300px] mb-8">
        <div class="flex flex-row gap-5">
        <a href="viewalbum.php?id=<?php echo $album['id']?>" class="bg-yellow-700 p-2 text-black font-bold w-[150px] text-center">Voir mon album</a>
            <form method="POST" action="invite.php">
                <input type="hidden" name="album_id" value="<?php echo $album['id'] ?> ">
                <button type="submit" class="bg-yellow-700 p-2 text-black font-bold w-[150px]">Inviter un ami</button>
            </form>
        </div>
    <?php endforeach; } ?>

    <h1>Albums partagés</h1>

    <?php

    $sharedalbums = $connection->getAcceptedInvitations($_SESSION['id']);

    ?>


    </section>
</body>
</html>
