<script setup>
import { useMovieStore } from '../../stores/movie'; //importáljuk a store-t

const img = "https://image.tmdb.org/t/p/original";
const movieData = useMovieStore();

</script>

<template>
    <div class="movie">
        <div class="movie-poster">
            <img :src="img + movieData.movie.poster_path" alt="The searched movie's picture">
            <p>Release date: {{ movieData.movie.release_date }}</p>
        </div>
        <div class="movie-data">
            <h1>{{ movieData.movie.title }}</h1>
            <button id="heart">❤</button>
            <button id="bookmark">🔖</button>
            <button id="seen">👁</button>
            <p>{{ movieData.movie.overview }}</p>
            <br><br>
            <p>Rating: {{ movieData.movie.vote_average }}</p><br><br>
            <p>Your rating: </p>
        </div>
    </div>
    <div class="movie2">
        <div class="people">
            <p>Director: ggggggg gggggggggggggggggggggg gggggggggggllll lllllllllllgggggg ggggggggggggggggggg</p>
            <p>Writer: </p> 
            <p>Stars: </p>
        </div>
        <div class="category">
            <p>Categories:<br>kkkkkkk kkkkkkk kkkkkkkk kkkkkkkk kkkkkkkk kkkkkk kkkkkk</p>
        </div>
    </div>
</template>

<style scoped>
.wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}

img {
    width: 250px;
    height: auto;
}

.movie {
    display: inline-flex;
    margin: 10px 35px 20px 35px;
    position: relative;
}

.movie-poster, .movie-data {
    position: relative;
    padding-left: 30px;
    height: auto;
}

.movie-data {
    text-align: left;
}

.movie-data button {
    position: absolute;
    text-align: center;
    top: 5px;
    right: 200px;
    background: none;
    cursor: pointer;
    font-size: 30px;
    margin: 0px 10px;
    color: var(--gray);
    z-index: 1;
    border: 0;
}

#seen {
    top: 0;
    font-size: 40px;
    right: 110px;
}
#bookmark {
    right: 150px;
}

h1 {
    margin-bottom: 10px;
}

.movie2 {
    display: inline-flex;
    position: relative;
    text-align: left;
    overflow: hidden;
    word-wrap: break-word;
    width: 100%;
}
.movie2 p {
    margin-bottom: 15px;
}
.people {
    text-align: left;
    display: block;
    position: relative;
    padding-left: 65px;
    height: auto;
    max-width: 55%;
    left: 0%;
}

.category {
    position: absolute;
    left: 55%;
    padding: 0 30px;
    height: auto;
}
</style>
