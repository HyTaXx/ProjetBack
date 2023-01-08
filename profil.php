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
    <title>Document</title>
</head>
<body>
        <h1>Profil de <?php echo $user['first_name'] . ' ' . $user['last_name'] ?> </h1>
        <h1>Albums Publics :</h1>

        <?php foreach ($albums as $album){?>
            <h2> <?php echo $album['album_name']; ?> </h2>
        <?php } ?>

        <?php foreach ($likedalbums as $likedalbum){ ?>
            <h2> <?php echo $likedalbum['album_name']; ?></h2>
        <?php } ?>





</body>
</html>