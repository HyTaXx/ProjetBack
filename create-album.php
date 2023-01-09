<?php
    session_start();
    require_once 'classes/connection.php';
    require_once 'classes/album.php';
    require_once 'classes/user.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
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
<body class="bg-black text-white">
    <section class="p-20">
    <h1 class="mb-8">Créer un album</h1>
    <form method="POST">
        <input type="text" name="album_name" placeholder="album name" class="text-black placeholder-black p-1">
        <select name="isprivate" class="text-black p-1">
            <option value="1" class="text-black">Private</option>
            <option value="0" class="text-black">Public</option>
        </select>
        <button type="submit" class="bg-yellow-700 p-1 text-black"><strong>Créer l'album</strong></button>
    </form>
    </section>
</body>

    <?php
        if(isset($_POST['album_name'])){
            $album = new Album(
                    $_POST['album_name'],
                    $_POST['isprivate'],
            );
            $connection = new Connection();
            $result = $connection->createAlbum($album);
                if($result){
                    echo 'Album created successfully';
                }else {
                    echo 'Something went wrong';
                }
        }
    ?>
</html>