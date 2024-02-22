import { defineStore } from 'pinia'

export const useCartStore = defineStore('cart', {
  state: () => ({
    cart: [],
    selected: [],
  }),
  actions: {
    setCount(data, count) {
      let index = this.cart.findIndex(x => x.id === data.id)

      if(index >= 0) {
        this.cart[index].count = count
      } else {
        data.count = count
        this.cart.push(data)
      }
      
    },

    addItem(data) {
      let index = this.cart.findIndex(x => x.id === data.id)

      if(index >= 0) {
        this.cart[index] = data
      } else {
        this.cart.push(data)
      }
    },

    removeItem(id) {
      let index = this.selected.findIndex(x => x.id === id)

      if(index >= 0) {
        this.selected.splice(index, 1)
      }
    },

    selectItem(data, count) {
      let index = this.selected.findIndex(x => x.id === data.id)
      this.setCount(data, count)
      data.count = count
      if(index >= 0) {
        this.selected[index] = data;
      } else {
        this.selected.push(data)
      }
    },

    deleteItems() {
      this.selected = this.cart = []
    }
  },
  persist: true,
})