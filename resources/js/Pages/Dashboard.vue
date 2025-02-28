<script setup>
import SummaryBox from "@/Components/SummaryBox.vue";
</script>

<template>
    <MainLayout>
        <section class="grid grid-cols-3 gap-10">
            <SummaryBox
                heading="Total Employees"
                value="10"
                subheading="Total number of employees"
            />
            <SummaryBox
                heading="Total Users"
                value="10"
                subheading="Total number of users"
            />
            <SummaryBox
                heading="Total Documents"
                value="10"
                subheading="Total number of documents"
            />
        </section>
    </MainLayout>
</template>
