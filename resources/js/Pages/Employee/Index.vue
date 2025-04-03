<script setup>
import useDelete from "@/Composables/useDelete.js";
import { useSearch } from "@/Composables/useSearch";
import Dialog from "primevue/dialog";
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import FileUpload from "primevue/fileupload";

const { employees } = defineProps({
    employees: {
        type: Object,
        required: true,
    },
});

const { search } = useSearch("employees.index");

const form = useForm({
    documents: [],
    employee_id: null,
});
const isUploadDocumentModalVisible = ref(false);
const openUploadDocumentModal = (id) => {
    form.employee_id = id;
    isUploadDocumentModalVisible.value = true;
};
const { deleteModel } = useDelete("employee", "archive");

import { useToast } from "primevue/usetoast";
import Loading from "@/Components/Loading.vue";

const isLoading = ref(false);
const toast = useToast();

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

const statusColor = (status) => {
    const statusLower = status.toLowerCase();
    switch (statusLower) {
        case "permanent":
            return "bg-green-500 text-white";
        case "casual":
            return "bg-blue-500 text-white";
        case "cos/jop":
            return "bg-yellow-500 text-white";
        default:
            return "bg-gray-500 text-white";
    }
};

const sexColor = (sex) => {
    const sexLower = sex.toLowerCase();

    switch (sexLower) {
        case "male":
            return "bg-blue-500 text-white";
        default:
            return "bg-pink-500 text-white";
    }
};

const teachingColor = (teaching) => {
    const teachingLower = teaching.toLowerCase();

    switch (teachingLower) {
        case "teaching":
            return "bg-green-500 text-white";
        default:
            return "bg-gray-500 text-white";
    }
};
</script>
<template>
    <MainLayout>
        <DivHeading title="List Of Employees">
            <LinkButton :href="route('employees.create')">
                Add New Employee
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
                    <TH>Id</TH>
                    <TH>Full Name</TH>
                    <TH>Office/Colleges</TH>
                    <TH>Position</TH>
                    <TH>Status</TH>
                    <TH>Employment Classfication</TH>
                    <TH>Sex</TH>
                    <TH>Actions</TH>
                </TableHead>
                <TableBody>
                    <tr v-for="employee in employees.data">
                        <TD>{{ employee.id }}</TD>
                        <TD>{{ employee.full_name }}</TD>
                        <TD>{{ employee.office_colleges }}</TD>
                        <TD> {{ employee.position }}</TD>
                        <TD>
                            <span
                                class="px-3 py-1 font-bold text-xs rounded-lg"
                                :class="statusColor(employee.status)"
                            >
                                {{ employee.status.toUpperCase() }}
                            </span>
                        </TD>
                        <TD>
                            <span
                                class="px-3 py-1 font-bold text-xs rounded-lg"
                                :class="
                                    teachingColor(
                                        employee.employment_classification
                                    )
                                "
                            >
                                {{
                                    employee.employment_classification.toUpperCase()
                                }}
                            </span></TD
                        >
                        <TD>
                            <span
                                class="px-3 py-1 font-bold text-xs rounded-lg"
                                :class="sexColor(employee.sex)"
                            >
                                {{ employee.sex.toUpperCase() }}
                            </span></TD
                        >

                        <TD class="flex flex-center gap-3">
                            <UploadButton
                                @click="openUploadDocumentModal(employee.id)"
                                >Upload Document</UploadButton
                            >
                            <ShowButton
                                :isLink="true"
                                :href="route('employees.show', employee.id)"
                            />
                            <EditButton
                                :isLink="true"
                                :href="route('employees.edit', employee.id)"
                            />
                            <DeleteButton
                                @click="
                                    deleteModel(
                                        route('employees.destroy', employee.id)
                                    )
                                "
                            />
                        </TD>
                    </tr>
                </TableBody>
            </Table>
            <Pagination :data="employees" />
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
