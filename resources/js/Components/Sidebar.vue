<script setup>
import NavLink from "@/Components/NavLink.vue";
import {
    Home,
    UsersRound,
    Warehouse,
    FileText,
    SquareUserRound,
    BriefcaseBusiness,
    LampDesk,
    LogOut,
    CircleUser,
} from "lucide-vue-next";
import { router } from "@inertiajs/vue3";
defineProps({
    isSidebarOpen: true,
});

const logout = () => {
    router.post("/logout");
};
</script>

<template>
    <nav class="grid items-start pl-4 text-sm font-medium" v-if="isSidebarOpen">
        <NavLink href="/dashboard" :icon="Home"> Dashboard </NavLink>
        <!-- <NavLink href="/users" :icon="UsersRound"> Users </NavLink> -->
        <NavLink href="/employees" :icon="SquareUserRound"> Employees </NavLink>
        <NavLink href="/documents" :icon="FileText"> Documents </NavLink>

        <!-- <NavLink href="/archives/users" :icon="FileText"> Users</NavLink> -->
        <NavLink href="/archives/employees" :icon="SquareUserRound">
            Archived Employees
        </NavLink>
        <NavLink href="/archives/documents" :icon="FileText">
            Archived Documents
        </NavLink>
        <NavLink href="/profiles" :icon="CircleUser"> Profile </NavLink>
        <button
        @click="logout"
            class="text-white flex items-center gap-3 rounded-l-lg px-3 py-2 text-muted-foreground transition-all hover:text-primary"
        >
            <LogOut class="size-4" />
            Logout
        </button>
    </nav>
</template>
