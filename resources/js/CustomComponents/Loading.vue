<script setup>
import {router} from "@inertiajs/vue3";
import {onUnmounted, ref} from "vue";

const isLoading = ref(false);

const startEventListener = router.on('start', (event) => {
    isLoading.value = true
    console.log(`Starting a visit to ${event.detail.visit.url}`)
})

const finishEventListener = router.on('finish', (event) => {
    isLoading.value = false
})

const update = () => {
    startEventListener()
    finishEventListener()
}


onUnmounted(update)

// onUnmounted(
//     router.on('finish', (event) => {
//         isLoading.value = false
//         console.log(`Finish a visit to ${event.detail.visit.url}`)
//     })
// )

</script>

<template>
    <div>
        <slot :isLoading="isLoading"/>
    </div>
</template>
