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
</head>
<body>

<a href="my-invitations.php?id=<?php echo $_SESSION['id'] ?>">Mes invitations</a>



<form id="filters" method="POST">
    <select name="genre" id="genre">

    </select>
    <button type="submit" id="btn">Submit</button>
</form>

<form action="">
    <input type="text" id="search-bar">
</form>

<form action="" method="POST">
    <input type="text" name="search-users" id="search-users" placeholder="search users">
    <button type="submit" name="search-user">Chercher</button>
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


    if (isset($_POST['search-users'])) {
        $username = $_POST['search-users'];
        $users = $connection->getUsers($username);
        foreach ($users as $user) {?>
            <a href="profil.php?id=<?php echo $user['id']?>">Voir le profil</a>
        <?php }
    }



?>
</body>
</html>
