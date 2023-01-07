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
                let balisea = document.createElement('a')

                let iWatch = document.createElement('i')
                iWatch.classList.add("fa-solid")
                iWatch.classList.add("fa-eye")
                balisea.appendChild(iWatch)
                balisea.href = 'singlemovie.php?id=' + a.id

                
                let iSeen = document.createElement("i")
                iSeen.classList.add("fa-solid")
                iSeen.classList.add("fa-user-check")
                let button2 = document.createElement('button')
                button2.appendChild(iSeen)
                button2.type = 'submit'

                let like = document.createElement('form')
                let iLike = document.createElement("i")
                like.method = 'POST'
                let liked = document.createElement('input')
                liked.name = 'liked'
                liked.value = a.id
                liked.type = 'hidden'
                let buttonx = document.createElement('button')
                iLike.classList.add("fa-regular")
                iLike.classList.add("fa-thumbs-up")
                buttonx.appendChild(iLike)
                buttonx.type = 'submit'
                like.appendChild(liked)
                like.appendChild(buttonx)
                
                let form = document.createElement('form')
                form.method = 'GET'
                let addtoalbum = document.createElement('input')
                addtoalbum.type = 'hidden'
                addtoalbum.name = 'filmid'
                addtoalbum.value = a.id
                let button = document.createElement('button')
                let iAdd = document.createElement("i")
                iAdd.classList.add("fa-solid")
                iAdd.classList.add("fa-circle-plus")
                button.appendChild(iAdd)
                button.type = 'submit'
                form.appendChild(addtoalbum)
                form.appendChild(button)

                let stockbtn = document.createElement('div')
                stockbtn.appendChild(like)
                stockbtn.appendChild(form)
                stockbtn.appendChild(balisea)
                stockbtn.appendChild(button2)
                stockbtn.classList.add("flex")
                stockbtn.classList.add("flex-row")
                stockbtn.classList.add("gap-5")
                stockbtn.classList.add("justify-center")                
                let newdiv = document.createElement("div")
                newdiv.classList.add("flex")
                newdiv.classList.add("flex-col")
                newdiv.classList.add("w-[200px]")
                let h2 = document.createElement("h2")
                h2.classList.add("font-bold")
                h2.innerHTML = a.title
                let img = document.createElement('img')
                if(a.poster_path!='null'){
                    img.src = 'https://image.tmdb.org/t/p/w500' + a.poster_path
                } else {
                    img.src = "img/unknown.jpg"
                }
                img.classList.add("w-[200px]")
                img.classList.add("h-[300px]")
                img.classList.add("m-auto")
                newdiv.appendChild(img)
                newdiv.appendChild(h2)
                newdiv.appendChild(stockbtn)

                getSection.appendChild(newdiv)
}