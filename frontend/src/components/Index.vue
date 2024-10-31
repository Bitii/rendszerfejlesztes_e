<script setup>

</script>

<template>
  <div class="movies">
      <p class="slogan">MOVIES A TO Z</p>
    <!-- <img class="szalag" src="../assets/szalag2.jpg" alt="movie"> -->
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
  /*background: url(../assets/szalag.jpg) repeat-x;*/
  /*background-size: cover;*/
  /*flex-direction: row;*/
  background: linear-gradient(to top, rgba(222, 181, 34, 0.055) 0%, rgba(222, 181, 34, 0.55) 100%);
  height: 250px;/*
  gap: 10px;
  padding: 10px;*/
  margin-bottom: 20px;
  overflow: hidden;
  /*animation: szalag 15s linear infinite;*/
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

/*.szalag {

  object-fit: fill;
  animation: szalag 25s linear infinite;
}
@keyframes szalag{
  0% { transform: translateX(0%); }
  50% {transform: translateX(-50%);}
  100% { transform: translateX(-50%); }
}*/

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
