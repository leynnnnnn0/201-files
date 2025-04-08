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

const statusColor = (status) => {
    const statusLower = status.toLowerCase();
    switch (statusLower) {
        case "permanent":
            return "bg-green-500 text-white";
        case "casual":
            return "bg-blue-500 text-white";
        case "cos/jop":
            return "bg-yellow-500 text-white";
        default:
            return "bg-gray-500 text-white";
    }
};

const sexColor = (sex) => {
    const sexLower = sex.toLowerCase();

    switch (sexLower) {
        case "male":
            return "bg-blue-500 text-white";
        default:
            return "bg-pink-500 text-white";
    }
};

const teachingColor = (teaching) => {
    const teachingLower = teaching.toLowerCase();

    switch (teachingLower) {
        case "teaching":
            return "bg-green-500 text-white";
        default:
            return "bg-gray-500 text-white";
    }
};

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
                    <TH>Office/Colleges</TH>
                    <TH>Position</TH>
                    <TH>Status</TH>
                    <TH>Employment Classfication</TH>
                    <TH>Sex</TH>
                    <TH>Actions</TH>
                </TableHead>
                <TableBody>
                    <tr v-for="employee in employees.data">
                        <TD>{{ employee.id }}</TD>
                        <TD>{{ employee.full_name }}</TD>
                        <TD>{{ employee.office_colleges }}</TD>
                        <TD> {{ employee.position }}</TD>
                        <TD>
                            <span
                                class="px-3 py-1 font-bold text-xs rounded-lg"
                                :class="statusColor(employee.status)"
                            >
                                {{ employee.status.toUpperCase() }}
                            </span>
                        </TD>
                        <TD>
                            <span
                                class="px-3 py-1 font-bold text-xs rounded-lg"
                                :class="
                                    teachingColor(
                                        employee.employment_classification
                                    )
                                "
                            >
                                {{
                                    employee.employment_classification.toUpperCase()
                                }}
                            </span></TD
                        >
                        <TD>
                            <span
                                class="px-3 py-1 font-bold text-xs rounded-lg"
                                :class="sexColor(employee.sex)"
                            >
                                {{ employee.sex.toUpperCase() }}
                            </span></TD
                        >
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
