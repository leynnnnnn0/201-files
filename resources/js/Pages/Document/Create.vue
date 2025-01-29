<script setup>
import { useForm } from "@inertiajs/vue3";
const form = useForm({
    file: null,
    description: null,
    name: null,
    remarks: null,
});
</script>

<template>
    <MainLayout>
        <Heading>Upload New Document</Heading>

        <FormContainer>
            <FormInput label="File" :errorMessage="form.errors.file">
                <Input type="file" />
            </FormInput>

            <FormInput label="Name" :errorMessage="form.errors.name">
                <Input />
            </FormInput>

            <FormInput
                label="Description"
                :errorMessage="form.errors.description"
                :isRequired="false"
            >
                <Textarea />
            </FormInput>

            <FormInput
                label="Remarks"
                :errorMessage="form.errors.remarks"
                :isRequired="false"
            >
                <Textarea />
            </FormInput>

            <FormFooter>
                <Button class="text-white">Upload</Button>
            </FormFooter>
        </FormContainer>
    </MainLayout>
</template>
