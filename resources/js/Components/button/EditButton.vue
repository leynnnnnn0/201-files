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
        class="cursor-pointer text-blue-500 p-0 sm:mr-3 size-5"
        variant="link"
    >
        <TooltipProvider>
            <Tooltip>
                <TooltipTrigger as-child>
                    <Pencil />
                </TooltipTrigger>
                <TooltipContent>
                    <p>Edit Details</p>
                </TooltipContent>
            </Tooltip>
        </TooltipProvider>
    </Component>
</template>
