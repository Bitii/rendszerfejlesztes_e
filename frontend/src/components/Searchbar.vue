<script setup>
import axios from "axios";
import { ref, reactive } from "vue";
import { useRouter } from "vue-router";
import { useMovieStore } from '../../stores/movie'; //importáljuk a store-t

const TMDBapi = "https://api.themoviedb.org/3/search/movie" //api kulcs - omdbapi.com
const apiKey = "83e8713d6dfc87ac2ec4a2da58f338cd"; //api kulcs
const img = "https://image.tmdb.org/t/p/original"; //kép url
const searchBar = ref("");
const movies = reactive([]); //tömb, amiben a keresés eredményeit tároljuk (reactive, mert a tömb elemei változhatnak)
const router = useRouter();

const movieData = useMovieStore();

/* kereső fügvény */
const search = async () =>
{
    try
    {
        const response = await axios.get(TMDBapi, {
            params: {
                api_key: apiKey, //api kulcs
                query: searchBar.value, //kereső mező értéke, az api leíratában s: kulcs
                language: 'hu-HU',
            }
        });
        /*  console.log(response.data); */
        movies.splice(0, movies.length, ...response.data.results || []); //ha nincs találat, akkor üres tömb
        console.log(movies);
    } catch (err)
    {
        console.error(err);
    }
};

/* film részletek oldalra navigálás */
const goToMovie = (id) =>
{
    //a store-ban tároljuk a kiválasztott film adatait hogy ebből generáljuk le a detail oldalt
    movieData.movie = movies.find((movie) => movie.id === id);
    //navigálás a detail oldalra
    router.push({ name: 'MovieDetail', params: { id: id } });
    searchBar.value = '';
    movies.splice(0, movies.length);
};
</script>

<template>
    <!-- <div class="test" v-for="movie in movies" :key="movie.imdbID">{{ movie.imdbID }}</div> -->
    <input type="text" placeholder="Search..." v-model="searchBar" @input="search" />
    <!-- @input - ha input érkezik a kereső mezőben akkor lefut a keresés -->
    <button @click="search">Search</button>

    <!-- keresési találatok megjelenítése -->
    <div class="search-result" v-if="movies.length > 0"> <!-- ha van találat, akkor jelenítse meg -->
        <ul>
            <!-- v-for -> bejárja movies tömböt és kiíratjuk az elemeket -->
            <!-- kulcsnak átadtjuk a response-ból megkapott imdbID -t -->
            <li v-for="movie in movies" :key="movie.id" @click="goToMovie(movie.id)">
                <img :src="img + movie.poster_path" alt="The searched movie's picture">
                {{ movie.title }} ({{ movie.release_date }})
            </li>
        </ul>
    </div>
</template>

<style scoped>
.test {
    background-color: var(--yellow);
    width: 100px;
    height: 10px;
    color: black;
}

input {
    padding: 10px;
    font-size: 1rem;
    border-radius: 10px;
    border: none;
    min-width: 20rem;
}

input:focus {
    outline: 2px solid var(--yellow);
}

.search-result {
    position: absolute;
    margin-top: 1rem;
    background-color: var(--white);
    color: var(--black);
    padding: 1rem;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    max-height: 400px;
    overflow-y: auto;
}

li {
    display: flex;
    justify-content: left;
    align-items: center;
    margin: 10px 0px;
    padding-bottom: 10px;
    border-bottom: 1px solid var(--black);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

li img {
    width: auto;
    height: 100px;
    margin-right: 10px;
}

.search-result ul {
    list-style-type: none;
    padding: 0;
}
</style>
