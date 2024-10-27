<script setup>
import { useMovieStore } from '../../stores/movie'; //importáljuk a store-t

const img = "https://image.tmdb.org/t/p/original";
const movieData = useMovieStore();

</script>

<template>
    <h1>{{ movieData.movie.title }}</h1>
    <p>{{ movieData.movie.overview }}</p>
    <p>Rating: {{ movieData.movie.vote_average }}</p>
    <p>Release date: {{ movieData.movie.release_date }}</p>
    <img :src="img + movieData.movie.poster_path" alt="The searched movie's picture">
</template>

<style scoped>
.wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}

img {
    width: 200px;
    height: auto;
    margin-bottom: 1rem;
}
</style>
