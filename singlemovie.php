<?php

session_start();
require_once 'classes/user.php';
require_once 'classes/connection.php';
require_once 'classes/album.php';

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Film</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/18ebf66202.js" crossorigin="anonymous"></script>
</head>
<body class="bg-black flex flex-col">
<header class="bg-[#393939] mb-20">
        <div class="flex flex-row h-16 p-4">
            <div class="basis-1/4 flex justify-center">
                <a href="index.php">
                <img src="img/logo_filmhub.png" alt="logo-filmhub">
                </a>
            </div>
            <form action="" class="basis-1/2 flex justify-center">
                <div class="flex flex-row w-5/6">
                    <div class="flex p-2 bg-[#7C7C7C]">
                        <img src="img/search.png" alt="logo-search" class="m-auto">
                    </div>
                    <input type="text" id="search-bar" class="w-full h-full bg-[#7C7C7C] p-3 text-white placeholder-white" placeholder="Rechercher sur Filmhub">
                </div>
            </form>
            <div class="flex flex-row basis-1/4 gap-5">
                <div>
                    <a href="login.php" class="text-white">Se connecter</a>
                </div>
                <div>
                    <a href="register.php" class="text-white">Inscrivez-vous !</a>
                </div>
            </div> 
        </div>
        <hr class="h-px bg-[#5F5F5F] border-0">
        <div class="flex flex-row justify-center gap-5 p-2">
            <a href="index.php" class="text-white">Accueil</a>
            <a href="#" class="text-white">Albums</a>
            <a href="#" class="text-white">Profils</a>
            <form id="filters" method="POST" class="border-2 border-[#5F5F5F]">
                <select name="genre" id="genre" class="bg-[#393939] text-white">
            
                </select>
                <button type="submit" id="btn" class="text-yellow-200">Go</button>
            </form>
        </div>
    </header>
    <main class="flex md:flex-row gap-20 flex-col justify-center">
        <section class="w-full max-w-[450px] flex flex-col justify-center m-auto md:m-0"><div id="affichage" class="flex flex-col justify-center"></div></section>
        <section>
            <div id="affichage2" class="flex flex-col"></div>
            <h2 class="text-white font-bold mt-20">Cast</h2>
            <div id="affichage-acteurs" class="flex flex-row gap-8 mt-8">
            </div>
        </section>
    </main>

    <?php
        if($_GET['id'] == 419430 ){ ?>
            <a target="_blank" href="https://www.youtube.com/watch?v=ikWblkVZsPY&ab_channel=ismaloo12" class="text-white">BANDE D'ANNONCE</a>
        <?php } ?>



    <script>
        fetch('https://api.themoviedb.org/3/movie/<?php echo $_GET['id'] ?>?api_key=16eb18763928632ac96b6291fa839732&language=en-US')
            .then((response) => response.json())
            .then((data) => { 
                let infos = data
                let h1 = document.createElement('h1')
                h1.classList.add("text-white")
                h1.classList.add("font-bold")
                h1.classList.add("text-center")
                

                let img = document.createElement('img')
                img.classList.add("w-[300px]")
                img.classList.add("m-auto")
                img.classList.add("mb-8")
                img.src = 'https://image.tmdb.org/t/p/w500' + infos.poster_path

                h1.innerHTML = `${infos.title}`
                document.title="FilmHub - "+h1.innerHTML
                let stockage = document.getElementById('affichage')
                let stockage2 = document.getElementById('affichage2')
                stockage.appendChild(img)
                stockage.appendChild(h1)
                let h2 = document.createElement('h2')
                h2.innerHTML = `${infos.title}`
                h2.classList.add("text-white")
                h2.classList.add("font-bold")
                h2.classList.add("mb-8")

                let description = document.createElement("p")
                description.innerHTML = infos.overview
                description.classList.add("text-white")
                description.classList.add("w-[70%]")
                h2.classList.add("text-xl")
                stockage2.appendChild(h2)
                stockage2.appendChild(description)
                console.log(infos)
                
            })

            fetch('https://api.themoviedb.org/3/movie/<?php echo $_GET['id'] ?>/credits?api_key=16eb18763928632ac96b6291fa839732&language=en-US')
            .then((response) => response.json())
            .then((data) => { 
                let actors = data.cast
                for (let i = 0; i < 6; i++) {
                    if(actors[i].profile_path!=null){
                        let stockageActeurs = document.getElementById("affichage-acteurs")
                    let newdiv = document.createElement("div")
                    let img = document.createElement("img")
                    img.classList.add("w-[100px]")
                    console.log(actors[i].profile_path)
                    img.src="https://image.tmdb.org/t/p/original"+actors[i].profile_path
                    newdiv.classList.add("flex")
                    newdiv.classList.add("flex-col")
                    newdiv.appendChild(img)
                    stockageActeurs.appendChild(newdiv)
                    }
            }
            })
    </script>
</body>
</html>