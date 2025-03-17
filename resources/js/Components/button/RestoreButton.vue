<script setup>
import { ArchiveRestore } from "lucide-vue-next";

import {
    Tooltip,
    TooltipContent,
    TooltipProvider,
    TooltipTrigger,
} from "@/components/ui/tooltip";
</script>
<template>
    <button
        class="cursor-pointer text-blue-500 sm:mr-3 hover:underline"
        variant="link"
    >
        <TooltipProvider>
            <Tooltip>
                <TooltipTrigger as-child>
                    <ArchiveRestore />
                </TooltipTrigger>
                <TooltipContent>
                    <p>Restore</p>
                </TooltipContent>
            </Tooltip>
        </TooltipProvider>
    </button>
</template>
