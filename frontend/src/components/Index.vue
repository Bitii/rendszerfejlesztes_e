<script setup>

</script>

<template>
  <div class="movies">
      <p class="slogan">MOVIES A TO Z</p>
  </div>

  <h2>Top 10 this week</h2>
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

  <h2>Fan favorites</h2>
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

  <h2>Popular interests</h2>
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
</template>

<style scoped>
.movies {
  background: linear-gradient(to top, rgba(222, 181, 34, 0.055) 0%, rgba(222, 181, 34, 0.55) 100%);
  height: 250px;
  margin-bottom: 20px;
  overflow: hidden;
}

.slogan {
  top: 35%;
  margin: auto;
  color: var(--blue);
  font-size: 65px;
  position: relative;
  z-index: 1;
  text-shadow: 10px 10px black;
  letter-spacing: 10px;
}

h2 {
  text-align: left;
  margin-left: 20px;
  color: var(--blue);
  letter-spacing: 3px;
}

.panels {
  display: flex;
  flex-direction: row;
  justify-content: left;
  border: 1px solid var(--yellow);
  gap: 20px;
  padding: 10px;
  overflow: hidden;
  margin: 20px;
}

.panels img {
  width: 80px;
  height: 100px;
}

.slide p {
  text-align: left;
}
</style>
