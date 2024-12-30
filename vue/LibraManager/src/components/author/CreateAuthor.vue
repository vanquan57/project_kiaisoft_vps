<template>
    <div>
        <FormAuthor
            :is-edit="false"
            @submit="handleSubmit"
        />
    </div>
</template>

<script setup>
import FormAuthor from './FormAuthor.vue';
import axiosInstance from '@/config/axios';
import HTTP_STATUS_CODE from '@/config/statusCode';
import { useRouter } from 'vue-router';
import { ElNotification } from 'element-plus';

const router = useRouter();
const emit = defineEmits(['getAuthors']);

/**
 * Handle submit form create author
 *
 * @param {object} data - The data
 *
 * @returns {Promise<void>}
 */
const handleSubmit = async (data) => {
    try {
        const response = await axiosInstance.post('/author', data);
        if (response.status === HTTP_STATUS_CODE.HTTP_CREATED) {
            ElNotification.success({
                title: 'Thành công',
                message: 'Thêm tác giả thành công'
            });

            emit('getAuthors', 1, 'created_at', 'desc');
            router.push({ name: 'author' });
        }
    } catch (error) {
        if (error && error.status === HTTP_STATUS_CODE.HTTP_UNPROCESSABLE_ENTITY) {
            ElNotification.error({
                title: 'Lỗi',
                message: 'Dữ liệu không hợp lệ'
            });
        }

        if (error.status === HTTP_STATUS_CODE.HTTP_INTERNAL_SERVER_ERROR) {
            ElNotification.error({
                title: 'Lỗi',
                message: 'Có lỗi xảy ra, vui lòng thử lại sau'
            });
        }
    }
};
</script>

<style lang="scss" scoped></style>
