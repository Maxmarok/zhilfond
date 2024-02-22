<script setup>
import { onMounted, ref } from 'vue'
import { useCartStore } from '@/stores/cartStore'
import helper from '@/helper'

const store = useCartStore()
const items = ref()
const success = ref(false)

onMounted(() => {
    getItems()
})

const getItems = () => {
    let ids = store.selected.map(x => x.id)
    if(ids.length > 0) {
        axios.post(`/api/v1/cart`, {ids: ids})
            .then(res => {
                console.log(store.selected)
                items.value = store.selected.map(x => {
                    let obj = res.data.items.find(y => x.id === y.id)
                    return {...obj, ...x}
                })
            })
    }
}

const sendForm = () => {
    let items = store.selected

    axios.post(`/api/v1/order`, {items: items})
        .then(res => {
            if(res.data.success) {
                store.deleteItems()
                success.value = true
            }
        })
}

const checkInCart = (id) => {
    let item = store.cart.find(x => x.id === id)
    return item !== undefined ? item.count : 1
}

const getTotalSum = () => {
    return items.value.map(x => x.total = x.price * x.count).reduce((x, y) => x + y)
}

const getTotalPrice = () => {
    return items.value.map(x => x.price).reduce((x, y) => x + y)
}

const getTotalItems = () => {
    console.log(items.value.map(x => x.count))
    return items.value.map(x => x.count).reduce((x, y) => x + y)
}

</script>
<template>
    <div class="col-6 mx-auto my-5">
        <div class="d-flex align-items-center justify-content-between mb-5">
            <h1>Оформление заказа</h1>
            <div>
                <router-link class="btn btn-warning" to="/">Вернуться в каталог</router-link>
            </div>
        </div>
    
        <div v-if="!success">
            <table class="table table-centered table-bordered" v-if="items">
                <thead class="thead-dark">
                    <tr >
                        <th scope="col">Название</th>
                        <th scope="col">Цена за шт</th>
                        <th scope="col">Кол-во</th>
                        <th scope="col">Всего</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in items">
                        <td v-html="`${item.title} ${item.id}`" />
                        <td v-html="helper.getPrice(item.price)" />
                        <td v-html="checkInCart(item.id)" />
                        <td v-html="helper.getPrice(item.price * item.count)" />
                    </tr>
                    
                </tbody>

                <tfoot>
                    <tr>
                        <td>Итого:</td>
                        <td v-html="helper.getPrice(getTotalPrice())" />
                        <td v-html="helper.getPrice(getTotalItems(), false)" />
                        <td v-html="helper.getPrice(getTotalSum())" />
                    </tr>
                </tfoot>
            </table>

            <button v-if="items && items.length > 0" @click="sendForm" class="btn btn-success">Оформить заказ</button>
            <div v-else>
                <p>Чтобы оформить заказ, выберите товары из <router-link to="/">каталога</router-link></p>
            </div>
     
        </div>

        <div v-else>
            <p class="text-success">Ваш заказ успешно оформлен! <router-link to="/dashboard">Перейти к управлению заказами</router-link></p>
        </div>
    </div>
</template>