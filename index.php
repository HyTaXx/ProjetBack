<?php
    session_start();
    require_once 'classes/album.php';
    require_once 'classes/connection.php';
    $connection = new Connection();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="./public/js/script.js" defer></script>
    <script src="./public/js/search.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.2.2/axios.min.js" integrity="sha512-QTnb9BQkG4fBYIt9JGvYmxPpd6TBeKp6lsUrtiVQsrJ9sb33Bn9s0wMQO9qVBFbPX3xHRAsBHvXlcsrnJjExjg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>FilmHub - Accueil</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/18ebf66202.js" crossorigin="anonymous"></script>
</head>
<body class="bg-black">
    <header class="bg-[#393939]">
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
    <main class="bg-black w-4/5 m-auto flex flex-col justify-center">
        <h2 id="h2Searched" class="font-bold bg-black text-white text-center text-xl pb-8 pt-8" style="display:none">Films par recherche</h2>
        <section id="movieSearched" class="text-white bg-black gap-5 flex flex-wrap pb-8 m-auto justify-center">

        </section>
        <hr class="h-px bg-[#5F5F5F] border-0">
        <h2 class="font-bold bg-black text-white text-center text-xl pb-8 pt-8">Films par catégorie</h2>
        <section id="list" class="text-white bg-black gap-5">

        </section>
        <div class="m-auto flex flex-row gap-5 pt-8 pb-8">
            <span class="text-white">
                <button id="page-minus" class="w-[90px] h-[60px] bg-yellow-600"><i class="fa-solid fa-chevron-left"></i></button>
            </span>
            <span class="text-white">
                <button id="page-plus" class="w-[90px] h-[60px] bg-yellow-600"><i class="fa-solid fa-chevron-right"></i></button>
            </span>
        </div>

        <?php

            if(isset($_GET['filmid'])){
                $connection = new Connection();
                $list = $connection->getAlbums();

                foreach ($list as $album): ?>
                    <form method="POST">
                        <input type="hidden" value="<?php echo $album['id']?>" name="album_id">
                        <button type="submit"><?php echo $album['album_name'] ?></button>
                    </form>
                <?php endforeach;

            }

            if(isset($_POST['album_id'])){
                if(isset($_GET['filmid'])){
                    $film = $_GET['filmid'];
                }
                $album = $_POST['album_id'];
                $connection = new Connection();
                $response = $connection->addFilm($film, $album);

                if($response){
                    echo 'Film ajouté à lalmbum';
                }else{
                    echo 'Nope';
                }
            }

            if(isset($_POST['visioned'])){
                $film = $_POST['visioned'];
                $response =  $connection->addFilm($film, $_SESSION['visionned']);

                if($response){
                    echo 'Yo man, ton film est add';
                }

            }

            if(isset($_POST['liked'])){
                $film = $_POST['liked'];
                $response =  $connection->addFilm($film, $_SESSION['liked']);

                if($response){
                    echo 'Yo man, ton film est add';
                }

            }
        ?>
    </main>
</body>
</html>
