<script setup>
import { ref } from 'vue';
import logo from "@/assets/logo.svg";

// Felhasznaloi informaciok
const username = ref('username');
const email = ref('email@email.com');
const password = ref('password1234');
const registrationDate = ref('YYY-MM-DD');

// Felhasznalo adatai mint: kedvencek, latott, ...
const favorites = ref([]);
const seenMovies = ref([]);
const watchlist = ref([]);

const comments = ref([]);

const editMode = ref(false);

const toggleEditMode = () => {
    editMode.value != editMode.value;
};
</script>

<template>
    <div id = 'user-profile'>
        <header>
            <img :src="logo" alt="profilkep" />
            <div class="profile-info">
                <p>Felhasználónév: <span>{{ username }}</span></p>
                <p>Email-cim: <span>{{email}}</span></p>
                <p v-if="editMode">Jelszó: <input type="password" v-model="password" /></p>
                <p v-else>Jelszo: ********</p>
                <p>Regisztráció dátuma: </p>
                <button @click="toggleEditMode">{{editMode ? 'Profil mentése' : 'Profil szerkesztése'}}</button>
            </div>
        </header>

        
    </div>
</template>