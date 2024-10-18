<!-- SCRIPT -->
<script setup>
import { ref } from "vue";
import axios from "axios";
import router from "../router";

const email = ref("");
const password = ref("");
const error = ref("");
const user = ref({});

/* BEJELENTKEZÉS */
const login = () => {
  if (!email.value || !password.value) {
    error.value = "Töltsd ki az összes mezőt!";
    return;
  }

  axios
    .post("http://127.0.0.1:8000/api/users/login", {
      email: email.value,
      jelszo: password.value,
    })
    .then((resp) => {
      user.value = resp.data.user;
      user.token = resp.data.user.token;
      console.log(user.value, user.token);
      router.push("/");
    })
    .catch((err) => (error.value = "Hibás email vagy jelszó!"));
};
</script>

<!-- TEMPLATE -->
<template>
  <main>
    <div class="form-container">
      <form @submit.prevent="login" id="signup" class="sign-in-form">
        <h2 class="title">Sign in</h2>
        {{ error }}
        <label for="email">Email address</label>
        <div class="input-field">
          <input type="email" required v-model="email" />
        </div>
        <label for="password">Password</label>
        <div class="input-field">
          <input type="password" required v-model="password" />
        </div>
        <input type="submit" class="btn" value="Sign in" />
        <div id="separator"><span>  or  </span></div>
        <input type="button" class="btn" value="Create a new account" /> <!-- még nem irányít át a regisztrálós oldalra -->
      </form>
    </div>
  </main>
  <footer></footer>
</template>

<!-- STYLE -->
<style scoped>
form {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  padding: 0rem 3rem;
  gap: 0.7rem;
  transition: all 0.2s 0.7s;
  overflow: hidden;
  grid-column: 1 / 2;
  grid-row: 1 / 2;
}
.sign-in-form {
  border: #333 solid 5px;
  min-width: 350px;
  padding-top: 1rem;
  padding-bottom: 1rem;
  margin-top: auto;
}
.form-container {
  display: grid;
  grid-template-columns: 350px;
  justify-content: center;
  align-items: center;
  height: 60vh;
  margin-bottom: 10rem;
}
label {
  color: var(--white);
  font-size: 1.2rem;
  position: relative;
  top: 1.4rem;
}

.input-field {
  max-width: 400px;
  width: 100%;
  background-color: var(--grey);
  margin: 15px 10px 0px 10px;
  height: 2rem;
  border-radius: 5px;
  display: flex;
  flex-direction: column;
}

.input-field input {
  background: none;
  outline: none;
  border: none;
  font-size: 1.1rem;
  color: var(--white);
  height: 100%;
  padding: 0 10px;
}
.btn {
  width: fit-content;
  background-color: var(--blue);
  border: none;
  outline: none;
  height: 49px;
  border-radius: 15px;
  color: #fff;
  text-transform: uppercase;
  font-weight: 600;
  margin: 10px 0;
  padding: 0 2rem;
  cursor: pointer;
  transition: 0.5s;
}

.btn:hover {
  background-color: #deb522;
}

#separator {
  color: #deb522;
  align-items: center;
  text-align: center;
  position: relative;
  display: flex;
}

#separator::before{
  content: '';
  display: block;
  min-width: 170px;
  height: 5px;
  position: absolute;
  top: 50%;
  left: 10px;
  background: #deb522;
  z-index: -20;
}
#separator::after {
  content: '';
  display: block;
  min-width: 170px;
  height: 5px;
  position: absolute;
  top: 50%;
  right: 10px;
  background: #deb522;
  z-index: -20;
}
span {
  background-color: var(--black);
  padding-left: 10px;
  padding-right: 10px;
}
</style>
