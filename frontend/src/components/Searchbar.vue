<script setup>
import axios from "axios";
import { ref, reactive } from "vue";
import { useRouter } from "vue-router";

const OMDBapi = "https://www.omdbapi.com/?i=tt3896198&apikey=ac05d1d7"
const searchBar = ref("");
const movies = reactive([]);
const router = useRouter();

const search = () =>
{
    axios.get(OMDBapi, {
        params: {
            s: searchBar.value,
        }
    }).then(response =>
    {
        movies.splice(0, movies.length, ...response.data.Search || []);
        console.log(movies);
    }).catch((err) =>
        {
            console.log(err);
        });
}
const goToMovie = (imdbID) =>
{
    router.push({ name: 'MovieDetail', params: { id: imdbID } });
    searchBar.value = '';
    movies.splice(0, movies.length);
};
</script>

<template>
    <input type="text" placeholder="Search..." v-model="searchBar" />
    <button @click="search">Search</button>

    <div class="search-result" v-if="movies != ''">
        <ul>
            <li v-for="movie in movies" :key="movie.imdbID" @click="goToMovie(movie.imdbID)">
                    <img :src="movie.Poster" alt="">
                    {{ movie.Title }} ({{ movie.Year }})
            </li>
        </ul>
    </div>
</template>

<style scoped>

::-webkit-scrollbar {
    width: 5px;
}
::-webkit-scrollbar-thumb {
    background-color: var(--yellow);
    border-radius: 5px;
}
::-webkit-scrollbar-track {
    background-color: var(--grey);
}

input {
    padding: 7px;
    font-size: 1rem;
    border-radius: 5px;
    border: none;
    width: 15rem;
}

input:focus {
    outline: 2px solid var(--yellow);
}

.search-result {
    position: absolute;
    margin-top: 1rem;
    background-color: var(--white);
    color:var(--black);
    padding: 1rem;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    max-height: 400px;
    overflow-y: auto;
}

li{
    display: flex;
    justify-content: left;
    align-items: center;
    margin:10px 0px;
    padding-bottom: 10px;
    border-bottom: 1px solid var(--black);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
 li img{
    width: auto;
    height: 100px;
    margin-right: 10px;
 }

.search-result ul {
    list-style-type: none;
    padding: 0;
}
</style>
