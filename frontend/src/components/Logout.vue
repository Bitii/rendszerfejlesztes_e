<script setup>
import { useUserStore } from '../../stores/user';
import { useRouter } from 'vue-router';
import axios from 'axios';

const userData = useUserStore();
const router = useRouter();

const logoutURL = "http://127.0.0.1:8000/api/users/logout";

const logout = async () =>
{
    try
    {
        let resp = await axios.post(logoutURL, {}, {
            headers: {
                Authorization: `Bearer ${userData.user.token}`
            }
        });
        console.log(resp);
        userData.user = {};
        router.push("/");
    } catch (error)
    {
        console.log(error);
    }
};

</script>

<template>
    <button class="logoutbtn" v-if="userData.user.id" @click="logout">Log out</button>
</template>

<style scoped>

</style>
