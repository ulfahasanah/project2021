<template>
   <div>
      <!-- Cart -->
      <inertia-link v-if="canLogin" :href="route('login')" class="text-sm text-gray-700 underline">
            <button class="btn btn-outline-primary ml-5" >Cart <i class="fa fa-shopping-cart"></i></button>
      </inertia-link>

      <button v-else class="btn btn-outline-primary ml-5" data-toggle="modal" data-target="#shoppingCart">Cart <i class="fa fa-shopping-cart"></i> ({{ cart.length }})</button>

   </div>
</template>

<script>
import { mapActions, mapState } from 'vuex'

export default {
    props: ['canLogin'],
    computed: {
      ...mapState(['cart'])
   },
    methods: {
      ...mapActions(['getCart']),
    },
    created () {
      this.getCart()
   }
}
</script>