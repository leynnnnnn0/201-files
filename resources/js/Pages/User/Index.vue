<script setup>
import useDelete from "@/Composables/useDelete.js";
import { useSearch } from "@/Composables/useSearch";
const { users } = defineProps({
    users: {
        type: Object,
        required: true,
    },
});

const { search } = useSearch("users.index");

const { deleteModel } = useDelete("User");
</script>
<template>
    <MainLayout>
        <DivHeading title="List of Users">
            <LinkButton :href="route('users.create')">
                Create New User
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
                    <TH>Email</TH>
                    <TH>Phone Number</TH>
                    <TH>Actions</TH>
                </TableHead>
                <TableBody>
                    <tr v-for="user in users.data">
                        <TD>{{ user.id }}</TD>
                        <TD>{{ user.full_name }}</TD>
                        <TD>{{ user.email }}</TD>
                        <TD>{{ user.phone_number ?? "N/a" }}</TD>
                        <TD class="flex flex-center gap-3">
                            <ShowButton
                                :isLink="true"
                                :href="route('users.show', user.id)"
                            />
                            <EditButton
                                :isLink="true"
                                :href="route('users.edit', user.id)"
                            />
                            <DeleteButton
                                @click="
                                    deleteModel(route('users.destroy', user.id))
                                "
                            />
                        </TD>
                    </tr>
                </TableBody>
            </Table>
            <Pagination :data="users" />
        </TableContainer>
    </MainLayout>
</template>
