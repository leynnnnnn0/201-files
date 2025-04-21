<script setup>
import { useForm } from "@inertiajs/vue3";
import useStore from "@/Composables/useStore";
import { watch, ref } from "vue";
import FileUpload from "primevue/fileupload";
import DefaultImage from "../../../images/defaultImage.jpg";
import Select from "primevue/select";

const props = defineProps({
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
    officesColleges: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    id_number: null,
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

console.log(props.positions);

const positionsOptions = ref(
    Object.entries(props.positions).map(([value, label]) => ({
        label,
        value,
    }))
);

const officesCollegesOptions = ref(
    Object.entries(props.officesColleges).map(([value, label]) => ({
        label,
        value,
    }))
);
const employmentClassificationsOptions = ref(
    Object.entries(props.employmentClassifications).map(([value, label]) => ({
        label,
        value,
    }))
);
const statusesOptions = ref(
    Object.entries(props.statuses).map(([value, label]) => ({ label, value }))
);
const sexesOptions = ref(
    Object.entries(props.sexes).map(([value, label]) => ({ label, value }))
);

const onSelect = (event) => {
    form.documents = event.files;
};

const src = ref(null, DefaultImage);

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
        <BackButton />
        <Heading>Create New Employee</Heading>

        <section class="grid grid-cols-7 gap-5 border-2 p-5 rounded-lg">
            <FormInput label="Image" :errorMessage="form.errors.image">
                <div class="w-fit">
                    <img
                        :src="src ?? DefaultImage"
                        alt="Image"
                        class="shadow-md rounded-xl w-full sm:size-32"
                    />
                    <FileUpload
                        mode="basic"
                        @select="onFileSelect"
                        customUpload
                        auto
                        severity="secondary"
                        class="p-button-outlined mt-2"
                    />
                </div>
            </FormInput>

            <section class="grid grid-cols-2 col-span-6 gap-5">
                <FormInput
                    label="ID Number"
                    :errorMessage="form.errors.id_number"
                >
                    <Input v-model="form.id_number" />
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
                    <Select
                        v-model="form.position"
                        :options="positionsOptions"
                        optionLabel="label"
                        optionValue="value"
                        placeholder="Select a Position"
                        class="w-full"
                        filter
                    />
                </FormInput>
                <FormInput
                    label="Office/Colleges"
                    :errorMessage="form.errors.office_colleges"
                >
                    <Select
                        v-model="form.office_colleges"
                        :options="officesCollegesOptions"
                        optionLabel="label"
                        optionValue="value"
                        placeholder="Select Office/College"
                        class="w-full"
                        filter
                    />
                </FormInput>
                <FormInput
                    label="Employment Classification"
                    :errorMessage="form.errors.employment_classification"
                >
                    <Select
                        v-model="form.employment_classification"
                        :options="employmentClassificationsOptions"
                        optionLabel="label"
                        optionValue="value"
                        placeholder="Select Classification"
                        class="w-full"
                        filter
                    />
                </FormInput>
                <FormInput label="Status" :errorMessage="form.errors.status">
                    <Select
                        v-model="form.status"
                        :options="statusesOptions"
                        optionLabel="label"
                        optionValue="value"
                        placeholder="Select Status"
                        class="w-full"
                        filter
                    />
                </FormInput>
                <FormInput label="Sex" :errorMessage="form.errors.sex">
                    <Select
                        v-model="form.sex"
                        :options="sexesOptions"
                        optionLabel="label"
                        optionValue="value"
                        placeholder="Select Sex"
                        class="w-full"
                        filter
                    />
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
                    <Button class="text-white w-fit" @click="store"
                        >Create</Button
                    >
                </DivFlexCenter>
            </section>
        </section>
    </MainLayout>
</template>
