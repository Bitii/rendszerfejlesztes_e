<script setup>
import logo from '@/assets/logo.svg';
import { ref } from 'vue';
import Searchbar from './components/Searchbar.vue';

const dropdownVisible = ref(false);

const dropDown = () =>
{
  dropdownVisible.value = !dropdownVisible.value;
};
</script>

<template>
  <!-- Egyetlen gyökérelem lehet csak -->
  <div id="app">
    <header>
      <img :src="logo" alt="logo" />
      <div class="topnav">
        <button @click=dropDown>Menu</button>
        <div id="myDropdown" class="dropdown-content" :style="{ display: dropdownVisible ? 'block' : 'none' }">
          <a class="active" href="/">Home</a>
          <a href="/signup">Sign Up</a>
          <a href="/signin">Sign In</a>
          <a href="/user">User</a>
        </div>
        <Searchbar />
      </div>
    </header>

    <main>
      <!-- Router megjelenítési pont (routernek megfelelo oldal jelenik meg) -->
      <router-view />
    </main>

    <footer>
      <h3>Follow us on social media</h3>
      <a href="https://www.facebook.com"><img src="./assets/facebook.png" alt="facebook" /></a>
      <a href="https://www.instagram.com"><img src="./assets/instagram.png" alt="instagram" /></a>
      <a href="https://www.twitter.com"><img src="./assets/twitter.png" alt="twitter" /></a>
      <p>&copy; 2021</p>
    </footer>
  </div>
</template>

<style>
@import url("https://fonts.cdnfonts.com/css/berlin-sans-fb-demi");

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Berlin Sans FB Demi", sans-serif;
}

:root {
  --black: rgb(12, 11, 0);
  --white: rgb(252, 247, 247);
  --blue: rgb(18, 139, 181);
  --yellow: rgb(222, 181, 34);
  --grey: rgb(51, 51, 51);
}

body {
  background-color: var(--black);
  color: var(--white);
  text-align: center;
}

.topnav {
  display: inline-block;
  justify-content: center;
  gap: 20px;
  margin: 20px;
}

.topnav a {
  color: white;
  text-decoration: none;
  font-size: 20px;
}

.topnav a:hover {
  color: var(--blue);
}

.topnav button {
  margin-right: 20px;
  padding: 5px;
  border-radius: 5px;
  border: none;
  background: none;
  color: var(--blue);
  font-size: 20px;
}

.topnav button:hover {
  background-color: var(--blue);
  color: var(--white);
}

.dropdown-content {
  position: absolute;
  background-color: var(--black);
  min-width: 160px;
  display: none;
  z-index: 1;
}

.dropdown-content a {
  color: white;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

header {
  background-color: var(--black);
  color: white;
  margin-bottom: 30px;
  text-align: center;
  display: flex;
  margin-left: auto;
  margin-right: auto;
}

header img {
  width: 80px;
  height: 80px;
}

footer h3{
  display: flex;
  justify-content: center;
  background-color: var(--black);
  color: white;
  text-align: center;
}
footer img {
  width: 30px;
  height: 30px;
  margin: 2px;
}

</style>
