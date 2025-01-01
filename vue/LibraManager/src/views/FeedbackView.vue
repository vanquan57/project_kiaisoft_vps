<template>
    <div>
        <div class="feedback-management-container">
            <div class="feedback-management-breadcrumb-container">
                <h1>Quản lý phản hồi</h1>
                <BreadcrumbComponent
                    class="feedback-management-breadcrumb"
                    :breadcrumb-list="breadcrumbList"
                />
            </div>
            <div class="feedback-management-search">
                <SearchForm
                    placeholder="Nhập tên sách ..."
                    :is-has-date="true"
                    @search="handleSearch"
                    :data-book="dataBooks"
                />
            </div>
            <div class="feedback-management-content">
                <ListFeedback
                    :table-data="tableData"
                    @handle-option-delete="handleOptionDelete"
                    @handle-option-update="handleOptionUpdate"
                />
            </div>
            <div
                v-if="tableData.length > 0"
                class="feedback-management-pagination"
            >
                <PaginationComponent
                    :total="dataPagination.total"
                    :current-page="dataPagination.currentPage"
                    :page-size="dataPagination.limit"
                    @current-page="handlePageChange"
                />
            </div>
        </div>
    </div>
</template>

<script setup>
import BreadcrumbComponent from '@/components/breadcrumb/BreadcrumbComponent.vue';
import SearchForm from '@/components/search/SearchComponent.vue';
import ListFeedback from '@/components/feedback/ListFeedback.vue';
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import PaginationComponent from '@/components/pagination/PaginationComponent.vue';
import axiosInstance from '@/config/axios';
import HTTP_STATUS_CODE from '@/config/statusCode';
import { useRouter } from 'vue-router';
import { ElMessage, ElNotification } from 'element-plus';

const router = useRouter();
const route = useRoute();
const props = defineProps({
    site: {
        type: String,
        default: 'list'
    },
    id: {
        type: Number,
        required: false,
        default: null
    }
});
const dataBooks = ref([]);
const breadcrumbList = ref([
    {
        name: 'Trang chủ',
        path: '/'
    },
    {
        name: 'Phản hồi',
        path: '/feedback'
    }
]);


const dataPagination = ref({
    limit: 10,
    total: 0,
    currentPage: 1
});
const tableData = ref([]);

/**
 * Get feedbacks
 *
 * @returns {Promise<void>}
 */
const getFeedbacks = async (page = 1, order = null, column = null) => {
    try {
        const response = await axiosInstance.get('/feedback', {
            params: {
                page,
                limit: dataPagination.value.limit,
                order,
                column
            }
        });
        if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
            tableData.value = response.data.data;
            dataPagination.value.total = response.data.total;
            dataPagination.value.currentPage = response.data.current_page;
        }
    } catch (error) {
    }
};

const getBooks = async () => {
    const response = await axiosInstance.get('/book', {
        params: {
            limit: 1000
        }
    });
    if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
        dataBooks.value = response.data.data;
    }
};

/**
 * The method handle mount
 *
 * @returns {Promise<void>}
 */
onMounted(async () => {
    await getFeedbacks(dataPagination.value.currentPage, 'asc', 'status');
    await getBooks();
});

/**
 * The method handle search
 *
 * @param {string} search - The search
 *
 * @returns {Promise<void>}
 */
const handleSearch = async (search) => {
    const queryParams = {};

    if (search.book_id) {
        queryParams.book_id = search.book_id;
    }

    if (search.startDate) {
        queryParams.start_date = search.startDate;
    }

    if (search.endDate) {
        queryParams.end_date = search.endDate;
    }

    queryParams.order = 'desc';
    queryParams.column = 'status';

    if (Object.keys(queryParams).length > 0) {
        router.push({
            path: route.path,
            query: queryParams
        });
        try {
            const response = await axiosInstance.get('/feedback', {
                params: queryParams
            });
            if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
                tableData.value = response.data.data;
                dataPagination.value.total = response.data.total;
                dataPagination.value.currentPage = response.data.current_page;
            }
        } catch (error) {
        }
    }
};

/**
 * The method handle page change
 *
 * @param {number} page - The page number
 *
 * @returns {Promise<void>}
 */
const handlePageChange = (page) => {
    dataPagination.value.currentPage = page;
    getFeedbacks(page, 'asc', 'status');
};

/**
 * The method handle option delete
 *
 * @param {number} id - The id
 *
 * @returns {Promise<void>}
 */
const handleOptionDelete = async (id) => {
    try {
        const response = await axiosInstance.delete(`/feedback/${id}`);

        if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
            ElNotification.success({
                title: 'Thành công',
                message: 'Xóa phản hồi thành công'
            });

            tableData.value = tableData.value.filter((item) => item.id !== id);
        }
    } catch (error) {
        ElNotification.error({
            title: 'Thất bại',
            message: 'Có lỗi xảy ra khi xóa phản hồi'
        });
    }
};

/**
 * The method handle option update
 *
 * @param {number} id - The id
 * @param {number} newStatus - The new status
 * @returns {Promise<void>}
 */
const handleOptionUpdate = async (id, newStatus) => {
    try {
        const response = await axiosInstance.put(`/feedback/${id}`, {
            status: newStatus
        });

        if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
            ElNotification.success({
                title: 'Thành công',
                message: 'Cập nhật trạng thái thành công'
            });

            tableData.value = tableData.value.map((item) => {
                if (item.id === id) {
                    item.status = newStatus;
                }
                return item;
            });
        }
    } catch (error) {
        ElNotification.error({
            title: 'Thất bại',
            message: 'Có lỗi xảy ra khi cập nhật trạng thái'
        });
    }
};
</script>

<style lang="scss" scoped>
.feedback-management-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
    height: 100%;
    padding-bottom: 15px;
    .feedback-management-breadcrumb-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        margin: 10px 0;
        padding: 0 10px;
        h1 {
            font-size: 24px;
            font-weight: bold;
        }
    }
    .feedback-button {
        margin: 5px 10px;
        align-self: flex-start;
    }
    .feedback-management-search {
        width: 100%;
    }
    .feedback-management-content {
        width: 100%;
    }
    .feedback-management-pagination {
        margin-top: 10px;
    }
}
</style>
