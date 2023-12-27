<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, router, useForm, usePage, useRemember} from '@inertiajs/vue3';
import PageSize from "@/CustomComponents/PageSize.vue";
import Delete from "@/CustomComponents/Delete.vue";
import LinkWarningButton from "@/CustomComponents/LinkWarningButton.vue";
import {COLUMN_TYPE, getValueFromColumn} from "@/Helper/TableHelper.jsx";
import {computed, ref, watch} from "vue";
import LinkButton from "@/CustomComponents/LinkButton.vue";
import {TailwindPagination} from 'laravel-vue-pagination';

const page = usePage()
const users = computed(() => page.props.users)

// param
const query = useRemember(ref(''), 'query')
const size = useRemember(ref(10), 'size')
const loading = ref(false)


const form = useForm('userFilter', {
    query: '',
    size: 10,
    page: 1
})


watch(form, (newForm) => {
    router.visit(route('user.index'), {
        method: 'get',
        data: {query: newForm.query, page: newForm.page, size: newForm.size},
        replace: true,
        preserveState: true,
        preserveScroll: true,
        only: ['users'],
        onBefore: (visit) => loading.value = true,
        onFinish: visit => loading.value = false,
    })

    query.value = newForm.query
    size.value = newForm.size
})

const columns = [
    {
        data: 'id',
        title: 'No',
        type: COLUMN_TYPE.NO
    },
    {
        data: 'username',
        title: 'First namae',
        type: COLUMN_TYPE.STRING
    },
    {
        data: 'name',
        title: 'Last name',
        type: COLUMN_TYPE.STRING
    },
    {
        data: 'email',
        title: 'Email',
        type: COLUMN_TYPE.STRING
    },
    {
        data: 'roles',
        key: 'name',
        title: 'Role',
        type: COLUMN_TYPE.LIST
    },
    {
        data: 'created_at',
        title: 'Created at',
        type: COLUMN_TYPE.DATETIME
    },
]

const onButtonSearchClick = () => {
    form.query = query.value
    form.page = 1
}

const pageSizeChange = (pageSize) => {
    form.reset({query, page})
    form.size = pageSize
}

const onPaginationChange = (page) => {
    if (!page)
        page = 1

    form.page = page
}

</script>

<template>
    <Head title="User"/>

    <AuthenticatedLayout checked>
        <div class="py-10">
            <div class="w-auto mx-auto sm:px-6 lg:px-8">

                <div class="bg-white shadow-sm sm:rounded-lg">

                    <div class="p-6 text-gray-900">

                        <div
                            class="relative items-center block w-full dark:bg-with-200 dark:border-gray-800 ">

                            <div :class="{ 'opacity-50' : loading }">

<!--                                <button id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">-->
<!--                                    <svg id="theme-toggle-dark-icon" class=" w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>-->
<!--                                    <svg id="theme-toggle-light-icon" class=" w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>-->
<!--                                </button>-->

                                <div class="grid grid-flow-col auto-cols-4 md:auto-cols-4 mb-4">
                                    <div class="flex items-center justify-start">
                                        <div class="flex min-w-0 sm:min-w-60 md:min-w-80 lg:min-w-80 xl:min-w-80">
                                            <div class="relative w-full">
                                                <div
                                                    class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                                         aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                         fill="none" viewBox="0 0 18 20">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                              stroke-linejoin="round" stroke-width="2"
                                                              d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm12 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0V6a3 3 0 0 0-3-3H9m1.5-2-2 2 2 2"/>
                                                    </svg>
                                                </div>
                                                <input v-model="query" id="simple-search"
                                                       class="border border-gray-300 text-gray-800 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-with-200 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                       placeholder="Search" required>
                                            </div>
                                            <button @click="onButtonSearchClick"
                                                    class="p-2.5 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                <svg class="w-4 h-4" aria-hidden="true"
                                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                          stroke-linejoin="round" stroke-width="2"
                                                          d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                                </svg>
                                                <span class="sr-only">Search</span>
                                            </button>
                                            <button @click="form.reset()"
                                                    class="p-2.5 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                <svg class="w-4 h-4" aria-hidden="true"
                                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                          stroke-linejoin="round" stroke-width="2"
                                                          d="M16 1v5h-5M2 19v-5h5m10-4a8 8 0 0 1-14.947 3.97M1 10a8 8 0 0 1 14.947-3.97"/>
                                                </svg>
                                                <span class="sr-only">Reset</span>
                                            </button>
                                        </div>

                                    </div>

                                    <div class="flex items-center justify-end bg-blend-color-burn">
                                        <LinkButton :href="route('user.create')">Add new</LinkButton>
                                    </div>
                                </div>

                                <div class="flex md:justify-center w-full overflow-auto">
                                    <table class="table w-full">
                                        <thead>
                                        <tr>
                                            <th v-for="column in columns" class="bg-blue-50 text-left px-8 py-3">{{
                                                    column.title
                                                }}
                                            </th>
                                            <th class="bg-blue-50 text-left px-8 py-3">Action</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <tr v-for="(user, key) in users.data">
                                            <td v-for="column in columns" class="px-8 py-2.5">
                                                {{ getValueFromColumn(column, user, key) }}
                                            </td>
                                            <td class="">
                                                <LinkWarningButton class="mr-3" :href="route('user.edit', {id: user.id})">Edit
                                                </LinkWarningButton>
                                                <Delete :delete-route="route('user.destroy', {id: user.id})"/>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>

                                </div>

                                <div class="grid grid-flow-col auto-cols-2 md:auto-cols-2 mt-5">
                                    <div class="flex items-center justify-start">
                                        <PageSize @change:page-size="pageSizeChange" :item-per-page="form.size"/>
                                    </div>

                                    <div class="flex items-center justify-end">
                                        <TailwindPagination
                                            :data="users"
                                            @pagination-change-page="onPaginationChange"
                                        />
                                    </div>
                                </div>

                            </div>


                            <div v-show="loading" role="status"
                                 class="absolute -translate-x-1/2 -translate-y-1/2 top-2/4 left-1/2">
                                <svg aria-hidden="true"
                                     class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                     viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                        fill="currentColor"/>
                                    <path
                                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                        fill="currentFill"/>
                                </svg>
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>


    </AuthenticatedLayout>
</template>


<style>
</style>
