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

<h1 class="center">REGISTER OR LOGIN</h1>
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

if($_POST){
    if(isset($_POST['register'])) {
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
                echo 'You have been registered';
            } else {
                echo 'Internal error😔 ';
            }
        } else {
            echo 'Form has an error 😔';
        }
    }else{
        $connection = new Connection();
        $email = $_POST['email'];
        $user = $connection->login($email);

        if(md5($_POST['password1'] . 'SALT') === $user['password']){
            echo 'login';
            $_SESSION['email'] = $user['email'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['password'] = $user['password'];
            $_SESSION['admin'] = $user['admin'];
            $_SESSION['id'] = $user['id'];
            print_r($user);
            if($_SESSION['admin'] == 0){
                    echo 'Vous êtes connectés en utilisateur';
                }else{
                    echo 'Vous êtes connectés en admin';
                }
        }else {
            echo '<h2 style="color: red;" class="center"> Votre e-mail ou mot de passe est erroné ! </h2>';
        }
    }
}

?>


</body>
</html>
