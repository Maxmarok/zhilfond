<script setup>
import { ref } from 'vue'
import { useProfileStore } from '@/stores/profileStore'
import router from "@/router"

const profile = useProfileStore()

const email = ref()
const password = ref()
const errors = ref()

const sendForm = () => {
    let obj = {
        email: email.value,
        password: password.value,
    }

    axios.post(`/api/v1/login`, obj)
        .then(res => {
            profile.setUser(res.data.user)
            profile.setToken(res.data.token)
            router.push({name: 'Dashboard'})
        })
        .catch(e => {
            if(e.response !== undefined)
            errors.value = e.response.data.errors
        })
}
</script>
<template>
    <div class="col-6 mx-auto my-5">
        <div class="d-flex align-items-center justify-content-between mb-5">
            <h1>Вход</h1>
            <div>
                <router-link class="btn btn-warning" to="/">Вернуться в каталог</router-link>
            </div>
        </div>
 
        <div>
            <div class="form-group mb-2">
                <input type="email" class="form-control" placeholder="Введите email" v-model="email">
                <p v-if="errors" v-for="error in errors.email" v-html="error" class="text-danger" />
            </div>

            <div class="form-group mb-2">
                <input type="password" class="form-control" placeholder="Введите пароль" v-model="password">
                <p v-if="errors" v-for="error in errors.password" v-html="error" class="text-danger" />
            </div>

            <button @click="sendForm" class="btn btn-primary">Войти</button>
        </div>
    </div>
</template>