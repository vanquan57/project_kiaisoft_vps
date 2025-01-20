<template>
    <div class="list-book-management-container">
        <el-table
            :data="props.booksData"
            class="table-author"
            :scrolling="true"
            style="width: 100%;"
        >
            <el-table-column
                type="index"
                label="STT"
                width="60"
                align="center"
                fixed="left"
            />
            <el-table-column
                prop="image"
                label="Ảnh"
                width="100"
                align="center"
                fixed="left"
            >
                <template #default="{ row }">
                    <img
                        class="image-book"
                        :src="imageUrl(row.image)"
                        alt="Ảnh sách"
                        width="100"
                        height="100"
                    >
                </template>
            </el-table-column>
            <el-table-column
                prop="name"
                label="Tên sách"
                width="200"
                fixed="left"
            />
            <el-table-column
                prop="quantity"
                label="Số lượng"
                width="100"
                align="center"
            />
            <el-table-column
                prop="categories"
                label="Danh mục"
                width="150"
            >
                <template #default="{ row }">
                    {{ row.categories[0].name }}
                </template>
            </el-table-column>
            <el-table-column
                prop="author"
                label="Tác giả"
                width="150"
            >
                <template #default="{ row }">
                    {{ row.author.name }}
                </template>
            </el-table-column>
            <el-table-column
                prop="publisher"
                label="Nhà xuất bản"
                width="150"
            >
                <template #default="{ row }">
                    {{ row.publisher.name }}
                </template>
            </el-table-column>
            <el-table-column
                prop="views"
                label="Lượt xem"
                width="100"
                align="center"
            />
            <el-table-column
                fixed="right"
                label="Tính năng"
                width="150"
                align="center"
            >
                <template #default="{ row }">
                    <div class="actions-group-book">
                        <el-button
                            type="primary"
                            @click="handleShowDetailsBook(row.id)"
                        >
                            Xem chi tiết
                        </el-button>
                        <div class="actions-group">
                            <router-link :to="`/book/edit/${row.id}`">
                                <el-button
                                    type="primary"
                                    :icon="Edit"
                                />
                            </router-link>
                            <el-button
                                type="danger"
                                :icon="Delete"
                                @click="handleOptionDelete(row.id)"
                            />
                        </div>
                    </div>
                </template>
            </el-table-column>
        </el-table>
    </div>
</template>

<script setup>
import { Edit, Delete } from '@element-plus/icons-vue';
const emit = defineEmits(['handleOptionDelete', 'showDetailsBook']);
const imageUrl = (url) => {
    return import.meta.env.VITE_STORAGE_URL + url;
};
const props = defineProps({
    booksData: {
        type: Array,
        default: () => []
    }
});

/**
 * The method handle option delete
 *
 * @param {number} id - The id
 *
 * @returns {Promise<void>}
 */
const handleOptionDelete = (id) => {
    emit('handleOptionDelete', id);
};

/**
 * The method handle show details book
 *
 * @param {number} id - The id
 *
 * @returns {Promise<void>}
 */
const handleShowDetailsBook = (id) => {
    emit('showDetailsBook', id);
};
</script>

<style lang="scss">
@import '@/assets/scss/book.scss';

.list-book-management-container {
    padding: 10px;
    .actions-group-book{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 10px!important;
        .actions-group{
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px!important;
        }
    }
    .image-book{
        object-fit: cover;
    }
}
</style>

