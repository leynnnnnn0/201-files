<script setup>
defineProps({
    employee: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <MainLayout>
        <Heading>Employee Details</Heading>
        <FormContainer>
            <InfoList label="First Name" :value="employee.first_name" />
            <InfoList label="Middle Name" :value="employee.middle_name" />
            <InfoList label="Last Name" :value="employee.last_name" />
            <InfoList label="Phone Number" :value="employee.phone_number" />
            <InfoList label="Email" :value="employee.email" />
        </FormContainer>
    </MainLayout>
</template>
