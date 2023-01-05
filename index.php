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
    <title>Document</title>
</head>
<body>
<form id="filters" method="POST">
    <select name="genre" id="genre">

    </select>
    <button type="submit" id="btn">Submit</button>
</form>

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

</body>
</html>
