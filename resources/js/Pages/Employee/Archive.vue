<script setup>
import useRestore from "@/Composables/useRestore.js";
import { useSearch } from "@/Composables/useSearch";
const { employees } = defineProps({
    employees: {
        type: Object,
        required: true,
    },
});

const { search } = useSearch("employees.index");

const { restoreModel } = useRestore("Employees", "delete");
</script>
<template>
    <MainLayout>
        <DivHeading title="List of Archived Employees"> </DivHeading>
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
                    <TH>Full Name</TH>
                    <TH>Designation</TH>
                    <TH>Position</TH>
                    <TH>Email</TH>
                    <TH>Phone Number</TH>
                    <TH>Actions</TH>
                </TableHead>
                <TableBody>
                    <tr v-for="employee in employees.data">
                        <TD>{{ employee.id }}</TD>
                        <TD>{{ employee.full_name }}</TD>
                        <TD>{{ employee.designation }}</TD>
                        <TD>{{ employee.position }}</TD>
                        <TD>{{ employee.email }}</TD>
                        <TD>{{ employee.phone_number ?? "N/a" }}</TD>
                        <TD class="flex flex-center gap-3">
                            <ShowButton
                                :isLink="true"
                                :href="route('employees.show', employee.id)"
                            />
                            <RestoreButton
                                @click="
                                    restoreModel(
                                        route(
                                            'archives.employees-restore',
                                            employee.id
                                        )
                                    )
                                "
                            />
                        </TD>
                    </tr>
                </TableBody>
            </Table>
            <Pagination :data="employees" />
        </TableContainer>
    </MainLayout>
</template>
