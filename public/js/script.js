'use strict'
let list = document.getElementById('list')
list.classList.add("flex")
list.classList.add("flex-wrap")
list.classList.add("justify-center")
let currentPage = 1
let genrePage = 1
let minCount = 0
let maxCount = 20
let btn = document.getElementById('btn')
let genre = document.getElementById('genre')
let selectedGenre = 'null'


window.onload = getFilters()

document.getElementById('filters').onsubmit = (e) => {
    e.preventDefault();
    list.innerHTML = ''
    if(genrePage>1){
        genrePage = 1
    }
    selectedGenre = genre.value
    console.log(selectedGenre)
    getFilm(0, 20)
}


btn.addEventListener('click', getFilm(minCount, maxCount))

// Show film
async function getFilm(min, max) {
    if (selectedGenre === 'null') {
        for (let i = min; i < max; i++) {
            await fetch('https://api.themoviedb.org/3/movie/' + i + '?api_key=051277f4f78b500821fed3e0e4d59bf4&language=en=US')
                .then(async result => await result.json())
                .then(data => {
                    let infos = data
                    if (infos.success !== false) {
                        showFilm(infos)
                    } else {
                        max += 1
                    }
                })
        }
    } else {
        for (let i = min; i < max; i++) {
            await fetch('https://api.themoviedb.org/3/discover/movie?api_key=051277f4f78b500821fed3e0e4d59bf4&language=en-US&sort_by=popularity.desc&include_adult=false&include_video=false&page=' + genrePage + '&with_genres=' + selectedGenre + '&with_watch_monetization_types=flatrate')
                .then(async result => await result.json())
                .then(data => {
                    let infos = data.results[i]
                    showFilm(infos)
                })
        }
    }
}

function showFilm(data) {
    let film = document.createElement('div')
    let stockbtn = document.createElement('div')
    stockbtn.classList.add("flex")
    stockbtn.classList.add("flex-row")
    stockbtn.classList.add("gap-5")
    stockbtn.classList.add("justify-center")
    film.id = data.id
    let img = document.createElement('img')
    img.src = 'https://image.tmdb.org/t/p/w500' + data.poster_path
    img.classList.add("w-[200px]")
    img.classList.add("h-[300px]")
    img.classList.add("m-auto")
    let h1 = document.createElement('h1')
    h1.innerHTML = data.title
    h1.classList.add("m-auto")
    h1.classList.add("font-bold")
    // let p = document.createElement('p')
    // p.innerHTML = data.overview
    let a = document.createElement('a')
    let iWatch = document.createElement('i')
    iWatch.classList.add("fa-solid")
    iWatch.classList.add("fa-eye")
    a.appendChild(iWatch)
    a.href = 'singlemovie.php?id=' + data.id


    let form = document.createElement('form')
    form.method = 'GET'

    let vision = document.createElement('form')
    vision.method = 'POST'
    let visioned = document.createElement('input')
    visioned.name = 'visioned'
    visioned.value = film.id
    visioned.type = 'hidden'
    let button2 = document.createElement('button')
    let iSeen = document.createElement("i")
    iSeen.classList.add("fa-solid")
    iSeen.classList.add("fa-user-check")
    button2.appendChild(iSeen)
    button2.type = 'submit'

    let like = document.createElement('form')
    like.method = 'POST'
    let liked = document.createElement('input')
    liked.name = 'liked'
    liked.value = film.id
    liked.type = 'hidden'
    let buttonx = document.createElement('button')
    let iLike = document.createElement("i")
    iLike.classList.add("fa-regular")
    iLike.classList.add("fa-thumbs-up")
    buttonx.appendChild(iLike)

    buttonx.type = 'submit'


    like.appendChild(liked)
    like.appendChild(buttonx)
    vision.appendChild(visioned)
    vision.appendChild(button2)
    

    let addtoalbum = document.createElement('input')
    addtoalbum.type = 'hidden'
    addtoalbum.name = 'filmid'
    addtoalbum.value = data.id
    let button = document.createElement('button')
    let iAdd = document.createElement("i")
    iAdd.classList.add("fa-solid")
    iAdd.classList.add("fa-circle-plus")
    button.appendChild(iAdd)
    button.type = 'submit'
    form.appendChild(addtoalbum)
    form.appendChild(button)
    film.appendChild(img)
    film.appendChild(h1)
    stockbtn.appendChild(like)
    stockbtn.appendChild(form)
    // film.appendChild(p)
    stockbtn.appendChild(a)
    stockbtn.appendChild(vision)
    film.appendChild(stockbtn)
    film.classList.add("flex")
    film.classList.add("flex-col")
    film.classList.add("w-[200px]")
    list.appendChild(film)
}

// Create option for each movie genre
let filters = document.getElementById('genre')

async function getFilters() {
    await fetch('https://api.themoviedb.org/3/genre/movie/list?api_key=051277f4f78b500821fed3e0e4d59bf4&language=en=US')
        .then(result => result.json())
        .then(data => {
            for (let i = 0; i < data['genres'].length; i++) {
                let option = document.createElement('option')
                option.innerHTML = data['genres'][i]['name']
                option.value = data['genres'][i]['id']

                filters.appendChild(option)
            }
        })
}


// Page change function
let pagePlus = document.getElementById('page-plus')
let pageMinus = document.getElementById('page-minus')

pagePlus.addEventListener('click', () => {
    if (selectedGenre === 'null') {
        currentPage += 1
        minCount = (currentPage - 1) * 20
        maxCount = currentPage * 20
        list.innerHTML = ''
        getFilm(minCount, maxCount)
    } else {
        genrePage += 1
        minCount = (genrePage - 1) * 20
        maxCount = genrePage * 20
        list.innerHTML = ''
        getFilm(0, 20)
    }
})

pageMinus.addEventListener('click', () => {
    if (currentPage > 0 && genrePage > 0) {
        if (selectedGenre === 'null') {
            currentPage -= 1
            minCount = (currentPage - 1) * 20
            maxCount = currentPage * 20
            list.innerHTML = ''
            getFilm(minCount, maxCount)
        } else {
            genrePage -= 1
            minCount = (genrePage - 1) * 20
            maxCount = genrePage * 20
            list.innerHTML = ''
            getFilm(0, 20)
        }
    }
})

