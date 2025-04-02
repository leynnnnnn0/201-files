// First install these packages: // npm install @fullcalendar/vue3
@fullcalendar/core @fullcalendar/daygrid @fullcalendar/timegrid
@fullcalendar/interaction

<script setup>
import SummaryBox from "@/Components/SummaryBox.vue";
import Chart from "primevue/chart";
import { ref, onMounted } from "vue";
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";

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

// Calendar configuration
const calendarOptions = ref({
    plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
    initialView: "dayGridMonth",
    headerToolbar: {
        left: "prev,next today",
        center: "title",
        right: "dayGridMonth,timeGridWeek,timeGridDay",
    },
    editable: true,
    selectable: true,
    selectMirror: true,
    dayMaxEvents: true,
    weekends: true,
    height: "auto", // Makes it responsive
    // Sample events - replace with your own
    // events: [
    //     {
    //         title: "Meeting",
    //         start: new Date().toISOString().split("T")[0], // Today's date
    //         backgroundColor: "#4338ca", // Custom color
    //     },
    // ],
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

// Calendar event handling
const handleDateSelect = (selectInfo) => {
    const title = prompt("Please enter a new title for your event");
    const calendarApi = selectInfo.view.calendar;

    if (title) {
        calendarApi.addEvent({
            title,
            start: selectInfo.startStr,
            end: selectInfo.endStr,
            allDay: selectInfo.allDay,
        });
    }
    calendarApi.unselect();
};

const handleEventClick = (clickInfo) => {
    if (
        confirm(
            `Are you sure you want to delete the event '${clickInfo.event.title}'`
        )
    ) {
        clickInfo.event.remove();
    }
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

        <section class="grid grid-cols-3 gap-5 mb-8">
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

        <!-- Calendar Section with full width -->
        <section class="w-full">
            <div class="p-4 bg-white rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4">Calendar</h2>
                <div class="calendar-container">
                    <FullCalendar
                        :options="calendarOptions"
                        @dateSelect="handleDateSelect"
                        @eventClick="handleEventClick"
                    />
                </div>
            </div>
        </section>
    </MainLayout>
</template>

<style>
/* Ensure the calendar container allows full width */
.calendar-container {
    width: 100%;
    overflow: hidden;
}

/* Customize FullCalendar styles if needed */
.fc {
    width: 100%;
    font-family: inherit;
}

.fc .fc-toolbar {
    flex-wrap: wrap;
    gap: 8px;
}

/* Make responsive adjustments for smaller screens */
@media (max-width: 768px) {
    .fc .fc-toolbar {
        flex-direction: column;
        align-items: center;
    }

    .fc .fc-toolbar-title {
        font-size: 1.2em;
    }
}
</style>
