<script setup>
import {
    Tooltip,
    TooltipContent,
    TooltipProvider,
    TooltipTrigger,
} from "@/components/ui/tooltip";
</script>
<template>
    <button
        class="cursor-pointer text-red-500 sm:mr-3 size-5 hover:underline"
        variant="link"
    >
        <TooltipProvider>
            <Tooltip>
                <TooltipTrigger as-child>
                    <Trash2 />
                </TooltipTrigger>
                <TooltipContent>
                    <p>Delete</p>
                </TooltipContent>
            </Tooltip>
        </TooltipProvider>
    </button>
</template>
