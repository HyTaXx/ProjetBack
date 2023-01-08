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
    <title>Document</title>
</head>
<body>
    <h1>Mes Albums</h1>
    <?php
    $connection = new Connection();
    $req = $connection->getAlbums();


    if($req){
        foreach ($req as $album): ?>
        <h2><?php echo $album['album_name']?></h2>
            <a href="viewalbum.php?id=<?php echo $album['id']?>">Voir mon album</a>
            <form method="POST" action="invite.php">
                <input type="hidden" name="album_id" value="<?php echo $album['id'] ?> ">
                <button type="submit">Inviter un ami</button>
            </form>
    <?php endforeach; } ?>

    <h1>Albums partagés</h1>

    <?php

    $sharedalbums = $connection->getAcceptedInvitations($_SESSION['id']);

    ?>


</body>
</html>