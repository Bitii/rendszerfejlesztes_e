<script setup>

</script>

<template>
  <div id="movies-app">
    <div class="movies">
      <p class="slogan">MOVIES A TO Z</p>
    </div>

    <h2>Top 10 This Week</h2>
    <div class="panels">
      <div class="slide">
        <img src="../assets/placeholder.jpg" alt="movie" />
        <p>Title</p>
      </div>
      <div class="slide">
        <img src="../assets/placeholder.jpg" alt="movie" />
        <p>Title</p>
      </div>
      <div class="slide">
        <img src="../assets/placeholder.jpg" alt="movie" />
        <p>Title</p>
      </div>
      <div class="slide">
        <img src="../assets/placeholder.jpg" alt="movie" />
        <p>Title</p>
      </div>
      <div class="slide">
        <img src="../assets/placeholder.jpg" alt="movie" />
        <p>Title</p>
      </div>
      <div class="slide">
        <img src="../assets/placeholder.jpg" alt="movie" />
        <p>Title</p>
      </div>
    </div>

    <h2>Fan Favorites</h2>
    <div class="panels">
      <div class="slide">
        <img src="../assets/placeholder.jpg" alt="movie" />
        <p>Title</p>
      </div>
      <div class="slide">
        <img src="../assets/placeholder.jpg" alt="movie" />
        <p>Title</p>
      </div>
      <div class="slide">
        <img src="../assets/placeholder.jpg" alt="movie" />
        <p>Title</p>
      </div>
      <div class="slide">
        <img src="../assets/placeholder.jpg" alt="movie" />
        <p>Title</p>
      </div>
      <div class="slide">
        <img src="../assets/placeholder.jpg" alt="movie" />
        <p>Title</p>
      </div>
      <div class="slide">
        <img src="../assets/placeholder.jpg" alt="movie" />
        <p>Title</p>
      </div>
    </div>

    <h2>Popular Interests</h2>
    <div class="panels">
      <div class="slide">
        <img src="../assets/placeholder.jpg" alt="movie" />
        <p>Title</p>
      </div>
      <div class="slide">
        <img src="../assets/placeholder.jpg" alt="movie" />
        <p>Title</p>
      </div>
      <div class="slide">
        <img src="../assets/placeholder.jpg" alt="movie" />
        <p>Title</p>
      </div>
      <div class="slide">
        <img src="../assets/placeholder.jpg" alt="movie" />
        <p>Title</p>
      </div>
      <div class="slide">
        <img src="../assets/placeholder.jpg" alt="movie" />
        <p>Title</p>
      </div>
      <div class="slide">
        <img src="../assets/placeholder.jpg" alt="movie" />
        <p>Title</p>
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
}

.slide:hover {
  transform: scale(1.05);
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
}

.panels img {
  width: 100%;
  height: auto;
  display: block;
  border-bottom: 2px solid #FFD700;
}

.slide p {
  margin: 10px 0;
  font-size: 16px;
  font-weight: bold;
  color: white;
}
</style>