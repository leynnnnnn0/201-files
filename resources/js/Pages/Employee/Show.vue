<script setup>
defineProps({
    employee: {
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
        <Heading>Employee Details</Heading>

        <section class="grid grid-cols-7 gap-5 border-2 p-5 rounded-lg">
            <img
                :src="employee.image"
                alt="Profile"
                class="size-32 rounded-full"
            />

            <section class="col-span-6 space-y-5">
                <FormContainer>
                    <InfoList label="ID" :value="employee.id" />
                    <InfoList label="First Name" :value="employee.first_name" />
                    <InfoList
                        label="Middle Name"
                        :value="employee.middle_name ?? 'None'"
                    />
                    <InfoList label="Last Name" :value="employee.last_name" />
                    <InfoList label="Sex" :value="employee.sex" />
                    <InfoList
                        label="Phone Number"
                        :value="employee.phone_number"
                    />
                    <InfoList label="Email" :value="employee.email" />
                    <InfoList label="Address" :value="employee.address" />
                    <InfoList label="Position" :value="employee.position" />
                    <InfoList
                        label="Office/Colleges"
                        :value="employee.office_colleges"
                    />
                    <InfoList
                        label="Employment Classification"
                        :value="employee.employment_classification"
                    />
                    <InfoList label="Status" :value="employee.status" />
                </FormContainer>

                <FormContainer>
                    <InfoList
                        label="PhilHealth ID"
                        :value="employee.philhealth_id ?? 'N/a'"
                    />
                    <InfoList
                        label="Pag-ibig ID"
                        :value="employee.pag_ibig_id ?? 'N/a'"
                    />
                    <InfoList
                        label="TIN ID"
                        :value="employee.tin_id ?? 'N/a'"
                    />
                    <InfoList
                        label="GSIS ID"
                        :value="employee.gsis_id ?? 'N/a'"
                    />
                </FormContainer>

                <FormContainer>
                    <Label class="col-span-2">Documents</Label>
                    <Label
                        class="col-span-2"
                        v-for="document in employee.documents"
                    >
                        <a
                            class="text-blue-500 underline"
                            target="_blank"
                            :href="getFileUrl(document.path)"
                        >
                            {{ document.name }}
                        </a>
                    </Label>
                    <Label v-if="employee.documents.length < 1"
                        >Nothing to show</Label
                    >
                </FormContainer>
            </section>
        </section>

        <BackButton />
    </MainLayout>
</template>
