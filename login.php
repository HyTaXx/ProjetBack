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
    <title>Document</title>
</head>
<body>

<h1 class="center">LOGIN</h1>


<section class="container2">
    <form method="post" class="formcenter">
        <div class="contact-box">
            <div class="left3"></div>
            <div class="right">
                <input type="email" name="email" class="field" placeholder="Email">
                <input type="password" name="password1" class="field" placeholder="Password">
                <button type="submit" value="login" name="login" class="field" >Log In</button>
            </div>
    </form>
            </div>
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
        }else {
            echo '<h2 style="color: red;" class="center"> Votre e-mail ou mot de passe est erroné ! </h2>';
        }
    }
}

?>


</body>
</html>
