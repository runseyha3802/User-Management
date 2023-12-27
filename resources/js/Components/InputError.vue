<script setup>
defineProps({
    message: {
        type: String,
    },
});
</script>

<template>
    <Transition name="fade">
        <div v-if="message">
            <p class="text-sm text-red-600">
                {{ message }}
            </p>
        </div>
    </Transition>
</template>
