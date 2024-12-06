<script setup>
import { ref, onMounted } from 'vue';
import { useUserStore } from '../../stores/user';
import placeholderImage from "@/assets/placeholder.jpg"; // Placeholder image
import axios from 'axios'; // Axios to fetch data from API

// User data from Pinia
const userStore = useUserStore();
const userId = userStore.user?.id;
const username = ref(userStore.user?.nev || 'Default Username');
const email = ref(userStore.user?.email || 'example@example.com');
const registrationDate = ref(userStore.user?.regisztracios_datum || 'N/A');

// Movie categories
const favorites = ref([]);
const seenMovies = ref([]);
const watchlist = ref([]);

// TMDB API details
const TMDB_API_BASE = "https://api.themoviedb.org/3";
const TMDB_API_KEY = "83e8713d6dfc87ac2ec4a2da58f338cd"; 

// Fetch user movies from the backend
const loadUserMovies = async () => {
  if (!userId) {
    console.error("User ID not found");
    return;
  }

  try {
    const response = await axios.get(`/api/movie-info/${userId}`);
    const movies = response.data.movies || [];

    // Categorize movies
    favorites.value = movies.filter(movie => movie.favorite === 1);
    seenMovies.value = movies.filter(movie => movie.seen === 1);
    watchlist.value = movies.filter(movie => movie.bookmark === 1);
  } catch (error) {
    console.error("Error loading user movies:", error);
    favorites.value = [];
    seenMovies.value = [];
    watchlist.value = [];
  }
};

// Fetch movie details from TMDB
const fetchMovieDetails = async (movieId) => {
  try {
    const response = await axios.get(`${TMDB_API_BASE}/movie/${movieId}?api_key=${TMDB_API_KEY}`);
    return response.data;
  } catch (error) {
    console.error("Error fetching movie details:", error);
    return null;
  }
};

// Bookmark functionality
const createBookmark = async (movieId) => {
  const movie = await fetchMovieDetails(movieId);
  if (movie) {
    const bookmarkUrl = `${TMDB_API_BASE}/movie/${movieId}`;
    window.open(bookmarkUrl, '_blank');
  } else {
    alert("Unable to create bookmark.");
  }
};

// Load user movies on mount
onMounted(() => {
  loadUserMovies();
});

// Toggle visibility for categories
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
        Favorites <span>{{ isFavouritesOpen ? '▼' : '▶' }}</span>
      </h3>
      <div v-if="isFavouritesOpen" class="section-content">
        <div v-if="favorites.length > 0" class="cards">
          <div v-for="(movie, index) in favorites" :key="'favourites-' + index" class="card">
            <img :src="movie.image || placeholderImage" alt="Movie Image" class="card-img" />
            <p>{{ movie.title }}</p>
            <button @click="createBookmark(movie.movie_id)">🔖 Bookmark</button>
          </div>
        </div>
        <div v-else>No content in this category</div>
      </div>
    </section>

    <!-- Seen Movies -->
    <section>
      <h3 @click="toggleSeen" :style="{ color: isSeenOpen ? '#FFD700' : '' }">
        Seen Movies <span>{{ isSeenOpen ? '▼' : '▶' }}</span>
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
        Watchlist <span>{{ isWatchlistOpen ? '▼' : '▶' }}</span>
      </h3>
      <div v-if="isWatchlistOpen" class="section-content">
        <div v-if="watchlist.length > 0" class="cards">
          <div v-for="(movie, index) in watchlist" :key="'watchlist-' + index" class="card">
            <img :src="movie.image || placeholderImage" alt="Movie Image" class="card-img" />
            <p>{{ movie.title }}</p>
            <button @click="createBookmark(movie.movie_id)">🔖 Bookmark</button>
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

.profile-pic p {
    margin: 10px;
}

.profile-img {
    position: relative;
    width: 200px;
    height: 200px;
    object-fit: cover;
    border-radius: 10px;
    border: 3px solid #444;
    z-index: 0;
    margin-bottom: 10px;
}

.add-picture-button,
.delete-picture-button {
    position: absolute;
    background: none;
    cursor: pointer;
    font-size: 20px;
    color: var(--yellow);
    z-index: 1;
    margin-left: 5px;
}
.delete-picture-button{
    top: 15%;
}

.profile-info {
    left: 25%;
    top: 5%;
    position: absolute;
    margin: 20px;
}
.profile-info p {
    margin: 0 0 5px 0;
    font-weight: bold;
    color: var(white);
    text-align: left;
}
.edit-button {
    position: absolute;
    margin-right: 20px;
    right: 0%;
    top: 10%;
}
button {
    background-color: var(--blue);
    color: white;
    border: none;
    border-radius: 5px;
    padding: 10px;
    cursor: pointer;
    font-weight: bold;
}

h3 {
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: #444;
    padding: 10px;
    margin: 15px 20px 0 20px;
    border-radius: 5px;
    color: #00acee;
    font-weight: bold;
    border-bottom: 2px solid #00acee;
}

.section-content {
    margin: 10px 20px 0 20px;
    background-color: #333;
    padding: 10px;
    border-radius: 5px;
    border-top: 2px solid #00acee;
}

.watchlist {
    border-top: 2px solid #FFD700;
}

.cards {
    display: grid;
    gap: 10px;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
}

.card {
    text-align: center;
    color: #fff;
    position: relative;
}

.card-img {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border: 2px solid #00acee;
    border-radius: 5px;
}

.delete-button {
    position: absolute;
    padding: 0%;
    top: 5px;
    right: 5px;
    background: none;
    border: none;
    cursor: pointer;
    color: #FF6347;
    font-size: 20px;
}

.reviews-section {
    margin: 20px 20px 0 20px;
    background-color: #222;
    padding: 15px;
    border-radius: 10px;
    border-top: 2px solid #00acee;
}

.review {
    background-color: #333;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
    border-left: 5px solid #00acee;
}

.review-actions {
    margin-top: 10px;
    display: flex;
    gap: 10px;
}

.footer-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 20px;
    font-size: 24px;
    color: #00acee;
    gap: 10px;
}

.social-icons {
    display: flex;
    gap: 10px;
}

.picture-modifiers{
    background-color: #00acee;
}
</style>