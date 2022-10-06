<script setup>
    import GuestLayout from '@/Layouts/GuestLayout.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import Input from '@/Components/Input.vue';
    import { Head, useForm } from '@inertiajs/inertia-vue3';
   
    
    const form = useForm({
        topic: '',
        to: '',
        body:''
    });
     
    const submit = () => {
        form.post(route('email-create'));
    };
    </script>
    
    <template>
        <GuestLayout>
            <Head title="User Register" />
    
            <form @submit.prevent="submit">
                <div>
                    <InputLabel for="topic" value="Topic" />
                    <Input id="topic" type="text" class="mt-1 block w-full" v-model="form.topic" required autofocus autocomplete="topic" max="100" />
                    <InputError class="mt-2" :message="form.errors.topic" />
                </div>
                <div>
                    <InputLabel for="to" value="To" />
                    <Input id="to" type="email" class="mt-1 block w-full" v-model="form.to" required  autocomplete="to" />
                    <InputError class="mt-2" :message="form.errors.to" />
                </div>
                <div>
                    <InputLabel for="body" value="Body" />
                    <textarea id="body" type="text" class="mt-1 block w-full" v-model="form.body" required  autocomplete="body" ></textarea>
                    <InputError class="mt-2" :message="form.errors.body" />
                </div>
                
                <div class="flex items-center justify-end mt-4">
                    <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Send Email
                    </PrimaryButton>
                </div>
            </form>
        </GuestLayout>
    </template>