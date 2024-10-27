<script setup>
import axios from "axios";
import { ref, reactive } from "vue";
import { useRouter } from "vue-router";
import { useMovieStore } from '../../stores/movie'; //importáljuk a store-t

const OMDBapi = "https://www.omdbapi.com/?i=tt3896198&apikey=ac05d1d7" //api kulcs - omdbapi.com
const searchBar = ref("");
const movies = reactive([]); //tömb, amiben a keresés eredményeit tároljuk (reactive, mert a tömb elemei változhatnak)
const router = useRouter();

const movieData = useMovieStore();

/* kereső fügvény */
const search = async () => {
  try {
    const response = await axios.get(OMDBapi, {
      params: {
        s: searchBar.value, //kereső mező értéke, az api leíratában s: kulcs
      }
    });
    movies.splice(0, movies.length, ...response.data.Search || []); //ha nincs találat, akkor üres tömb
    console.log(movies);
  } catch (err) {
    console.error(err);
  }
};

/* film részletek oldalra navigálás */
const goToMovie = (imdbID) =>
{
    //a store-ban tároljuk a kiválasztott film adatait hogy ebből generáljuk le a detail oldalt
    movieData.movie = movies.find((movie) => movie.imdbID === imdbID);
    //navigálás a detail oldalra
    router.push({ name: 'MovieDetail', params: { id: imdbID } });
    searchBar.value = '';
    movies.splice(0, movies.length);
};
</script>

<template>
    <div class="test" v-for="movie in movies" :key="movie.imdbID">{{ movie.imdbID }}</div>
    <input type="text" placeholder="Search..." v-model="searchBar" @input="search"/> <!-- @input - ha input érkezik a kereső mezőben akkor lefut a keresés -->
    <button @click="search">Search</button>

    <!-- keresési találatok megjelenítése -->
    <div class="search-result" v-if="movies.length > 0"> <!-- ha van találat, akkor jelenítse meg -->
        <ul>
            <!-- v-for -> bejárja movies tömböt és kiíratjuk az elemeket -->
             <!-- kulcsnak átadtjuk a response-ból megkapott imdbID -t -->
            <li v-for="movie in movies" :key="movie.imdbID" @click="goToMovie(movie.imdbID)"> 
                    <img :src="movie.Poster" alt="">
                    {{ movie.Title }} ({{ movie.Year }})
            </li>
        </ul>
    </div>
</template>

<style scoped>
.test {
    background-color:var(--yellow);
    width: 100px;
    height: 10px;
    color: black;
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
