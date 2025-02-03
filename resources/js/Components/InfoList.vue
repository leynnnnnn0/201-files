<script setup>
defineProps({
    label: {
        type: String,
        required: true,
    },
    value: {
        type: String,
        required: true,
    },
});
</script>
<template>
    <InputContainer>
        <span class="text-xs text-gray-700">{{ label }}</span>
        <Label class="font-bold">{{ value }}</Label>
    </InputContainer>
</template>
