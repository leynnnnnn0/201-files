<script setup>
import DivFlexCol from "@/Components/div/DivFlexCol.vue";
import NavLink from "@/Components/NavLink.vue";
import { Home, UsersRound, Warehouse } from "lucide-vue-next";
import ConfirmDialog from "primevue/confirmdialog";
import Toast from "primevue/toast";
</script>

<template>
    <Toast />
    <ConfirmDialog></ConfirmDialog>
    <div
        class="grid min-h-screen max-h-screen w-full md:grid-cols-[220px_1fr] lg:grid-cols-[280px_1fr] overflow-hidden"
    >
        <div class="hidden border-r bg-muted/40 md:block overflow-hidden">
            <div class="flex h-full max-h-screen flex-col gap-2">
                <div
                    class="flex h-14 items-center border-b px-4 lg:h-[60px] lg:px-6"
                >
                    <a href="/" class="flex items-center font-semibold">
                        <span class="font-bold">201 Files</span>
                    </a>
                    <!-- <Button
                        variant="outline"
                        size="icon"
                        class="ml-auto h-8 w-8"
                    >
                        <Bell class="h-4 w-4" />
                        <span class="sr-only">Toggle notifications</span>
                    </Button> -->
                </div>
                <div
                    class="flex-1 overflow-y-auto scrollbar-thin scrollbar-track-gray-100 scrollbar-thumb-gray-300 hover:scrollbar-thumb-gray-400"
                >
                    <nav class="grid items-start pl-4 text-sm font-medium">
                        <NavLink :href="route('dashboard')" :icon="Home">
                            Dashboard
                        </NavLink>
                        <NavLink href="/positions" :icon="UsersRound">
                            Positions
                        </NavLink>
                        <NavLink href="/designations" :icon="Warehouse">
                            Designations
                        </NavLink>
                        <NavLink href="/users" :icon="Warehouse">
                            Users
                        </NavLink>
                    </nav>
                </div>
            </div>
        </div>
        <DivFlexCol class="p-10 gap-5">
            <slot></slot>
        </DivFlexCol>
    </div>
</template>
