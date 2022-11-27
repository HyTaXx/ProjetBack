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

<form method="POST">
    <select name="genre" id="genre">
        <option value="Action" id="option1">Action</option>
        <option value="Adventure" id="option2">Adventure</option>
        <option value="Animation" id="option2">Animation</option>
        <option value="Comedy" id="option2">Comedy</option>
        <option value="Crime" id="option2">Crime</option>
        <option value="Documentary" id="option2">Documentary</option>
        <option value="Drama" id="option2">Drama</option>
        <option value="Family" id="option2">Family</option>
        <option value="Fantasy" id="option2">Fantasy</option>
        <option value="Horror" id="option2">Horror</option>
        <option value="Music" id="option2">Music</option>
        <option value="Mystery" id="option2">Mystery</option>
        <option value="Romance" id="option2">Romance</option>
        <option value="Science Fiction" id="option2">Science Fiction</option>
        <option value="Thriller" id="option2">Thriller</option>
        <option value="TV Movie" id="option2">TV Movie</option>
        <option value="War" id="option2">War</option>
        <option value="Western" id="option2">Western</option>
    </select>
    <button type="submit" id="btn">Submit</button>
</form>

<div id="infos"></div>
<script>

    let i = document.querySelector('#btn')
    let genre = document.querySelector('#genre')
    i.onclick = (e)=> {
        e.preventDefault()
        let selectedGenre = genre.value
        console.log(selectedGenre)
        for (let i = 2; i < 10; i++) {
            fetch('https://api.themoviedb.org/3/movie/' + i + '?api_key=16eb18763928632ac96b6291fa839732&language=en-US')
                .then((response) => response.json())
                .then((data) => {
                    let infos = data
                    if (infos.success != false) {
                        let test = infos.genres.length
                        for (let a = 0; a < test; a++) {
                            if (infos.genres[a].name == selectedGenre) {
                                console.log('caca')
                                let h1 = document.createElement('h1')
                                h1.innerHTML = `${infos.title}`
                                h1.id = i
                                document.getElementById('infos').appendChild(h1)
                            }
                        }

                    }
                })
        }
    }
</script>

</body>
</html>