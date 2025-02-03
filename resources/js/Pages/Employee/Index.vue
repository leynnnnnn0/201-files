<script setup>
import useDelete from "@/Composables/useDelete.js";
import { useSearch } from "@/Composables/useSearch";
const { employees } = defineProps({
    employees: {
        type: Object,
        required: true,
    },
});

const { search } = useSearch("employees.index");

const { deleteModel } = useDelete("employee");
</script>
<template>
    <MainLayout>
        <DivHeading title="List Of Employees">
            <LinkButton :href="route('employees.create')">
                Create New Employee
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
                        <TD>{{ employee.designation.name }}</TD>
                        <TD>{{ employee.position.name }}</TD>
                        <TD>{{ employee.email }}</TD>
                        <TD>{{ employee.phone_number ?? "N/a" }}</TD>
                        <TD class="flex flex-center gap-3">
                            <ShowButton />
                            <EditButton
                                :isLink="true"
                                :href="route('employees.edit', employee.id)"
                            />
                            <DeleteButton
                                @click="
                                    deleteModel(
                                        route('employees.destroy', employee.id)
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
