<template>
    <div>
        <section class="verify-email">
            <main>
                <div class="logo">
                    <img
                        :src="images.logoKiaiSoft"
                        alt="logo"
                    >
                </div>
                <h1>Xác thực email</h1>
                <el-form
                    ref="formRef"
                    :model="form"
                    :rules="rules"
                    label-position="top"
                    @submit.prevent="onSubmit"
                >
                    <div
                        v-if="errorMessage"
                        class="error-message-container"
                    >
                        <p class="error-message">
                            {{ errorMessage }}
                        </p>
                    </div>

                    <el-form-item prop="email">
                        <el-input
                            v-model="form.email"
                            placeholder="Nhập email của bạn"
                            clearable
                            class="input-field"
                            @input="errorMessage = ''"
                        />
                    </el-form-item>
                    <el-form-item>
                        <el-button
                            type="primary"
                            :loading="loading"
                            class="btn-submit"
                            @click="onSubmit"
                        >
                            Gửi yêu cầu
                        </el-button>
                    </el-form-item>
                </el-form>
            </main>
        </section>
    </div>
</template>

<script setup>
import { ref, reactive } from 'vue';
import images from '@/assets/images';
import axiosInstance from '@/config/axios';
import HTTP_STATUS_CODE from '@/config/statusCode';
import { ElNotification } from 'element-plus';

const loading = ref(false);
const formRef = ref(null);

const errorMessage = ref('');
const form = reactive({
    email: ''
});

const rules = {
    email: [
        {
            required: true,
            message: 'Vui lòng nhập email',
            trigger: 'blur'
        },
        {
            type: 'email',
            message: 'Email không đúng định dạng',
            trigger: 'blur'
        },
        {
            validator: (_, value, callback) => {
                if (!value.includes('kiaisoft')) {
                    callback(new Error('Bạn không phải nhân viên của Kiaisoft ?'));
                } else {
                    callback();
                }
            },
            trigger: 'blur'
        }
    ]
};

const onSubmit = () => {
    formRef.value.validate(async (valid) => {
        if (valid) {
            try {
                loading.value = true;
                const response = await axiosInstance.post(
                    '/auth/verify-email',
                    form
                );

                if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
                    ElNotification.success({
                        title: 'Thành công',
                        message: 'Gửi yêu cầu thành công, vui lòng kiểm tra email của bạn',
                        duration: 1000
                    });
                    localStorage.setItem('email', form.email);
                    loading.value = false;
                }
            } catch (error) {
                if (error.status === HTTP_STATUS_CODE.HTTP_BAD_REQUEST) {
                    ElNotification.error({
                        title: 'Lỗi',
                        message: 'Có lỗi xảy ra, vui lòng thử lại sau',
                        duration: 1000
                    });
                    loading.value = false;
                }

                if (
                    error.status === HTTP_STATUS_CODE.HTTP_UNPROCESSABLE_ENTITY
                ) {
                    errorMessage.value =
                        'Bạn không phải nhân viên của Kiaisoft ? Hoặc chưa đăng ký tài khoản';
                    loading.value = false;
                }
            }
        }
    });
};
</script>

<style lang="scss">
@import '@/assets/scss/commonInput.scss';
@import '@/assets/scss/_variables.scss';

.verify-email {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 50px 0;
    main {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 500px;
        margin: auto;
        padding: 30px 20px;
        box-shadow: 0px 0px 10px 0px #0000001a;
        border-radius: 10px;
        background-color: #fff;
        .error-message-container {
            width: 100%;
            padding: 10px 5px;
            margin-bottom: 20px;
            background-color: #f8d7da;
            border-radius: 5px;
            .error-message {
                color: $color-red;
                font-size: 14px;
            }
        }
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
        form {
            width: 70%;
            .input-field {
                width: 100%;
                padding: 0 10px;
                height: 40px;
                border-radius: 5px;
                border: 1px solid #e0e0e0;
                background-color: $text-color-grown;
                margin: 10px 0;
            }
            .error-message {
                color: red;
                font-size: 12px;
                margin-top: 5px;
            }
            .btn-submit {
                width: 50%;
                height: 40px;
                border-radius: 5px;
                margin: 20px auto;
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
