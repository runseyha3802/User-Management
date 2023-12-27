<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, Link, useForm, usePage} from '@inertiajs/vue3';
import SecondaryButton from "@/Components/SecondaryButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const user = {};
const roles = usePage().props.roles;
const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};

</script>

<template>

        <div class="py-12">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-6 space-y-6">
                <div class="p-2 sm:p-9 bg-white shadow-2xl sm:rounded-lg">
                    <div class="max-w-xl ">
                        <section>

                            <header>
                                <h2 class="text-lg font-medium text-gray-800 text-center">Register user</h2>
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

                                        <option v-for="role in roles">
                                            {{ role }}

                                        </option>
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

                                    <div class="flex items-center justify-end mt-4">
                                        <Link
                                            :href="route('login')"
                                            class="underline text-sm text-blue-500 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                        >
                                            Already registered?
                                        </Link>
                                    </div>

                                    <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }"
                                                   :disabled="form.processing">
                                       Register
                                    </PrimaryButton>
                                </div>
                            </form>

                        </section>
                    </div>
                </div>
            </div>
    </div>
<!--<template>-->
<!--    <GuestLayout>-->
<!--        <Head title="Register Acc" />-->

<!--        <form @submit.prevent="submit">-->

<!--            <div>-->
<!--                <InputLabel for="username" value="Username"/>-->

<!--                <TextInput-->
<!--                    id="username"-->
<!--                    type="text"-->
<!--                    class="mt-1 block w-full"-->
<!--                    v-model="form.username"-->
<!--                    required-->
<!--                    autofocus-->
<!--                    autocomplete="username"-->
<!--                />-->

<!--                <InputError class="mt-2" :message="form.errors.username"/>-->
<!--            </div>-->


<!--            <div>-->
<!--                <InputLabel for="name" value="Name" />-->

<!--                <TextInput-->
<!--                    id="name"-->
<!--                    type="text"-->
<!--                    class="mt-1 block w-full"-->
<!--                    v-model="form.name"-->
<!--                    required-->
<!--                    autofocus-->
<!--                    autocomplete="name"-->
<!--                />-->

<!--                <InputError class="mt-2" :message="form.errors.name" />-->
<!--            </div>-->

<!--            <div class="mt-4">-->
<!--                <InputLabel for="email" value="Email" />-->

<!--                <TextInput-->
<!--                    id="email"-->
<!--                    type="email"-->
<!--                    class="mt-1 block w-full"-->
<!--                    v-model="form.email"-->
<!--                    required-->
<!--                    autocomplete="username"-->
<!--                />-->

<!--                <InputError class="mt-2" :message="form.errors.email" />-->
<!--            </div>-->

<!--            <div class="mt-4">-->
<!--                <InputLabel for="role" value="Role"/>-->

<!--                <select required id="role" v-model="form.role"-->
<!--                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">-->
<!--                    <option v-for="role in roles">{{ role }}</option>-->
<!--                </select>-->

<!--                <InputError class="mt-2" :message="form.errors.role"/>-->
<!--            </div>-->

<!--            <div class="mt-4">-->
<!--                <InputLabel for="password" value="Password" />-->

<!--                <TextInput-->
<!--                    id="password"-->
<!--                    type="password"-->
<!--                    class="mt-1 block w-full"-->
<!--                    v-model="form.password"-->
<!--                    required-->
<!--                    autocomplete="new-password"-->
<!--                />-->

<!--                <InputError class="mt-2" :message="form.errors.password" />-->
<!--            </div>-->

<!--            <div class="mt-4">-->
<!--                <InputLabel for="password_confirmation" value="Confirm Password" />-->

<!--                <TextInput-->
<!--                    id="password_confirmation"-->
<!--                    type="password"-->
<!--                    class="mt-1 block w-full"-->
<!--                    v-model="form.password_confirmation"-->
<!--                    required-->
<!--                    autocomplete="new-password"-->
<!--                />-->

<!--                <InputError class="mt-2" :message="form.errors.password_confirmation" />-->
<!--            </div>-->

<!--            <div class="flex items-center justify-end mt-4">-->
<!--                <Link-->
<!--                    :href="route('login')"-->
<!--                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"-->
<!--                >-->
<!--                    Already registered?-->
<!--                </Link>-->

<!--                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">-->
<!--                    Register-->
<!--                </PrimaryButton>-->
<!--            </div>-->
<!--        </form>-->
<!--    </GuestLayout>-->
</template>
