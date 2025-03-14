<script setup>
const props = defineProps({
    isLink: {
        type: Boolean,
        default: false,
    },
});

import {
    Tooltip,
    TooltipContent,
    TooltipProvider,
    TooltipTrigger,
} from "@/components/ui/tooltip";
</script>
<template>
    <Component
        :is="isLink ? 'Link' : 'Button'"
        class="cursor-pointer p-0 size-5 sm:mr-3"
        variant="link"
    >
        <TooltipProvider>
            <Tooltip>
                <TooltipTrigger as-child>
                    <Eye />
                </TooltipTrigger>
                <TooltipContent>
                    <p>Show Details</p>
                </TooltipContent>
            </Tooltip>
        </TooltipProvider>
    </Component>
</template>
