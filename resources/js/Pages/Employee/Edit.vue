<script setup>
import { useForm } from "@inertiajs/vue3";
import useUpdate from "@/Composables/useUpdate";
import { ref } from "vue";

import FileUpload from "primevue/fileupload";
import useAlert from "@/Composables/useAlert.js";
const { confirm, toast } = useAlert();

const { employee, documents, officesColleges } = defineProps({
    positions: {
        type: Object,
        required: true,
    },
    sexes: {
        type: Object,
        required: true,
    },
    statuses: {
        type: Object,
        required: true,
    },
    employmentClassifications: {
        type: Object,
        required: true,
    },
    employee: {
        type: Object,
        required: true,
    },
    documents: {
        type: Object,
        required: true,
    },
    image: String,
    officesColleges: {
        type: Object,
        required: true,
    },
});
console.log(officesColleges);

const form = useForm({
    image: null,
    position: employee.position,
    office_colleges: employee.office_colleges,
    employment_classification: employee.employment_classification,
    status: employee.status,
    sex: employee.sex,
    first_name: employee.first_name,
    middle_name: employee.middle_name,
    last_name: employee.last_name,
    email: employee.email,
    phone_number: employee.phone_number,
    philhealth_id: employee.philhealth_id,
    pag_ibig_id: employee.pag_ibig_id,
    tin_id: employee.tin_id,
    gsis_id: employee.gsis_id,
    address: employee.address,
    removed_documents: [],
});

const update = () => {
    confirm.require({
        message: `Are you sure you want to update this employee?`,
        header: "Confirmation",
        icon: "pi pi-exclamation-triangle",
        rejectProps: {
            label: "Cancel",
            severity: "secondary",
            outlined: true,
        },
        acceptProps: {
            label: "Confirm",
            severity: "success",
        },
        accept: () => {
            form.post(route("update", employee.id), {
                preserveScroll: true,
                onSuccess: () => {
                    toast.add({
                        severity: "success",
                        summary: "Success",
                        detail: `Employee Updated Successfully.`,
                        life: 5000,
                    });
                },
                onError: (e) => {
                    toast.add({
                        severity: "error",
                        summary: "Error",
                        detail: `An error occured while trying to update the employee  details.`,
                        life: 5000,
                    });
                    console.log(e);
                },
            });
        },
    });
};

const getFileUrl = (path) => {
    return `/storage/${path}`;
};
const visibleDocuments = ref([...documents]);
const removeDocument = (id) => {
    confirm.require({
        message: `Are you sure you want to remove this document?`,
        header: "Confirmation",
        icon: "pi pi-exclamation-triangle",
        rejectProps: {
            label: "Cancel",
            severity: "secondary",
            outlined: true,
        },
        acceptProps: {
            label: "Confirm",
            severity: "danger",
        },
        accept: () => {
            visibleDocuments.value = visibleDocuments.value.filter(
                (doc) => doc.id != id
            );
            form.removed_documents.push(id);
            toast.add({
                severity: "success",
                summary: "Success",
                detail: `Document Removed Successfully.`,
                life: 5000,
            });
        },
    });
};

const src = ref(null);

function onFileSelect(event) {
    const file = event.files[0];
    const reader = new FileReader();

    form.image = file;

    reader.onload = async (e) => {
        src.value = e.target.result;
    };

    reader.readAsDataURL(file);
}
</script>

<template>
    <MainLayout>
        <Heading>Edit Employee Details</Heading>

        <section class="grid grid-cols-7 gap-5 border-2 p-5 rounded-lg">
            <FormInput label="Image">
                <img
                    :src="src || image"
                    alt="Image"
                    class="shadow-md rounded-xl w-full sm:size-32"
                />
                <div class="w-fit">
                    <FileUpload
                        mode="basic"
                        @select="onFileSelect"
                        customUpload
                        auto
                        severity="secondary"
                        class="p-button-outlined"
                    />
                </div>
            </FormInput>

            <section class="grid grid-cols-2 col-span-6 gap-5">
                <FormInput
                    label="First Name"
                    :errorMessage="form.errors.first_name"
                >
                    <Input v-model="form.first_name" />
                </FormInput>
                <FormInput
                    label="Middle Name"
                    :isRequired="false"
                    :errorMessage="form.errors.middle_name"
                >
                    <Input v-model="form.middle_name" />
                </FormInput>
                <FormInput
                    label="Last Name"
                    :errorMessage="form.errors.last_name"
                >
                    <Input v-model="form.last_name" />
                </FormInput>
                <FormInput label="Email" :errorMessage="form.errors.email">
                    <Input v-model="form.email" type="email" />
                </FormInput>
                <FormInput
                    label="Phone Number"
                    :errorMessage="form.errors.phone_number"
                >
                    <Input v-model="form.phone_number" type="number" />
                </FormInput>
                <FormInput
                    label="Position"
                    :errorMessage="form.errors.position"
                >
                    <FormSelect v-model="form.position">
                        <SelectItem
                            v-for="(label, value) in positions"
                            :value="value"
                            >{{ label }}</SelectItem
                        >
                    </FormSelect>
                </FormInput>
                <FormInput
                    label="Office/Colleges"
                    :errorMessage="form.errors.office_colleges"
                >
                    <Input v-model="form.office_colleges" />
                </FormInput>
                <FormInput
                    label="Employment Classification"
                    :errorMessage="form.errors.employment_classification"
                >
                    <FormSelect v-model="form.employment_classification">
                        <SelectItem
                            v-for="(label, value) in employmentClassifications"
                            :value="value"
                            >{{ label }}</SelectItem
                        >
                    </FormSelect>
                </FormInput>
                <FormInput label="Status" :errorMessage="form.errors.status">
                    <FormSelect v-model="form.status">
                        <SelectItem
                            v-for="(label, value) in statuses"
                            :value="value"
                            >{{ label }}</SelectItem
                        >
                    </FormSelect>
                </FormInput>
                <FormInput label="Sex" :errorMessage="form.errors.sex">
                    <FormSelect v-model="form.sex">
                        <SelectItem
                            v-for="(label, value) in sexes"
                            :value="value"
                            >{{ label }}</SelectItem
                        >
                    </FormSelect>
                </FormInput>

                <FormInput
                    label="Office/Colleges"
                    :errorMessage="form.errors.office_colleges"
                >
                    <FormSelect v-model="form.office_colleges">
                        <SelectItem
                            v-for="(label, value) in officesColleges"
                            :value="value"
                            >{{ label }}</SelectItem
                        >
                    </FormSelect>
                </FormInput>

                <FormInput label="Address" :errorMessage="form.errors.address">
                    <Textarea v-model="form.address" />
                </FormInput>

                <FormContainer class="col-span-2">
                    <FormInput
                        label="Phil Health ID"
                        :isRequired="false"
                        :errorMessage="form.errors.philhealth_id"
                    >
                        <Input v-model="form.philhealth_id" />
                    </FormInput>

                    <FormInput
                        label="Pag-ibig ID"
                        :isRequired="false"
                        :errorMessage="form.errors.pag_ibig_id"
                    >
                        <Input v-model="form.pag_ibig_id" />
                    </FormInput>

                    <FormInput
                        label="TIN ID"
                        :isRequired="false"
                        :errorMessage="form.errors.tin_id"
                    >
                        <Input v-model="form.tin_id" />
                    </FormInput>

                    <FormInput
                        label="GSIS ID"
                        :isRequired="false"
                        :errorMessage="form.errors.gsis_id"
                    >
                        <Input v-model="form.gsis_id" />
                    </FormInput>
                </FormContainer>

                <TableContainer class="col-span-2">
                    <Table>
                        <TableHead>
                            <TH>Document Name</TH>
                            <TH>Actions</TH>
                        </TableHead>
                        <TableBody>
                            <tr v-for="document in visibleDocuments">
                                <TD>{{ document.name }}</TD>
                                <TD>
                                    <DivFlexCenter class="gap-2">
                                        <a
                                            target="_blank"
                                            :href="getFileUrl(document.path)"
                                        >
                                            <Eye />
                                        </a>
                                    </DivFlexCenter>
                                </TD>
                            </tr>
                        </TableBody>
                    </Table>
                </TableContainer>

                <DivFlexCenter class="justify-end gap-2 col-span-2">
                    <BackButton />
                    <Button class="text-white w-fit" @click="update"
                        >Update</Button
                    >
                </DivFlexCenter>
            </section>
        </section>
    </MainLayout>
</template>
