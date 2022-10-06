<template>
    <form @submit.prevent="buscar">
        <div class="flex flex-row justify-end space-x-4">
            <InputLabel for="search" value="Filter" class="text-lg"/>
            <Input id="search" type="search" class="mt-1 block" autofocus v-model="form.search"/>
        </div>
    </form>
</template>

<script setup>
import Input from './Input.vue';
import InputLabel from './InputLabel.vue';
import { useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    search: String
})

const form = useForm({
    search:props.search??''
})


const buscar = () => {
    form.get(route('dashboard'), {
        search
    });
};
</script>

<style scoped>
</style>