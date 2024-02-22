<script setup>
import { onMounted, ref } from 'vue'
import { useCartStore } from '@/stores/cartStore'
import { Bootstrap5Pagination } from 'laravel-vue-pagination'
import helper from '@/helper'

const store = useCartStore()
const items = ref()

onMounted(() => {
    getItems()
})

const getItems = (page = 1) => {
    axios.get(`/api/v1/items?page=${page}`)
        .then(res => {
            items.value = res.data.items
        })
}

const checkInCart = (id) => {
    let item = store.cart.find(x => x.id === id)
    return item !== undefined ? item.count : 1
}


const addToCart = (item) => {
    store.selectItem(item, checkInCart(item.id))
}


const changeValue = (value, item) => {
    let count = checkInCart(item.id)

    if(count > 1 && value === -1) {
        count = count - 1
        store.setCount(item, count)
    }

    if(count < 999 && value === 1) {
        count = count + 1
        store.setCount(item, count)
    }
}

const changeInput = (e, item) => {
    let value = e.target.value.replace(' ', '').replace(/[^\.0-9]/g, '')
    let count = parseInt(value)
    
    if(value == null || value == '' || !(value > 0 && value < 1000)) {
        count = 1
    }

    store.setCount(item, count)
}


</script>
<template>
    <div class="col-6 mx-auto my-5">
        <div class="d-flex align-items-center justify-content-between mb-5">
            <h1>Каталог товаров</h1>
            <div>
                <router-link v-if="store.selected.length > 0" class="btn btn-success" to="/cart" >Оформить заказ</router-link>
                <button v-else disabled class="btn btn-info" >Оформить заказ</button>
            </div>
        </div>
    

        <table class="table table-centered table-bordered" v-if="items">
            <thead class="thead-dark">
                <tr >
                    <th scope="col">Название</th>
                    <th scope="col">Цена</th>
                    <th scope="col">Добавить</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in items.data">
                    <td v-html="`${item.title} ${item.id}`" />
                    <td v-html="helper.getPrice(item.price)" />
                    <td>
                        <div class="d-flex align-items-center">
                            <div>
                                <button class="btn btn-sm btn-primary" @click="changeValue(-1, item)">-</button>
                            </div>
                            <div class="mx-2">
                                <input class="form-control" type="number" @keypress="helper.isNumber($event)" @input="(e) => changeInput(e, item)" :value="checkInCart(item.id)" />
                            </div>
                            <div>
                                <button class="btn btn-sm btn-primary" @click="changeValue(1, item)">+</button>
                            </div>

                            <div>
                                <button class="btn btn-sm btn-success ms-2" @click="addToCart(item)">Добавить в корзину</button>
                            </div>
                        </div>
                        <!-- <div class="d-flex">
                            <button class="q-minus blue_color" @click="changeValue(-1)">-</button>
                            <input class="quantity border-start-0 border-end-0 text-center blue_color" type="number" @input="(e) => changeInput(e)" :value="itemForCart.count">
                            <button class="q-plus blue_color"  @click="changeValue(1)">+</button>
                        </div> -->
                    </td>
                </tr>
            </tbody>
        </table>

        <Bootstrap5Pagination
            :data="items"
            @pagination-change-page="getItems"
            :show-disabled="true"
            :limit="5"
            v-if="items && items.data.length > 0"
        />
    </div>
</template>