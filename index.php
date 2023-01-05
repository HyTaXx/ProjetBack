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
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black">
    <header class="bg-[#393939]">
        <div class="flex flex-row h-16 p-4">
            <div class="basis-1/4 flex justify-center">
                <img src="img/logo_filmhub.png" alt="logo-filmhub">
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
        <div class="flex flex-row justify-center gap-5">
            <a href="index.php" class="text-white">Accueil</a>
            <form id="filters" method="POST">
                <select name="genre" id="genre">
            
                </select>
                <button type="submit" id="btn">Submit</button>
            </form>
            <a href="#" class="text-white">Albums</a>
            <a href="#" class="text-white">Profils</a>
        </div>
    </header>
    <main class="bg-white w-4/5 m-auto">
    <form id="filters" method="POST">
    <select name="genre" id="genre">

    </select>
    <button type="submit" id="btn">Submit</button>
</form>

<form action="">
    <input type="text" id="search-bar">
</form>

<section id="movieSearched">

</section>
<section id="list">

</section>
<span id="page-plus">Next Page</span>
<span id="page-minus">Prev Page</span>

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
