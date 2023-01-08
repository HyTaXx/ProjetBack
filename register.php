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
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<header class="bg-[#393939]">
    <div class="flex flex-row h-16 p-4 justify-center">
        <div class="basis-1/4 flex justify-center">
            <a href="index.php">
            <img src="img/logo_filmhub.png" alt="logo-filmhub">
            </a>
        </div>
    </div>
    <hr class="h-px bg-[#5F5F5F] border-0">
    <div class="flex flex-row justify-center gap-5 p-2">
    </div>
</header>
<body class="bg-black text-white">

<section class="bg-[#393939] mt-20 w-[500px] p-8 flex flex-col justify-center m-auto">
<h1 class="center m-auto mb-8">REGISTER</h1>
<section class="container2">

    <form method="post">
        <div class="contact-box">
            <div class="left"></div>
            <div class="right flex flex-col gap-8">
                <input type="email" name="email" class="field p-1" placeholder="Email">
                <input type="password" name="password1" class="field p-1 text-black" placeholder="Password">
                <input type="password" name="password2" class="field p-1 text-black" placeholder="Retype password">
                <input type="text" name="first_name" class="field p-1" placeholder="Firstname">
                <input type="text" name="last_name" class="field p-1" placeholder="Lastname">
                <button type="submit" value="register" class="field field w-[50%] m-auto bg-yellow-600 p-3 text-black mb-8" name="register">Register</button>
            </div>
    </form>
    </div>
    <div class="flex">
        <a href="login.php" class="m-auto">Vous avez deja un compte</a>
    </div>
</section>
</section>

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
                    header('Location: login.php');
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