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
        class="grid min-h-screen w-full md:grid-cols-[220px_1fr] lg:grid-cols-[280px_1fr] overflow-hidden bg-[#0058A5]"
    >
        <div
            class="hidden border-r bg-muted/40 md:block overflow-hidden bg-[#0058A5]"
        >
            <div class="flex h-full max-h-screen flex-col gap-2">
                <div
                    class="flex h-14 items-center border-b px-4 lg:h-[60px] lg:px-6"
                >
                    <div class="flex items-center justify-between flex-1">
                        <a
                            href="/"
                            class="flex items-center font-semibold text-white"
                        >
                            <span class="font-bold">201 Files</span>
                        </a>
                        <Link :href="route('profiles.index')">
                            <CircleUser />
                        </Link>
                    </div>
                </div>
                <div
                    class="flex-1 overflow-y-auto scrollbar-thin scrollbar-track-gray-100 scrollbar-thumb-gray-300 hover:scrollbar-thumb-gray-400"
                >
                    <DivFlexCol class="h-full bg-[#0058A5]">
                        <section class="flex-1">
                            <Sidebar />
                        </section>
                        <button
                            @click="logout"
                            class="flex items-center gap-2 px-3 py-2 text-muted-foreground transition-all hover:text-primary"
                        >
                            <LogOut class="size-5" />
                            Logout
                        </button>
                    </DivFlexCol>
                </div>
            </div>
        </div>
        <DivFlexCol class="p-10 gap-5 bg-[#7AC6FF]">
            <slot></slot>
        </DivFlexCol>
    </div>
</template>
