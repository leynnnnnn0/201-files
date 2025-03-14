<script setup>
import {
    Tooltip,
    TooltipContent,
    TooltipProvider,
    TooltipTrigger,
} from "@/components/ui/tooltip";
</script>
<template>
    <TooltipProvider>
        <Tooltip>
            <TooltipTrigger as-child>
                <button
                    class="cursor-pointer text-red-500 sm:mr-3 size-5 hover:underline"
                    variant="link"
                >
                    <Trash2 />
                </button>
            </TooltipTrigger>
            <TooltipContent>
                <p>Delete</p>
            </TooltipContent>
        </Tooltip>
    </TooltipProvider>
</template>
