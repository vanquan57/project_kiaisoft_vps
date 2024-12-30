<template>
    <div class="user-management-container">
        <div class="user-management-breadcrumb-container">
            <BreadcrumbComponent
                class="user-management-breadcrumb"
                :breadcrumb-list="breadcrumbList"
            />
            <router-link
                v-if="props.site === 'user'"
                class="btn-add-user"
                to="/user/information"
            >
                <el-button type="primary">
                    Import thông tin người dùng
                </el-button>
            </router-link>
        </div>
        <div
            v-if="props.site === 'user'"
            class="user-management-content"
        >
            <div class="user-management-top">
                <h1>Quản lý người dùng</h1>
                <div class="user-management-search">
                    <SearchComponent
                        placeholder="Nhập mã nhân viên, tên người dùng, email . . ."
                        :style-input="styleInput"
                        @search="handleSearch"
                    />
                </div>
            </div>
            <div class="user-management-content">
                <ListUsers
                    :table-data="tableData"
                    @handle-update-status="handleUpdateStatus"
                />
            </div>
            <div
                v-if="tableData.length > 0"
                class="user-management-pagination"
            >
                <PaginationComponent
                    class="user-management-pagination-left"
                    :total="dataPagination.total"
                    :current-page="dataPagination.currentPage"
                    :page-size="dataPagination.limit"
                    @current-page="handlePageChange"
                />
            </div>
        </div>
        <div
            v-else
            class="user-management-content"
        >
            <div class="user-management-top">
                <h1>Thêm thông tin người dùng</h1>
                <div class="user-management-upload">
                    <div class="user-management-upload-btn">
                        <el-button
                            class="ml-3"
                            type="primary"
                            @click="handleUpload"
                        >
                            Chọn file
                        </el-button>
                        <el-button
                            class="ml-3 btn-upload"
                            type="success"
                            :loading="loading"
                            @click="submitUpload"
                        >
                            Tải lên
                        </el-button>
                    </div>
                    <input
                        ref="fileInput"
                        type="file"
                        accept=".csv"
                        style="display: none"
                        @change="handleFileChange"
                    >
                    <p
                        v-if="fileName"
                        class="file-name"
                    >
                        <span>{{ fileName }} <span
                            class="remove-file"
                            @click="handleRemoveFile"
                        >x</span></span>
                    </p>
                </div>
            </div>
            <div class="user-management-content">
                <ListFormation :table-data="tableDataInfoEmployeeCodes" />
                <div class="user-management-pagination">
                    <PaginationComponent
                        class="user-management-pagination-left"
                        :total="dataPagination.total"
                        :current-page="dataPagination.currentPage"
                        :page-size="dataPagination.limit"
                        @current-page="handlePageChange"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import BreadcrumbComponent from '@/components/Breadcrumb/BreadcrumbComponent.vue';
import SearchComponent from '@/components/search/SearchComponent.vue';
import ListUsers from '@/components/user/ListUsers.vue';
import ListFormation from '@/components/user/ListFormation.vue';
import { onMounted, ref, watch, watchEffect } from 'vue';
import { useRoute } from 'vue-router';
import PaginationComponent from '@/components/pagination/PaginationComponent.vue';
import axiosInstance from '@/config/axios';
import HTTP_STATUS_CODE from '@/config/statusCode';
import { ElNotification } from 'element-plus';
import { useRouter } from 'vue-router';

const props = defineProps({
    site: {
        type: String,
        default: 'user'
    }
});
const breadcrumbList = ref([
    { name: 'Trang chủ', path: '/' },
    { name: 'Người dùng', path: '/user' }
]);
const fileUpload = ref();
const fileName = ref('');
const fileInput = ref();
const router = useRouter();
const route = useRoute();
const tableData = ref([]);
const tableDataInfoEmployeeCodes = ref([]);
const styleInput = ref('width: 400px');
const dataPagination = ref({
    limit: 10,
    total: 0,
    currentPage: 1
});
const loading = ref(false);

onMounted(async () => {
    if (props.site === 'user') {
        await getUsers();
    } else {
        await getInformationEmployeeCodes();
    }
});

watch(
    () => props.site,
    async (newSite) => {
        if (newSite === 'information') {
            await getInformationEmployeeCodes();
            breadcrumbList.value = [
                { name: 'Trang chủ', path: '/' },
                { name: 'Danh sách', path: '/user' },
                { name: 'Thêm thông tin', path: '/user/information' }
            ];
        } else {
            await getUsers();
            breadcrumbList.value = [
                { name: 'Trang chủ', path: '/' },
                { name: 'Người dùng', path: '/user' }
            ];
        }
    }
);
/**
 * The method get data users
 *
 * @param {number} page - The page number
 *
 * @returns {Promise<void>}
 */
const getUsers = async (page = 1) => {
    try {
        const response = await axiosInstance.get('/user', {
            params: {
                limit: dataPagination.value.limit,
                page: page
            }
        });
        if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
            tableData.value = response.data.data;
            dataPagination.value.total = response.data.total;
            dataPagination.value.currentPage = response.data.current_page;
        }
    } catch (error) {}
};

const getInformationEmployeeCodes = async (page = 1) => {

    const response = await axiosInstance.get('/employees', {
        params: {
            page: page
        }
    });
    if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
        tableDataInfoEmployeeCodes.value = response.data.data;
        dataPagination.value.total = response.data.total;
        dataPagination.value.currentPage = response.data.current_page;
    }
};

watchEffect(() => {
    if (route.fullPath === '/user') {
        getUsers();
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
        const response = await axiosInstance.get('/user', {
            params: {
                key_word: search.trim()
            }
        });

        tableData.value = response.data.data;
    } else {
        getUsers();
    }
};

/**
 * The method handle update status
 *
 * @param {number} id - The id of user
 * @param {number} status - The status of user
 *
 * @returns {Promise<void>}
 */
const handleUpdateStatus = async (id, status) => {
    try {
        const response = await axiosInstance.put(`/user/${id}`, { status });
        if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
            ElNotification({
                title: 'Thành công',
                message: 'Cập nhật trạng thái người dùng thành công',
                type: 'success'
            });
            await getUsers(dataPagination.value.currentPage);
        }
    } catch (error) {
        if (error.status === HTTP_STATUS_CODE.HTTP_BAD_REQUEST) {
            ElNotification({
                title: 'Thất bại',
                message: 'Cập nhật trạng thái người dùng thất bại',
                type: 'error'
            });
        }
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
    if (props.site === 'user') {
        dataPagination.value.currentPage = page;
        getUsers(page);
    } else {
        dataPagination.value.currentPage = page;
        getInformationEmployeeCodes(page);
    }
};

const handleUpload = () => {
    fileInput.value.click();
};

const handleRemoveFile = () => {
    fileName.value = '';
    fileUpload.value = '';
};

const handleFileChange = (event) => {
    const file = event.target.files[0];
    fileUpload.value = file;

    if (file && file.type !== 'text/csv' && !file.name.endsWith('.csv')) {
        ElNotification({
            title: 'Thất bại',
            message: 'File không đúng định dạng',
            type: 'error'
        });
        fileUpload.value = '';
        return;
    } else {
        fileName.value = fileUpload.value.name;
    }
};

const submitUpload = async () => {
    try {
        if (!fileUpload.value) {
            return;
        }

        const formData = new FormData();
        formData.append('file', fileUpload.value);
        const response = await axiosInstance.post('employees', formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });
        if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
            ElNotification({
                title: 'Thành công',
                message: 'Cập nhật thông tin người dùng thành công',
                type: 'success'
            });
            fileUpload.value = '';
            fileName.value = '';
        }
    } catch (error) {
        loading.value = false;
        ElNotification({
            title: 'Thất bại',
            message: 'Tải lên file thất bại',
            type: 'error'
        });
    }
};
</script>

<style lang="scss" scoped>
.user-management-container {
    display: flex;
    flex-direction: column;
    width: 100%;
    height: 100%;
    padding-bottom: 15px;
    .user-management-breadcrumb-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 0;
        .user-management-breadcrumb {
            padding: 10px;
        }
        .btn-add-user {
            margin-left: auto;
            margin-right: 10px;
        }
    }

    .user-management-top {
        display: flex;
        width: 100%;
        gap: 10px;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #ccc;
    }
    h1 {
        font-size: 24px;
        font-weight: bold;
        padding: 10px;
    }
    .user-management-content {
        width: 100%;
        .user-management-upload {
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 10px;
            padding-bottom: 10px;
            margin-right: 10px;
            .error-message {
                font-size: 12px;
                color: red;
            }
            .file-name {
                font-size: 12px;
                .remove-file {
                    background-color: rgb(182, 182, 182);
                    color: white;
                    padding:1px 4px;
                    border-radius: 10px;
                    &:hover {
                    cursor: pointer;
                }
                }
            }
            .btn-upload {
                width: 100px;
            }
        }
    }
    .user-management-pagination {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
}
</style>
