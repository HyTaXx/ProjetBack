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
<div id="infos"></div>
    <script>
        for (let i = 2; i < 10; i++) {
            fetch('https://api.themoviedb.org/3/movie/' +i+ '?api_key=16eb18763928632ac96b6291fa839732&language=en-US')
                    .then((response) => response.json())
                    .then((data) => {
                        let infos = data
                        if(`$infos.success` != false){
                            let h1 = document.createElement('h1')
                            h1.innerHTML = `${infos.title}`
                            document.getElementById('infos').appendChild(h1)
                        }else{
                            console.log('caca')
                        }
            })
        }


    </script>
</body>
</html>