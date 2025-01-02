<template>
    <div class="chart-container">
        <Bar
            class="chart-left"
            :data="userChartData"
            :options="chartOptions"
        />

        <Bar
            class="chart-right"
            :data="bookChartData"
            :options="chartOptions"
        />
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Bar } from 'vue-chartjs';
import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    BarElement,
    CategoryScale,
    LinearScale
} from 'chart.js';

ChartJS.register(
    Title,
    Tooltip,
    Legend,
    BarElement,
    CategoryScale,
    LinearScale
);

const truncateLabel = (text, maxLength) => {
    if (text.length > maxLength) {
        return text.substring(0, maxLength) + '...';
    }
    return text;
};

const props = defineProps({
    topUsers: {
        type: Array,
        required: true,
        default: () => []
    },

    topBooks: {
        type: Array,
        required: true,
        default: () => []
    }
});

const userChartData = computed(() => ({
    labels: props.topUsers.map((user) => truncateLabel(user.name, 10)),
    datasets: [
        {
            label: 'Số lượt mượn',
            data: props.topUsers.map((user) => user.orders_count),
            backgroundColor: 'rgba(75, 192, 192, 0.5)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }
    ]
}));

/**
 * Get data for chart
 *
 * @returns {Object}
 */
const bookChartData = computed(() => ({
    labels: props.topBooks.map((book) => truncateLabel(book.name, 10)),
    datasets: [
        {
            label: 'Số lượt mượn',
            data: props.topBooks.map((book) => book.borrowing_number),
            backgroundColor: 'rgba(153, 102, 255, 0.5)',
            borderColor: 'rgba(153, 102, 255, 1)',
            borderWidth: 1
        }
    ]
}));

const chartOptions = {
    indexAxis: 'y',
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        legend: { position: 'top' }
    },
    barPercentage: 0.8,
    categoryPercentage: 0.8
};
</script>

<style lang="scss" scoped>
.chart-container {
    display: flex;
    gap: 20px;
    .chart-left {
        min-height: 350px;
        height: 350px;
        max-height: 350px;
        max-width: 50%;
        display: block;
        width: 444px;
    }
    .chart-right {
        min-height: 350px;
        height: 350px;
        max-height: 350px;
        max-width: 45%;
        display: block;
        width: 444px;
    }
}
</style>
