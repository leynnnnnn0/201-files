<script setup>
import { Upload } from "lucide-vue-next";
import {
    Tooltip,
    TooltipContent,
    TooltipProvider,
    TooltipTrigger,
} from "@/components/ui/tooltip";
</script>
<template>
    <button
        class="cursor-pointer text-green-500 sm:mr-3 size-5 hover:underline"
        variant="link"
    >
        <TooltipProvider>
            <Tooltip>
                <TooltipTrigger as-child>
                    <Upload />
                </TooltipTrigger>
                <TooltipContent>
                    <p>Upload Documents</p>
                </TooltipContent>
            </Tooltip>
        </TooltipProvider>
    </button>
</template>
