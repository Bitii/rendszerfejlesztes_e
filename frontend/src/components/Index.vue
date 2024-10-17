<script setup>

</script>

<template>
  <div class="movies">
    <img src="../assets/placeholder.jpg" alt="movie" />
    <img src="../assets/placeholder.jpg" alt="movie" />
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
  display: flex;
  flex-direction: row;
  justify-content: left;
  background: linear-gradient(to top, rgba(222, 181, 34, 0.055) 0%, rgba(222, 181, 34, 0.55) 100%);
  height: 250px;
  gap: 10px;
  padding: 10px;
}

.movies img {
  width: 80px;
  height: 100px;
}

.panels {
  display: flex;
  flex-direction: row;
  justify-content: left;
  border: 1px solid var(--yellow);
  gap: 10px;
  padding: 10px;
  overflow: hidden;
}

.panels img {
  width: 80px;
  height: 100px;
}

.slide p {
  text-align: left;
}
</style>
