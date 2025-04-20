<script setup>
defineProps({
    document: {
        type: Object,
        required: true,
    },
    documents: {
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
        <BackButton />
        <Heading>Document Details</Heading>
        <FormContainer>
            <InfoList
                label="Office Number"
                :value="document?.office_number ?? 'N/a'"
            />
            <InfoList
                label="Special Number"
                :value="document?.special_number ?? 'N/a'"
            />
            <InfoList label="Name" :value="document?.name ?? 'N/a'" />
            <InfoList
                label="Description"
                :value="document?.description ?? 'N/a'"
            />
            <InfoList
                label="Person Indicated"
                :value="document?.person_indicated ?? 'N/a'"
            />
            <InfoList label="Remarks" :value="document?.remarks ?? 'N/a'" />
        </FormContainer>

        <FormContainer>
            <Label class="col-span-2">Documents</Label>
            <Label class="col-span-2" v-for="document in documents">
                <a
                    class="text-blue-500 underline"
                    target="_blank"
                    :href="getFileUrl(document.path)"
                >
                    {{ document.name }}
                </a>
            </Label>
            <Label v-if="documents.length < 1">Nothing to show</Label>
        </FormContainer>
    </MainLayout>
</template>
