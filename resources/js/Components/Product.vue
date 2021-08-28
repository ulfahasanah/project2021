<template>
     <div class="col-md-3 mb-5">
        <div class="card h-100">
            <div class="card-body">

            <img :src='image' :alt="name" class="card-img-top img-fluid">
            <h6 class="card-title">{{ name.split(':')[0] }} </h6>
                <div class="card-text">Price: {{ currencyRp }}</div>
                <div class="card-text">Stock: {{ qty }}</div>
                <div v-if="loading" class="spinner-border mt-auto mx-auto"></div>
                <div
                class="alert alert-primary"
                variant="success"
                v-if="success"
                >
                Added to cart <i class="fa fa-check"></i>
                </div>
                <inertia-link v-if="canLogin" :href="route('login')" class="text-sm text-gray-700 underline">
                    <button class="btn btn-primary active mt-auto" >Add to cart <i class="fa fa-shopping-cart"></i></button>
                </inertia-link>
                <button v-else class="btn btn-primary active mt-auto" @click="cart(product_id, price)">Add to cart <i class="fa fa-shopping-cart"></i></button>

            </div>
        </div>         
    </div>
</template>

<script>
import { mapActions } from 'vuex'

export default {
    data () {
    return {
      success: false,
      loading: false
    }
  },
    props: ['image', 'name', 'product_id', 'qty', 'price', 'canLogin'],
    computed: {
        currencyRp() {
            return `Rp${this.price.toLocaleString('id-ID')}`
        }
    },
    methods: {
    ...mapActions(['addToCart', 'getCart']),
    cart(product_id, qty) {
        this.loading = true
        const data = {
            product_id,
            qty
        }
        this.addToCart(data)
           .then(result => {
            this.loading = false
            this.success = true

            setTimeout(() => {
                this.success = false
            }, 1000)
            this.getCart()
          })
          .catch(err => {
            this.$store.state.error = err
            this.loading = false
          })
        }
    }
}
</script>