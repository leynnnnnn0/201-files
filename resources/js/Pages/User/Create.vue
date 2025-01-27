<script setup>
import { useForm } from "@inertiajs/vue3";
import useStore from "@/Composables/useStore";

const props = defineProps({
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
});

console.log(props.employmentClassifications);
const form = useForm({
    position_id: null,
    designation_id: null,
    employment_classification: null,
    status: null,
    sex: null,
    first_name: null,
    middle_name: null,
    last_name: null,
    email: null,
    phone_number: null,
});

const { store } = useStore(form, route("users.store"), "User");
</script>

<template>
    <MainLayout>
        <Heading>Create New User</Heading>
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
            <FormInput label="Position" :errorMessage="form.errors.position_id">
                <FormSelect v-model="form.position_id">
                    <SelectItem
                        v-for="position in positions"
                        :value="position.value"
                        >{{ position.label }}</SelectItem
                    >
                </FormSelect>
            </FormInput>
            <FormInput
                label="Designation"
                :errorMessage="form.errors.designation_id"
            >
                <FormSelect v-model="form.designation_id">
                    <SelectItem
                        v-for="designation in designations"
                        :value="designation.value"
                        >{{ designation.label }}</SelectItem
                    >
                </FormSelect>
            </FormInput>
            <FormInput
                label="Employment Classification"
                :errorMessage="form.errors.employment_classification"
                v-model="form.employment_classification"
            >
                <FormSelect>
                    <SelectItem
                        v-for="(label, value) in employmentClassifications"
                        :value="value"
                        >{{ label }}</SelectItem
                    >
                </FormSelect>
            </FormInput>
            <FormInput
                label="Status"
                :errorMessage="form.errors.status"
                v-model="form.status"
            >
                <FormSelect>
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

            <DivFlexCenter class="justify-end gap-2 col-span-2">
                <BackButton />
                <Button class="text-white w-fit" @click="store">Create</Button>
            </DivFlexCenter>
        </section>
    </MainLayout>
</template>
