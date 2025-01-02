<template>
    <div class="dashboard-container">
        <div class="dashboard-item">
            <h1>
                Top 10 người mượn sách nhiều nhất và 10 sách được mượn nhiều
                nhất
            </h1>
            <TopUserAndBook
                :top-users="topUsers"
                :top-books="topBooks"
            />
        </div>
        <div class="dashboard-container__month__category">
            <div class="dashboard-item">
                <h1>Số lượng đơn hàng theo từng tháng</h1>
                <TotalOrdersByMonth :total-orders-by-month="totalOrdersByMonth" />
            </div>
            <div class="dashboard-item">
                <h1>Tổng số lượng sách trong mỗi loại danh mục</h1>
                <TotalBookInCategory :pie-chart-data="pieChartData" />
            </div>
        </div>
        <div class="dashboard-item">
            <h1>Sách được yêu thích nhiều nhất</h1>
            <TopMostPopularBooks :top-most-popular-books="topMostPopularBooks" />
        </div>
    </div>
</template>

<script setup>
import TopUserAndBook from '@/components/chart/TopUsersAndBooks.vue';
import TotalBookInCategory from '@/components/chart/TotalBooksInCategories.vue';
import TotalOrdersByMonth from '@/components/chart/TotalOrdersByMonth.vue';
import TopMostPopularBooks from '@/components/chart/TopMostPopularBooks.vue';
import { onMounted } from 'vue';
import axios from '@/config/axios';
import HTTP_STATUS_CODE from '@/config/statusCode';
import { ref } from 'vue';

const topUsers = ref([]);
const topBooks = ref([]);
const pieChartData = ref([]);
const totalOrdersByMonth = ref([]);
const topMostPopularBooks = ref([]);

/**
 * Get data from API and render to the page
 *
 * @returns {Promise<void>}
*/
onMounted(async () => {
    await getDataDashboard();
});

/**
 * Get data admin dashboard
 *
 * @returns {Promise<void>}
*/
const getDataDashboard = async () => {
    try {
        const response = await axios.get('dashboard');

        if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
            topUsers.value = response.data.topUsers;
            topBooks.value = response.data.topBooks;
            pieChartData.value = response.data.totalBooksInCategories;
            totalOrdersByMonth.value = response.data.totalOrders;
            topMostPopularBooks.value = response.data.topMostLikesBook;
        }
    } catch (error) {}
};

</script>

<style lang="scss" scoped>
.dashboard-container {
    display: flex;
    flex-direction: column;
    gap: 30px;
    margin: 20px;
    .dashboard-item {
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 10px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: inset 2px 2px 2px rgba(1, 1, 1, 0.3),
            inset -2px -2px 2px rgba(205, 205, 205, 0.9);
        h1 {
            font-size: 16px;
            font-weight: 600;
            text-align: center;
            margin: 10px 0;
            text-transform: uppercase;
        }
    }
    .dashboard-container__month__category{
        display: flex;
        flex-direction: row;
        gap: 30px;
    }
}
</style>
