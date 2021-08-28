<template>
    <breeze-validation-errors class="mb-4" />

    <form @submit.prevent="submit">
        <div>
            <breeze-label for="name" value="Name" />
            <breeze-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
        </div>

        <div class="mt-4">
            <breeze-label for="email" value="Email" />
            <breeze-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autocomplete="username" />
        </div>

        <div class="mt-4">
            <breeze-label for="password" value="Password" />
            <breeze-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
        </div>

        <div class="mt-4">
            <breeze-label for="password_confirmation" value="Confirm Password" />
            <breeze-input id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
        </div>

         <div>
            <breeze-label for="contact" value="Contact" />
            <breeze-input id="contact" type="text" class="mt-1 block w-full" v-model="form.contact" required autofocus autocomplete="contact" />
        </div>

        <div>
            <breeze-label for="address" value="Address" />
            <breeze-input id="address" type="text" class="mt-1 block w-full" v-model="form.address" required autofocus autocomplete="address" />
        </div>

         <div>
            <breeze-label for="ktp" value="ID Card" />
            <breeze-input id="ktp" type="file" class="mt-1 block w-full"  @input="form.ktp = $event.target.files[0]" required autofocus autocomplete="ktp" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <inertia-link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                Already registered?
            </inertia-link>

            <breeze-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Register
            </breeze-button>
        </div>
    </form>
</template>

<script>
    import BreezeButton from '@/Components/Button'
    import BreezeGuestLayout from '@/Layouts/Guest'
    import BreezeInput from '@/Components/Input'
    import BreezeLabel from '@/Components/Label'
    import BreezeValidationErrors from '@/Components/ValidationErrors'
    import { useForm } from '@inertiajs/inertia-vue3'

    export default {
        layout: BreezeGuestLayout,

        components: {
            BreezeButton,
            BreezeInput,
            BreezeLabel,
            BreezeValidationErrors,
        },
        setup () {
            const form = useForm({
                name: null,
                email: null,
                password: null,
                password_confirmation: null,
                contact: null,
                address: null,
                ktp: null,
            })

            function submit() {
                form.post('/register', {
                    onFinish: () => form.reset('password', 'password_confirmation'),
                })
            }

            return { form, submit }
        }
    }
</script>
