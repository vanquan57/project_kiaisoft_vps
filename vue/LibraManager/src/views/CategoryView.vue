<template>
    <div>
        <div
            v-if="props.site === 'list'"
            class="category-management-container"
        >
            <div class="category-management-breadcrumb-container">
                <BreadcrumbComponent
                    class="category-management-breadcrumb"
                    :breadcrumb-list="breadcrumbList"
                />
                <router-link
                    to="/category/create"
                    class="category-button"
                >
                    <el-button type="primary">
                        Thêm mới danh mục
                    </el-button>
                </router-link>
            </div>
            <div class="category-management-header-container">
                <div class="category-management-search">
                    <h1>Danh sách danh mục</h1>
                    <SearchForm
                        placeholder="Nhập tên danh mục ..."
                        :style-input="styleInput"
                        @search="handleSearch"
                    />
                </div>
            </div>
            <div class="category-management-content">
                <ListCategories
                    :table-data="tableData"
                    @handle-option-delete="handleOptionDelete"
                />
            </div>
            <div
                v-if="tableData.length > 0"
                class="category-management-pagination"
            >
                <PaginationComponent
                    :total="dataPagination.total"
                    :current-page="dataPagination.currentPage"
                    :page-size="dataPagination.limit"
                    @current-page="handlePageChange"
                />
            </div>
        </div>
        <div
            v-else-if="props.site === 'create'"
            class="category-management-container"
        >
            <div class="category-management-breadcrumb-container">
                <h1>Thêm danh mục</h1>
                <BreadcrumbComponent
                    class="category-management-breadcrumb"
                    :breadcrumb-list="breadcrumbList"
                />
            </div>
            <div class="category-management-content">
                <CreateCategory @get-categories="getCategories" />
            </div>
        </div>
        <div
            v-else
            class="category-management-container"
        >
            <div class="category-management-breadcrumb-container">
                <h1>Cập nhật danh mục</h1>
                <BreadcrumbComponent
                    class="category-management-breadcrumb"
                    :breadcrumb-list="breadcrumbList"
                />
            </div>
            <div class="category-management-content">
                <EditCategory
                    :id="props.id"
                    :current-page="dataPagination.currentPage"
                    @get-categories="getCategories"
                />
            </div>
        </div>
    </div>
</template>

<script setup>
import SearchForm from '@/components/search/SearchComponent.vue';
import ListCategories from '@/components/category/ListCategories.vue';
import { ref, onMounted, watchEffect } from 'vue';
import { useRoute } from 'vue-router';
import PaginationComponent from '@/components/pagination/PaginationComponent.vue';
import CreateCategory from '@/components/category/CreateCategory.vue';
import EditCategory from '@/components/category/EditCategory.vue';
import axiosInstance from '@/config/axios';
import HTTP_STATUS_CODE from '@/config/statusCode';
import { useRouter } from 'vue-router';
import { ElNotification, ElMessageBox } from 'element-plus';
import BreadcrumbComponent from '@/components/Breadcrumb/BreadcrumbComponent.vue';

const router = useRouter();
const route = useRoute();
const props = defineProps({
    site: {
        type: String,
        default: 'list'
    },
    id: {
        type: Number,
        required: false,
        default: null
    }
});

const breadcrumbList = ref([
    {
        name: 'Trang chủ',
        path: '/'
    },
    {
        name: 'Danh mục',
        path: '/category'
    }
]);
const styleInput = ref('width: 400px');

const dataPagination = ref({
    limit: 10,
    total: 1,
    currentPage: 1
});
const tableData = ref([]);

/**
 * Get categories
 *
 * @returns {Promise<void>}
 */
const getCategories = async (page = 1, column = null, order = null) => {
    try {
        const response = await axiosInstance.get('/category', {
            params: {
                page,
                limit: dataPagination.value.limit,
                column: column ?? null,
                order: order ?? null
            }
        });
        if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
            tableData.value = response.data.data;
            dataPagination.value.total = response.data.total;
            dataPagination.value.currentPage = response.data.current_page;
        }
    } catch (error) {}
};

/**
 * The method handle mount
 *
 * @returns {Promise<void>}
 */
onMounted(async () => {
    await getCategories();
});

watchEffect(() => {
    if (props.site === 'create') {
        breadcrumbList.value = [
            {
                name: 'Trang chủ',
                path: '/'
            },
            {
                name: 'Danh mục',
                path: '/category'
            },
            {
                name: 'Thêm danh mục',
                path: '/category/create'
            }
        ];
    } else if (props.site === 'edit') {
        breadcrumbList.value = [
            {
                name: 'Trang chủ',
                path: '/'
            },
            {
                name: 'Danh mục',
                path: '/category'
            },
            {
                name: 'Cập nhật danh mục',
                path: `/category/edit/${props.id}`
            }
        ];
    } else {
        breadcrumbList.value = [
            {
                name: 'Trang chủ',
                path: '/'
            },
            {
                name: 'Danh mục',
                path: '/category'
            }
        ];
    }
});

/**
 * The method handle search
 *
 * @param {string} search - The search
 *
 * @returns {Promise<void>}
 */
const handleSearch = async (search) => {
    const query = search === '' ? {} : { search: search.trim() };

    router.push({
        path: route.path,
        query
    });

    if (search !== '') {
        const response = await axiosInstance.get('/category', {
            params: { name: search.trim() }
        });
        tableData.value = response.data.data;
        dataPagination.value.total = response.data.total;
        dataPagination.value.currentPage = response.data.current_page;
        dataPagination.value.limit = response.data.limit;
    } else {
        getCategories();
    }
};

/**
 * The method handle page change
 *
 * @param {number} page - The page number
 *
 * @returns {Promise<void>}
 */
const handlePageChange = (page) => {
    dataPagination.value.currentPage = page;
    getCategories(page);
};

/**
 * The method handle option delete
 *
 * @param {number} id - The id
 *
 * @returns {Promise<void>}
 */
const handleOptionDelete = async (id) => {
    try {
        await ElMessageBox.confirm(
            'Bạn có chắc chắn muốn xóa danh mục này không?',
            'Xác nhận',
            {
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy',
                type: 'warning'
            }
        );

        const response = await axiosInstance.delete(`/category/${id}`);

        if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
            ElNotification({
                title: 'Thành công',
                message: 'Xóa danh mục thành công',
                type: 'success'
            });

            getCategories(dataPagination.value.currentPage);
        }
    } catch (error) {
        ElNotification({
            title: 'Thất bại',
            message: 'Danh mục có sách, không thể xóa',
            type: 'error'
        });
    }
};
</script>

<style lang="scss" scoped>
.category-management-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
    height: 100%;
    padding-bottom: 15px;
    .category-management-breadcrumb-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        margin: 10px 0;
        padding: 0 10px;
        h1 {
            font-size: 24px;
            font-weight: bold;
        }
    }
    .category-management-header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        h1 {
            margin-left: 10px;
            font-size: 24px;
            font-weight: bold;
        }
    }

    .category-button {
        align-self: flex-start;
    }
    .category-management-search {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
    }
    .category-management-content {
        width: 100%;
    }
}
</style>
