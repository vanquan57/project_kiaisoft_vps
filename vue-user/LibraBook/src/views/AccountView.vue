<template>
    <div class="account-container__right__update-info">
        <h1 class="account-container__right__update-info__title">
            Cập nhật thông tin tài khoản
        </h1>
        <div class="account-container__right__update-info__form">
            <el-form
                ref="accountFormRef"
                :model="accountForm"
                :rules="rules"
                class="from-checkout"
                @submit.prevent="updateUserInfo"
            >
                <el-row :gutter="50">
                    <el-col :span="12">
                        <el-form-item
                            label-position="top"
                            label="Email"
                            prop="email"
                        >
                            <el-input
                                v-model="accountForm.email"
                                disabled
                            />
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item
                            label-position="top"
                            label="Mã nhân viên"
                            prop="employee_code"
                        >
                            <el-input
                                v-model="accountForm.employee_code"
                                disabled
                            />
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row :gutter="50">
                    <el-col :span="12">
                        <el-form-item
                            label-position="top"
                            label="Họ tên"
                            prop="name"
                        >
                            <el-input v-model="accountForm.name" />
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item
                            label-position="top"
                            label="Tỉnh thành"
                            prop="province"
                        >
                            <el-select
                                v-model="accountForm.province"
                                placeholder="Chọn tỉnh thành"
                                filterable
                                no-data-text="Không tìm thấy tỉnh thành"
                                @change="getDistricts(accountForm.province)"
                            >
                                <el-option
                                    v-for="item in provinces"

                                    :key="item.id"
                                    :label="item.name"
                                    :value="item.id"
                                    :disabled="item.disabled"
                                />
                            </el-select>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row :gutter="50">
                    <el-col :span="12">
                        <el-form-item
                            label-position="top"
                            label="Quận huyện"
                            prop="district"
                        >
                            <el-select
                                v-model="accountForm.district"
                                placeholder="Chọn quận huyện"
                                filterable
                                no-data-text="Không tìm thấy quận huyện"
                                @change="getWards(accountForm.district)"
                            >
                                <el-option
                                    v-for="item in districts"

                                    :key="item.id"
                                    :label="item.name"
                                    :value="item.id"
                                    :disabled="item.disabled"
                                />
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item
                            label-position="top"
                            label="Xã phường"
                            prop="ward"
                        >
                            <el-select
                                v-model="accountForm.ward"
                                placeholder="Chọn xã phường"
                                filterable
                                no-data-text="Không tìm thấy xã phường"
                            >
                                <el-option
                                    v-for="item in wards"
                                    :key="item.id"
                                    :label="item.name"
                                    :value="item.id"
                                    :disabled="item.disabled"
                                />
                            </el-select>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row :gutter="20">
                    <el-col :span="24">
                        <el-form-item
                            label-position="top"
                            label="Địa chỉ"
                            prop="address"
                        >
                            <el-input v-model="accountForm.address" />
                        </el-form-item>
                    </el-col>
                </el-row>
            </el-form>
            <div class="group-button">
                <div>
                    <button
                        class="btn-cancel"
                        @click="cancelUpdateUserInfo"
                    >
                        Hủy
                    </button>
                    <button
                        class="btn-update"
                        @click="updateUserInfo"
                    >
                        Cập nhật
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import axiosInstance from '@/config/axios';
import HTTP_STATUS_CODE from '@/config/statusCode';
import { ElNotification } from 'element-plus';
import { onMounted, ref, watch } from 'vue';
import { useAuthStore } from '@/stores/auth';

const authStore = useAuthStore();
const provinces = ref([]);
const districts = ref([]);
const wards = ref([]);
const accountFormRef = ref(null);
const accountForm = ref({
    name: '',
    employee_code: '',
    email: '',
    province: '',
    district: '',
    ward: '',
    address: ''
});
const defaultAddress = ref({
    name: '',
    province: '',
    district: '',
    ward: '',
    address: '',
    province_id: '',
    district_id: '',
    ward_id: ''
});

const rules = ref({
    name: [
        {
            required: true,
            message: 'Vui lòng nhập họ tên của bạn',
            trigger: 'blur'
        }
    ],
    employee_code: [
        {
            required: true,
            message: ''
        }
    ],
    email: [
        {
            required: true,
            message: ''
        }
    ],
    province: [
        {
            required: true,
            message: 'Vui lòng chọn tỉnh thành của bạn',
            trigger: 'change'
        }
    ],
    district: [
        {
            required: true,
            message: 'Vui lòng chọn quận huyện của bạn',
            trigger: 'change'
        }
    ],
    ward: [
        {
            required: true,
            message: 'Vui lòng chọn xã phường của bạn',
            trigger: 'change'
        }
    ],
    address: [
        {
            required: true,
            message: 'Vui lòng nhập địa chỉ của bạn',
            trigger: 'blur'
        }
    ]
});
const getProvinces = async () => {
    try {
        const response = await axiosInstance.get('/provinces');
        if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
            provinces.value = response.data;
        }
    } catch (error) {}
};

const getDistricts = async (provinceId) => {
    const provinceCode = provinces.value.find(
        (province) => province.id === provinceId
    ).code;

    try {
        const response = await axiosInstance.get(`/districts/${provinceCode}`);
        if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
            districts.value = response.data;
        }
    } catch (error) {}
};

const getWards = async (districtId) => {
    const districtCode = districts.value.find(
        (district) => district.id === districtId
    ).code;
    try {
        const response = await axiosInstance.get(`/wards/${districtCode}`);
        if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
            wards.value = response.data;
        }
    } catch (error) {}
};

onMounted(async () => {
    await getProvinces();
    await getUserInfo();
    await getDistricts(defaultAddress.value.province_id);
    await getWards(defaultAddress.value.district_id);
});


const getUserInfo = async () => {
    try {
        const response = await axiosInstance.get('/profile');
        accountForm.value.name = response.data.name;
        accountForm.value.employee_code = response.data.code;
        accountForm.value.email = response.data.email;
        accountForm.value.province = response.data.province.name;
        accountForm.value.district = response.data.district.name;
        accountForm.value.ward = response.data.ward.name;
        accountForm.value.address = response.data.address;
        // default address
        defaultAddress.value.name = response.data.name;
        defaultAddress.value.province = response.data.province.name;
        defaultAddress.value.district = response.data.district.name;
        defaultAddress.value.ward = response.data.ward.name;
        defaultAddress.value.address = response.data.address;
        defaultAddress.value.province_id = response.data.province_id;
        defaultAddress.value.district_id = response.data.district_id;
        defaultAddress.value.ward_id = response.data.ward_id;
    } catch (error) {}
};

const updateUserInfo = async () => {
    if (!authStore.checkTokenValidity()) {
        router.push({ name: 'auth-login' });
        return;
    }
    try {
        accountFormRef.value.validate(async (valid) => {
            if (valid) {
                const provinceId =
                    typeof accountForm.value.province !== 'string'
                        ? accountForm.value.province
                        : defaultAddress.value.province_id;
                const districtId =
                    typeof accountForm.value.district !== 'string'
                        ? accountForm.value.district
                        : defaultAddress.value.district_id;
                const wardId =
                    typeof accountForm.value.ward !== 'string'
                        ? accountForm.value.ward
                        : defaultAddress.value.ward_id;
                if (
                    accountForm.value.name !== defaultAddress.value.name ||
                    accountForm.value.province !==
                        defaultAddress.value.province ||
                    accountForm.value.district !==
                        defaultAddress.value.district ||
                    accountForm.value.ward !== defaultAddress.value.ward ||
                    accountForm.value.address !== defaultAddress.value.address
                ) {
                    const response = await axiosInstance.put('/profile', {
                        name: accountForm.value.name,
                        address: accountForm.value.address,
                        province_id: provinceId,
                        district_id: districtId,
                        ward_id: wardId
                    });
                    if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
                        ElNotification({
                            title: 'Thành công',
                            message: 'Cập nhật thông tin tài khoản thành công',
                            type: 'success'
                        });
                        await getUserInfo();
                    }
                } else {
                    ElNotification({
                        title: 'Cảnh báo',
                        message: 'Không có thay đổi nào được tìm thấy',
                        type: 'warning'
                    });
                }
            }
        });
    } catch (error) {
        ElNotification({
            title: 'Thất bại',
            message: 'Cập nhật thông tin tài khoản thất bại',
            type: 'error'
        });
    }
};

const cancelUpdateUserInfo = async () => {
    await getUserInfo();
};
</script>

<style lang="scss" scoped>
@import "@/assets/scss/_variables.scss";
.account-container__right__update-info {
    @media (min-width: 1024px) {
        padding: 40px 80px 24px 80px;
    }
    &__title {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 16px;
        color: $primary-color;
    }
    &__form {
        .el-form-item {
            margin-bottom: 24px;
        }
        .el-input__wrapper {
            height: 50px;
        }
        .el-select__selection {
            height: 40px;
        }
    }
    .group-button {
        display: flex;
        justify-content: flex-end;
        .btn-cancel {
            background-color: transparent;
            border: 1px solid #ccc;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-right: 20px;
            height: 56px;
            &:hover {
                background-color: #ccc;
                color: #fff;
            }
        }
        .btn-update {
            background-color: $primary-color;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            height: 56px;
            width: 215px;
            &:hover {
                background-color: $color-red;
            }
        }
    }
}
</style>
