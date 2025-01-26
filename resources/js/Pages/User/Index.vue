<script setup>
import { useSearch } from "@/Composables/useSearch";
const { users } = defineProps({
    users: {
        type: Object,
        required: true,
    },
});

const { search } = useSearch("positions.index");
</script>
<template>
    <MainLayout>
        <Heading>Users</Heading>
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
                    <TH>Email</TH>
                    <TH>Phone Number</TH>
                </TableHead>
                <TableBody>
                    <tr v-for="user in users.data">
                        <TD>{{ user.id }}</TD>
                        <TD>{{ user.full_name }}</TD>
                        <TD>{{ user.email }}</TD>
                        <TD>{{ user.phone_number ?? "N/a" }}</TD>
                        <TD class="flex flex-center gap-3">
                            <ShowButton />
                            <EditButton />
                            <DeleteButton />
                        </TD>
                    </tr>
                </TableBody>
            </Table>
            <Pagination :data="users" />
        </TableContainer>
    </MainLayout>
</template>
