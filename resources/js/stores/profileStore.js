import { defineStore } from 'pinia'

export const useProfileStore = defineStore("profile", {
    state: () => ({
        token: null,
    }),

    actions: {
        setToken(token) {
            this.token = token;
        },
    },

    persist: true,
})