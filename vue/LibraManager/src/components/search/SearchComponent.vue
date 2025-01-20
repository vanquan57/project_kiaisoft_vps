<template>
    <div class="search-form-container">
        <el-form
            ref="searchFormRef"
            :model="searchForm"
            :rules="rules"
            class="search-form"
            :style="`grid-template-columns: ${styleSearch}; display: ${displaySearch}`"
            @submit.prevent="handleSearch"
        >
            <el-form-item prop="search">
                <el-input
                    :style="styleInput"
                    v-model="searchForm.search"
                    :placeholder="props.placeholder"
                />
            </el-form-item>
            <el-form-item v-if="props.isSearchBook">
                <el-select
                    v-model="searchForm.category_id"
                    placeholder="Chọn danh mục"
                >
                    <el-option
                        v-for="item in props.categoryData"
                        :key="item.id"
                        :label="item.name"
                        :value="item.id"
                    />
                </el-select>
            </el-form-item>
            <el-form-item v-if="props.isSearchBook">
                <el-select
                    v-model="searchForm.author_id"
                    placeholder="Chọn tác giả"
                >
                    <el-option
                        v-for="item in props.authorData"
                        :key="item.id"
                        :label="item.name"
                        :value="item.id"
                    />
                </el-select>
            </el-form-item>
            <el-form-item v-if="props.isSearchBook">
                <el-select
                    v-model="searchForm.publisher_id"
                    placeholder="Chọn nhà xuất bản"
                >
                    <el-option
                        v-for="item in props.publisherData"
                        :key="item.id"
                        :label="item.name"
                        :value="item.id"
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
</template>

<script setup>
import { ref, watchEffect } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();
const displaySearch = ref('flex');
const props = defineProps({
    placeholder: {
        type: String,
        default: 'Nhập nội dung tìm kiếm ...'
    },
    styleInput: {
        type: String,
        default: ''
    },
    isSearchBook: {
        type: Boolean,
        default: false
    },
    categoryData: {
        type: Array,
        default: () => []
    },
    authorData: {
        type: Array,
        default: () => []
    },
    publisherData: {
        type: Array,
        default: () => []
    },
});
const emit = defineEmits(['search']);
const searchFormRef = ref(null);
const searchForm = ref({
    search: '',
    category_id: '',
    author_id: '',
    publisher_id: ''
});

const styleSearch = ref('');

watchEffect(() => {
    if (route.path === '/book') {
        styleSearch.value = '3fr 2fr 2fr 2fr 1fr';
        displaySearch.value = 'grid';
    }

    if (props.resetSearch) {
        searchForm.value = {
            search: '',
            category_id: '',
            author_id: '',
            publisher_id: ''
        };
    }
});

const handleSearch = async () => {
    await searchFormRef.value.validate((valid) => {
        if (valid) {
            if (props.isSearchBook) {
                emit('search', {
                    search: searchForm.value.search,
                    category_id: searchForm.value.category_id,
                    author_id: searchForm.value.author_id,
                    publisher_id: searchForm.value.publisher_id
                });
            } else {
                emit('search', searchForm.value.search);
            }

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
