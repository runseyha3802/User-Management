<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import {useForm} from '@inertiajs/vue3';
import {ref} from "vue";
import InputError from "@/Components/InputError.vue";

const props = defineProps({
    label: {
        type: String,
        default: 'Delete',
    },
    title: {
        type: String,
        default: 'Are you sure you want to delete?',
    },
    description: {
        type: String,
        default: 'Once this record is deleted, all of its resources and data will be permanently deleted',
    },
    deleteRoute: {
        type: String,
        required: true
    },
    onSuccess: {
        type: Function
    },
    onError: {
        type: Function
    },
});

const confirmingDeletion = ref(false);

const form = useForm({});
const confirmUserDeletion = () => confirmingDeletion.value = true

const deleteUser = () => {
    form.delete(props.deleteRoute, {
        preserveScroll: true,
        onSuccess: () => {
            closeModal()
            props.onSuccess()
        },
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    if(!form.processing) {
        confirmingDeletion.value = false;
        form.errors = []
        form.reset();
    }
};
</script>

<template>
        <DangerButton @click="confirmUserDeletion">Delete</DangerButton>
        <Modal :show="confirmingDeletion" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900"> {{ title }} </h2>

                <p class="mt-1 text-sm text-gray-600">{{ description }}</p>

                <div class="mt-6">
                    <InputError v-for="error in Object.values(form.errors)" :message="error" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

                    <DangerButton
                        class="ms-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteUser"
                    >
                        {{ label }}
                    </DangerButton>
                </div>
            </div>
        </Modal>
</template>
