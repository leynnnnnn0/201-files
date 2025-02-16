<script setup>
import { useForm } from "@inertiajs/vue3";
import useUpdate from "@/Composables/useUpdate";

const { user } = defineProps({
    user: {
        type: Object,
        required: true,
    },
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
    first_name: user.first_name,
    middle_name: user.middle_name,
    last_name: user.last_name,
    email: user.email,
});

const { update } = useUpdate(form, route("users.update", user.id), "User");
</script>

<template>
    <MainLayout>
        <Heading>Edit User Details</Heading>
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
                <Button class="text-white w-fit" @click="update">Update</Button>
            </DivFlexCenter>
        </section>
    </MainLayout>
</template>
