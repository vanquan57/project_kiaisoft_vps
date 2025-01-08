<template>
    <main class="login-container">
        <div class="side-image">
            <img
                :src="images.heroImage"
                alt=""
                loading="lazy"
            >
        </div>
        <div class="login-form">
            <el-form
                ref="loginForm"
                :model="form"
                :rules="rules"
                class="form-control"
                @submit.prevent="handleSubmit"
            >
                <div class="form-header">
                    <h2>Đăng nhập Kiai-Libra</h2>
                    <p>Nhập thông tin của bạn bên dưới</p>
                </div>
                <div
                    v-if="errorMessage"
                    class="error-message-container"
                >
                    <p class="error-message">
                        {{ errorMessage }}
                    </p>
                </div>
                <el-form-item
                    prop="email"
                    class="form-group"
                >
                    <el-input
                        v-model="form.email"
                        class="form-input no-border"
                        type="email"
                        placeholder="Email"
                        @input="errorMessage = ''"
                    />
                </el-form-item>

                <el-form-item
                    prop="password"
                    class="form-group"
                >
                    <el-input
                        v-model="form.password"
                        class="form-input no-border"
                        type="password"
                        placeholder="Mật khẩu"
                        show-password
                        @input="errorMessage = ''"
                    />
                </el-form-item>
                <div class="form-group-actions">
                    <div class="login-google">
                        <GoogleLogin
                            class="btn-login_google"
                            :callback="callback"
                        />
                    </div>
                    <div class="login-actions">
                        <button type="submit">
                            Đăng nhập
                        </button>
                        <router-link to="/auth/verify-email">
                            Quên mật khẩu ?
                        </router-link>
                    </div>
                </div>
            </el-form>
        </div>
    </main>
</template>

<script setup>
import images from '@/assets/images';
import { reactive, ref } from 'vue';
import axiosInstance from '@/config/axios';
import HTTP_STATUS_CODE from '@/config/statusCode';
import { useRouter } from 'vue-router';
import { ElNotification } from 'element-plus';

const router = useRouter();

const form = reactive({
    email: '',
    password: ''
});
const loginForm = ref(null);
const errorMessage = ref('');

const rules = {
    email: [
        {
            required: true,
            message: 'Vui lòng nhập email của bạn',
            trigger: 'blur'
        },
        {
            type: 'email',
            message: 'Vui lòng nhập đúng định dạng email',
            trigger: 'blur'
        },
        {
            validator: (rule, value, callback) => {
                if (value && !value.includes('kiaisoft')) {
                    callback(new Error('Bạn không phải là nhân viên của KiaiSoft ?'));
                } else {
                    callback();
                }
            },
            trigger: 'blur'
        }
    ],
    password: [
        {
            required: true,
            message: 'Vui lòng nhập mật khẩu của bạn',
            trigger: 'blur'
        },
        {
            pattern: /^(?=.*\d)(?=.*[A-Z]).{8,}$/,
            message:
                'Mật khẩu phải có ít nhất 8 ký tự và phải có ít nhất một chữ số và một chữ cái viết hoa',
            trigger: 'blur'
        }
    ]
};
/**
 * Google login callback
 *
 * @param {Object} response - Google response
 *
 * @returns {void}
 */
const callback = async (response) => {
    const credential = response.credential;

    try {
        const authResponse = await axiosInstance.post(
            'auth/google/callback/',
            {
                credential: credential
            }
        );

        if (authResponse.status === HTTP_STATUS_CODE.HTTP_OK) {
            localStorage.setItem('token', authResponse.data.access_token);
            router.push('/');
        }
    } catch (error) {
        if (
            error.status === HTTP_STATUS_CODE.HTTP_UNAUTHORIZED
        ) {
            ElNotification.error({
                title: 'Lỗi',
                message: 'Bạn không có quyền truy cập vào trang này !',
                duration: 1000
            });
        }
    }
};

const handleSubmit = async () => {
    await loginForm.value.validate(async (valid) => {
        if (valid) {
            try {
                const response = await axiosInstance.post('/auth/login', form);

                if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
                    localStorage.setItem('token', response.data.access_token);
                    router.push('/');
                }
            } catch (error) {
                if (
                    error.status === HTTP_STATUS_CODE.HTTP_UNAUTHORIZED ||
                    error.status === HTTP_STATUS_CODE.HTTP_UNPROCESSABLE_ENTITY
                ) {
                    errorMessage.value = 'Email hoặc mật khẩu không đúng !';
                }
            }
        }
    });
};
</script>

<style lang="scss">
@import '@/assets/scss/commonInput.scss';
@import '@/assets/scss/_variables.scss';

.login-container {
    margin: 30px 0 60px 0;
    display: flex;
    .side-image {
        width: 56%;
        img {
            width: 100%;
            max-height: 781px;
            object-fit: cover;
        }
    }
    .login-form {
        flex: 1;
        display: flex;
        justify-content: center;
        .error-message-container {
            width: 70%;
            padding: 10px 5px;
            margin-top: 20px;
            background-color: #f8d7da;
            border-radius: 5px;
            .error-message {
                color: $color-red;
                font-size: 14px;
            }
        }
        .form-control {
            width: 371px;
            display: flex;
            justify-content: center;
            flex-direction: column;
            .form-header {
                color: $text-color-black;
                h2 {
                    font-size: 36px;
                    font-weight: 500;
                    line-height: 30px;
                }
                p {
                    margin-top: 24px;
                    margin-bottom: 48px;
                    font-size: 16px;
                }

            }
            .form-group {
                border: none;
                margin-bottom: 40px;
                .form-input:first-child {
                    margin-top: 0;
                }
                .form-input {
                    width: 100%;
                    height: 32px;
                    border-bottom: 1.5px solid #e0e0e0;
                    font-size: 16px;
                }
            }
            .form-group-actions {
                display: flex;
                flex-direction: column;
                width: 100%;
                .login-google {
                    width: 100%;
                    .nsm7Bb-HzV7m-LgbsSe-bN97Pc-sM5MNb {
                        position: relative;
                        .nsm7Bb-HzV7m-LgbsSe-BPrWId {
                            font-size: 16px;
                            padding: 5px 0;
                        }
                        .nsm7Bb-HzV7m-LgbsSe-Bz112c {
                            position: absolute;
                            top: 50%;
                            left: 20%;
                            transform: translate(-50%, -50%);
                        }
                    }
                    .btn-login_google {
                        width: 100%;
                        height: 40px;
                    }
                }
                .login-actions {
                    display: flex;
                    gap: 10px;
                    height: 56px;
                    align-items: center;
                    margin-top: 20px;
                    justify-content: space-between;
                    button {
                        width: 143px;
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
                        font-size: 16px;
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
    .login-container {
        padding: 60px 0 149px 0;
        margin: 0 auto;
        max-width: 1170px;
        gap: 129px;
    }
}
</style>
