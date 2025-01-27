<script setup>
defineProps({
    title: {
        type: String,
        required: true,
    },
});
</script>
<template>
    <DivFlexCenter class="justify-between">
        <Heading>{{ title }}</Heading>
        <slot />
    </DivFlexCenter>
</template>
