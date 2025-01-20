<template>
    <div class="account-container__right__update-info">
        <h1 class="account-container__right__update-info__title">
            Cập nhật mật khẩu
        </h1>
        <div class="account-container__right__update-info__form">
            <div
                v-if="errorMessages"
                class="error-message-container"
            >
                <p class="error-message">
                    {{ errorMessages }}
                </p>
            </div>
            <el-form
                ref="passwordFormRef"
                :model="passwordForm"
                :rules="rules"
                class="from-checkout"
                @submit.prevent="handleChangePassword"
            >
                <el-row :gutter="20">
                    <el-col :span="24">
                        <el-form-item
                            label-position="top"
                            label="Mật khẩu cũ"
                            prop="current_password"
                        >
                            <el-input
                                v-model="passwordForm.current_password"
                                type="password"
                                show-password
                                @input="errorMessages = ''"
                            />
                        </el-form-item>
                    </el-col>
                    <el-col :span="24">
                        <el-form-item
                            label-position="top"
                            label="Mật khẩu mới"
                            prop="password"
                        >
                            <el-input
                                v-model="passwordForm.password"
                                type="password"
                                show-password
                            />
                        </el-form-item>
                    </el-col>
                    <el-col :span="24">
                        <el-form-item
                            label-position="top"
                            label="Nhập lại mật khẩu mới"
                            prop="confirm_password"
                        >
                            <el-input
                                v-model="passwordForm.confirm_password"
                                type="password"
                                show-password
                            />
                        </el-form-item>
                    </el-col>
                </el-row>
            </el-form>
            <div class="group-button">
                <div>
                    <button
                        class="btn-cancel"
                        @click="cancelChangePassword"
                    >
                        Hủy
                    </button>
                    <button
                        class="btn-update"
                        @click="handleChangePassword"
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
const passwordFormRef = ref(null);
const passwordForm = ref({
    current_password: '',
    password: '',
    confirm_password: ''
});
const errorMessages = ref('');

const rules = ref({
    current_password: [
        {
            required: true,
            message: 'Vui lòng nhập mật khẩu cũ',
            trigger: 'blur'
        }
    ],
    password: [
        {
            required: true,
            message: 'Vui lòng nhập mật khẩu mới',
            trigger: 'blur'
        },
        {
            validator: (rule, value, callback) => {
                const regex =
                    /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
                if (!regex.test(value)) {
                    callback(
                        new Error(
                            'Mật khẩu phải chứa ít nhất 8 ký tự, bao gồm chữ in hoa, chữ thường, số và ký tự đặc biệt'
                        )
                    );
                } else {
                    callback();
                }
            },
            trigger: 'blur'
        }
    ],
    confirm_password: [
        {
            required: true,
            message: 'Vui lòng nhập lại mật khẩu mới',
            trigger: 'blur'
        },
        {
            validator: (rule, value, callback) => {
                if (value !== passwordForm.value.password) {
                    callback(new Error('Mật khẩu không khớp'));
                } else {
                    callback();
                }
            }
        }
    ]
});

const handleChangePassword = async () => {
    if (!authStore.checkTokenValidity()) {
        router.push({ name: 'auth-login' });
        return;
    }

    passwordFormRef.value.validate(async (valid) => {
        try {
            if (valid) {
                const response = await axiosInstance.put(
                    'auth/change-password',
                    {
                        current_password: passwordForm.value.current_password,
                        password: passwordForm.value.password,
                        confirm_password: passwordForm.value.confirm_password
                    }
                );
                if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
                    ElNotification({
                        title: 'Thành công',
                        message: 'Cập nhật mật khẩu thành công',
                        type: 'success'
                    });
                    passwordForm.value = {
                        current_password: '',
                        password: '',
                        confirm_password: ''
                    };
                }
            }
        } catch (error) {
            if (
                error.status === HTTP_STATUS_CODE.HTTP_UNPROCESSABLE_ENTITY ||
                error.status === HTTP_STATUS_CODE.HTTP_BAD_REQUEST
            ) {
                errorMessages.value = 'Mật khẩu cũ không đúng';
            } else {
                ElNotification({
                    title: 'Thất bại',
                    message: 'Cập nhật mật khẩu thất bại',
                    type: 'error'
                });
            }
        }
    });
};

const cancelChangePassword = () => {
    passwordForm.value = {
        current_password: '',
        password: '',
        confirm_password: ''
    };
};
</script>

<style lang="scss">
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
    .error-message-container {
        width: 70%;
        padding: 10px 5px;
        margin-bottom: 20px;
        background-color: #f8d7da;
        border-radius: 5px;
        .error-message {
            color: $color-red;
            font-size: 14px;
        }
    }
    &__form {
        .el-form-item {
            margin-bottom: 20px;
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
        margin-top: 24px;
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
