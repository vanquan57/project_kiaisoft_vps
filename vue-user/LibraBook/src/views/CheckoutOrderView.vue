<template>
    <div>
        <div class="breadcrumb-container-checkout">
            <BreadcrumbLayout :breadcrumb-list="breadcrumbList" />
        </div>
        <section class="checkout-order-container">
            <div class="checkout-order-container-left">
                <el-form
                    ref="checkoutFormRef"
                    :model="checkoutForm"
                    :rules="rules"
                    class="from-checkout"
                >
                    <el-form-item
                        label-position="top"
                        label="Họ tên"
                        prop="name"
                    >
                        <el-input
                            v-model="checkoutForm.name"
                            disabled
                        />
                    </el-form-item>
                    <el-form-item
                        label-position="top"
                        label="Mã nhân viên"
                        prop="employee_code"
                    >
                        <el-input
                            v-model="checkoutForm.employee_code"
                            disabled
                        />
                    </el-form-item>
                    <el-form-item
                        label-position="top"
                        label="Email"
                        prop="email"
                    >
                        <el-input
                            v-model="checkoutForm.email"
                            disabled
                        />
                    </el-form-item>
                    <el-form-item
                        label-position="top"
                        label="Số điện thoại"
                        prop="phone"
                    >
                        <el-input v-model="checkoutForm.phone" />
                    </el-form-item>
                    <el-form-item
                        label-position="top"
                        label="Tỉnh thành"
                        prop="province"
                    >
                        <el-select
                            v-model="checkoutForm.province"
                            placeholder="Chọn tỉnh thành"
                            filterable
                            :no-data-text="'Không tìm thấy tỉnh thành'"
                            @change="getDistricts(checkoutForm.province)"
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
                    <el-form-item
                        label-position="top"
                        label="Quận huyện"
                        prop="district"
                    >
                        <el-select
                            v-model="checkoutForm.district"
                            placeholder="Chọn quận huyện"
                            filterable
                            :no-data-text="'Không tìm thấy quận huyện'"
                            @change="getWards(checkoutForm.district)"
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
                    <el-form-item
                        label-position="top"
                        label="Xã phường"
                        prop="ward"
                    >
                        <el-select
                            v-model="checkoutForm.ward"
                            placeholder="Chọn xã phường"
                            filterable
                            :no-data-text="'Không tìm thấy xã phường'"
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
                    <el-form-item
                        label-position="top"
                        label="Địa chỉ"
                        prop="address"
                    >
                        <el-input v-model="checkoutForm.address" />
                    </el-form-item>
                </el-form>
            </div>
            <div class="checkout-order-container-right">
                <div class="checkout-cart__title">
                    <h2>Sách</h2>
                    <h2>Số lượng</h2>
                    <h2>Ngày trả</h2>
                </div>
                <div class="checkout-cart__list">
                    <div
                        v-for="item in dataCart"
                        :key="item.id"
                        class="checkout-cart__item"
                    >
                        <div class="checkout-cart__item-info">
                            <div class="checkout-cart__item-info-image">
                                <img
                                    :src="imageUrl(item.image)"
                                    alt=""
                                    class="checkout-cart__item-image-img"
                                >
                                <p>{{ item.name }}</p>
                            </div>
                            <p class="checkout-cart__item-quantity">
                                {{ item.quantity }}
                            </p>
                            <p class="checkout-cart__item-return-date">
                                {{ item.return_date }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="cart-footer-checkout">
                    <div class="cart-footer-checkout-container">
                        <h1>Tổng cộng</h1>
                        <div class="cart-footer-checkout-total">
                            <p>Tổng cộng</p>
                            <p>{{ dataCart.length }}</p>
                        </div>
                    </div>
                </div>
                <div class="checkout-cart__button">
                    <button @click="handleSubmit">
                        Xác nhận đơn mượn
                    </button>
                </div>
            </div>
        </section>
    </div>
</template>

<script setup>
import BreadcrumbLayout from '@/components/Breadcrumb/BreadcrumbComponent.vue';
import axiosInstance from '@/config/axios';
import HTTP_STATUS_CODE from '@/config/statusCode';
import { ElNotification } from 'element-plus';
import { onMounted, ref } from 'vue';
import { useRouter } from 'vue-router';
import { useCounterCartAndWishList } from '@/stores/counterCartAndWishList';

const router = useRouter();
const counterCartAndWishList = useCounterCartAndWishList();
const breadcrumbList = [
    {
        name: 'Trang chủ',

        path: '/'
    },
    {
        name: 'Tài khoản của tôi',
        path: '/account'
    },
    {
        name: 'Giỏ mượn',
        path: '/cart'
    },

    {
        name: 'Mượn sách',
        path: '/checkout'
    }
];
const provinces = ref([]);
const districts = ref([]);
const wards = ref([]);
const imageUrl = (url) => {
    return `${import.meta.env.VITE_URL_IMAGE}${url}`;
};

onMounted(async () => {
    await getProvinces();
    await getInformationUser();
    await getDataCart();
    await getCounterWishList();
    await getCounterCart();
});

const checkoutForm = ref({
    name: '',
    employee_code: '',
    email: '',
    phone: '',
    province: '',
    district: '',
    ward: '',
    address: ''
});
const checkoutFormRef = ref(null);
const dataCart = ref([]);
const rules = ref({
    name: [
        {
            required: true,
            message: '',
        }
    ],
    employee_code: [
        {
            required: true,
            message: '',
        }
    ],
    email: [
        {
            required: true,
            message: '',
        }
    ],
    phone: [
        {
            required: true,
            message: 'Vui lòng nhập số điện thoại của bạn',
            trigger: 'blur'
        },
        {
            pattern: /^[0-9]*$/,
            message: 'Vui lòng nhập số điện thoại hợp lệ',
            trigger: 'blur'
        },
        {
            min: 10,
            max: 11,
            message: 'Vui lòng nhập số điện thoại hợp lệ',
            trigger: 'blur'
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

const getInformationUser = async () => {
    try {
        const response = await axiosInstance.get('profile');
        if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
            checkoutForm.value.name = response.data.name;
            checkoutForm.value.employee_code = response.data.code;
            checkoutForm.value.email = response.data.email;
        }
    } catch (error) {}
};

const getDataCart = async () => {
    try {
        const cart = JSON.parse(localStorage.getItem('cart'));

        if (cart) {
            dataCart.value = cart;
        }
    } catch (error) {}
};

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

const getCounterCart = async () => {
    try {
        const response = await axiosInstance.get('/cart');

        if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
            counterCartAndWishList.setCart(response.data.length);
        }
    } catch (error) {}
};

const getCounterWishList = async () => {
    try {
        const response = await axiosInstance.get('/wish-list');
        if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
            counterCartAndWishList.setWishList(response.data.length);
        }
    } catch (error) {}
};

/**
 * Handle submit form category send emit to parent component

 *
 * @returns {Promise<void>}
 */
const handleSubmit = async () => {
    const valid = await checkoutFormRef.value.validate();

    if (valid) {
        try {
            const dataCart = JSON.parse(localStorage.getItem('cart'));

            if (!dataCart) {
                ElNotification({
                    title: 'Lỗi',
                    message: 'Vui lòng cập nhật giỏ mượn',
                    type: 'error'
                });
            }
            const dataCartStore = dataCart.map((item) => {
                return {
                    book_id: item.book_id,
                    quantity: item.quantity,
                    return_date: item.return_date
                };
            });

            const response = await axiosInstance.post('/order', {
                name: checkoutForm.value.name,
                email: checkoutForm.value.email,
                phone: checkoutForm.value.phone,
                province_id: checkoutForm.value.province,
                district_id: checkoutForm.value.district,
                ward_id: checkoutForm.value.ward,
                address: checkoutForm.value.address,
                order_details: dataCartStore
            });

            if (response.status === HTTP_STATUS_CODE.HTTP_CREATED) {
                localStorage.removeItem('cart');
                router.push('/my-account/orders');
            }
        } catch (error) {
            if (error.status === HTTP_STATUS_CODE.HTTP_BAD_REQUEST) {
                ElNotification({
                    title: 'Lỗi',
                    message: 'Vui lòng thử lại và kiểm tra số lượng sách',
                    type: 'error'
                });
            }
        }
    }
};
</script>

<style lang="scss">
@import "@/assets/scss/_variables.scss";

.breadcrumb-container-checkout {
    padding: 60px 0;
}
.checkout-order-container {
    display: flex;
    width: 100%;
    gap: 173px;
    padding-bottom: 140px;
    .el-form-item {
        margin-bottom: 0px;
    }
    .el-form-item__content {
        margin-bottom: 32px;
    }
    .el-form-item__label {
        font-size: 16px;
        font-weight: 400;
    }
    .el-input__wrapper,

    .el-select__wrapper {
        background-color: $background-color-input !important;
        height: 50px;
        padding: 0 10px !important;
    }
    &-left {
        width: 50%;
        max-width: 470px;
    }
    &-right {
        width: 50%;
        max-width: 425px;
        .checkout-cart__title {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            text-align: center;
        }
        .checkout-cart__list {
            margin-top: 20px;
            max-height: 500px;
            overflow-y: auto;
        }
        .checkout-cart__item {
            padding: 10px 0;
            .checkout-cart__item-info-image {

                display: flex;
                align-items: center;
                gap: 10px;
            }
            .checkout-cart__item-info {
                display: grid;
                grid-template-columns: 2fr 1fr 1fr;
                text-align: center;
                justify-content: center;
                align-items: center;
                .checkout-cart__item-image-img {
                    width: 54px;
                    height: 54px;
                    object-fit: cover;
                }
            }
        }
        .cart-footer-checkout {
            display: flex;
            justify-content: flex-end;
            padding-bottom: 40px;
            margin-top: 20px;
            &-container {
                display: flex;
                flex-direction: column;
                gap: 16px;
                width: 100%;
                max-height: 324px;
            }
            h1 {
                font-size: 16px;
                font-weight: 400;
            }
            &-total {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 20px;
                border-top: 1px solid $border-color;
                padding-top: 16px;
            }
        }
        .checkout-cart__button {
            display: flex;
            button {
                background-color: $primary-color;
                width: 267px;
                height: 56px;
                color: #fff;
                padding: 16px 48px;
                border-radius: 5px;
                border: none;
                cursor: pointer;
                text-decoration: none;
                display: flex;
                justify-content: center;
                align-items: center;
                margin-top: 32px;
            }
        }
    }
}
@media (min-width: 1024px) {
    .breadcrumb-container-checkout {
        max-width: 1170px;
        margin: 0 auto;
    }
    .checkout-order-container {
        max-width: 1170px;
        margin: 0 auto;
    }
}
</style>
