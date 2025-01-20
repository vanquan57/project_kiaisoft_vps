<template>
    <div>
        <section class="login-admin">
            <main>
                <div class="logo">
                    <img
                        :src="images.logoKiaisoft"
                        alt="logo"
                    >
                </div>
                <h1>Đăng nhập Admin Kiai-Libra</h1>
                <div
                    v-if="errorMessages"
                    class="error-message-container"
                >
                    <p class="error-message">
                        {{ errorMessages }}
                    </p>
                </div>
                <el-form
                    ref="formRef"
                    :model="form"
                    :rules="rules"
                    label-position="top"
                >
                    <el-form-item prop="email">
                        <el-input
                            v-model="form.email"
                            placeholder="Nhập email"
                            clearable
                            class="input-field"
                            type="email"
                            @input="errorMessages = ''"
                        />
                    </el-form-item>
                    <el-form-item prop="password">
                        <el-input
                            v-model="form.password"
                            placeholder="Nhập mật khẩu"
                            clearable
                            class="input-field"
                            type="password"
                            show-password
                            @input="errorMessages = ''"
                        />
                    </el-form-item>
                    <el-form-item>
                        <el-button
                            type="primary"
                            :loading="loading"
                            class="btn-submit"
                            @click="onSubmit"
                        >
                            Đăng nhập
                        </el-button>
                    </el-form-item>
                </el-form>
            </main>
        </section>
    </div>
</template>

<script setup>
import { ref, reactive } from 'vue';
import images from '@/assets/images/index';
import { useRouter } from 'vue-router';
import HTTP_STATUS_CODE from '@/config/statusCode';
import axiosInstance from '@/config/axios';

const router = useRouter();
const loading = ref(false);
const formRef = ref(null);
const errorMessages = ref('');

// Model form data
const form = reactive({
    email: '',
    password: ''
});

// Validate email
const validateEmail = (_, value, callback) => {
    if (!value) {
        callback(new Error('Vui lòng nhập email'));
    } else if (!/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/.test(value)) {
        callback(new Error('Email không đúng định dạng'));
    } else if (!value.includes('kiaisoft')) {
        callback(new Error('Bạn không phải là nhân viên Kiaisoft'));
    } else {
        callback();
    }
};

// Validate password
const validatePassword = (_, value, callback) => {
    if (!value) {
        callback(new Error('Vui lòng nhập mật khẩu'));
    } else {
        callback();
    }
};

// rules validate form
const rules = {
    email: [{ validator: validateEmail, trigger: 'blur' }],
    password: [{ validator: validatePassword, trigger: 'blur' }]
};

// Handle submit form
const onSubmit = () => {
    formRef.value.validate(async (valid) => {
        if (valid) {
            try {
                loading.value = true;

                const response = await axiosInstance.post('/auth/login', {
                    email: form.email,
                    password: form.password
                });

                if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
                    localStorage.setItem('token', response.data.access_token);
                    loading.value = false;
                    router.push({ name: 'home' });
                }
            } catch (error) {
                loading.value = false;

                if (
                    error.status ===
                        HTTP_STATUS_CODE.HTTP_UNPROCESSABLE_ENTITY ||
                    error.status === HTTP_STATUS_CODE.HTTP_UNAUTHORIZED
                ) {
                    errorMessages.value = 'Email hoặc mật khẩu không đúng';
                }
            }
        }
    });
};
</script>

<style lang="scss" scoped>
@import "@/assets/scss/_variables.scss";

.login-admin {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100vh;
    background-image: url("@/assets/images/shape.png");
    background-size: cover;
    background-position: center;
    background-color: $primary-color;
    main {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 500px;
        height: fit-content;
        margin: auto;
        padding: 30px 20px;
        box-shadow: 0px 0px 10px 0px #0000001a;
        border-radius: 10px;
        background-color: #fff;

        .logo {
            width: 100px;
            height: 100px;
            img {
                width: 100%;
                height: 100%;
                object-fit: contain;
            }
        }

        h1 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .error-message-container {
            width: 70%;
            padding: 10px 5px;
            margin-bottom: 20px;
            background-color: #f8d7da;
            border-radius: 5px;
            .error-message {
                color: $error-color;
                font-size: 14px;
            }
        }

        form {
            width: 70%;
            display: flex;
            flex-direction: column;
            gap: 15px;
            .input-field {
                width: 100%;
                height: 40px;
                border-radius: 5px;
            }
            .btn-submit {
                width: 50%;
                height: 40px;
                border-radius: 5px;
                margin: 5px auto;
                background-color: $primary-color;
                border: none;
                color: #fff;
                &:hover {
                    background-color: darken($primary-color, 10%);
                }
            }
        }
    }
}
</style>
