<script setup>
import useRestore from "@/Composables/useRestore.js";
import { useSearch } from "@/Composables/useSearch";
import useDelete from "@/Composables/useDelete.js";
const { documents } = defineProps({
    documents: {
        type: Object,
        required: true,
    },
});
const { deleteModel } = useDelete("Document");
const { search } = useSearch("documents.index");
const { restoreModel } = useRestore("Documents");
const getFileUrl = (path) => {
    return `/storage/${path}`;
};
</script>
<template>
    <MainLayout>
        <DivHeading title="List of Archived Documents"> </DivHeading>
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
                    <TH>Description</TH>
                    <TH>Actions</TH>
                </TableHead>
                <TableBody>
                    <tr v-for="document in documents.data">
                        <TD>{{ document.id }}</TD>
                        <TD>{{ document.name }}</TD>
                        <TD>{{ document.description ?? "N/a" }}</TD>
                        <TD class="flex flex-center gap-3">
                            <ShowButton
                                :isLink="true"
                                :href="route('documents.show', document.id)"
                            />
                            <RestoreButton
                                @click="
                                    restoreModel(
                                        route(
                                            'archives.documents-restore',
                                            document.id
                                        )
                                    )
                                "
                            />
                            <ForceDeleteButton
                                @click="
                                    deleteModel(
                                        route(
                                            'archives.documents-delete',
                                            document.id
                                        )
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
