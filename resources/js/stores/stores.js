import { createStore } from 'vuex'
import axios from 'axios'

const stores = new createStore({
    state: {
        error: '',
        cart: [],
    },
    mutations: {
      SET_CART (state, cart) {
        state.cart = cart
      },
      SET_LOADING (state, boolean) {
        state.loading = boolean
      },
      SHOW_ERROR (state, error) {
        state.error = error
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
          context.commit('SET_LOADING', true)
           axios({
            method: 'GET',
            url: '/cart/get'
          })
          .then(({ data }) => {
            const filterFalse = data.filter(el => {
              return el.status === false
            })
            context.commit('SET_CART', filterFalse)
            context.commit('SET_LOADING', false)
          })
          .catch(err => {
            context.commit('SHOW_ERROR', err.response.data.error)
            context.commit('SET_LOADING', false)
          })
        }
    }
})

export default stores