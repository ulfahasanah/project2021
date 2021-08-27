<template>
     <div class="col-md-3 mb-5">
        <div class="card h-100">
            <div class="card-body">

            <img :src='image' :alt="name" class="card-img-top img-fluid">
            <h6 class="card-title">{{ name.split(':')[0] }} </h6>
                <div class="card-text">Price: {{ currencyRp }}</div>
                <div class="card-text">Stock: {{ qty }}</div>

                <inertia-link v-if="canLogin" :href="route('login')" class="text-sm text-gray-700 underline">
                    <button class="btn btn-primary active mt-auto" >Add to cart <i class="fa fa-shopping-cart"></i></button>
                </inertia-link>
                <button v-else class="btn btn-primary active mt-auto" @click="addToCart(product_id, price)">Add to cart <i class="fa fa-shopping-cart"></i></button>

            </div>
        </div>         
    </div>
</template>

<script>

export default {
    props: ['image', 'name', 'product_id', 'qty', 'price', 'canLogin'],
    computed: {
        currencyRp() {
            return `Rp${this.price.toLocaleString('id-ID')}`
        }
    },
    methods: {
    addToCart (product_id, qty) {
        const data = {
            product_id,
            qty
        }
            this.$inertia.post(route('add_to_cart'), data)
        }
    }
}
</script>