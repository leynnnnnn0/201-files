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
} from "lucide-vue-next";
</script>

<template>
    <nav class="grid items-start pl-4 text-sm font-medium">
        <NavLink href="/dashboard" :icon="Home"> Dashboard </NavLink>
        <!-- <NavLink href="/users" :icon="UsersRound"> Users </NavLink> -->
        <NavLink href="/employees" :icon="SquareUserRound"> Employees </NavLink>
        <NavLink href="/documents" :icon="FileText"> Documents </NavLink>
        <Label class="mt-5 ml-3 text-white/80">Archives</Label>
        <!-- <NavLink href="/archives/users" :icon="FileText"> Users</NavLink> -->
        <NavLink href="/archives/employees" :icon="SquareUserRound">
            Employees
        </NavLink>
        <NavLink href="/archives/documents" :icon="FileText">
            Documents
        </NavLink>
    </nav>
</template>
