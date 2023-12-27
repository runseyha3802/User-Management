<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, router, useForm, usePage} from '@inertiajs/vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

const user = {};
const roles = usePage().props.roles;

const form = useForm({
    name: '',
    username: '',
    email: '',
    password: '',
    password_confirmation: '',
    role: ''
});
const submit = () => {
    form.post(route('user.store'), {
        onError: () => {
            setTimeout(() => form.clearErrors(), 4000);
        }
    });
};
const goBack = () => {
    window.history.back()
};
</script>

<template>
<!--    <Head title="Edit user"/>-->

    <AuthenticatedLayout checked>
        <div class="py-12">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-6 space-y-6">
                <div class="p-2 sm:p-9 bg-white shadow-2xl sm:rounded-lg">
                    <div class="max-w-xl ">
                        <section>

                            <header>
                                <h2 class="text-lg font-medium text-gray-900 text-center">Profile Information</h2>

                                <p class="mt-1 mb-2 text-sm text-gray-600 text-center">
                                    Create new user
                                </p>
                            </header>

                            <form @submit.prevent="submit">

                                <div>
                                    <InputLabel for="username" value="First name"/>

                                    <TextInput
                                        id="username"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.username"
                                        required
                                        autofocus
                                        autocomplete="username"
                                    />

                                    <InputError class="mt-2" :message="form.errors.username"/>
                                </div>

                                <div class="mt-4">
                                    <InputLabel for="name" value="Last name"/>

                                    <TextInput
                                        id="name"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.name"
                                        required
                                        autocomplete="name"
                                    />

                                    <InputError class="mt-2" :message="form.errors.name"/>
                                </div>

                                <div class="mt-4">
                                    <InputLabel for="role" value="Role"/>

                                    <select required id="role" v-model="form.role"
                                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                                        <option v-for="role in roles">{{ role }}</option>
                                    </select>

                                    <InputError class="mt-2" :message="form.errors.role"/>
                                </div>

                                <div class="mt-4">
                                    <InputLabel for="email" value="Email"/>

                                    <TextInput
                                        id="email"
                                        type="email"
                                        class="mt-1 block w-full"
                                        v-model="form.email"
                                        autocomplete="email"
                                        required
                                    />

                                    <InputError class="mt-2" :message="form.errors.email"/>
                                </div>

                                <div class="mt-4">
                                    <InputLabel for="password" value="Password"/>

                                    <TextInput
                                        id="password"
                                        type="password"
                                        class="mt-1 block w-full"
                                        v-model="form.password"
                                        autocomplete="new-password"
                                        required
                                    />

                                    <InputError class="mt-2" :message="form.errors.password"/>
                                </div>

                                <div class="mt-4">
                                    <InputLabel for="password_confirmation" value="Confirm Password"/>

                                    <TextInput
                                        id="password_confirmation"
                                        type="password"
                                        class="mt-1 block w-full"
                                        v-model="form.password_confirmation"
                                        autocomplete="new-password"
                                        required
                                    />

                                    <InputError class="mt-2" :message="form.errors.password_confirmation"/>
                                </div>

                                <div class="flex items-center justify-end mt-4">

                                    <SecondaryButton @click="goBack"> Back </SecondaryButton>

                                    <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }"
                                                   :disabled="form.processing">
                                        Create
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
