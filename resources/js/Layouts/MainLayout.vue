<script setup>
import DivFlexCol from "@/Components/div/DivFlexCol.vue";
import NavLink from "@/Components/NavLink.vue";
import Sidebar from "@/Components/Sidebar.vue";
import { LogOut } from "lucide-vue-next";
import { router } from "@inertiajs/vue3";
import { CircleUser } from "lucide-vue-next";

import ConfirmDialog from "primevue/confirmdialog";
import Toast from "primevue/toast";

const logout = () => {
    router.post("/logout");
};
</script>

<template>
    <Toast />
    <ConfirmDialog></ConfirmDialog>
    <div
        class="grid min-h-screen w-full md:grid-cols-[220px_1fr] lg:grid-cols-[280px_1fr]"
    >
        <!-- Sidebar - Fixed height with internal scrolling -->
        <div
            class="hidden md:block border-r bg-muted/40 h-screen overflow-hidden"
        >
            <div class="flex flex-col h-full bg-[#555555] text-white">
                <!-- Fixed header -->
                <div
                    class="flex h-14 items-center border-b px-4 lg:h-[60px] lg:px-6 flex-shrink-0"
                >
                    <div class="flex items-center justify-between flex-1">
                        <a href="/" class="flex items-center font-semibold">
                            <span class="font-bold">201 Files</span>
                        </a>
                        <Link :href="route('profiles.index')">
                            <CircleUser />
                        </Link>
                    </div>
                </div>
                <!-- Scrollable sidebar content -->
                <div class="flex-1 overflow-y-auto">
                    <DivFlexCol class="h-full py-2">
                        <section class="flex-1">
                            <Sidebar />
                        </section>
                        <button
                            @click="logout"
                            class="flex items-center gap-2 px-3 py-2 mt-auto text-muted-foreground transition-all hover:text-primary"
                        >
                            <LogOut class="size-5" />
                            Logout
                        </button>
                    </DivFlexCol>
                </div>
            </div>
        </div>

        <!-- Main Content - Fixed height with internal scrolling -->
        <div class="h-screen overflow-hidden">
            <div class="h-full overflow-y-auto">
                <DivFlexCol class="p-10 gap-5">
                    <slot></slot>
                </DivFlexCol>
            </div>
        </div>
    </div>
</template>
