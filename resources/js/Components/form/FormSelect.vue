<script setup>
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectLabel,
    SelectTrigger,
    SelectValue,
} from "@/components/ui/select";

defineProps({
    placeholder: {
        type: String,
        required: false,
        default: "Select an option",
    },
    selectLabel: {
        type: String,
        required: false,
        default: "Select an option",
    },
});
</script>

<template>
    <Select>
        <SelectTrigger>
            <SelectValue :placeholder="placeholder" />
        </SelectTrigger>
        <SelectContent>
            <SelectGroup>
                <SelectLabel>{{ selectLabel }}</SelectLabel>
                <slot />
            </SelectGroup>
        </SelectContent>
    </Select>
</template>
