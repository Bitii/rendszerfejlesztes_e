<script setup>
import { ref } from "vue";
import axios from "axios";
const email = ref("");
const nev = ref("");
const jelszo = ref("");
const jelszo2 = ref("");
const error = ref("");

const register = () =>
{
  if (!email.value || !nev.value || !jelszo.value || !jelszo2.value)
  {
    error.value = "Tölts ki minden mezőt!";
    return;
  }
  if (jelszo.value != jelszo2.value)
  {
    error.value = "A két jelszó nem egyezik!";
    return;
  }

  axios
    .post("http://localhost:8000/api/users/register", {
      email: email.value,
      nev: nev.value,
      jelszo: jelszo.value,
    }).then((resp) => {
      console.log(resp.data);
    }).catch((err) => {
      error.value = "Hiba a regisztráció során!";
    });
}
</script>

<template>
  <main>
  <div id="main-div">
    <div class="form-container">
      <form @submit.prevent="register" id="signup" class="sign-in-form">
        <h2 class="title">Create your account</h2>
        {{ error }}
        <label for="email">Email address</label>
        <div class="input-field">
          <input type="email" required v-model="email" />
        </div>
        <label for="username">Username</label>
        <div class="input-field">
          <input type="text" required v-model="nev" />
        </div>
        <label for="password">Password</label>
        <div class="input-field">
          <input type="password" required v-model="jelszo" />
        </div>
        <label for="repassword">Re-enter password</label>
        <div class="input-field">
          <input type="password" required v-model="jelszo2" />
        </div>
        <!-- profilkép feltöltés -->
        <p class="upload-pic-text">Upload your profile picture:<br />(optional)</p>
        <div class="profilepic">
          <div class="img-holder">
            <img src="" id="img" alt="profile picture" />
          </div>
          <div>
            <p>Upload picture</p>
            <input
              type="file"
              id="profilepic"
              name="profilepic"
              accept="image/*"
            />
          </div>
        </div>
        <input type="submit" class="btn" value="Create account" />
      </form>
    </div>
    <p>Already have an account? <a href="Signin.vue">sign in</a></p>
  </div>
  </main>
</template>

<style scoped>
form {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  padding: 0rem 5rem;
  gap: 0.7rem;
  transition: all 0.2s 0.7s;
  overflow: hidden;
  grid-column: 1 / 2;
  grid-row: 1 / 2;
}
.sign-in-form {
  border: #333 solid 5px;
  min-width: 450px;
  padding-top: 1rem;
  padding-bottom: 1rem;
  margin-top: auto;
}
.form-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: auto;
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
  line-height: 1;
  font-weight: 600;
  font-size: 1.1rem;
  color: var(--white);
  height: 100%;
  padding: 0.7rem;
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

.profilepic {
  display: flex;
  align-items: flex-start;
  text-align: left;
  gap: 1rem;
  width: 100%;
  margin-top: 1rem;
}

.img-holder {
  width: 100px;
  height: 100px;
  overflow: hidden;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: var(--black);
  border: solid 2px var(--grey);
}

.img-holder img {
  max-width: 100%;
  min-width: auto;
  height: auto;
  object-fit: cover;
  text-align: center;
}

p {
  color: var(--white);
  font-size: 1.2rem;
}

.title {
  color: var(--white);
  font-size: 1.5rem;
  margin-bottom: 1rem;
}
#main-div {
  height: auto;
  margin-bottom: 5rem;
  align-items: center;
  overflow: hidden;
}
.upload-pic-text {
  margin-top: 2rem;
}


</style>
