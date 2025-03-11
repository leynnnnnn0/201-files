<script setup>
defineProps({
    document: {
        type: Object,
        required: true,
    },
});

const getFileUrl = (path) => {
    return `/storage/${path}`;
};
</script>

<template>
    <MainLayout>
        <Heading>Document Details</Heading>
        <FormContainer>
            <section class="col-span-2">
                <a
                    :href="getFileUrl(document.path)"
                    target="_blank"
                    class="text-blue-500 underline"
                >
                    Document
                </a>
            </section>
            <InfoList label="Office Number" :value="document.office_number" />
            <InfoList label="Special Number" :value="document.special_number" />
            <InfoList label="Name" :value="document.name" />
            <InfoList label="Description" :value="document.description" />
            <InfoList
                label="Person Indicated"
                :value="document.person_indicated"
            />
            <InfoList label="Remarks" :value="document.remarks" />
        </FormContainer>
    </MainLayout>
</template>
