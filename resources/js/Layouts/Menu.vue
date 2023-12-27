<script setup>
import NavLink from "@/Components/NavLink.vue";

const items = [
    {title: 'Dashboard', route: 'dashboard'},
    {title  : 'User', route: 'user.index'},
    {title: 'Role',route:'role.index'}
]

</script>

<template>
    <NavLink v-for="item in items" :href="route(item.route)" :active="route().current(item.route)">
        {{item.title}}
    </NavLink>
</template>

