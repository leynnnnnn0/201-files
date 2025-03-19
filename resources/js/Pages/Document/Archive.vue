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
const { deleteModel } = useDelete("Document", "delete");
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
                    <TH>Office Number</TH>
                    <TH>Special Number</TH>
                    <TH>Person Indicated</TH>
                    <TH>Description</TH>
                    <TH>Actions</TH>
                </TableHead>
                <TableBody>
                    <tr v-for="document in documents.data">
                        <TD>{{ document.office_number ?? "None" }}</TD>
                        <TD>{{ document.special_number ?? "None" }}</TD>
                        <TD>{{ document.person_indicated }}</TD>
                        <TD>{{ document.description ?? "None" }}</TD>
                        <TD class="flex items-center flex-center gap-3">
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
