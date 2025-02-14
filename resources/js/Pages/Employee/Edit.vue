<script setup>
import { useForm } from "@inertiajs/vue3";
import useUpdate from "@/Composables/useUpdate";
import { ref } from "vue";
import useAlert from "@/Composables/useAlert.js";
const { confirm, toast } = useAlert();

const { employee, documents } = defineProps({
    positions: {
        type: Object,
        required: true,
    },
    designations: {
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
});

const form = useForm({
    position: employee.position,
    designation: employee.designation,
    employment_classification: employee.employment_classification,
    status: employee.status,
    sex: employee.sex,
    first_name: employee.first_name,
    middle_name: employee.middle_name,
    last_name: employee.last_name,
    email: employee.email,
    phone_number: employee.phone_number,
    removed_documents: [],
});

const { update } = useUpdate(
    form,
    route("employees.update", employee.id),
    "Employee"
);

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
</script>

<template>
    <MainLayout>
        <Heading>Edit Employee Details</Heading>
        <section class="rounded-lg grid grid-cols-2 gap-5 border-2 p-5">
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
            <FormInput label="Last Name" :errorMessage="form.errors.last_name">
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
            <FormInput label="Position" :errorMessage="form.errors.position">
                <FormSelect v-model="form.position">
                    <SelectItem
                        v-for="(label, value) in positions"
                        :value="value"
                        >{{ label }}</SelectItem
                    >
                </FormSelect>
            </FormInput>
            <FormInput
                label="Designation"
                :errorMessage="form.errors.designation"
            >
                <Input v-model="form.designation" />
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

            <TableContainer class="col-span-2">
                <Table>
                    <TableHead>
                        <TH>ID</TH>
                        <TH>Document Name</TH>
                        <TH>Actions</TH>
                    </TableHead>
                    <TableBody>
                        <tr v-for="document in visibleDocuments">
                            <TD>{{ document.id }}</TD>
                            <TD>{{ document.name }}</TD>
                            <TD>
                                <DivFlexCenter class="gap-2">
                                    <a
                                        target="_blank"
                                        :href="getFileUrl(document.path)"
                                    >
                                        <Eye />
                                    </a>
                                    <DeleteButton
                                        @click="removeDocument(document.id)"
                                    />
                                </DivFlexCenter>
                            </TD>
                        </tr>
                    </TableBody>
                </Table>
            </TableContainer>

            <DivFlexCenter class="justify-end gap-2 col-span-2">
                <BackButton />
                <Button class="text-white w-fit" @click="update">Update</Button>
            </DivFlexCenter>
        </section>
    </MainLayout>
</template>
