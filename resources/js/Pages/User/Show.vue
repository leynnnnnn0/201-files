<script setup>
defineProps({
    user: {
        type: Object,
        required: true,
    },
});
</script>
<template>
    <MainLayout>
        <Heading>User Details</Heading>
        <FormContainer>
            <InfoList label="First Name" :value="user.first_name" />
            <InfoList label="Middle Name" :value="user.middle_name" />
            <InfoList label="Last Name" :value="user.last_name" />
            <InfoList label="Email" :value="user.email" />
        </FormContainer>
        <BackButton />
    </MainLayout>
</template>
