<template>
   <div>
      <inertia-link v-if="login" :href="route('login')" class="text-sm text-gray-700 underline">
            <button class="btn btn-outline-primary ml-5" >Cart <i class="fa fa-shopping-cart"></i> ({{ 1 }})</button>
      </inertia-link>

      <button v-else class="btn btn-outline-primary ml-5" data-toggle="modal" data-target="#shoppingCart">Cart <i class="fa fa-shopping-cart"></i> ({{ 2 }})</button>

   </div>
</template>

<script>

export default {
    props: ['login']
}
</script>