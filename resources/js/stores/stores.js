import { createStore } from 'vuex'
import axios from 'axios'

const stores = new createStore({
    state: {
        message: '',
        cart: [],
    },
    mutations: {
      SET_CART (state, cart) {
        state.cart = cart
      },
      SHOW_MESSAGE (state, message) {
        state.message = message
      }
    },
    actions: {
        addToCart (context, data) {
            return axios({
              method: 'POST',
              url: '/cart/add',
              data
            })
          },
        getCart(context) {
           axios({
            method: 'GET',
            url: '/cart/get'
          })
          .then(({ data }) => {
            const filterFalse = data.filter(el => {
              return el.status === false
            })
            context.commit('SET_CART', filterFalse)
          })
          .catch(err => {
          })
        },
        updateCart(context, data) {
          return axios({
            method: 'PUT',
            url: `/cart/update/${data.id}`,
            data,
          })
        },
        deleteCart(context, id){
          return axios({
            method: 'DELETE',
            url: `/cart/${id}`
          })
        },
        checkout(context, data){
          return axios({
            method: 'POST',
            url: '/cart/checkout',
            data,
          })
        },
        setMessage(context, data) {
          context.commit('SHOW_MESSAGE', data)
        }
    }
})

export default stores