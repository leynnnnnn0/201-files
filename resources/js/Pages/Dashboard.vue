<script setup>
import SummaryBox from "@/Components/SummaryBox.vue";
import Chart from "primevue/chart";
import { ref, onMounted } from "vue";

const { sexCounts } = defineProps({
    sexCounts: {
        type: Object,
        required: true,
    },
});

onMounted(() => {
    chartData.value = setChartData();
    chartOptions.value = setChartOptions();
});

const chartData = ref();
const chartOptions = ref();

const setChartData = () => {
    const documentStyle = getComputedStyle(document.body);

    return {
        labels: ["Male", "Female"],
        datasets: [
            {
                data: [sexCounts["male"], sexCounts["female"]],
                backgroundColor: [
                    documentStyle.getPropertyValue("--p-cyan-500"),
                    documentStyle.getPropertyValue("--p-orange-500"),
                ],
                hoverBackgroundColor: [
                    documentStyle.getPropertyValue("--p-cyan-400"),
                    documentStyle.getPropertyValue("--p-orange-400"),
                ],
            },
        ],
    };
};

const setChartOptions = () => {
    const documentStyle = getComputedStyle(document.documentElement);
    const textColor = documentStyle.getPropertyValue("--p-text-color");

    return {
        plugins: {
            legend: {
                labels: {
                    usePointStyle: true,
                    color: textColor,
                },
            },
        },
    };
};
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

        <section class="grid grid-cols-3 gap-5">
            <Chart
                type="pie"
                :data="chartData"
                :options="chartOptions"
                class="w-full md:w-[30rem]"
            />
        </section>
    </MainLayout>
</template>
