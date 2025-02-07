<script setup>
import useDelete from "@/Composables/useDelete.js";
import { useSearch } from "@/Composables/useSearch";
defineProps({
    documents: {
        type: Object,
        required: true,
    },
});

const { deleteModel } = useDelete("Document");
const { search } = useSearch("documents.index");
const getFileUrl = (path) => {
    return `/storage/${path}`;
};
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
                    <TH>Employee</TH>
                    <TH>Document Name</TH>
                    <TH>Description</TH>
                    <TH>Actions</TH>
                </TableHead>
                <TableBody>
                    <tr v-for="document in documents.data">
                        <TD>{{ document.id }}</TD>
                        <TD>{{ document.employee?.first_name ?? "N/a" }}</TD>
                        <TD>{{ document.name }}</TD>
                        <TD>{{ document.description ?? "N/a" }}</TD>
                        <TD class="flex flex-center gap-3">
                            <a
                                target="_blank"
                                :href="getFileUrl(document.path)"
                            >
                                <Eye />
                            </a>
                            <EditButton
                                :isLink="true"
                                :href="route('documents.edit', document.id)"
                            />
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
