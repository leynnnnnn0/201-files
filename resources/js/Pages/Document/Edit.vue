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
    file: null,
    description: document.description,
    name: document.name,
    remarks: document.remarks,
});

const { update } = useUpdate(
    form,
    route("documents.update", document.id),
    "Document"
);

const getFileUrl = (path) => {
    return `/storage/${path}`;
};
</script>

<template>
    <MainLayout>
        <Heading>Edit Document</Heading>

        <FormContainer>
            <FormInput label="Current File" v-if="document.path">
                <p class="text-sm text-gray-600">
                    Current file:
                    <a
                        :href="getFileUrl(document.path)"
                        target="_blank"
                        class="text-blue-500 hover:underline"
                    >
                        {{ document.name }}
                    </a>
                </p>
            </FormInput>

            <FormInput label="File" :errorMessage="form.errors.file">
                <Input
                    type="file"
                    @input="form.file = $event.target.files[0]"
                />
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
