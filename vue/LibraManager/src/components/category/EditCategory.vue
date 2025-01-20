<template>
    <div>
        <FormCategory
            :is-edit="true"
            :category="category"
            @submit="handleSubmit"
        />
    </div>
</template>

<script setup>
import { ref, watch } from 'vue';
import FormCategory from './FormCategory.vue';
import axiosInstance from '@/config/axios';
import HTTP_STATUS_CODE from '@/config/statusCode';
import { ElNotification } from 'element-plus';
import { useRouter } from 'vue-router';

const router = useRouter();
const props = defineProps({
    id: {
        type: Number,
        required: true
    },
    currentPage: {
        type: Number,
        required: true
    }
});

const emit = defineEmits(['getCategories']);

const category = ref(null);

/**
 * The method watch props id
 *
 * @param {number} newId - The new id
 *
 * @returns {Promise<void>}
 */
watch(() => props.id, async (newId) => {
    try {
        const response = await axiosInstance.get(`/category/${newId}`);

        if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
            category.value = response.data;
        }
    } catch (error) {
        if (error && error.status === HTTP_STATUS_CODE.HTTP_BAD_REQUEST) {
            ElNotification({
                title: 'Thất bại',
                message: 'Danh mục không tồn tại',
                type: 'error'
            });

            router.push({ name: 'category' });
        }
    }
}, { immediate: true });

/**
 * The method handle submit
 *
 * @param {object} data - The data
 *
 * @returns {Promise<void>}
 */
const handleSubmit = async (data) => {
    try {
        const response = await axiosInstance.put(`/category/${props.id}`, data);

        if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
            ElNotification({
                title: 'Thành công',
                message: 'Cập nhật danh mục thành công',
                type: 'success'
            });

            emit('getCategories', props.currentPage);
            router.push({ name: 'category' });
        }
    } catch (error) {
        if (error && error.status === HTTP_STATUS_CODE.HTTP_UNPROCESSABLE_ENTITY) {
            ElNotification({
                title: 'Thất bại',
                message: 'Dữ liệu không hợp lệ',
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
