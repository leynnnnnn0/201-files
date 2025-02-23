<script setup>
import useRestore from "@/Composables/useRestore.js";
import { useSearch } from "@/Composables/useSearch";
const { users } = defineProps({
    users: {
        type: Object,
        required: true,
    },
});

const { search } = useSearch("users.index");

const { restoreModel } = useRestore("User");
</script>
<template>
    <MainLayout>
        <DivHeading title="List of Archived Users"> </DivHeading>
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
                            <RestoreButton
                                @click="
                                    restoreModel(
                                        route('archives.users-restore', user.id)
                                    )
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
