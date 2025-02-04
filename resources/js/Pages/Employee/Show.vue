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
            <InfoList label="Sex" :value="employee.sex" />
            <InfoList label="Phone Number" :value="employee.phone_number" />
            <InfoList label="Email" :value="employee.email" />
            <InfoList label="Position" :value="employee.position" />
            <InfoList label="Designation" :value="employee.designation" />
            <InfoList
                label="Employment Classification"
                :value="employee.employment_classification"
            />
            <InfoList label="Status" :value="employee.status" />
        </FormContainer>
        <BackButton />
    </MainLayout>
</template>
