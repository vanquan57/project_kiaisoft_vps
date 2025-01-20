<template>
    <div>
        <el-dialog
            v-model="outerVisible"
            :title="`Chi tiết đơn hàng: ${orderDetails.code}`"
            append-to-body
            class="book-detail-dialog"
        >
            <div class="book-list">
                <div
                    v-for="book in orderDetails.order_details"
                    :key="book.id"
                    class="book-item"
                >
                    <div class="book-image">
                        <img
                            :src="imageUrl(book.image)"
                            :alt="book.name"
                        >
                    </div>

                    <div class="book-info">
                        <h3>{{ book.name }}</h3>
                        <div class="info-grid">
                            <div class="info-row">
                                <span class="label">Số lượng:</span>
                                <span>{{ book.pivot.quantity }}</span>
                            </div>
                            <div class="info-row">
                                <span class="label">Ngày trả:</span>
                                <span>{{
                                    formatDate(book.pivot.return_date)
                                }}</span>
                            </div>
                            <div class="info-row">
                                <span class="label">Ghi chú:</span>
                                <span>{{ book.pivot.note || "Không có" }}</span>
                            </div>
                            <div class="info-row">
                                <span class="label">Cập nhật trạng thái {{ book.pivot.status }}</span>
                                <el-select
                                    :model-value="book.pivot.status"
                                    class="status-select"
                                    @change="handleUpdateStatus(orderDetails.id, book.pivot.book_id, $event, book.pivot.status)"
                                >
                                    <el-option
                                        v-for="option in options"
                                        :key="option.value"
                                        :value="option.value"
                                        :label="option.label"
                                        :disabled="isStatusDisabled(option.value, book.pivot.status)"
                                    />
                                </el-select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <template #footer>
                <div class="dialog-footer">
                    <el-button @click="outerVisible = false">
                        Đóng
                    </el-button>
                </div>
            </template>
        </el-dialog>
    </div>
</template>

<script setup>
import { ref, watch } from 'vue';
import STATUS_CODE_ORDER from '@/config/statusOrder';
import { ElMessageBox, ElMessage } from 'element-plus';

const emit = defineEmits(['updateStatusOrderDetails']);
/**
 * The method get options
 *
 * @returns {Array} - The options
 */
const options = [
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
const props = defineProps({
    orderDetails: {
        type: Object,
        default: () => {}
    }
});

const outerVisible = ref(false);
const imageUrl = (url) => {
    return import.meta.env.VITE_STORAGE_URL + url;
};
/**
 * The method watch book
 *
 * @returns {Promise<void>}
 */
watch(
    () => props.orderDetails,
    (newOrderDetails) => {
        if (newOrderDetails) {
            outerVisible.value = true;
        }
    }
);

const handleUpdateStatus = async (orderId, bookId, status, oldStatus) => {
    if (oldStatus === STATUS_CODE_ORDER.RETURNED) {
        ElMessage.error({
            message: 'Sách đã trả, không thể cập nhật trạng thái',
            type: 'error'
        });
        return;
    }
    if (oldStatus === STATUS_CODE_ORDER.OVERDUE && status === STATUS_CODE_ORDER.BORROWING) {
        ElMessage.error({
            message: 'Sách đã quá hạn, không thể cập nhật trạng thái đang mượn',
            type: 'error'
        });
        return;
    }
    if (status === STATUS_CODE_ORDER.MISSING) {
        try {
            const { value: note } = await ElMessageBox.prompt('Vui lòng nhập lý do mất sách', 'Lý do mất sách', {
                confirmButtonText: 'Xác nhận',
                cancelButtonText: 'Hủy',
                inputPlaceholder: 'Nhập lý do mất sách',
                inputValidator: (value) => !!value || 'Lý do không được để trống'
            });

            emit('updateStatusOrderDetails', orderId, bookId, status, note);
        } catch (error) {
        }
        return;
    }

    emit('updateStatusOrderDetails', orderId, bookId, status);
};

const isStatusDisabled = (value, oldStatus) => {
    //disable status current
    if (value === oldStatus) {
        return true;
    }

    //disable status returned
    if (oldStatus === STATUS_CODE_ORDER.RETURNED) {
        return true;
    }

    //if overdue can't change to borrowing
    if (oldStatus === STATUS_CODE_ORDER.OVERDUE) {
        return value === STATUS_CODE_ORDER.BORROWING;
    }

    //if missing can just change to returned
    if (oldStatus === STATUS_CODE_ORDER.MISSING) {
        return value !== STATUS_CODE_ORDER.RETURNED && value !== oldStatus;
    }


    return false;
};


/**
 * The method format date
 *
 * @param {string} inputDate - The input date
 *
 * @returns {string} - The formatted date
 */
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
.book-detail-dialog {
    .el-dialog__body {
        padding: 20px;
        background: #f9f9f9;
        border-radius: 8px;
    }
}

.book-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.book-item {
    display: flex;
    gap: 15px;
    background: white;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.book-image img {
    width: 130px;
    height: 180px;
    object-fit: cover;
    border-radius: 4px;
    border: 1px solid #ddd;
}

.book-info {
    flex: 1;
}

.book-info h3 {
    font-size: 16px;
    margin-bottom: 10px;
    color: #333;
}

.info-grid {
    display: grid;
    grid-template-columns: 1fr;
    row-gap: 8px;
}

.info-row {
    display: flex;
    justify-content: space-between;
    padding: 5px 0;
}

.label {
    font-weight: bold;
    color: #555;
}

.status-select {
    width: 150px;
}

.dialog-footer {
    text-align: right;
    padding-top: 10px;
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
</style>
