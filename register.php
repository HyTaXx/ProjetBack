<?php

session_start();
require_once 'classes/connection.php';
require_once 'classes/user.php';
require_once 'classes/album.php';

if($_SESSION['id'] != null){
    header('Location: index.php');
}

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

<section class="container2">

    <form method="post">
        <div class="contact-box">
            <div class="left"></div>
            <div class="right">
                <input type="email" name="email" class="field" placeholder="Email">
                <input type="password" name="password1" class="field" placeholder="Password">
                <input type="password" name="password2" class="field" placeholder="Retype password">
                <input type="text" name="first_name" class="field" placeholder="Firstname">
                <input type="text" name="last_name" class="field" placeholder="Lastname">
                <button type="submit" value="register" class="field" name="register">Register</button>
            </div>
    </form>
    </div>
</section

    <?php

        if (isset($_POST['register'])) {
            $user = new User(
                $_POST['email'],
                $_POST['password1'],
                $_POST['password2'],
                $_POST['first_name'],
                $_POST['last_name']
            );

            if ($user->verify()) {
                $connection = new Connection();
                $result = $connection->insert($user);
                if ($result) {
                    $newUser = $connection->getNewUserId($_POST['email']);
                    var_dump($newUser);
                    $_SESSION['id'] = $newUser['id'];
                    $visionned = new Album('visionnes', 0);
                    $result2 = $connection->createAlbum($visionned);
                    $liked = new Album('likes', 0);
                    $result3 = $connection->createAlbum($liked);
                    $getliked = $connection->getAlbum('likes');
                    $getwatched = $connection->getAlbum('visionnes');

                    echo 'You have been registered';
                } else {
                    echo 'Internal error😔 ';
                }
            } else {
                echo 'Form has an error 😔';
            }
        }
?>


</body>
</html>