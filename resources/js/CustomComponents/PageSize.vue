<script setup>
import CustomDropDown from "@/CustomComponents/CustomDropDown.vue";
import DropdownItem from "@/CustomComponents/DropdownItem.vue";

const emit = defineEmits(['change:pageSize']);

const props = defineProps({
    itemPerPage: {
        type: Number,
        required: true,
    },
});

const pageSizes = [
    10,
    20,
    50,
    100
]

const itemChange = (item) => {
    if(item === props.itemPerPage)
        return

    emit('change:pageSize', item)
}

</script>

<template>
    <CustomDropDown align="left" width="25" class="p-1">
        <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                Show {{ itemPerPage }} entries
                                                <svg
                                                    class="ms-1 -me-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
        </template>

        <template #content>
            <DropdownItem v-for="page in pageSizes" @click="itemChange(page)" :label="page.toString()"/>
        </template>
    </CustomDropDown>
</template>
