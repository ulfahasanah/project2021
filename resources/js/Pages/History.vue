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
        </div>

        <div class="container">
            <div class="row"  v-for="val in sales" :key="val.id">
                 <div class="card mb-2">
                    <span class="text-dark"> CODE: {{ val.code }}</span>
                    <span class="text-dark"> PRICE: {{ val.total_price }}</span>
                </div>
            </div>
        </div>

        
    </breeze-authenticated-layout>
</template>

<script>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated'

    export default {
        components: {
            BreezeAuthenticatedLayout
        },
        props: {
            sales: Array,
        }
    }
</script>
