<script setup>
import { useForm } from "@inertiajs/vue3";
import useUpdate from "@/Composables/useUpdate";
import { watch } from "vue";
import { ref } from "vue";
import useAlert from "@/Composables/useAlert.js";
const { confirm, toast } = useAlert();

const { document, documents } = defineProps({
    document: {
        type: Object,
        required: true,
    },
    documents: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    office_number: document.office_number,
    special_number: document.special_number,
    person_indicated: document.person_indicated,
    description: document.description,
    remarks: document.remarks,
    removed_documents: [],
});

const { update } = useUpdate(
    form,
    route("documents.update", document.id),
    "Document"
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
        <BackButton />
        <Heading>Edit Document</Heading>

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

            <FormFooter>
                <Button class="text-white" @click="update">Update</Button>
            </FormFooter>
        </FormContainer>
    </MainLayout>
</template>
