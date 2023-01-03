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
    <?php
        $connection = new Connection();
        $req = $connection->getMovies($_GET['id']);
            if($req){
                foreach ($req as $movie): ?>
                <div id="film">

                </div>
            <script>
                fetch('https://api.themoviedb.org/3/movie/<?php echo $movie['movie_id'] ?>?api_key=16eb18763928632ac96b6291fa839732&language=en-US')
                    .then((response) => response.json())
                    .then((data) => {
                        let infos = data
                        let h1 = document.createElement('h1')
                        h1.innerHTML = `${infos.title}`
                        document.getElementById('film').appendChild(h1)
                    })
            </script>
                <?php endforeach; }else{
                echo "Vous n'avez aucun film dans votre album";
            } ?>
</body>
</html>