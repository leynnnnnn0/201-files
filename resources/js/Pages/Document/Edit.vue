<script setup>
import { useForm } from "@inertiajs/vue3";
import useUpdate from "@/Composables/useUpdate";

const { document } = defineProps({
    document: {
        type: Object,
        required: true,
    },
});
const form = useForm({
    description: document.description,
    name: document.name,
    remarks: document.remarks,
});

const { update } = useUpdate(
    form,
    route("documents.update", document.id),
    "Document"
);
</script>

<template>
    <MainLayout>
        <Heading>Upload New Document</Heading>

        <FormContainer>
            <FormInput
                label="File"
                :errorMessage="form.errors.file"
                @input="form.file = $event.target.files[0]"
            >
                <Input type="file" />
            </FormInput>

            <FormInput label="Name" :errorMessage="form.errors.name">
                <Input v-model="form.name" />
            </FormInput>

            <FormInput
                label="Description"
                :errorMessage="form.errors.description"
                :isRequired="false"
            >
                <Textarea v-model="form.description" />
            </FormInput>

            <FormInput
                label="Remarks"
                :errorMessage="form.errors.remarks"
                :isRequired="false"
            >
                <Textarea v-model="form.remarks" />
            </FormInput>

            <FormFooter>
                <Button class="text-white" @click="update">Update</Button>
            </FormFooter>
        </FormContainer>
    </MainLayout>
</template>
