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

<div id="affichage"></div>

<script>
    fetch('https://api.themoviedb.org/3/movie/<?php echo $_GET['id'] ?>?api_key=16eb18763928632ac96b6291fa839732&language=en-US')
        .then((response) => response.json())
        .then((data) => {
            let infos = data
            let h1 = document.createElement('h1')
            h1.innerHTML = `${infos.title}`
            document.getElementById('affichage').appendChild(h1)
        })
</script>


</body>
</html>