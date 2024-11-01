<script setup>
import logo from '@/assets/logo.svg';
import { ref } from 'vue';
import Searchbar from './components/Searchbar.vue';

const dropdownVisible = ref(false);

const goHome = () => {
  router.push('/');
};

const dropDown = () =>
{
  dropdownVisible.value = !dropdownVisible.value;
};
</script>

<template>
  <!-- Egyetlen gyökérelem lehet csak -->
  <div id="app">
    <header>
      <a href="/"><img class="logo" :src="logo" alt="logo"/></a>
      <div class="topnav">
        <button @click=dropDown>Menu</button>
        <div id="myDropdown" class="dropdown-content" :style="{ display: dropdownVisible ? 'block' : 'none' }">
          <a class="active" href="/">Home</a>
          <a href="/signup">Sign Up</a>
          <a href="/signin">Sign In</a>
          <a href="/user">User</a>
        </div>
        <Searchbar /> <!-- Searchbar komponens megjelenítése -->
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
::-webkit-scrollbar {
  width: 7px;
}

::-webkit-scrollbar-thumb {
  background-color: var(--yellow);
  border-radius: 5px;
}

::-webkit-scrollbar-track {
  background-color: var(--grey);
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
  display: inline-flex;
  justify-content: center;
  gap: 20px;
  /*margin: 20px;*/
  margin: auto;
  position: relative;
}

.topnav a {
  color: white;
  text-decoration: none;
  font-size: 20px;
}

.topnav a:hover {
  color: var(--yellow);
}

.topnav button {
  margin-right: 30px;
  padding: 10px;
  border-radius: 10px;
  border: none;
  background: none;
  color: var(--blue);
  font-size: 25px;
}

.topnav button:hover {
  background-color: var(--blue);
  color: var(--white);
}

.dropdown-content {
  position: absolute;
  background-color: var(--grey);
  min-width: 160px;
  display: none;
  z-index: 2;
  top: 100%;
  left: 0;
  margin-top: 40px;
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
  /*margin-bottom: 30px;*/
  text-align: center;
  align-items: center;
  display: inline-flex;
  margin-left: auto;
  margin-right: auto;
  width: 100%;
  position: relative;
  padding: 40px 40px;
}

.logo {
  width: 80px;
  height: 80px;
  position: absolute;
  left: 10px;
  top: 15px;
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
  margin: 5px 15px 5px 15px;
}

</style>
