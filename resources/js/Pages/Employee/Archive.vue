<script setup>
import useRestore from "@/Composables/useRestore.js";
import { useSearch } from "@/Composables/useSearch";
import useDelete from "@/Composables/useDelete.js";
import { ref } from "vue";
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

const teachingColor = (teaching, status) => {
    const teachingLower = teaching.toLowerCase();
    const statusLower = status.toLowerCase();
    console.log(statusLower == "permanent" && teachingLower == "non teaching");
    if (statusLower == "permanent" && teachingLower == "teaching") {
        return "bg-yelow-500 text-white";
    } else if (statusLower == "permanent" && teachingLower == "non teaching") {
        return "bg-red-500 text-white";
    } else if (statusLower == "cos/jop" && teachingLower == "teaching") {
        return "bg-green-300 text-white";
    } else if (statusLower == "cos/jop" && teachingLower == "non teaching") {
        return "bg-green-700 text-white";
    } else {
        return "bg-gray-500 text-white";
    }
};

const { deleteModel } = useDelete("Employee  ", "delete");
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
                    <TH>#</TH>
                    <TH>ID Number</TH>
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
                        <TD>{{ employees.data.indexOf(employee) + 1 }}</TD>
                        <TD>{{ employee.id_number }}</TD>
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
                                        employee.employment_classification,
                                        employee.status
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
                            <ForceDeleteButton
                                @click="
                                    deleteModel(
                                        route(
                                            'archives.employees-delete',
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
