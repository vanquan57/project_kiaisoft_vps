<template>
    <section>
        <div class="search-form-container">
            <el-form
                ref="searchFormRef"
                :model="searchForm"
                class="search-form"
                @submit.prevent="handleSearch"
            >
                <el-form-item prop="dateRange">
                    <el-date-picker
                        v-model="searchForm.start_date"
                        type="date"
                        :placeholder="`Chọn ngày bắt đầu`"
                        format="DD/MM/YYYY"
                        value-format="YYYY-MM-DD"
                    />
                </el-form-item>
                <el-form-item prop="dateRange">
                    <el-date-picker
                        v-model="searchForm.end_date"
                        type="date"
                        :placeholder="`Chọn ngày kết thúc`"
                        format="DD/MM/YYYY"
                        value-format="YYYY-MM-DD"
                    />
                </el-form-item>
                <el-form-item prop="status">
                    <el-select
                        v-model="searchForm.status"
                        :placeholder="`Chọn trạng thái`"
                    >
                        <el-option
                            v-for="item in statusOptions"
                            :key="item.value"
                            :label="item.label"
                            :value="item.value"
                        />
                    </el-select>
                </el-form-item>
                <el-form-item justify="center">
                    <el-button
                        type="primary"
                        class="search-button"
                        native-type="submit"
                    >
                        Tìm kiếm
                    </el-button>
                </el-form-item>
            </el-form>
        </div>
        <div class="list-order-container">
            <el-table
                :data="tableData"
                class="table-order"
                :scrolling="true"
                empty-text="Không tìm thấy đơn mượn"
            >
                <el-table-column
                    label="STT"
                    width="80"
                    align="center"
                    type="index"
                />
                <el-table-column
                    prop="code"
                    label="Mã đơn mượn"
                    width="150"
                    align="center"
                    show-overflow-tooltip
                />
                <el-table-column
                    prop="order_details_count"
                    label="Số lượng"
                    width="100"
                    align="center"
                />
                <el-table-column
                    prop="status"
                    label="Trạng thái"
                    width="130"
                >
                    <template #default="{ row }">
                        <span
                            :class="{
                                'status-overdue':
                                    row.status === STATUS_CODE_ORDER.OVERDUE,
                                'status-borrowing':
                                    row.status === STATUS_CODE_ORDER.BORROWING,
                                'status-missing':
                                    row.status === STATUS_CODE_ORDER.MISSING,
                                'status-returned':
                                    row.status === STATUS_CODE_ORDER.RETURNED,
                            }"
                        >
                            {{
                                row.status === STATUS_CODE_ORDER.OVERDUE
                                    ? "Quá hạn"
                                    : row.status === STATUS_CODE_ORDER.BORROWING
                                        ? "Đang mượn"
                                        : row.status === STATUS_CODE_ORDER.MISSING
                                            ? "Mất sách"
                                            : "Đã trả"
                            }}
                        </span>
                    </template>
                </el-table-column>
                <el-table-column
                    prop="created_at"
                    label="Ngày mượn"
                    width="180"
                    align="center"
                >
                    <template #default="{ row }">
                        {{ formatDate(row.created_at) }}
                    </template>
                </el-table-column>
                <el-table-column
                    label="Tính năng"
                    width="180"
                    align="center"
                >
                    <template #default="{ row }">
                        <el-button
                            type="primary"
                            @click="handleViewDetails(row.id)"
                        >
                            Xem chi tiết
                        </el-button>
                    </template>
                </el-table-column>
            </el-table>
            <div
                v-if="tableData.length > 0"
                class="order-pagination"
            >
                <PaginationComponent
                    :total="dataPagination.total"
                    :current-page="dataPagination.currentPage"
                    :page-size="dataPagination.limit"
                    @current-page="handlePageChange"
                />
            </div>
        </div>
        <OrderDetails
            :order-details="orderDetails"
            @update-status-order-details="handleUpdateStatusOrderDetails"
        />
    </section>
</template>

<script setup>
import PaginationComponent from '@/components/pagination/PaginationComponent.vue';
import OrderDetails from '@/components/order/OrderDetails.vue';
import { onMounted, ref } from 'vue';
import STATUS_CODE_ORDER from '@/config/statusOrder';
import axiosInstance from '@/config/axios';
import { useAuthStore } from '@/stores/auth';
import HTTP_STATUS_CODE from '@/config/statusCode';
import { ElNotification } from 'element-plus';
import { useRouter } from 'vue-router';

const router = useRouter();
const authStore = useAuthStore();
const statusOptions = [
    {
        value: STATUS_CODE_ORDER.OVERDUE,
        label: 'Quá hạn'
    },
    {
        value: STATUS_CODE_ORDER.BORROWING,
        label: 'Đang mượn'
    },
    {
        value: STATUS_CODE_ORDER.MISSING,
        label: 'Mất sách'
    },
    {
        value: STATUS_CODE_ORDER.RETURNED,
        label: 'Đã trả'
    }
];
const searchFormRef = ref(null);
const searchForm = ref({
    start_date: '',
    end_date: '',
    status: ''
});
const tableData = ref([]);
const dataPagination = ref({
    limit: 10,
    total: 0,
    currentPage: 1
});
const orderDetails = ref({});

const handleSearch = async () => {
    await searchFormRef.value.validate((valid) => {
        if (valid) {
            getListOrder(1, dataPagination.value.limit);
        }
    });
};

const handlePageChange = (page) => {
    dataPagination.value.currentPage = page;
    getListOrder(page, dataPagination.value.limit);
};

const getListOrder = async (page = 1, limit = 10) => {
    try {
        const response = await axiosInstance.get('/order', {
            params: {
                page,
                limit,
                column: 'created_at',
                order: 'desc',
                ...searchForm.value
            }
        });

        if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
            tableData.value = response.data.data;
        }
    } catch (error) {}
};

/**
 * The method handle view details
 *
 * @param {number} idOrder - The id order
 *
 * @returns {Promise<void>}
 */
const handleViewDetails = async (idOrder) => {
    try {
        const response = await axiosInstance.get(`/order/${idOrder}`);
        if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
            orderDetails.value = response.data;
        }
    } catch (error) {
        ElNotification.error({
            title: 'Lỗi',
            message: 'Vui lòng thử lại sau',
            type: 'error'
        });
    }
};

const handleUpdateStatusOrderDetails = async (orderId, bookId, status, note = null) => {
    try {
        if (status === STATUS_CODE_ORDER.MISSING) {
            const response = await axiosInstance.put(`/order/${orderId}`, {
                book_id: bookId,
                note,
                status: STATUS_CODE_ORDER.MISSING
            });

            if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
                getListOrder(dataPagination.value.currentPage);
                ElNotification.success({
                    title: 'Thành công',
                    message: 'Cập nhật trạng thái thành công',
                    type: 'success'
                });
            }
        } else {
            const response = await axiosInstance.put(`/order/${orderId}`, {
                book_id: bookId,
                status: status
            });

            if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
                getListOrder(dataPagination.value.currentPage);
                ElNotification.success({
                    title: 'Thành công',
                    message: 'Cập nhật trạng thái thành công',
                    type: 'success'
                });
            }
        }
        handleViewDetails(orderId);
    } catch (error) {
        ElNotification.error({
            title: 'Lỗi',
            message: 'Vui lòng thử lại sau',
            type: 'error'
        });
    }
};

onMounted(() => {
    if (!authStore.checkTokenValidity()) {
        router.push({ name: 'auth-login' });
    } else {
        getListOrder();
    }
});

const formatDate = (inputDate) => {
    if (!inputDate) return '';

    const date = new Date(inputDate);
    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const year = date.getFullYear();

    return `${day}/${month}/${year}`;
};
</script>

<style lang="scss" scoped>
.search-form-container {
    padding: 10px 10px 10px 10px;
    box-sizing: border-box;
    overflow: hidden;
    .search-form {
        display: grid;
        grid-template-columns: 2fr 2fr 2fr 1fr;
        gap: 10px;
        .search-button {
            width: 100%;
        }
        .el-form-item {
            @media (max-width: 768px) {
                max-width: 100px;
            }
            margin-bottom: 0 !important;
        }
    }
}
.list-order-container {
    width: 100%;
    padding: 10px;
    box-sizing: border-box;
    overflow: hidden;
}
.status-missing {
    color: orange;
    font-weight: bold;
}

.status-borrowing {
    color: blue;
    font-weight: bold;
}

.status-overdue {
    color: red;
    font-weight: bold;
}

.status-returned {
    color: green;
    font-weight: bold;
}
.order-pagination{
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 10px;
}
</style>
