<script setup>
import InputLabel from "@/Components/InputLabel.vue";

defineProps({
    label: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <InputLabel
        :value="label"
        class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
        <slot />
    </InputLabel>
</template>
