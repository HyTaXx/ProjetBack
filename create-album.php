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
</head>
<body>
    <h1>Créer un album</h1>
    <form method="POST">
        <input type="text" name="album_name" placeholder="album name">
        <select name="isprivate">
            <option value="1">Private</option>
            <option value="0">Public</option>
        </select>
        <button type="submit">Créer l'album</button>
    </form>
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