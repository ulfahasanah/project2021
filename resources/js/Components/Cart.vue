<template>
   <div>
      <!-- Cart -->
      <inertia-link v-if="canLogin" :href="route('login')" class="text-sm text-gray-700 underline">
            <button class="btn btn-outline-primary ml-5">Cart <i class="fa fa-shopping-cart"></i></button>
      </inertia-link>
      <button v-else @click="openModal()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-3 rounded my-3 flex">
          Cart ({{ cart.length }})
        <ShoppingCartIcon class="h-5 w-5 text-blue-100"/>
      </button>
                  <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="isOpen">
                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div class="fixed inset-0 transition-opacity">
                            <div class="absolute inset-0 bg-gray-500 opacity-75">

                            </div>
                        </div>

                        <!-- This element is to trick the browser into centering the modal contents. -->
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
                        <div class="inline-block align-top bg-white rounded-lg text-lef shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                            <table class="table text-gray-400 border-none space-y-6 text-sm table-auto">
                                <thead class="bg-gray-100 text-gray-500">
                                    <tr>
                                        <th class="p-2 text-center">Name</th>
                                        <th class="p-2">Price</th>
                                        <th class="p-2 text-center">Amount</th>
                                        <th class="p-2 w-1/4 text-center">Total Price</th>
                                        <th class="p-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr  v-for="item in cart" :key="item.id" class="bg-gray-100">
                                        <td class="p-3">
                                            <div class="flex align-items-center">
                                                <div class="ml-3">
                                                    <div class="text-gray-500">{{item.product.name}}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-3">
                                            <div class="text-gray-500">{{item.product.price}}</div>
                                        </td>
                                        <td class="p-3 font-bold">
                                            <div class="flex text-center">
                                                <button v-if="item.product.qty == item.qty" disabled class="disabled:opacity-50">
                                                    <PlusCircleIcon class="h-10 w-6 text-blue-500"/>
                                                </button>
                                                 <button v-else @click="updateQuantity(item.id, 'plus')">
                                                    <PlusCircleIcon class="h-10 w-6 text-blue-500"/>
                                                </button>
                                                <input readonly type="number"
                                                    class="text-gray-500"
                                                    @change="updateQuantity(item.id, $event)"
                                                    :min="1" 
                                                    :max="item.product.qty"
                                                    :value="+item.qty"/>
                                                <button  v-if="item.qty == 1" disabled class="disabled:opacity-50">
                                                    <MinusCircleIcon class="h-10 w-6 text-blue-500"/>
                                                </button>
                                                <button  v-else @click="updateQuantity(item.id, 'minus')">
                                                    <MinusCircleIcon class="h-10 w-6 text-blue-500"/>
                                                </button>
                                            </div>
                                        </td>
                                        <td class="p-3 text-center">
                                            <span class="bg-green-400 text-gray-50 rounded-md px-2">Rp{{(item.product.price * item.qty).toLocaleString()}}</span>
                                        </td>
                                        <td class="p-3 ">
                                            <button>
                                                <TrashIcon class="h-10 w-7 text-blue-500" @click="deleteProduct(item.id)"/>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr class="bg-gray-100">
                                        <td colspan="3" class="p-2 text-gray-500 text-right">Total :</td>
                                        <td class="p-2">
                                            <span class="bg-green-400 text-gray-50 rounded-md px-2">Rp{{total().toLocaleString()}}</span>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr class="bg-gray-100">
                                        <td colspan="3" class="p-2 text-gray-500 text-right">Total Discount :</td>
                                        <td class="p-2">
                                            <span class="bg-green-400 text-gray-50 rounded-md px-2">Rp {{totalDiscount().toLocaleString()}}</span>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr class="bg-gray-100">
                                        <td colspan="3" class="p-2 text-gray-500 text-right">Grand Total :</td>
                                        <td class="p-2">
                                            <span class="bg-green-400 text-gray-50 rounded-md px-2">Rp {{ (total() - totalDiscount()).toLocaleString() }}</span>
                                        </td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">

                                <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                                    <button @click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                        Cancel
                                    </button>
                                    <button @click="buy()" type="button" class="mx-2 px-4 py-2 bg-blue-600 rounded-md text-white outline-none focus:ring-4 shadow-lg transform active:scale-y-75 transition-transform flex">
                                        Buy
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>        
     
   

   </div>
</template>

<script>
import { mapActions, mapState } from 'vuex'
import BreezeApplicationLogo from '@/Components/ApplicationLogo'
import BreezeDropdown from '@/Components/Dropdown'
import BreezeDropdownLink from '@/Components/DropdownLink'
import BreezeNavLink from '@/Components/NavLink'
import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink'
import { ShoppingCartIcon, PlusCircleIcon, MinusCircleIcon, TrashIcon } from '@heroicons/vue/outline'

export default {
   components: {
            BreezeApplicationLogo,
            BreezeDropdown,
            BreezeDropdownLink,
            BreezeNavLink,
            BreezeResponsiveNavLink,
            ShoppingCartIcon,
            PlusCircleIcon,
            MinusCircleIcon,
            TrashIcon
   },
   data() {
      return {
         isOpen: false,
         total_discount: 0,
         total_paid: 0
      }
   },
    props: ['canLogin'],
    computed: {
      ...mapState(['cart'])
   },
    methods: {
      ...mapActions(['getCart', 'updateCart', 'deleteCart', 'checkout', 'setMessage']),
      openModal() {
         this.isOpen = true
      },
      closeModal() {
         this.isOpen = false
      },
      updateQuantity(id, update) {
          let qty = typeof update == 'string' ? update : update.target.value
          const data = {
              id,
              data: qty
          }
         this.updateCart(data)
         this.getCart()
      },  
      total () {
        return this.cart.reduce((accumulation, currentValue) => accumulation + (currentValue.product.price * currentValue.qty), 0)
      },
      totalDiscount() {
            let discount;
            const totalPrice = this.total()

            if(this.cart[0].user.discount_type == 'percentage') {
                discount = totalPrice * parseFloat(this.cart[0].user.discount)/100
            } else if(this.cart[0].user.discount_type == 'fix') {
                discount = +this.cart[0].user.discount
            } else {
                discount = 0
            }
            
            this.total_discount = discount
            this.total_paid = this.total() - discount
            return discount
      },
     deleteProduct(id){
         this.deleteCart(id)
         this.getCart()
     },
     buy(){
         const cart = {
             cart: this.cart,
             total_paid: this.total_paid,
             total_discount: this.total_discount
         }
         this.checkout(cart)
          .then(result => {
            this.setMessage(true)
          })
         this.isOpen = false
         this.getCart()
         this.$inertia.visit('dashboard');
         setTimeout(() => {
             this.setMessage('')
         }, 3000);

     }

    },
    created () {
      this.getCart()
   }
}
</script>