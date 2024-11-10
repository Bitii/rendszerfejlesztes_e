import { defineStore } from "pinia";

export const useUserStore = defineStore('user', {
  state: () => ({ user: {} }),
  getters: {
    isLoggedIn: (state) => !!state.user.id, 
  }
});