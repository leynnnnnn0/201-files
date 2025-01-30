<script setup>
import { useForm } from "@inertiajs/vue3";
import useStore from "@/Composables/useStore";
const form = useForm({
    file: null,
    description: null,
    name: null,
    remarks: null,
});

const { store } = useStore(form, route("documents.store"), "Document");
</script>

<template>
    <MainLayout>
        <Heading>Upload New Document</Heading>

        <FormContainer>
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
                <Button class="text-white" @click="store">Upload</Button>
            </FormFooter>
        </FormContainer>
    </MainLayout>
</template>
