<script setup>
import { useForm } from "@inertiajs/vue3";
import useStore from "@/Composables/useStore";

defineProps({
    data: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    name: null,
    office_code: null,
    remarks: null,
});
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
                            <EditButton />
                            <DeleteButton />
                        </TD>
                    </tr>
                </TableBody>
            </Table>
            <Pagination :data="data" />
        </TableContainer>
    </MainLayout>
</template>
