<template>
    <div>
        <FormAuthor
            :is-edit="true"
            :author="author"
            @submit="handleSubmit"
        />
    </div>
</template>

<script setup>
import { ref, watch } from 'vue';
import FormAuthor from './FormAuthor.vue';
import axiosInstance from '@/config/axios';
import HTTP_STATUS_CODE from '@/config/statusCode';
import { useRouter } from 'vue-router';
import { ElNotification } from 'element-plus';

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

const emit = defineEmits(['getAuthors']);

const author = ref(null);

/**
 * The method watch props id
 *
 * @param {number} newId - The new id
 *
 * @returns {Promise<void>}
 */
watch(() => props.id, async (newId) => {
    try {
        const response = await axiosInstance.get(`/author/${newId}`);

        if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
            author.value = response.data;
        }
    } catch (error) {
        if (error && error.status === HTTP_STATUS_CODE.HTTP_INTERNAL_SERVER_ERROR) {
            ElNotification.error({
                title: 'Lỗi',
                message: 'Có lỗi xảy ra, vui lòng thử lại sau',
                type: 'error'
            });

            router.push({ name: 'author' });
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
        const response = await axiosInstance.put(`/author/${props.id}`, data);

        if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
            ElNotification.success({
                title: 'Thành công',
                message: 'Cập nhật tác giả thành công',
                type: 'success'
            });

            emit('getAuthors', props.currentPage);
            router.push({ name: 'author' });
        }
    } catch (error) {
        if (error && error.status === HTTP_STATUS_CODE.HTTP_UNPROCESSABLE_ENTITY) {
            ElNotification.error({
                title: 'Lỗi',
                message: 'Dữ liệu không hợp lệ',
                type: 'error'
            });
        }

        if (error && error.status === HTTP_STATUS_CODE.HTTP_INTERNAL_SERVER_ERROR) {
            ElNotification.error({
                title: 'Lỗi',
                message: 'Có lỗi xảy ra, vui lòng thử lại sau',
                type: 'error'
            });
        }
    }
};

</script>

<style lang="scss" scoped></style>
