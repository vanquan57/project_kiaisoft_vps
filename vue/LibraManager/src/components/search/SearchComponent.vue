<template>
    <div class="search-form-container">
        <el-form
            ref="searchFormRef"
            :model="searchForm"
            class="search-form"
            :rules="rules"
            @submit.prevent="handleSearch"
        >
            <el-form-item prop="search">
                <el-input
                    :style="styleInput"
                    v-model="searchForm.search"
                    :placeholder="props.placeholder"
                />
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
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps({
    placeholder: {
        type: String,
        default: 'Nhập nội dung tìm kiếm ...'
    },
    styleInput: {
        type: String,
        default: ''
    }
});
const emit = defineEmits(['search']);
const searchFormRef = ref(null);
const searchForm = ref({
    search: ''
});

const handleSearch = async () => {
    await searchFormRef.value.validate((valid) => {
        if (valid) {
            emit('search', searchForm.value.search);
        }
    });
};

</script>

<style lang="scss" scoped>
.search-form-container {
    padding: 10px 10px 10px 10px;
    box-sizing: border-box;
    overflow: hidden;
    .search-form {
        display: flex;
        gap: 10px;
        .search-button {
            width: 100%;
        }
        .el-form-item {
            margin-bottom: 0 !important;
        }
    }
}
</style>
