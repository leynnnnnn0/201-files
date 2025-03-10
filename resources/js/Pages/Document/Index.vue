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
                    <TH>Office Number</TH>
                    <TH>Special Number</TH>
                    <TH>Person Indicated</TH>
                    <TH>Document Name</TH>
                    <TH>Description</TH>
                    <TH>Actions</TH>
                </TableHead>
                <TableBody>
                    <tr v-for="document in documents.data">
                        <TD>{{ document.office_number ?? "None" }}</TD>
                        <TD>{{ document.special_number ?? "None" }}</TD>
                        <TD>{{ document.person_indicated }}</TD>
                        <TD>{{ document.name }}</TD>
                        <TD>{{ document.description ?? "None" }}</TD>
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
