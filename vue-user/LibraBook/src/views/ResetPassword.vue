<template>
    <main class="reset-password-container">
        <div class="side-image">
            <img
                :src="images.heroImage"
                alt=""
            >
        </div>
        <div class="reset-password-form">
            <el-form
                ref="resetPasswordForm"
                :model="form"
                :rules="rules"
                class="form-control"
                @submit.prevent="handleSubmit"
            >
                <div class="form-header">
                    <h2>Đặt lại mật khẩu</h2>
                    <p>Nhập mật khẩu mới của bạn</p>
                </div>
                <el-form-item
                    prop="password"
                    class="form-group"
                >
                    <el-input
                        v-model="form.password"
                        class="form-input no-border"
                        type="password"
                        placeholder="Mật khẩu mới"
                        show-password
                    />
                </el-form-item>

                <el-form-item
                    prop="confirm_password"
                    class="form-group"
                >
                    <el-input
                        v-model="form.confirm_password"
                        class="form-input no-border"
                        type="password"
                        placeholder="Nhập lại mật khẩu"
                        show-password
                    />
                </el-form-item>
                <div class="form-group-actions">
                    <div class="login-actions">
                        <button type="submit">
                            Đặt lại mật khẩu
                        </button>
                    </div>
                </div>
            </el-form>
        </div>
    </main>
</template>

<script setup>
import images from '@/assets/images';
import HTTP_STATUS_CODE from '@/config/statusCode';
import { reactive, ref } from 'vue';
import { useRouter } from 'vue-router';
import { ElNotification } from 'element-plus';
import axiosInstance from '@/config/axios';
const router = useRouter();
const form = reactive({
    password: '',
    confirm_password: ''
});
const props = defineProps({
    token: {
        type: String,
        required: true
    }
});
const resetPasswordForm = ref(null);

const rules = {
    password: [
        {
            required: true,
            message: 'Please input your new password',
            trigger: 'blur'
        },
        {
            pattern: /^(?=.*\d)(?=.*[A-Z]).{8,}$/,
            message:
                'Password must be at least 8 characters and contain at least one number and one uppercase letter',
            trigger: 'blur'
        }
    ],
    confirm_password: [
        {
            required: true,
            message: 'Please input your password confirmation',
            trigger: 'blur'
        },
        {
            validator: (rule, value, callback) => {
                if (value !== form.password) {
                    callback(
                        new Error('The password confirmation does not match')
                    );
                } else {
                    callback();
                }
            },
            trigger: 'blur'
        }
    ]
};

const handleSubmit = async () => {
    await resetPasswordForm.value.validate(async (valid) => {
        if (valid) {
            try {
                const response = await axiosInstance.post(
                    'auth/reset-password',
                    {
                        email: localStorage.getItem('email'),
                        token: props.token,
                        password: form.password,
                        confirm_password: form.confirm_password
                    }
                );
                if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
                    localStorage.removeItem('email');
                    router.push({ name: 'auth-login' });
                }
            } catch (error) {
                if (
                    error.status ===
                        HTTP_STATUS_CODE.HTTP_UNPROCESSABLE_ENTITY ||
                    error.status === HTTP_STATUS_CODE.HTTP_BAD_REQUEST
                ) {
                    ElNotification.error({
                        title: 'Lỗi',
                        message: 'Token không hợp lệ hoặc đã hết hạn',
                        type: 'error'
                    });
                }
            }

        }
    });
};
</script>

<style lang="scss" scoped>
@import '@/assets/scss/commonInput.scss';
@import "@/assets/scss/_variables.scss";

.reset-password-container {
    margin: 40px 0 60px 0;
    display: flex;

    .side-image {
        width: 56%;
        img {
            width: 100%;
            max-height: 781px;
            object-fit: cover;
        }
    }
    .reset-password-form {
        flex: 1;
        display: flex;
        justify-content: center;

        .form-control {
            width: 371px;
            display: flex;
            justify-content: center;
            flex-direction: column;
            .form-header {
                color: $text-color-black;
                h2 {
                    font-size: clamp(24px, 2.5vw, 36px);
                    font-weight: 500;
                    line-height: 30px;
                }
                p {
                    margin-top: 10px;
                    font-size: clamp(16px, 1.5vw, 18px);
                }
            }
            .form-group {
                border: none;
                margin-top: 20px;
                margin-bottom: 0;

                .form-input {
                    width: 100%;
                    height: 40px;
                    border-bottom: 1.5px solid #e0e0e0;
                    margin-bottom: 10px;
                }
            }
            .form-group-actions {
                display: flex;
                flex-direction: column;
                width: 100%;
                .login-actions {
                    display: flex;
                    gap: 10px;
                    height: 56px;
                    align-items: center;
                    margin-top: 30px;
                    justify-content: space-between;
                    button {
                        width: 100%;
                        height: 100%;
                        background-color: $color-red;
                        color: $text-color-white;
                        border: none;
                        border-radius: 5px;
                        cursor: pointer;
                        font-size: 16px;
                        font-weight: 500;
                        transition: all 0.3s;
                        &:hover {
                            opacity: 0.9;
                        }
                    }
                    a {
                        color: $color-red;
                        font-size: 16px;
                        font-weight: 400;
                        text-decoration: none;
                    }
                }
            }
        }
    }
}
@media (max-width: 768px) {
    .side-image {
        display: none;
    }
    .form-header {
        text-align: center;
    }
}
@media (min-width: 1024px) {
    .reset-password-container {
        max-width: 1170px;
        margin: 0 auto;
        padding: 40px 0 60px 0;
    }
}
</style>
