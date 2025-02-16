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

const form = useForm({
    first_name: null,
    middle_name: null,
    last_name: null,
    email: null,
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

            <DivFlexCenter class="justify-end gap-2 col-span-2">
                <BackButton />
                <Button class="text-white w-fit" @click="store">Create</Button>
            </DivFlexCenter>
        </section>
    </MainLayout>
</template>
