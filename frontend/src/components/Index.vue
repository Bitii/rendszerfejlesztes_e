<script setup>
import axios from "axios";
import { reactive } from "vue";
import { useRouter } from "vue-router";
import { useMovieStore } from "../../stores/movie";

const TMDBapi = "https://api.themoviedb.org/3/movie/popular";
const apiKey = "83e8713d6dfc87ac2ec4a2da58f338cd";
const img = "https://image.tmdb.org/t/p/original";

const moviesTop = reactive([]);
const moviesFanFavorites = reactive([]);
const moviesPopular = reactive([]);

const router = useRouter();
const movieData = useMovieStore();

const fetchMovies = async () => {
  try {
    const response = await axios.get(TMDBapi, {
      params: {
        api_key: apiKey,
        language: "hu-HU",
      },
    });

    const results = response.data.results || [];
    moviesTop.splice(0, 10, ...results.slice(0, 10));
    moviesFanFavorites.splice(0, 6, ...results.slice(10, 16));
    moviesPopular.splice(0, 6, ...results.slice(16, 22));
  } catch (err) {
    console.error("Failed to fetch movies:", err);
  }
};

const goToMovie = (id) => {
  const selectedMovie = [...moviesTop, ...moviesFanFavorites, ...moviesPopular].find(
    (movie) => movie.id === id
  );
  if (selectedMovie) {
    movieData.movie = selectedMovie;
    router.push({ name: "MovieDetail", params: { id } });
  }
};

fetchMovies();
</script>

<template>
  <div id="movies-app">
    <div class="movies">
      <p class="slogan">Movies A to Z</p>
    </div>

    <h2>Top 10 This Week</h2>
    <div class="panels">
      <div
        v-for="movie in moviesTop"
        :key="movie.id"
        class="slide"
        @click="goToMovie(movie.id)"
      >
        <img :src="img + movie.poster_path" alt="movie poster" />
        <p>{{ movie.title }}</p>
      </div>
    </div>

    <h2>Fan Favorites</h2>
    <div class="panels">
      <div
        v-for="movie in moviesFanFavorites"
        :key="movie.id"
        class="slide"
        @click="goToMovie(movie.id)"
      >
        <img :src="img + movie.poster_path" alt="movie poster" />
        <p>{{ movie.title }}</p>
      </div>
    </div>

    <h2>Popular Interests</h2>
    <div class="panels">
      <div
        v-for="movie in moviesPopular"
        :key="movie.id"
        class="slide"
        @click="goToMovie(movie.id)"
      >
        <img :src="img + movie.poster_path" alt="movie poster" />
        <p>{{ movie.title }}</p>
      </div>
    </div>
  </div>
</template>

<style scoped>
.movies {
  background: linear-gradient(to top, rgba(0, 0, 0, 0.5) 0%, rgba(0, 0, 0, 0.8) 100%);
  height: 250px;
  margin-bottom: 20px;
  overflow: hidden;
  display: flex;
  justify-content: center;
  align-items: center;
}

.slogan {
  color: #00acee;
  font-size: 60px;
  font-weight: bold;
  text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
  letter-spacing: 5px;
}

h2 {
  margin: 20px;
  color: #00acee;
  font-size: 24px;
  border-bottom: 2px solid #FFD700;
  padding-bottom: 5px;
}

.panels {
  display: grid;
  gap: 15px;
  grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
  padding: 10px;
  margin: 0 20px;
}

.slide {
  text-align: center;
  background-color: #333;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
  overflow: hidden;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  cursor: pointer;
}

.slide:hover {
  transform: scale(1.05);
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
}

.panels img {
  width: 100%;
  height: auto;
  display: block;
  border-bottom: 2px solid #00acee;
}

.slide p {
  margin: 10px 0;
  font-size: 16px;
  font-weight: bold;
  color: white;
}
</style>
