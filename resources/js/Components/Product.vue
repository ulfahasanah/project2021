<template>
     <div class="col-md-3 mb-5">
        <div class="card h-100">
            <div class="card-body">

            <img :src='image' :alt="name" class="card-img-top img-fluid">
            <h6 class="card-title">{{ name.split(':')[0] }} </h6>
                <div class="card-text">Price: {{ currencyRp }}</div>
                <div class="card-text">Stock: {{ qty }}</div>
            </div>
        </div>         
    </div>
</template>

<script>

export default {
    props: ['image', 'name', 'product_id', 'qty', 'price'],
    computed: {
        currencyRp() {
            return `Rp${this.price.toLocaleString('id-ID')}`
        }
    },
}
</script>