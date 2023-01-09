<?php

session_start();

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
<h1 class="center m-auto mb-8">LOGIN</h1>
<section class="container2">
    <form method="post" class="formcenter">
        <div class="contact-box">
            <div class="left3"></div>
            <div class="right flex flex-col gap-8">
                <input type="email" name="email" class="field p-1 text-black" placeholder="Email">
                <input type="password" name="password1" class="field p-1 text-black" placeholder="Password">
                <button type="submit" value="login" name="login" class="field w-[50%] m-auto bg-yellow-600 p-3 text-black" >Se Connecter</button>
            </div>
        </div>
    </form>
</section>
<div class="flex mt-8">
    <a href="register.php" class="m-auto">Vous n'avez pas de compte</a>
</div>
</section>


<?php
require_once 'classes/user.php';
require_once 'classes/connection.php';
require_once 'classes/album.php';

if($_POST){
    if(isset($_POST['login'])) {
        $connection = new Connection();
        $email = $_POST['email'];
        $user = $connection->login($email);

        if(md5($_POST['password1'] . 'SALT') === $user['password']){
            echo 'login';
            $_SESSION['email'] = $user['email'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['password'] = $user['password'];
            $_SESSION['id'] = $user['id'];
            $getliked = $connection->getAlbum('likes');
            $getwatched = $connection->getAlbum('visionnes');
            $_SESSION['liked'] = $getliked[0]['id'];
            $_SESSION['visionned'] = $getwatched[0]['id'];
            header('Location: index.php');
        }else {
            echo '<h2 style="color: red;" class="center"> Votre e-mail ou mot de passe est erroné ! </h2>';
        }
    }
}

?>


</body>
</html>