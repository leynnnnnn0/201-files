<script setup>
import { useForm } from "@inertiajs/vue3";
import useUpdate from "@/Composables/useUpdate";

const { designation } = defineProps({
    designation: {
        type: Object,
        required: true,
    },
});
const form = useForm({
    name: designation.name,
    remarks: designation.remarks,
});

const { update } = useUpdate(
    form,
    route("positions.update", designation.id),
    "Position"
);
</script>

<template>
    <MainLayout>
        <Heading>Create New Position</Heading>
        <section class="rounded-lg grid grid-cols-2 gap-5 border-2 p-5">
            <InputContainer>
                <InputLabel label="Name" />
                <Input v-model="form.name" />
                <FormError>{{ form.errors.name }}</FormError>
            </InputContainer>
            <InputContainer>
                <InputLabel label="Remarks" :isRequired="false" />
                <Textarea v-model="form.remarks" />
                <FormError>{{ form.errors.remarks }}</FormError>
            </InputContainer>
            <DivFlexCenter class="justify-end col-span-2 gap-3">
                <BackButton />
                <Button class="text-white w-fit" @click="update">Create</Button>
            </DivFlexCenter>
        </section>
    </MainLayout>
</template>
