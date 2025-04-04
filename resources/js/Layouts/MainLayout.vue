<script setup>
import DivFlexCol from "@/Components/div/DivFlexCol.vue";
import NavLink from "@/Components/NavLink.vue";
import Sidebar from "@/Components/Sidebar.vue";
import { LogOut } from "lucide-vue-next";
import { router } from "@inertiajs/vue3";
import { CircleUser, AlignJustify } from "lucide-vue-next";
import Logo from "../../images/logo201.jpg";
import ConfirmDialog from "primevue/confirmdialog";
import Toast from "primevue/toast";
import { ref, onMounted, onBeforeUnmount } from "vue";

const isSidebarOpen = ref(true);
const isMobile = ref(false);

const toggleSidebar = () => {
    isSidebarOpen.value = !isSidebarOpen.value;
};

const checkIfMobile = () => {
    isMobile.value = window.innerWidth < 768;
};

onMounted(() => {
    checkIfMobile();
    window.addEventListener("resize", checkIfMobile);
});

onBeforeUnmount(() => {
    window.removeEventListener("resize", checkIfMobile);
});
</script>

<template>
    <Toast />
    <ConfirmDialog></ConfirmDialog>
    <div
        class="grid min-h-screen w-full"
        :class="
            isSidebarOpen
                ? 'md:grid-cols-[220px_1fr] lg:grid-cols-[280px_1fr]'
                : 'md:grid-cols-[80px_1fr] lg:grid-cols-[80px_1fr]'
        "
    >
        <!-- Sidebar - Fixed height with internal scrolling -->
        <div
            class="border-r bg-muted/40 h-screen overflow-hidden transition-all duration-300"
            :class="{ hidden: !isSidebarOpen && isMobile }"
        >
            <div class="flex flex-col h-full bg-[#555555] text-white">
                <!-- Fixed header -->
                <div
                    class="flex h-14 items-center border-b px-4 lg:h-24 lg:px-6 flex-shrink-0"
                >
                    <div
                        class="flex items-center justify-between flex-1 h-full"
                    >
                        <!-- Burger button to toggle sidebar -->
                        <span></span>
                        <DivFlexCol
                            class="items-center"
                            :class="{ hidden: !isSidebarOpen && !isMobile }"
                        >
                            <img
                                :src="Logo"
                                alt="logo"
                                class="size-10 rounded-full"
                            />
                            <a href="/" class="flex items-center font-semibold">
                                <span class="font-bold">201 Files</span>
                            </a>
                        </DivFlexCol>
                        <button
                            @click="toggleSidebar"
                            class="focus:outline-none"
                        >
                            <AlignJustify />
                        </button>
                    </div>
                </div>
                <!-- Scrollable sidebar content -->
                <div class="flex-1 overflow-y-auto">
                    <DivFlexCol class="h-full py-2">
                        <section
                            class="flex-1"
                            :class="{ 'px-0': !isSidebarOpen && !isMobile }"
                        >
                            <Sidebar
                                :collapsed="!isSidebarOpen && !isMobile"
                                :isSidebarOpen="isSidebarOpen"
                            />
                        </section>
                    </DivFlexCol>
                </div>
            </div>
        </div>

        <!-- Mobile sidebar toggle button - visible only on mobile -->
        <div
            class="md:hidden fixed bottom-4 right-4 z-50"
            v-if="!isSidebarOpen && isMobile"
        >
            <button
                @click="toggleSidebar"
                class="bg-[#555555] text-white p-3 rounded-full shadow-lg"
            >
                <AlignJustify />
            </button>
        </div>

        <!-- Main Content - Fixed height with internal scrolling -->
        <div class="h-screen overflow-hidden">
            <div class="h-full overflow-y-auto">
                <!-- Mobile header visible when sidebar is collapsed -->
                <div
                    class="md:hidden flex items-center justify-between p-4 bg-[#555555] text-white"
                >
                    <button @click="toggleSidebar" class="focus:outline-none">
                        <AlignJustify />
                    </button>
                    <img :src="Logo" alt="logo" class="size-8 rounded-full" />
                    <Link :href="route('profiles.index')">
                        <CircleUser />
                    </Link>
                </div>

                <DivFlexCol class="p-10 gap-5">
                    <slot></slot>
                </DivFlexCol>
            </div>
        </div>
    </div>
</template>
