<script setup>
defineProps({
    documents: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <MainLayout>
        <DivHeading title="List of Documents">
            <LinkButton :href="route('documents.create')">
                Upload New Document
            </LinkButton>
        </DivHeading>
        <TableContainer>
            <TableHeader>
                <SearchBar>
                    <Input
                        class="pl-10"
                        v-model="search"
                        placeholder="Search..."
                    />
                </SearchBar>
            </TableHeader>
            <Table>
                <TableHead>
                    <TH>Id</TH>
                    <TH>Document Name</TH>
                    <TH>Remarks</TH>
                    <TH>Actions</TH>
                </TableHead>
                <TableBody>
                    <tr v-for="document in documents.data">
                        <TD>{{ document.id }}</TD>
                        <TD>{{ document.title }}</TD>
                        <TD class="flex flex-center gap-3">
                            <ShowButton />
                            <EditButton />
                            <DeleteButton
                                @click="
                                    deleteModel(
                                        route('documents.destroy', document.id)
                                    )
                                "
                            />
                        </TD>
                    </tr>
                </TableBody>
            </Table>
            <Pagination :data="documents" />
        </TableContainer>
    </MainLayout>
</template>
