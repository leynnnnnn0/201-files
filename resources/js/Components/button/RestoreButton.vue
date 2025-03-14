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
    <TooltipProvider>
        <Tooltip>
            <TooltipTrigger as-child>
                <button
                    class="cursor-pointer text-blue-500 sm:mr-3 hover:underline"
                    variant="link"
                >
                    <ArchiveRestore />
                </button>
            </TooltipTrigger>
            <TooltipContent>
                <p>Restore</p>
            </TooltipContent>
        </Tooltip>
    </TooltipProvider>
</template>
