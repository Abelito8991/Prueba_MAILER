<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Input from '@/Components/Input.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import { ref, onBeforeMount } from 'vue';
import axios from 'axios';

onBeforeMount(async()=>{
    await getToken()
    updateCountries()
})

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    phoneNumber: '',
    cedula: '',
    bdate: '',
    zipcode: '',
    country: '',
    state: '',
    city: '',
});

const country = ref([])
const state = ref([])
const city = ref([])
const tokenCountries = ref('')

const getToken = async ()=>{
    const res = await axios.get("https://www.universal-tutorial.com/api/getaccesstoken", {
        headers: {
            "Accept": "application/json",
            "api-token": "EtRRxNVEuD30iWlZBoN3mY_A8MYNyny76Pi2IP1xkzTDo67Fi2Ty99E1CoMr12tMdLg",
            "user-email": "estevez8991@gmail.com"
        }
    });

    tokenCountries.value = res.data.auth_token
}

const updateCountries = async ()=>{
    const countries = await axios.get("https://www.universal-tutorial.com/api/countries/", {
        headers: {
            "Authorization": "Bearer " + tokenCountries.value,
            "Accept": "application/json"
        }
    })
    country.value = countries.data
}
const updateStates = async ()=>{
    const states = await axios.get("https://www.universal-tutorial.com/api/states/"+form.country, {
        headers: {
            "Authorization": "Bearer " + tokenCountries.value,
            "Accept": "application/json"
        }
    })
    console.log(states);
    state.value = states.data
}
const updateCities = async ()=>{
    const cities = await axios.get("https://www.universal-tutorial.com/api/cities/"+form.state, {
        headers: {
            "Authorization": "Bearer " + tokenCountries.value,
            "Accept": "application/json"
        }
    })
    city.value = cities.data
}

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="User Register" />

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Name" />
                <Input id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" max="100" />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />
                <Input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autocomplete="username" />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />
                <Input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />
                <Input id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div>
                <InputLabel for="cedula" value="Cedula" />
                <Input id="cedula" type="text" class="mt-1 block w-full" v-model="form.cedula" required autocomplete="cedula" max="11"/>
                <InputError class="mt-2" :message="form.errors.cedula" />
            </div>

            <div>
                <InputLabel for="phoneNumber" value="Phone Number" />
                <Input id="phoneNumber" type="tel" class="mt-1 block w-full" v-model="form.phoneNumber" autocomplete="phoneNumber" min="10" />
                <InputError class="mt-2" :message="form.errors.phoneNumber" />
            </div>
            
            <div>
                <InputLabel for="bdate" value="Birthday" />
                <Input id="bdate" type="date" class="mt-1 block w-full" v-model="form.bdate" required autocomplete="bdate"/>
                <InputError class="mt-2" :message="form.errors.bdate" />
            </div>
            
            <div>
                <InputLabel for="zipcode" value="Zip Code" />
                <Input id="zipcode" type="Number" class="mt-1 block w-full" v-model="form.zipcode" required autocomplete="zipcode" />
                <InputError class="mt-2" :message="form.errors.zipcode" />
            </div>
            
            <div>
                <InputLabel for="country" value="Country" />
                <select id="country" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" v-model="form.country" required autocomplete="country" :onchange="updateStates">
                    <option v-for="pais in country" :value="pais.country_name">{{pais.country_name}}</option>
                </select>
                <InputError class="mt-2" :message="form.errors.country" />
            </div>
            <div>
                <InputLabel for="state" value="State" />
                <select id="state" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" v-model="form.state" required autocomplete="state" :onchange="updateCities">
                    <option v-for="estado in state" :value="estado.state_name">{{estado.state_name}}</option>
                </select>
                <InputError class="mt-2" :message="form.errors.state" />
            </div>
            <div>
                <InputLabel for="city" value="City" />
                <select id="city" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" v-model="form.city" autocomplete="city">
                    <option v-for="ciudad in city" :value="ciudad.city_name">{{ciudad.city_name}}</option>
                </select>
                <InputError class="mt-2" :message="form.errors.city" />
            </div>
            
            <div class="flex items-center justify-end mt-4">
                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
