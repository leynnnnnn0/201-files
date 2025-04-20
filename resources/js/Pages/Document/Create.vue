<script setup>
import { useForm } from "@inertiajs/vue3";
import FileUpload from "primevue/fileupload";
import useStore from "@/Composables/useStore";
const form = useForm({
    office_number: null,
    special_number: null,
    person_indicated: null,
    description: null,
    name: null,
    remarks: null,
    documents: [],
});

const { store } = useStore(form, route("documents.store"), "Document");

const onSelect = (event) => {
    form.documents = event.files;
};


</script>

<template>
    <MainLayout>
        <BackButton />
        <Heading>Upload New Document</Heading>

        <FormContainer>
            <FormInput
                label="Office Number"
                :errorMessage="form.errors.office_number"
                :isRequired="false"
            >
                <Input v-model="form.office_number" />
            </FormInput>

            <FormInput
                label="Special Number"
                :errorMessage="form.errors.special_number"
                :isRequired="false"
            >
                <Input v-model="form.special_number" />
            </FormInput>

            <FormInput
                label="Person Indicated"
                :errorMessage="form.errors.person_indicated"
            >
                <Input v-model="form.person_indicated" />
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

            <FormInput
                label="Documents"
                :errorMessage="form.errors.documents"
                class="col-span-2"
            >
                <FileUpload
                    @select="onSelect"
                    :multiple="true"
                    :showUploadButton="false"
                    :showCancelButton="false"
                    :maxFileSize="30000000"
                >
                    <template #empty>
                        <p>Drag and drop files to here to upload.</p>
                    </template>
                </FileUpload>
            </FormInput>

            <FormFooter>
                <Button class="text-white" @click="store">Upload</Button>
            </FormFooter>
        </FormContainer>
    </MainLayout>
</template>
