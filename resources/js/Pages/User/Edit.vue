<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, router, useForm, usePage} from '@inertiajs/vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

const user = usePage().props.user;
const roles = usePage().props.roles;

const form = useForm({...user, role: user.roles[0].name});

const submit = () => {
    form.put(route('user.update', {id: user.id}), {
        onFinish: () => form.reset(),
    });
};

const goBack = () => {
    window.history.back()
};
</script>

<template>
    <Head title="Edit user"/>

    <AuthenticatedLayout checked>
        <div class="py-12">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-6 space-y-6">
                <div class="p-2 sm:p-9 bg-white shadow-2xl sm:rounded-lg">
                    <div class="max-w-xl ">
                        <section>

                            <form @submit.prevent="submit">
                                <div>
                                    <InputLabel for="username" value="Username" />

                                    <TextInput
                                        id="username"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.username"
                                        required
                                        autofocus
                                        autocomplete="username"
                                    />

                                    <InputError class="mt-2" :message="form.errors.username" />
                                </div>

                                <div>
                                    <InputLabel for="name" value="Name" />

                                    <TextInput
                                        id="name"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.name"
                                        required
                                        autofocus
                                        autocomplete="name"
                                    />

                                    <InputError class="mt-2" :message="form.errors.name" />
                                </div>

                                <div class="mt-4">
                                    <InputLabel for="role" value="Role" />

                                    <select id="role" required v-model="form.role" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                                        <option v-for="role in roles">{{role}}</option>
                                    </select>

                                    <InputError class="mt-2" :message="form.errors.role" />
                                </div>

                                <div class="mt-4">
                                    <InputLabel for="email" value="Email" />

                                    <TextInput
                                        id="email"
                                        type="email"
                                        class="mt-1 block w-full"
                                        v-model="form.email"
                                        required
                                        autocomplete="username"
                                    />

                                    <InputError class="mt-2" :message="form.errors.email" />
                                </div>

                                <div class="flex items-center justify-end mt-4">

                                    <SecondaryButton @click="goBack"> Back </SecondaryButton>

                                    <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                        save
                                    </PrimaryButton>
                                </div>
                            </form>

                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

</template>


<style>
</style>
