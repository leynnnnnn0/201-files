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
    <Card class="bg-blue-400">
        <CardHeader
            class="flex flex-row items-center justify-between space-y-0 pb-2"
        >
            <CardTitle
                class="flex items-center gap-2 text-sm font-medium text-white"
            >
                <component
                    :is="icon"
                    class="size-5 text-muted-foreground text-white"
                />
                {{ heading }}
            </CardTitle>
        </CardHeader>
        <CardContent>
            <div class="text-2xl font-bold text-white">{{ value }}</div>
            <p class="text-xs text-white/80">{{ subheading }}</p>
        </CardContent>
    </Card>
</template>
