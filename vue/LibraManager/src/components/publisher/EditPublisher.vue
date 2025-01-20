<template>
    <div>
        <FormPublisher
            :is-edit="true"
            :publisher="publisher"
            @submit="handleSubmit"
        />
    </div>
</template>

<script setup>
import { ref, watch } from 'vue';
import FormPublisher from './FormPublisher.vue';
import axiosInstance from '@/config/axios';
import HTTP_STATUS_CODE from '@/config/statusCode';
import { ElMessageBox, ElNotification } from 'element-plus';
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

const emit = defineEmits(['get-publishers']);

const publisher = ref(null);

/**
 * The method watch props id
 *
 * @param {number} newId - The new id
 *
 * @returns {Promise<void>}
 */
watch(() => props.id, async (newId) => {
    try {
        const response = await axiosInstance.get(`/publisher/${newId}`);

        if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
            publisher.value = response.data;
        }
    } catch (error) {

        if (error && error.status === HTTP_STATUS_CODE.HTTP_BAD_REQUEST) {
            await ElMessageBox.alert('Có lỗi xảy ra, vui lòng thử lại sau', 'Error', {
                confirmButtonText: 'OK',
                type: 'error'
            });

            router.push({ name: 'publisher' });
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
        const response = await axiosInstance.put(`/publisher/${props.id}`, data);

        if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
            ElNotification({
                title: 'Thành công',
                message: 'Cập nhật nhà xuất bản thành công',
                type: 'success'
            });

            emit('get-publishers', props.currentPage);
            router.push({ name: 'publisher' });
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
