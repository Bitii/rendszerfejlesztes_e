<script setup>
import { useMovieStore } from '../../stores/movie'; //importáljuk a store-t

const movieData = useMovieStore();
</script>

<template>
<div>
    <h1>Movie Detail</h1>
    <div>
        <img :src="movieData.movie.Poster" alt="">
        <h2>{{ movieData.movie.Title }}</h2>
        <p>{{ movieData.movie.Year }}</p>
        <p>{{ movieData.movie.Plot }}</p>
    </div>

</div>
</template>

<style scoped>

</style>
