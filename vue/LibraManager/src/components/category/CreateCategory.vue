<template>
    <div>
        <FormCategory
            :is-edit="false"
            @submit="handleSubmit"
        />
    </div>
</template>

<script setup>
import FormCategory from './FormCategory.vue';
import axiosInstance from '@/config/axios';
import HTTP_STATUS_CODE from '@/config/statusCode';
import { useRouter } from 'vue-router';
import { ElNotification } from 'element-plus';

const router = useRouter();
const emit = defineEmits(['get-categories']);

/**
 * Handle submit form create category
 *
 * @param {object} data - The data
 *
 * @returns {Promise<void>}
 */
const handleSubmit = async (data) => {
    try {
        const response = await axiosInstance.post('/category', data);
        if (response.status === HTTP_STATUS_CODE.HTTP_CREATED) {
            ElNotification({
                title: 'Thành công',
                message: 'Thêm danh mục thành công',
                type: 'success'
            });

            emit('get-categories', 1, 'created_at', 'desc');
            router.push({ name: 'category' });
        }
    } catch (error) {
        if (error && error.status === HTTP_STATUS_CODE.HTTP_UNPROCESSABLE_ENTITY) {
            ElNotification({
                title: 'Thất bại',
                message: 'Tên danh mục đã tồn tại',
                type: 'error'
            });
        }

        if (error && error.status === HTTP_STATUS_CODE.HTTP_BAD_REQUEST) {
            ElNotification({
                title: 'Thất bại',
                message: 'Có lỗi xảy ra, vui lòng thử lại sau',
                type: 'error'
            });
        }
    }
};
</script>

<style lang="scss" scoped></style>
