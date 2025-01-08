<template>
    <main class="register-container">
        <div class="side-image">
            <img
                :src="images.heroImage"
                alt=""
            >
        </div>
        <div class="register-form">
            <el-form
                ref="registerForm"
                :model="form"
                :rules="rules"
                class="form-control"
                @submit.prevent="handleSubmit"
            >
                <div class="form-header">
                    <h2>Tạo tài khoản</h2>
                    <p>Nhập thông tin cá nhân của bạn</p>
                </div>
                <el-form-item
                    prop="code"
                    class="form-group"
                >
                    <el-input
                        v-model="form.code"
                        class="form-input no-border"
                        type="text"
                        placeholder="Nhập mã nhân viên"
                    />
                </el-form-item>
                <el-form-item
                    prop="name"
                    class="form-group"
                >
                    <el-input
                        v-model="form.name"
                        class="form-input no-border"
                        type="text"
                        placeholder="Nhập họ tên"
                    />
                </el-form-item>
                <el-form-item
                    prop="email"
                    class="form-group"
                >
                    <el-input
                        v-model="form.email"
                        class="form-input no-border"
                        type="email"
                        placeholder="Nhập email"
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
                        placeholder="Nhập mật khẩu"
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
                    <div class="form-group-actions_item">
                        <button
                            class="btn btn-register"
                            type="submit"
                        >
                            Tạo tài khoản
                        </button>
                    </div>
                    <div class="form-group-actions_item">
                        <GoogleLogin
                            class="btn-register_google"
                            :callback="callback"
                            :button-config="{text: 'signup_with'}"
                        />
                    </div>
                    <div class="form-group-actions_item">
                        <p>Bạn đã có tài khoản?</p>
                        <router-link to="/auth/login">
                            Đăng nhập
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
import { ElMessageBox, ElNotification } from 'element-plus';
import HTTP_STATUS_CODE from '@/config/statusCode';
import { useRouter } from 'vue-router';

const router = useRouter();
const form = reactive({
    code: '',
    name: '',
    email: '',
    password: '',
    confirm_password: ''
});
const registerForm = ref(null);

const rules = {
    code: [
        {
            required: true,
            message: 'Vui lòng nhập mã nhân viên',
            trigger: 'blur'
        },
        {
            type: 'string',
            message: 'Mã nhân viên phải là chuỗi',
            trigger: 'blur'
        },
        {
            validator: (rule, value, callback) => {
                if (value && !value.match(/^K\d{5}$/)) {
                    callback(new Error('Bạn không phải nhân viên của KiaiSoft ?'));
                } else {
                    callback();
                }
            },
            trigger: 'blur'
        }
    ],
    name: [
        {
            required: true,
            message: 'Vui lòng nhập họ tên',
            trigger: 'blur'
        },
        {
            type: 'string',
            message: 'Họ tên phải là chuỗi',
            trigger: 'blur'
        },
        {
            max: 100,
            message: 'Họ tên không được quá 100 ký tự',
            trigger: 'blur'
        }
    ],
    email: [
        {
            required: true,
            message: 'Vui lòng nhập email',
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
                    callback(new Error('Bạn không phải nhân viên của KiaiSoft ?'));
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
            message: 'Vui lòng nhập mật khẩu',
            trigger: 'blur'
        },
        {
            pattern: /^(?=.*\d)(?=.*[A-Z]).{8,}$/,
            message:
                'Mật khẩu phải có ít nhất 8 ký tự và phải có ít nhất một chữ số và một chữ cái viết hoa',
            trigger: 'blur'
        }
    ],
    confirm_password: [
        {
            required: true,
            message: 'Vui lòng nhập lại mật khẩu',
            trigger: 'blur'
        },
        {
            validator: (rule, value, callback) => {
                if (value !== form.password) {
                    callback(new Error('Mật khẩu không khớp'));
                } else {
                    callback();
                }
            },
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
        if (credential) {
            const code = await ElMessageBox.prompt(
                'Vui lòng nhập mã nhân viên',
                'Mã nhân viên',
                {
                    confirmButtonText: 'OK',
                    cancelButtonText: 'Cancel',
                    inputPattern: /^K\d{5}$/,
                    inputErrorMessage: 'Bạn không phải nhân viên của KiaiSoft?'
                }
            );

            if (code.value) {
                const loginResponse = await axiosInstance.post(
                    '/auth/google/callback/register',
                    {
                        code: code.value,
                        credential: credential
                    }
                );

                if (loginResponse.status === HTTP_STATUS_CODE.HTTP_OK) {
                    localStorage.setItem(
                        'token',
                        loginResponse.data.access_token
                    );
                    router.push('/');
                }
            }
        }
    } catch (error) {
        if (
            error.status === HTTP_STATUS_CODE.HTTP_BAD_REQUEST ||
            error.status === HTTP_STATUS_CODE.HTTP_UNAUTHORIZED
        ) {
            ElNotification.error({
                title: 'Lỗi',
                message: 'Bạn không phải nhân viên của KiaiSoft ?',
                duration: 1000
            });
        }
    }
};

const handleSubmit = async () => {
    await registerForm.value.validate(async (valid) => {
        if (valid) {
            try {
                const response = await axiosInstance.post(
                    'auth/register',
                    form
                );
                if (response.status === HTTP_STATUS_CODE.HTTP_CREATED) {
                    router.push('/auth/login');
                }
            } catch (error) {
                if (
                    error.status === HTTP_STATUS_CODE.HTTP_BAD_REQUEST ||
                    error.status === HTTP_STATUS_CODE.HTTP_UNPROCESSABLE_ENTITY
                ) {
                    ElNotification.error({
                        title: 'Lỗi',
                        message: 'Có lỗi xảy ra, vui lòng thử lại',
                        duration: 1000
                    });
                }
            }
        }
    });
};
</script>

<style lang="scss">
@import "@/assets/scss/commonInput.scss";
@import "@/assets/scss/_variables.scss";

.register-container {
    display: flex;
    justify-content: center;
    .side-image {
        width: 56%;
        img {
            width: 100%;
            max-height: 781px;
            object-fit: cover;
            flex-shrink: 0;
        }
    }
    .register-form {
        flex: 1;
        display: flex;
        justify-content: center;
        .nsm7Bb-HzV7m-LgbsSe-bN97Pc-sM5MNb {
            position: relative;
            .nsm7Bb-HzV7m-LgbsSe-BPrWId{
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
                    font-size: 16px;
                    padding-top: 24px;
                    padding-bottom: 48px;
                }

            }
            .form-group {
                border: none;
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
                .form-group-actions_item {
                    width: 100%;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    gap: 20px;
                    .btn {
                        width: 100%;
                    }
                    .btn-register {
                        background-color: $primary-color;
                        color: $text-color-white;
                        border: none;
                        border-radius: 5px;
                        height: 46px;
                        cursor: pointer;
                        font-weight: 500;
                        transition: all 0.3s;
                        font-size: 16px;
                        &:hover {
                            opacity: 0.9;
                        }
                    }
                    .btn-register_google {
                        margin-top: 16px;
                        height: 40px;
                        width: 100%;
                        margin-bottom: 32px;
                    }
                    p{
                        font-size: 16px;
                    }

                    a {
                        color: $text-color-black;
                        font-size: 16px;
                        font-weight: 400;
                        text-decoration: underline;
                        &:hover {
                            color: $primary-color;
                        }


                    }
                }
            }
        }
    }
}
@media (max-width: 768px) {
    .register-container {
        padding: 20px 0 40px 0;
    }
    .side-image {
        display: none;
    }
    .form-header {
        text-align: center;
    }
    .form-group {
        margin-bottom: 40px;
    }
}
@media (min-width: 1024px ) {
    .register-container {
        padding: 60px 0 140px 0;
        margin: 0 auto;
        max-width: 1170px;
        gap: 129px;
    }
    .form-group {
        margin-bottom: 40px;
    }
}
@media (max-width: 1023px) and (min-width: 769px) {
    .register-container {
        padding: 20px 0 40px 0;
        margin: 0 auto;
        gap: 29px;
    }
    .form-group {
        margin-bottom: 20px;
    }
}
</style>

