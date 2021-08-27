<template>
    <breeze-authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        Hiii. You're logged in!
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row mb-3">
                <div class="col-md-9">
                </div>
                <div class="col-md-3">
                    <Cart/>
                </div>
            </div>

            <div class="row">
                <Product
                    v-for="item in products"
                    :key="item.id"
                    :product_id="item.id"
                    :name="item.name"
                    :image="item.image_url"
                    :price="item.price"
                    :qty="item.qty"
                />
            </div>
        </div>

        
    </breeze-authenticated-layout>
</template>

<script>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated'
    import Product from '../Components/Product'
    import Cart from '../Components/Cart'

    export default {
        components: {
            BreezeAuthenticatedLayout,
            Product,
            Cart
        },
        props: {
            products: Array
        },
    }
</script>
