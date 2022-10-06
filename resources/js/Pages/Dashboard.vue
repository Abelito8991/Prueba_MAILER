<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import Pagination from '../Components/Pagination.vue'
import Filter from '../Components/Filter.vue'

const formDelete = useForm({
    id:''
})

defineProps({
    users: Object,
    sort: Object,
    search: String
});

const edad = (bdate)=>{
    const age = (new Date() - new Date(bdate))/1000/60/60/24/365
    return Math.floor(age)
}

const deleteUser = (id) => {
    console.log(id);
    formDelete.post(route('user.destroy', {id}));
};

</script>

<template>
    <Head title="Admin Dashboard" />
    
    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-row justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Modulo de Usuarios
                </h2>
                <Link :href="route('register')">
                    <button class="border rounded-md p-3 hover:bg-slate-300">
                        Registrar Nuevo Usuario
                    </button>
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div v-if="users" class="bg-white overflow-x-scroll shadow-sm sm:rounded-lg p-10">
                    <Filter class="mt-2 w-full" :search="search"/>
                    <table class=" bg-white border-b border-gray-200 w-full">
                        <tr class="justify-around w-full">
                            <Link class="hover:cursor-pointer hover:bg-slate-300 hover:rounded-md" as="th" :href="route('dashboard', {sort:'id', search})">Id</Link>
                            <Link class="hover:cursor-pointer hover:bg-slate-300 hover:rounded-md" as="th" :href="route('dashboard', {sort:'name', search})">Name</Link>
                            <Link class="hover:cursor-pointer hover:bg-slate-300 hover:rounded-md" as="th" :href="route('dashboard', {sort:'email', search})">Email</Link>
                            <Link class="hover:cursor-pointer hover:bg-slate-300 hover:rounded-md" as="th" :href="route('dashboard', {sort:'phoneNumber', search})">Phone Number</Link>
                            <Link class="hover:cursor-pointer hover:bg-slate-300 hover:rounded-md" as="th" :href="route('dashboard', {sort:'cedula', search})">Cedula</Link>
                            <Link class="hover:cursor-pointer hover:bg-slate-300 hover:rounded-md" as="th" :href="route('dashboard', {sort:'bdate', search})">Birthday</Link>
                            <Link class="hover:cursor-pointer hover:bg-slate-300 hover:rounded-md" as="th" :href="route('dashboard', {sort:'bdate', search})">Age</Link>
                            <Link class="hover:cursor-pointer hover:bg-slate-300 hover:rounded-md" as="th" :href="route('dashboard', {sort:'zipcode', search})">Codigo de Ciudad</Link>
                            <Link class="hover:cursor-pointer hover:bg-slate-300 hover:rounded-md" as="th" :href="route('dashboard', {sort:'country', search})">Pais</Link>
                            <Link class="hover:cursor-pointer hover:bg-slate-300 hover:rounded-md" as="th" :href="route('dashboard', {sort:'state', search})">Estado</Link>
                            <Link class="hover:cursor-pointer hover:bg-slate-300 hover:rounded-md" as="th" :href="route('dashboard', {sort:'city', search})">Ciudad</Link>
                        </tr>
                        <br>
                        <tr v-for="user in users.data" class="justify-around w-full mt-10 text-left">
                            <th>{{user.id}}</th>
                            <th><input class="border-none text-center" type="text" disable :value="user.name"></th>
                            <th>{{user.email}}</th>
                            <th><input class="border-none text-center" type="text" disable :value="user.phoneNumber ?? 'No tiene'"></th>
                            <th>{{user.cedula}}</th>
                            <th><input class="border-none text-center" type="text" disable :value="user.bdate"></th>
                            <th>{{edad(user.bdate)}}</th>
                            <th><input class="border-none text-center" type="text" disable :value="user.zipcode"></th>
                            <th><input class="border-none text-center" type="text" disable :value="user.country"></th>
                            <th><input class="border-none text-center" type="text" disable :value="user.state"></th>
                            <th><input class="border-none text-center" type="text" disable :value="user.city"></th>
                            <button @click="()=>{deleteUser(user.id)}">
                                <svg class="w-4" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                <path style="fill:#B3404A;" d="M334.885,98.803c-1.182,0-2.381-0.142-3.579-0.439c-7.951-1.97-12.801-10.013-10.83-17.965
                                    l5.66-22.846l-99.892-24.752l-5.662,22.846c-1.97,7.951-10.021,12.801-17.965,10.83c-7.951-1.97-12.801-10.014-10.83-17.965
                                    l9.229-37.244c1.97-7.952,10.02-12.8,17.965-10.83L347.67,32.325c3.818,0.946,7.105,3.369,9.136,6.739
                                    c2.031,3.37,2.64,7.408,1.694,11.226l-9.229,37.245C347.597,94.288,341.542,98.803,334.885,98.803z"/>
                                <g>
                                    <polygon style="fill:#F4B2B0;" points="177.957,497.166 111.947,497.166 85.536,153.586 177.957,153.586 	"/>
                                    <polygon style="fill:#F4B2B0;" points="361.805,497.166 295.795,497.166 295.795,153.586 388.217,153.586 	"/>
                                </g>
                                <path style="fill:#B3404A;" d="M445.095,146.789L74.039,54.848c-7.945-1.971-15.995,2.876-17.965,10.83
                                    c-1.971,7.952,2.878,15.995,10.83,17.965l222.414,55.11h-111.36h-6.349H85.535c-4.131,0-8.075,1.724-10.883,4.754
                                    c-2.808,3.032-4.223,7.096-3.907,11.217l26.412,343.581c0.593,7.728,7.038,13.696,14.79,13.696h66.011h46.21
                                    c8.191,0,14.833-6.642,14.833-14.833c0-8.191-6.642-14.833-14.833-14.833h-31.377V168.419h88.169v328.747
                                    c0,8.191,6.642,14.833,14.833,14.833h66.01c7.752,0,14.196-5.967,14.79-13.696l25.491-331.609l35.874,8.89
                                    c1.199,0.297,2.397,0.439,3.579,0.439c6.657,0,12.712-4.515,14.385-11.269C457.897,156.802,453.048,148.759,445.095,146.789z
                                    M101.552,168.419h61.573v313.914h-37.442L101.552,168.419z M348.068,482.333h-37.439V168.419H372.2L348.068,482.333z"/>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                </svg>
                            </button>
                        </tr>
                    </table>
                    <Pagination v-if="users" class="mt-6 w-full" :links="users.links" :sort="sort"/>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
