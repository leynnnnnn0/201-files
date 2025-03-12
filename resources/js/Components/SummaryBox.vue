<script setup>
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
defineProps({
    heading: String,
    value: {
        required: true,
    },
    subheading: String,
    icon: {
        required: false,
    },
});
</script>

<template>
    <Card class="bg-[#006BC3] text-white">
        <CardHeader
            class="flex flex-row items-center justify-between space-y-0 pb-2"
        >
            <CardTitle class="text-sm font-medium"> {{ heading }} </CardTitle>
            <component :is="icon" class="h-4 w-4 text-muted-foreground" />
        </CardHeader>
        <CardContent>
            <div class="text-2xl font-bold">{{ value }}</div>
            <p class="text-xs text-white/80">{{ subheading }}</p>
        </CardContent>
    </Card>
</template>
