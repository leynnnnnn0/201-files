<script setup>
import { useForm } from "@inertiajs/vue3";
import useStore from "@/Composables/useStore";
import { watch, ref } from "vue";
import FileUpload from "primevue/fileupload";

const props = defineProps({
    positions: {
        type: Object,
        required: true,
    },
    office_collegess: {
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
});

const form = useForm({
    image: null,
    position: null,
    office_colleges: null,
    employment_classification: null,
    status: null,
    sex: null,
    first_name: null,
    middle_name: null,
    last_name: null,
    email: null,
    phone_number: null,
    philhealth_id: null,
    pag_ibig_id: null,
    tin_id: null,
    gsis_id: null,
    address: null,
    documents: [],
});

const { store } = useStore(form, route("employees.store"), "Employee");

watch(
    () => form.status,
    (value) => {
        console.log(value);
    }
);

const onSelect = (event) => {
    form.documents = event.files;
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
        <Heading>Create New Employee</Heading>
        <section class="rounded-lg grid grid-cols-2 gap-5 border-2 p-5">
            <FormInput
                label="Image"
                :errorMessage="form.errors.image"
                class="col-span-2"
            >
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
                <img
                    v-if="src"
                    :src="src"
                    alt="Image"
                    class="shadow-md rounded-xl w-full sm:size-32"
                />
            </FormInput>
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

            <FormInput label="Address" :errorMessage="form.errors.address">
                <Textarea v-model="form.address" />
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

            <DivFlexCenter class="justify-end gap-2 col-span-2">
                <BackButton />
                <Button class="text-white w-fit" @click="store">Create</Button>
            </DivFlexCenter>
        </section>
    </MainLayout>
</template>
