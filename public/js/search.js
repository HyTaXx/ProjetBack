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

            for (let i = 1; i < 3; i++) {
                console.log(response)
                let a = response.data.results[i]
                console.log(a);
                let newdiv = document.createElement("div")
                let h2 = document.createElement("h2")
                h2.innerHTML = a.title
                newdiv.appendChild(h2)
                getSection.appendChild(newdiv)

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