let searchbar = document.getElementById("search-bar")


searchbar.addEventListener("keyup", (event) => {
    result = document.getElementById("search-bar").value
    getValue(result)
  });



function getValue(result){
    // Requêter un utilisateur avec un ID donné.

    getSection = document.getElementById("movieSearched");
    // Requêter un utilisateur avec un ID donné.
    axios.get("https://api.themoviedb.org/3/search/movie?api_key=16eb18763928632ac96b6291fa839732&language=en-US&query="+result)
        .then(function (response) {
            while (getSection.firstChild) {
                getSection.removeChild(getSection.firstChild);
            }
            // en cas de réussite de la requête
            let h2title = document.getElementById("h2Searched")
            h2title.style.display = "block"
            for (let i = 0; i < 6; i++) {
                let a = response.data.results[i]
                displayMovieSearched(a)
            }
        })
        .catch(function (error) {
            // en cas d’échec de la requête
            console.log(error);
        })
        .then(function () {
            // dans tous les cas
        });
}

function displayMovieSearched(a){
                let stockbtn = document.createElement('div')
                stockbtn.classList.add("flex")
                stockbtn.classList.add("flex-row")
                stockbtn.classList.add("gap-5")
                stockbtn.classList.add("justify-center")                
                console.log(a);
                let newdiv = document.createElement("div")
                newdiv.classList.add("flex")
                newdiv.classList.add("flex-col")
                newdiv.classList.add("w-[200px]")
                let h2 = document.createElement("h2")
                h2.innerHTML = a.title
                let img = document.createElement('img')
                img.src = 'https://image.tmdb.org/t/p/w500' + a.poster_path
                img.classList.add("w-[200px]")
                img.classList.add("h-[300px]")
                img.classList.add("m-auto")
                newdiv.appendChild(img)
                newdiv.appendChild(h2)
                newdiv.appendChild(stockbtn)

                getSection.appendChild(newdiv)
}