<?php
session_start();
require_once 'classes/connection.php';
require_once 'classes/user.php';
require_once 'classes/album.php';
?>
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

    <?php
        $connection = new Connection();
        $req = $connection->getMovies($_GET['id']);
            if($req){
                foreach ($req as $movie): ?>
                <div id="film" class="flex flex-col gap-6 p-20">

                </div>
            <script>
                fetch('https://api.themoviedb.org/3/movie/<?php echo $movie['movie_id'] ?>?api_key=16eb18763928632ac96b6291fa839732&language=en-US')
                    .then((response) => response.json())
                    .then((data) => {
                        let infos = data
                        let h1 = document.createElement('h1')
                        h1.innerHTML = `${infos.title}`
                        document.getElementById('film').appendChild(h1)
                    })
            </script>
                <?php endforeach; }else{
                echo "Vous n'avez aucun film dans votre album";
            } ?>
</body>
</html>