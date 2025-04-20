<script setup>
import { usePage, router } from "@inertiajs/vue3";
import BackImage from "../../images/back.png";
const backButton = () => {
    router.get(usePage().props.previous);
};
</script>
<template>
    <Button
        variant="outline"
        class="sm:text-lg text-xs w-fit bg-transparent border-none"
        @click="backButton"
    >
        <img :src="BackImage" alt="back button" class="size-10" />
    </Button>
</template>
