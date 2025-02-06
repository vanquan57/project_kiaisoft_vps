<template>
    <main class="register-container">
        <div class="register-container__wrapper">
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
                            <button
                                class="btn-register_google"
                                type="button"
                                @click="handleRegisterGoogle"
                            >
                                <IconGoogle />
                                Đăng ký với Google
                            </button>
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
        </div>
    </main>
</template>

<script setup>
import images from '@/assets/images';
import { reactive, ref } from 'vue';
import axiosInstance from '@/config/axios';
import { ElMessageBox, ElNotification } from 'element-plus';
import HTTP_STATUS_CODE from '@/config/statusCode';
import IconGoogle from '@/components/icons/IconGoogle.vue';
import { googleTokenLogin } from 'vue3-google-login';
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
const handleRegisterGoogle = async () => {
    googleTokenLogin().then(async (response) => {
        try {
            if (response.access_token) {
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
                    const registerResponse = await axiosInstance.post(
                        '/auth/google/callback/register',
                        {
                            code: code.value,
                            access_token: response.access_token
                        }
                    );

                    if (registerResponse.success) {
                        localStorage.setItem(
                            'token',
                            registerResponse.data.access_token
                        );
                        router.push('/');
                    }
                }
            }
        } catch (error) {
            const errors = error.data.errors;

            if (
                error.status === HTTP_STATUS_CODE.HTTP_BAD_REQUEST ||
                error.status === HTTP_STATUS_CODE.HTTP_UNAUTHORIZED
            ) {
                ElNotification.error({
                    title: 'Lỗi',
                    message: errors.error_message,
                    duration: 2000
                });
            }
        }
    });
};

/**
 * Handle submit register form
 *
 * @returns {void}
 */
const handleSubmit = async () => {
    await registerForm.value.validate(async (valid) => {
        if (valid) {
            try {
                const response = await axiosInstance.post(
                    'auth/register',
                    form
                );
                if (response.success) {
                    router.push('/auth/login');
                }
            } catch (error) {
                const errors = error.data.errors;

                if (
                    error.status === HTTP_STATUS_CODE.HTTP_UNPROCESSABLE_ENTITY
                ) {
                    ElNotification.error({
                        title: 'Lỗi',
                        message: Object.values(errors)[0][0],
                        duration: 1000
                    });
                } else {
                    ElNotification.error({
                        title: 'Lỗi',
                        message: errors.error_message,
                        duration: 1000
                    });
                }
            }
        }
    });
};
</script>

<style lang="scss" scoped>
@import '@/assets/scss/views/register_view.scss';
</style>

