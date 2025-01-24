<script setup>
import useDelete from "@/Composables/useDelete.js";
import { useSearch } from "@/Composables/useSearch";

defineProps({
    data: {
        type: Object,
        required: true,
    },
});
const { search } = useSearch("designations.index");
const { deleteModel } = useDelete("Designation");
</script>
<template>
    <MainLayout>
        <DivFlexCenter class="justify-between">
            <Heading>Designations</Heading>
            <Link
                :href="route('designations.create')"
                class="text-white bg-slate-900 px-4 py-2 rounded-lg text-sm"
                >Create New Office</Link
            >
        </DivFlexCenter>
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
                    <TH>ID</TH>
                    <TH>Name</TH>
                    <TH>Remarks</TH>
                    <TH>Action</TH>
                </TableHead>
                <TableBody>
                    <tr v-for="item in data.data">
                        <TD>{{ item.id }}</TD>
                        <TD>{{ item.name }}</TD>
                        <TD>{{ item.remarks ?? "N/a" }}</TD>
                        <TD class="flex items-center gap-2">
                            <ShowButton />
                            <EditButton
                                :isLink="true"
                                :href="route('designations.edit', item.id)"
                            />
                            <DeleteButton
                                @click="
                                    deleteModel(
                                        route('designations.destroy', item.id)
                                    )
                                "
                            />
                        </TD>
                    </tr>
                </TableBody>
            </Table>
            <Pagination :data="data" />
        </TableContainer>
    </MainLayout>
</template>
