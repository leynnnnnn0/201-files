<script setup>
import useDelete from "@/Composables/useDelete.js";
import { useSearch } from "@/Composables/useSearch";
import { useForm } from "@inertiajs/vue3";
import { ref  } from "vue";
import FileUpload from "primevue/fileupload";
import Dialog from "primevue/dialog";
defineProps({
    documents: {
        type: Object,
        required: true,
    },
});

const { deleteModel } = useDelete("Document");
const { search } = useSearch("documents.index");
const getFileUrl = (path) => {
    return `/storage/${path}`;
};

import { useToast } from "primevue/usetoast";
import Loading from "@/Components/Loading.vue";
const isLoading = ref(false);
const toast = useToast();

const form = useForm({
    documents: [],
    employee_id: null,
});
const isUploadDocumentModalVisible = ref(false);
const openUploadDocumentModal = (id) => {
    form.employee_id = id;
    isUploadDocumentModalVisible.value = true;
};

const onAdvancedUpload = (event) => {
    isLoading.value = true;
    form.documents = event.files;
    form.post(route("documents.store-documents"), {
        onSuccess: () => {
            toast.add({
                severity: "info",
                summary: "Success",
                detail: "Documents Uploaded",
                life: 3000,
            });
            form.reset();
            form.clearErrors();
            isLoading.value = false;
            isUploadDocumentModalVisible.value = false;
        },
        onError: (e) => {
            console.log(e);
            toast.add({
                severity: "error",
                summary: "Error",
                detail: "An error occured while trying to upload the documents. Please make sure that the documents are on type PDF.",
                life: 3000,
            });
            isLoading.value = false;
        },
    });
};
</script>

<template>
    <MainLayout>
        <DivHeading title="List of Documents">
            <LinkButton :href="route('documents.create')">
                Upload New Document
            </LinkButton>
        </DivHeading>
        <TableContainer>
            <TableHeader>
                <SearchBar>
                    <Input
                        class="pl-10"
                        v-model="search"
                        placeholder="Search..."
                    />
                </SearchBar>
            </TableHeader>
            <Table>
                <TableHead>
                    <TH>Office Number</TH>
                    <TH>Special Number</TH>
                    <TH>Person Indicated</TH>
                    <TH>Description</TH>
                    <TH>Actions</TH>
                </TableHead>
                <TableBody>
                    <tr v-for="document in documents.data">
                        <TD>{{ document.office_number ?? "None" }}</TD>
                        <TD>{{ document.special_number ?? "None" }}</TD>
                        <TD>{{ document.person_indicated }}</TD>
                        <TD>{{ document.description ?? "None" }}</TD>
                        <TD class="flex flex-center gap-3">
                            <UploadButton
                                @click="openUploadDocumentModal(document.id)"
                                >Upload Document</UploadButton
                            >
                            <ShowButton
                                :isLink="true"
                                :href="route('documents.show', document.id)"
                            />
                            <EditButton
                                :isLink="true"
                                :href="route('documents.edit', document.id)"
                            />
                            <DeleteButton
                                @click="
                                    deleteModel(
                                        route('documents.destroy', document.id)
                                    )
                                "
                            />
                        </TD>
                    </tr>
                </TableBody>
            </Table>
            <Pagination :data="documents" />
        </TableContainer>

        <Dialog
            v-model:visible="isUploadDocumentModalVisible"
            modal
            header="Edit Profile"
            :style="{ width: '50rem' }"
        >
            <template #header>Upload Document</template>

            <FormInput
                label=""
                :isRequired="false"
                :errorMessage="form.errors.document"
            >
                <FileUpload
                    name="documents"
                    :custom-upload="true"
                    @uploader="onAdvancedUpload($event)"
                    :multiple="true"
                    :maxFileSize="1000000"
                    :headers="{
                        'X-CSRF-TOKEN': $page.props.csrf_token,
                    }"
                >
                    <template #empty>
                        <span>Drag and drop files to here to upload.</span>
                    </template>
                </FileUpload>
            </FormInput>
            <Label v-if="isLoading" class="flex gap-1 items-center"
                >Uploading <Loading />
            </Label>
        </Dialog>
    </MainLayout>
</template>
