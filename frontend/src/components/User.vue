<script setup>
import { ref, onMounted } from "vue";
import { useUserStore } from "../../stores/user";
import placeholderImage from "@/assets/placeholder.jpg";
import axios from "axios";

const userStore = useUserStore();
const userId = userStore.user?.id;
const username = ref(userStore.user?.nev || "Default Username");
const email = ref(userStore.user?.email || "example@example.com");
const registrationDate = ref(userStore.user?.regisztracios_datum || "N/A");

const favorites = ref([]);
const seenMovies = ref([]);
const watchlist = ref([]);

const TMDB_API_BASE = "https://api.themoviedb.org/3";
const TMDB_API_KEY = "83e8713d6dfc87ac2ec4a2da58f338cd";
const IMAGE_BASE_URL = "https://image.tmdb.org/t/p/w500";

const fetchMovieDetails = async (movieId) => {
  try {
    const response = await axios.get(
      `${TMDB_API_BASE}/movie/${movieId}?api_key=${TMDB_API_KEY}`
    );
    return response.data;
  } catch (error) {
    console.error("Error fetching movie details:", error);
    return null;
  }
};

const loadUserMovies = async () => {
  if (!userId) {
    console.error("User ID not found");
    return;
  }

  try {
    const response = await axios.get(
      `http://localhost:8000/api/movie-info/${userId}`
    );
    const movies = response.data.movies || [];

    for (const movie of movies) {
      const details = await fetchMovieDetails(movie.movie_id);
      movie.title = details?.title || "Unknown Title";
      movie.image = details?.poster_path
        ? `${IMAGE_BASE_URL}${details.poster_path}`
        : placeholderImage;
    }

    favorites.value = movies.filter((movie) => movie.favorite === 1);
    seenMovies.value = movies.filter((movie) => movie.seen === 1);
    watchlist.value = movies.filter((movie) => movie.bookmark === 1);
  } catch (error) {
    console.error("Error loading user movies:", error);
    favorites.value = [];
    seenMovies.value = [];
    watchlist.value = [];
  }
};

onMounted(() => {
  loadUserMovies();
});

const isFavouritesOpen = ref(false);
const isSeenOpen = ref(false);
const isWatchlistOpen = ref(false);

const toggleFavourites = () => {
  isFavouritesOpen.value = !isFavouritesOpen.value;
  if (isFavouritesOpen.value) {
    isSeenOpen.value = false;
    isWatchlistOpen.value = false;
  }
};

const toggleSeen = () => {
  isSeenOpen.value = !isSeenOpen.value;
  if (isSeenOpen.value) {
    isFavouritesOpen.value = false;
    isWatchlistOpen.value = false;
  }
};

const toggleWatchlist = () => {
  isWatchlistOpen.value = !isWatchlistOpen.value;
  if (isWatchlistOpen.value) {
    isFavouritesOpen.value = false;
    isSeenOpen.value = false;
  }
};
</script>

<template>
  <div id="user-profile">
    <!-- User Header -->
    <header>
      <div class="profile-pic">
        <img :src="placeholderImage" alt="Profile Picture" class="profile-img" />
        <p>Registration Date: {{ registrationDate }}</p>
      </div>
      <div class="profile-info">
        <p>Username: {{ username }}</p>
        <p>Email: {{ email }}</p>
      </div>
    </header>

    <!-- Favorites -->
    <section>
      <h3 @click="toggleFavourites" :style="{ color: isFavouritesOpen ? '#FFD700' : '' }">
        Favorites <span>{{ isFavouritesOpen ? "▼" : "▶" }}</span>
      </h3>
      <div v-if="isFavouritesOpen" class="section-content">
        <div v-if="favorites.length > 0" class="cards">
          <div v-for="(movie, index) in favorites" :key="'favourites-' + index" class="card">
            <img :src="movie.image || placeholderImage" alt="Movie Image" class="card-img" />
            <p>{{ movie.title }}</p>
          </div>
        </div>
        <div v-else>No content in this category</div>
      </div>
    </section>

    <!-- Seen Movies -->
    <section>
      <h3 @click="toggleSeen" :style="{ color: isSeenOpen ? '#FFD700' : '' }">
        Seen Movies <span>{{ isSeenOpen ? "▼" : "▶" }}</span>
      </h3>
      <div v-if="isSeenOpen" class="section-content">
        <div v-if="seenMovies.length > 0" class="cards">
          <div v-for="(movie, index) in seenMovies" :key="'seen-' + index" class="card">
            <img :src="movie.image || placeholderImage" alt="Movie Image" class="card-img" />
            <p>{{ movie.title }}</p>
          </div>
        </div>
        <div v-else>No content in this category</div>
      </div>
    </section>

    <!-- Watchlist -->
    <section>
      <h3 @click="toggleWatchlist" :style="{ color: isWatchlistOpen ? '#FFD700' : '' }">
        Watchlist <span>{{ isWatchlistOpen ? "▼" : "▶" }}</span>
      </h3>
      <div v-if="isWatchlistOpen" class="section-content">
        <div v-if="watchlist.length > 0" class="cards">
          <div v-for="(movie, index) in watchlist" :key="'watchlist-' + index" class="card">
            <img :src="movie.image || placeholderImage" alt="Movie Image" class="card-img" />
            <p>{{ movie.title }}</p>
          </div>
        </div>
        <div v-else>No content in this category</div>
      </div>
    </section>
  </div>
</template>

<style scoped>
#user-profile {
  color: #fff;
  padding: 20px;
  font-family: Arial, sans-serif;
  background-color: #121212;
}

header {
  display: inline-flex;
  margin-bottom: 20px;
  padding: 15px;
  border-radius: 10px;
  position: relative;
}

.profile-pic {
  text-align: left;
  position: relative;
}

.profile-img {
  width: 200px;
  height: 200px;
  object-fit: cover;
  border-radius: 10px;
  border: 3px solid #444;
}

.profile-info p {
  margin: 0 0 5px;
  font-weight: bold;
  color: white;
}

h3 {
  cursor: pointer;
  background-color: #444;
  padding: 10px;
  margin: 15px 20px 0;
  border-radius: 5px;
  color: #00acee;
  font-weight: bold;
}

.section-content {
  margin: 10px 20px;
  background-color: #333;
  padding: 10px;
  border-radius: 5px;
}

.cards {
  display: grid;
  gap: 10px;
  grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
}

.card {
  text-align: center;
}

.card-img {
  width: 150px;
  height: 150px;
  object-fit: cover;
  border: 2px solid #00acee;
  border-radius: 5px;
}

.card p {
  color: white;
}
</style>
