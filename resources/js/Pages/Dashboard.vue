<template>
    <breeze-authenticated-layout>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        Hi {{ $attrs.auth.user.name }}! Welcome!
                    </div>
                </div>
            </div>
            <div v-if="message" class="bg-green-200 px-6 py-4 mx-2 my-4 rounded-md text-lg flex items-center mx-auto w-3/4 xl:w-2/4">
                <svg
                    viewBox="0 0 24 24"
                    class="text-green-600 w-5 h-5 sm:w-5 sm:h-5 mr-3"
                    >
                    <path
                        fill="currentColor"
                        d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z"
                        ></path>
                </svg>
                <span class="text-green-800"> Your checkout is success! </span>
            </div>
        </div>

        <div class="container">
            <div class="row mb-3">
                <div class="col-md-9">
                </div>
                <div class="col-md-3">
                    <breeze-cart/>
                </div>
            </div>

            <div class="row">
                <breeze-product
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
    import BreezeProduct from '@/Components/Product'
    import BreezeCart from '@/Components/Cart'
    import { mapState } from 'vuex'

    export default {
        components: {
            BreezeAuthenticatedLayout,
            BreezeProduct,
            BreezeCart
        },
        props: {
            products: Array,
        },
        computed: {
            ...mapState(['message'])
        }
    }
</script>
