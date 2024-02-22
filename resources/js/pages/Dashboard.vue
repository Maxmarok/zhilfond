<script setup>

import { onMounted, ref } from 'vue'
import helper from '@/helper'

onMounted(() => {
    getItems()
})

const items = ref()
const total = ref()
const current_page = ref()

const getItems = (page = 1) => {
    axios.get(`/api/v1/orders?page=${page}`)
        .then(res => {
            items.value = res.data.orders
            total.value = res.data.total
            current_page.value = res.data.current_page
        })
}

const deleteItem = (id) => {
    axios.delete(`/api/v1/orders/delete/${id}`)
        .then(res => {
            getItems(current_page)
        })
}
</script>
<template>
    <div class="col-6 mx-auto my-5">
        <div class="d-flex align-items-center justify-content-between mb-5">
            <h1>Список заказов</h1>
            <div>
                <router-link class="btn btn-warning" to="/">Вернуться в каталог</router-link>
            </div>
        </div>
    
        <div v-if="total">
            <p>Общая стоимость всех заказов: <strong>{{ helper.getPrice(total) }}</strong></p>
        </div>

        <table class="table table-centered table-bitemed" v-if="items && items.data.length > 0">
            <thead class="thead-dark">
                <tr >
                    <th scope="col">№</th>
                    <th scope="col">Дата заказа</th>
                    <th scope="col">Товары</th>
                    <th scope="col">Всего</th>
                    <th scope="col">Удалить</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="item in items.data">
                    <td v-html="`#${item.id}`" />
                    <td v-html="item.ordered_at" />
                    <td v-html="item.items_titles" />
                    <td v-html="helper.getPrice(item.total)" />
                    <td>
                        <button class="btn btn-sm btn-danger" @click="deleteItem(item.id)">Удалить</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <div v-else>
            <p>Список заказов пуст</p>
        </div>

        <Bootstrap5Pagination
            :data="items"
            @pagination-change-page="getItems"
            :show-disabled="true"
            :limit="5"
            v-if="items && items.data.length > 0"
        />
    </div>
</template>