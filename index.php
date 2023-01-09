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
<body class="bg-black text-white">
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
                    <?php if(isset($_SESSION['id'])){ ?>
                    <a href="profil.php?id=<?php echo $_SESSION['id'] ?>" class="text-white">Mon Profil</a>
                    <?php }else{ ?>
                    <a href="login.php" class="text-white">Se connecter</a>
                    <?php } ?>
                </div>
                <div>
                    <?php if(isset($_SESSION['id'])){ ?>
                    <a href="deco.php?id=<?php echo $_SESSION['id'] ?>" class="text-white">Déconnexion</a>
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
            <form id="filters" method="POST" class="border-2 border-[#5F5F5F]">
                <select name="genre" id="genre" class="bg-[#393939] text-white">
            
                </select>
                <button type="submit" id="btn" class="text-yellow-200">Go</button>
            </form>
        </div>
    </header>
    <main class="bg-black w-4/5 m-auto flex flex-col justify-center">
        <hr class="h-px bg-[#5F5F5F] border-0">
        <form action="" method="POST" class="w-full bg-[#393939] flex flex-row gap-4">
            <div class="p-4 flex flex-row gap-5">
                <input type="text" name="search-users" id="search-users" placeholder="Rechercher des utilisateurs" class="p-1 pl-2 pr-6 bg-[#7C7C7C] text-white placeholder-white">
                <button type="submit" name="search-user" class="text-white">Chercher</button>
            </div>
            <div class="flex flex-row gap-5 h-[64px] p-5 border-l-2 border-[#5F5F5F]">
                <?php

                if (isset($_POST['search-users'])) {
                    $username = $_POST['search-users'];
                    $users = $connection->getUsers($username);
                    $i = 0;
                    foreach ($users as $user) {
                        if($i == 5){
                            break;
                        }
                        ?>
                        <a href="profil.php?id=<?php echo $user['id']?>" class="text-white"><?php echo $user['first_name'] . ' ' . $user['last_name']?></a>
                    <?php $i++; }
                }

                ?>
            </div>
        </form>

        <h2 id="h2Searched" class="font-bold bg-black text-white text-center text-xl pb-8 pt-8" style="display:none">Films par recherche</h2>
        <section id="movieSearched" class="text-white bg-black gap-5 flex flex-wrap pb-8 m-auto justify-center">

        </section>
        <hr class="h-px bg-[#5F5F5F] border-0">
        <h2 class="font-bold bg-black text-white text-center text-xl pb-8 pt-8">Films par catégorie</h2>
        <section class="flex flex-row gap-5 text-black font-bold justify-center mb-8">
            <div>
                <button class="tri bg-yellow-700 p-1" value="original_title.asc">Nom</button>
            </div>
            <div>
                <button class="tri bg-yellow-700 p-1" value="popularity.asc">Popularité</button>
            </div>
            <div>
                <button class="tri bg-yellow-700 p-1" value="vote_average.asc">Avis</button>
            </div>
        </section>
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
        <hr class="h-px bg-[#5F5F5F] border-0 mb-8">
        <h2 class="font-bold m-auto mb-5">Albums</h2>
        <?php

            if(isset($_GET['filmid'])){
                $connection = new Connection();
                $list = $connection->getAlbums();
                ?>
                <section class="flex flex-row gap-5 justify-center mb-8" id="albumsT"><?php
                foreach ($list as $album): ?>
                    <form method="POST" class="bg-yellow-700 text-black p-1 font-bold">
                        <input type="hidden" value="<?php echo $album['id']?>" name="album_id">
                        <button type="submit"><?php echo $album['album_name'] ?></button>
                    </form>
                <?php endforeach;
                ?>
                </section><?php

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
                }
            }

            if(isset($_POST['visioned'])){
                $film = $_POST['visioned'];
                $response =  $connection->addFilm($film, $_SESSION['visionned']);

                if($response){

                }

            }

            if(isset($_POST['liked'])){
                $film = $_POST['liked'];
                $response =  $connection->addFilm($film, $_SESSION['liked']);

                if($response){

                }

            }

            
        ?>
    </main>
</body>
</html>
