<script setup>
import SummaryBox from "@/Components/SummaryBox.vue";
import Chart from "primevue/chart";
import { ref, onMounted } from "vue";

const { sexCounts, statuses, classifications } = defineProps({
    sexCounts: {
        type: Object,
        required: true,
    },
    statuses: {
        type: Object,
        required: true,
    },
    classifications: {
        type: Object,
        required: true,
    },
    counts: {
        type: Object,
        required: true,
    },
});

onMounted(() => {
    chartData.value = setChartData();
    chartOptions.value = setChartOptions();

    chartDataStatus.value = setChartDataStatus();
    chartOptionsStatus.value = setChartOptionsStatus();

    chartDataClassifications.value = setChartDataClassifications();
    chartOptionsClassifications.value = setChartOptionsClassifications();
});

const chartData = ref();
const chartOptions = ref();

const setChartData = () => {
    const documentStyle = getComputedStyle(document.body);

    return {
        labels: ["Male", "Female"],
        datasets: [
            {
                data: [
                    sexCounts["male"] ? sexCounts["male"]["percentage"] : 0,
                    sexCounts["female"] ? sexCounts["female"]["percentage"] : 0,
                ],
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
            tooltip: {
                callbacks: {
                    label: function (context) {
                        return context.label + ": " + context.raw + "%";
                    },
                },
            },
        },
    };
};

const chartDataStatus = ref();
const chartOptionsStatus = ref();

const setChartDataStatus = () => {
    const documentStyle = getComputedStyle(document.body);

    return {
        labels: [
            "Casual",
            "Permanent",
            "Contract of service / Job order personnel",
        ],
        datasets: [
            {
                data: [
                    statuses["casual"] ? statuses["casual"]["percentage"] : 0,
                    statuses["permanent"]
                        ? statuses["permanent"]["percentage"]
                        : 0,
                    statuses["contractOfService/JobOrderPersonnel"]
                        ? statuses["contractOfService/JobOrderPersonnel"][
                              "percentage"
                          ]
                        : 0,
                ],
                backgroundColor: [
                    documentStyle.getPropertyValue("--p-cyan-500"),
                    documentStyle.getPropertyValue("--p-orange-500"),
                    documentStyle.getPropertyValue("--p-gray-500"),
                ],
                hoverBackgroundColor: [
                    documentStyle.getPropertyValue("--p-cyan-400"),
                    documentStyle.getPropertyValue("--p-orange-400"),
                    documentStyle.getPropertyValue("--p-gray-400"),
                ],
            },
        ],
    };
};

const setChartOptionsStatus = () => {
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
            tooltip: {
                callbacks: {
                    label: function (context) {
                        return context.label + ": " + context.raw + "%";
                    },
                },
            },
        },
    };
};

const chartDataClassifications = ref();
const chartOptionsClassifications = ref();
const setChartDataClassifications = () => {
    const documentStyle = getComputedStyle(document.body);

    return {
        labels: ["Teaching", "Non-Teaching"],
        datasets: [
            {
                data: [
                    classifications["teaching"]
                        ? classifications["teaching"]["percentage"]
                        : 0,
                    classifications["non teaching"]
                        ? classifications["non teaching"]["percentage"]
                        : 0,
                ],
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

const setChartOptionsClassifications = () => {
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
            tooltip: {
                callbacks: {
                    label: function (context) {
                        return context.label + ": " + context.raw + "%";
                    },
                },
            },
        },
    };
};
</script>

<template>
    <MainLayout>
        <DivHeading title="Dashboard"> </DivHeading>
        <section class="grid grid-cols-1 gap-10">
            <SummaryBox
                heading="Total Employees"
                :value="counts['employees']"
                subheading="Total number of employees"
            />
            <!-- <SummaryBox
                heading="Total Users"
                :value="counts['users']"
                subheading="Total number of users"
            /> -->
        </section>

        <section class="grid grid-cols-3 gap-5">
            <Chart
                type="doughnut"
                :data="chartData"
                :options="chartOptions"
                class="w-full"
            />
            <Chart
                type="pie"
                :data="chartDataStatus"
                :options="chartOptionsStatus"
                class="w-full"
            />
            <Chart
                type="doughnut"
                :data="chartDataClassifications"
                :options="chartOptionsClassifications"
                class="w-full"
            />
        </section>
    </MainLayout>
</template>
