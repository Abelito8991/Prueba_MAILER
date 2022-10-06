<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, Link } from '@inertiajs/inertia-vue3';

defineProps({
    mails: Object

})

</script>
    
<template>
    
    <Head title="User Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-row justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Modulo de Correo
                </h2>
                <Link :href="route('email-create')">
                    <button class="border rounded-md p-3 hover:bg-slate-300">
                        Enviar Nuevo Correo
                    </button>
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <table class=" bg-white border-b w-full border-gray-200">
                        <tr class="justify-around w-full">
                            <Link class="hover:cursor-pointer hover:bg-slate-300 hover:rounded-md" as="th" :href="route('dashboard')">Id</Link>
                            <Link class="hover:cursor-pointer hover:bg-slate-300 hover:rounded-md" as="th" :href="route('dashboard')">From</Link>
                            <Link class="hover:cursor-pointer hover:bg-slate-300 hover:rounded-md" as="th" :href="route('dashboard')">To</Link>
                            <Link class="hover:cursor-pointer hover:bg-slate-300 hover:rounded-md" as="th" :href="route('dashboard')">Topic</Link>
                            <Link class="hover:cursor-pointer hover:bg-slate-300 hover:rounded-md" as="th" :href="route('dashboard')">Status</Link>
                        </tr>
                        <br>
                        <tr v-for="mail in mails" class="justify-around w-full mt-10 text-center space-y-2">
                            <th>{{mail.id}}</th>
                            <th>{{mail.from}}</th>
                            <th>{{mail.to}}</th>
                            <th>{{mail.topic}}</th>
                            <th :class="(mail.status=='Enviando')? 'bg-red-300' : 'bg-green-400'">{{mail.status}}</th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>