import { createStore } from 'vuex'
import axios from 'axios'

const stores = new createStore({
    state: {
        error: ''
    },
    actions: {
        addToCart (context, data) {
            return axios({
              method: 'POST',
              url: '/cart/add',
              data
            })
          },
    }
})

export default stores