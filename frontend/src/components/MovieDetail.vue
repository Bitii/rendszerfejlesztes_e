<script setup>
import { useMovieStore } from '../../stores/movie';
import axios from 'axios';
import { useUserStore } from '../../stores/user';

const img = "https://image.tmdb.org/t/p/original";
const movieData = useMovieStore();

const updateMovieInfo = async (actionType) => {
  try {
    const userStore = useUserStore();
    const userId = userStore.user?.id;

    if (!userId) {
      alert("User is not logged in!");
      return;
    }

    const response = await axios.post('http://127.0.0.1:8000/api/movie-info', {
      user_id: userId,
      movie_id: movieData.movie.id,
      [actionType]: true,
    });

    if (response.status === 200) {
      alert(`Movie marked as ${actionType}!`);
    } else {
      console.log('Unexpected response from the server:', response);
      alert('Something went wrong!');
    }
  } catch (error) {
    console.error('Error updating movie info:', error.response?.data || error.message);
    alert('Failed to update the database.');
  }
};

const addToFavorites = () => {
  updateMovieInfo('favorite');
};

const addToBookmarks = () => {
  updateMovieInfo('bookmark');
  addBrowserBookmark();
};

const addBrowserBookmark = () => {
  const movieTitle = movieData.movie.title || 'Movie';
  const movieUrl = `https://www.themoviedb.org/movie/${movieData.movie.id}`;

  if (window.sidebar && window.sidebar.addPanel) {
    window.sidebar.addPanel(movieTitle, movieUrl, '');
  } else if (window.external && 'AddFavorite' in window.external) {
    window.external.AddFavorite(movieUrl, movieTitle);
  } else if (window.chrome) {
    alert(
      `To bookmark this movie, press ${navigator.platform.includes('Mac') ? 'Cmd' : 'Ctrl'}+D.`
    );
  } else {
    alert(
      `Use the bookmark feature in your browser to save this link: ${movieUrl}`
    );
  }
};

const markAsSeen = () => {
  updateMovieInfo('seen');
};
</script>

<template>
  <div class="movie">
    <div class="movie-poster">
      <img :src="img + movieData.movie.poster_path" alt="The movie's poster">
      <div class="action-buttons">
        <button id="heart" @click="addToFavorites">❤</button>
        <button id="bookmark" @click="addToBookmarks">🔖</button>
        <button id="seen" @click="markAsSeen">👁</button>
      </div>
      <p>Release date: {{ movieData.movie.release_date }}</p>
    </div>
    <div class="movie-data">
      <h1>{{ movieData.movie.title }}</h1>
      <p>{{ movieData.movie.overview }}</p>
      <p>Rating: {{ movieData.movie.vote_average }}</p>
    </div>
  </div>
  <div class="movie2">
    <div class="people">
      <p>Director: Christopher Nolan</p>
      <p>Writer: Jonathan Nolan</p>
      <p>Stars: Christian Bale, Michael Caine, Heath Ledger</p>
    </div>
    <div class="category">
      <p>Categories: Action, Drama, Thriller</p>
    </div>
  </div>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

body {
  font-family: 'Roboto', sans-serif;
}

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

.movie-poster {
  text-align: center;
  padding-left: 30px;
  height: auto;
  position: relative;
}

.action-buttons {
  margin-top: 10px;
  display: flex;
  justify-content: center;
  gap: 15px;
}

.action-buttons button {
  background: none;
  cursor: pointer;
  font-size: 30px;
  color: var(--gray);
  border: none;
}

#seen {
  font-size: 40px;
}

.movie-data {
  text-align: left;
  padding-left: 30px;
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
