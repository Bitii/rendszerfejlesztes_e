<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import placeholderImage from "@/assets/placeholder.jpg"; // Pelda film/sorozat kep
import profilePicture from "@/assets/profile.jpg"; // Pelda profil-kep

// Felhasznalo informacio
const username = ref('username_123');
const email = ref('email@email.com');
const password = ref('password1234');
const registrationDate = ref('YYYY-MM-DD');

// Felhasznalo adatai: kedvencek, latottak, nezesi lista...
const favorites = ref([]);
const seenMovies = ref([]);
const watchlist = ref([]);

const reviews = ref([]);

const editMode = ref(false);
const toggleEditMode = () => {
    editMode.value = !editMode.value;
};

// Szekciok nyitasa/zarsa
const isFavouritesOpen = ref(false);
const isSeenOpen = ref(false);
const isWatchlistOpen = ref(false);

const toggleFavourites = () => {
    isFavouritesOpen.value = !isFavouritesOpen.value;
    if (isFavouritesOpen.value) {
        isSeenOpen.value = false;
        isWatchlistOpen.value = false;
    }
};

const toggleSeen = () => {
    isSeenOpen.value = !isSeenOpen.value;
    if (isSeenOpen.value) {
        isFavouritesOpen.value = false;
        isWatchlistOpen.value = false;
    }
};

const toggleWatchlist = () => {
    isWatchlistOpen.value = !isWatchlistOpen.value;
    if (isWatchlistOpen.value) {
        isFavouritesOpen.value = false;
        isSeenOpen.value = false;
    }
};
// Dinamikus kep szam beallitasa a kepernyo merete alapjan
const numberOfImages = ref(0);

const updateNumberOfImages = () => {
    const containerWidth = window.innerWidth;
    const imageWidth = 165; // feltetelezett kep szelesseg pixelben (kep + hely + padding)
    const imagesPerRow = Math.floor(containerWidth / imageWidth);
    const rows = 2; // Mindig ket sor
    numberOfImages.value = imagesPerRow * rows; // mindig ket sorban tartsuk a kepeket
    [favorites, seenMovies, watchlist].forEach(list => {
        while (list.value.length < numberOfImages.value) {
            list.value.push({ image: placeholderImage, title: "Title" });
        }
        if (list.value.length > numberOfImages.value) {
            list.value.length = numberOfImages.value;
        }
    });
};

onMounted(() => {
    updateNumberOfImages();
    window.addEventListener('resize', updateNumberOfImages);
});

onUnmounted(() => {
    window.removeEventListener('resize', updateNumberOfImages);
});

// Felhasznaloi bejelentkezes kezelese
const isLoggedIn = ref(false);
const toggleLogin = () => {
    isLoggedIn.value = !isLoggedIn.value;
};

const addProfilePicture = () => {
    // Kep feltoltese
    const input = document.createElement('input');
    input.type = 'file';
    input.accept = 'image/*';
    input.onchange = (event) => {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                profilePicture.value = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    };
    input.click();
};

const deleteProfilePicture = () => {
    profilePicture.value = placeholderImage;
};

const editReview = (index) => {
    // ...
};

const deletReview = (index) => {
    reviews.value.splice(index, 1);
};
</script>

<template>
    <div id="user-profile">
        <!-- Fejlec -->
        <header>
            <div class="profile-header">
                <img :src="profilePicture" alt="profile picture" class="profile-img" />
                    <button class="add-picture-button" @click="addProfilePicture">➕</button>
                    <button class="delete-picture-button" @click="deleteProfilePicture">🗑️</button>
                <div class="profile-info">
                    <p>Username: <span>{{ username }}</span></p>
                    <p>Email address: <span v-if="!editMode">{{ email }}</span><input v-if="editMode" type="text" v-model="email" /></p>
                    <p>Password: <span v-if="!editMode">********</span><input v-if="editMode" type="password" v-model="password" /></p>
                    <p>Registration date: {{ registrationDate }}</p>
                    <button @click="toggleEditMode">{{ editMode ? 'Save Profile' : 'Edit Profile' }}</button>
                </div>
            </div>
        </header>

        <!-- Szekciok -->
        <section>
            <!-- Kedvencek -->
            <h3 @click="toggleFavourites" :style="{ color: isFavouritesOpen ? '#FFD700' : '', borderBottom: isFavouritesOpen ? '2px solid #FFD700' : '' }">
                Favourites <span>{{ isFavouritesOpen ? '▼' : '▶' }}</span>
            </h3>
            <div v-if="isFavouritesOpen" class="section-content">
                <div class="cards">
                    <div v-for="(item, index) in favorites.slice(0, numberOfImages)" :key="'favourites-' + index" class="card">
                        <img :src="item.image" alt="Movie image {{ index + 1 }}" class="card-img" />
                        <p>{{ item.title }}</p>
                        <button @click="deleteReview(index)" class="delete-button">🗑️</button>
                    </div>
                </div>
            </div>

            <!-- Mar latott filmek/sorozatok -->
            <h3 @click="toggleSeen" :style="{ color: isSeenOpen ? '#FFD700' : '', borderBottom: isSeenOpen ? '2px solid #FFD700' : '' }">
                Seen Movies <span>{{ isSeenOpen ? '▼' : '▶' }}</span>
            </h3>
            <div v-if="isSeenOpen" class="section-content">
                <div class="cards">
                    <div v-for="(item, index) in seenMovies.slice(0, numberOfImages)" :key="'seen-' + index" class="card">
                        <img :src="item.image" alt="Movie image {{ index + 1 }}" class="card-img" />
                        <p>{{ item.title }}</p>
                        <button @click="deleteReview(index)" class="delete-button">🗑️</button>
                    </div>
                </div>
            </div>

            <!-- Varolista -->
            <h3 @click="toggleWatchlist" :style="{ color: isWatchlistOpen ? '#FFD700' : '', borderBottom: isWatchlistOpen ? '2px solid #FFD700' : '' }">
                Watchlist <span>{{ isWatchlistOpen ? '▼' : '▶' }}</span>
            </h3>
            <div v-if="isWatchlistOpen" class="section-content watchlist">
                <div class="cards">
                    <div v-for="(item, index) in watchlist.slice(0, numberOfImages)" :key="'watchlist-' + index" class="card">
                        <img :src="item.image" alt="Movie image {{ index + 1 }}" class="card-img" />
                        <p>{{ item.title }}</p>
                        <button @click="deleteReview(index)" class="delete-button">🗑️</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Velemenyek -->
        <section class="reviews-section">
            <h3>Reviews</h3>
            <div v-for="(review, index) in reviews" :key="'review-' + index" class="review">
                <h4>{{ review.title }}</h4>
                <p v-if="!editMode">{{ review.content }}</p>
                <input v-if="editMode" type="text" v-model="review.content" />
                <div class="review-actions">
                    <button v-if="editMode" @click="toggleEditMode">✔️</button>
                    <button @click="editReview(index)">✏️</button>
                    <button @click="deleteReview(index)">🗑️</button>
                </div>
            </div>
        </section>

        <!-- Kozossegi media ikonok -->
        <footer>
            <div class="footer-content">
                <div class="social-icons">
                    <span class="icon-facebook"></span>
                    <span class="icon-twitter"></span>
                    <span class="icon-instagram"></span>
                    <span class="icon-youtube"></span>
                </div>
                <p>Follow us!</p>
            </div>
        </footer>
    </div>
</template>

<style scoped>
#user-profile {
    color: #fff;
    padding: 20px;
    font-family: Arial, sans-serif;
    background-color: #121212;
}

header {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-bottom: 20px;
    background-color: #222;
    padding: 15px;
    border-radius: 10px;
}

.profile-img {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border-radius: 10px;
    border: 3px solid #444;
    margin-right: 20px;
}

.add-picture-button,
.delete-picture-button {
    background: none;
    border: none;
    cursor: pointer;
    font-size: 24px;
    color: #00acee;
}

.profile-info p {
    margin: 5px 0;
    font-weight: bold;
    color: #00acee;
}

button {
    margin-top: 10px;
    background-color: #007BFF;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 10px;
    cursor: pointer;
    font-weight: bold;
}

h3 {
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: #444;
    padding: 10px;
    margin-top: 15px;
    border-radius: 5px;
    color: #00acee;
    font-weight: bold;
    border-bottom: 2px solid #00acee;
}

.section-content {
    margin-top: 10px;
    background-color: #333;
    padding: 10px;
    border-radius: 5px;
    border-top: 2px solid #00acee;
}

.watchlist {
    border-top: 2px solid #FFD700;
}

.cards {
    display: grid;
    gap: 10px;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
}

.card {
    text-align: center;
    color: #fff;
    position: relative;
}

.card-img {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border: 2px solid #00acee;
    border-radius: 5px;
}

.delete-button {
    position: absolute;
    top: 5px;
    right: 5px;
    background: none;
    border: none;
    cursor: pointer;
    color: #FF6347;
    font-size: 20px;
}

.reviews-section {
    margin-top: 20px;
    background-color: #222;
    padding: 15px;
    border-radius: 10px;
    border-top: 2px solid #00acee;
}

.review {
    background-color: #333;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
    border-left: 5px solid #00acee;
}

.review-actions {
    margin-top: 10px;
    display: flex;
    gap: 10px;
}

.footer-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 20px;
    font-size: 24px;
    color: #00acee;
    gap: 10px;
}

.social-icons {
    display: flex;
    gap: 10px;
}

.picture-modifiers{
    background-color: #00acee;
}
</style>