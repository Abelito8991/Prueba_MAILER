<template>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10">
                <Filter class="mt-2 w-full"/>
                <table class=" bg-white border-b border-gray-200 w-full">
                    <tr class="justify-around w-full">
                        <Link class="hover:cursor-pointer hover:bg-slate-300 hover:rounded-md" as="th" :href="route('dashboard', {sort:'id'})">Id</Link>
                        <Link class="hover:cursor-pointer hover:bg-slate-300 hover:rounded-md" as="th" :href="route('dashboard', {sort:'name'})">Name</Link>
                        <Link class="hover:cursor-pointer hover:bg-slate-300 hover:rounded-md" as="th" :href="route('dashboard', {sort:'email'})">Email</Link>
                        <Link class="hover:cursor-pointer hover:bg-slate-300 hover:rounded-md" as="th" :href="route('dashboard', {sort:'phoneNumber'})">Phone Number</Link>
                        <Link class="hover:cursor-pointer hover:bg-slate-300 hover:rounded-md" as="th" :href="route('dashboard', {sort:'cedula'})">Cedula</Link>
                        <Link class="hover:cursor-pointer hover:bg-slate-300 hover:rounded-md" as="th" :href="route('dashboard', {sort:'bdate'})">Birthday</Link>
                        <Link class="hover:cursor-pointer hover:bg-slate-300 hover:rounded-md" as="th" :href="route('dashboard', {sort:'bdate'})">Age</Link>
                        <Link class="hover:cursor-pointer hover:bg-slate-300 hover:rounded-md" as="th" :href="route('dashboard', {sort:'zipcode'})">Codigo de Ciudad</Link>
                        <Link class="hover:cursor-pointer hover:bg-slate-300 hover:rounded-md" as="th" :href="route('dashboard', {sort:'country'})">Pais</Link>
                        <Link class="hover:cursor-pointer hover:bg-slate-300 hover:rounded-md" as="th" :href="route('dashboard', {sort:'state'})">Estado</Link>
                        <Link class="hover:cursor-pointer hover:bg-slate-300 hover:rounded-md" as="th" :href="route('dashboard', {sort:'city'})">Ciudad</Link>
                    </tr>
                    <br>
                    <tr v-for="user in users.data" class="justify-around w-full mt-10 text-left">
                        <th>{{user.id}}</th>
                        <th>{{user.name}}</th>
                        <th>{{user.email}}</th>
                        <th>{{user.phoneNumber ?? 'No tiene'}}</th>
                        <th>{{user.cedula}}</th>
                        <th>{{user.bdate}}</th>
                        <th>{{edad(user.bdate)}}</th>
                        <th>{{user.zipcode}}</th>
                        <th>{{user.country}}</th>
                        <th>{{user.state}}</th>
                        <th>{{user.city}}</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import Filter from '../Components/Filter.vue'

defineProps({
    users: Object,
    sort: Object
});

const edad = (bdate)=>{
    const age = (new Date() - new Date(bdate))/1000/60/60/24/365
    return Math.floor(age)
}

</script>

<style scoped>
</style>