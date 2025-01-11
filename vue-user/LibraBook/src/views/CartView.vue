<template>
    <div class="cart-container">
        <div class="cart-header">
            <BreadcrumbComponent :breadcrumb-list="breadcrumbList" />
        </div>
        <div class="cart-body">
            <div class="cart-item-title">
                <h3 class="cart-item-title-column">
                    Sách
                </h3>
                <h3 class="cart-item-title-column">
                    Số lượng
                </h3>
                <h3 class="cart-item-title-column">
                    Ngày trả
                </h3>
            </div>
            <div
                v-for="(item, index) in cart"
                :key="index"
                class="cart-item"
            >
                <div class="cart-item-column image-column">
                    <img
                        :src="imageUrl(item.image)"
                        alt="Book Image"
                        class="book-image"
                    >
                    <div
                        class="cart-item-column-icon"
                        @click="removeFromCart(item.id)"
                    >
                        <IconRemoveCart />
                    </div>
                    <h3>{{ item.name }}</h3>
                </div>
                <div class="cart-item-column quantity-column">
                    <input
                        v-model.number="item.pivot.quantity"
                        type="number"
                        :max="item.quantity"
                        min="1"
                        @change="validateQuantity(item.id, item.pivot.quantity)"
                        @input="item.pivot.quantity = Math.min(Math.max(1, item.pivot.quantity), item.quantity)"
                    >
                </div>
                <div class="cart-item-column return-date-column">
                    <input
                        v-model="item.returnDate"
                        type="date"
                        @input="validateReturnDate(item.id, item.returnDate)"
                    >
                    <p
                        v-if="item.error"
                        class="return-date-column-error"
                    >
                        {{ item.error }}
                    </p>
                </div>
            </div>
        </div>
        <div class="cart-footer">
            <router-link to="/">
                <button class="cart-footer-button">
                    Trở về trang chủ
                </button>
            </router-link>
            <button
                class="cart-footer-button"
                @click="updateCart"
            >
                Cập nhật giỏ mượn
            </button>
        </div>
        <div class="cart-footer-checkout">
            <div class="cart-footer-checkout-container">
                <h1>Tổng giỏ mượn</h1>
                <div class="cart-footer-checkout-total">
                    <p>Tổng</p>
                    <p>{{ cart.length }}</p>
                </div>
                <div class="cart-footer-checkout-button">
                    <router-link to="/checkout">
                        Tiến hành mượn sách
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import BreadcrumbComponent from '@/components/Breadcrumb/BreadcrumbComponent.vue';
import axiosInstance from '@/config/axios';
import HTTP_STATUS_CODE from '@/config/statusCode';
import { onMounted, ref } from 'vue';
import { ElNotification } from 'element-plus';
import IconRemoveCart from '@/components/icons/IconRemoveCart.vue';
import { useCounterCartAndWishList } from '@/stores/counterCartAndWishList';

const counterCartAndWishList = useCounterCartAndWishList();
const breadcrumbList = [
    { name: 'Trang chủ', path: '/' },
    { name: 'Giỏ mượn', path: '/cart' }
];

const cart = ref([]);
const imageUrl = (url) => {
    return `${import.meta.env.VITE_URL_IMAGE}${url}`;
};
onMounted(async () => {
    await getWishList();
    await getCart();
});

async function updateCart() {
    localStorage.removeItem('cart');
    const dataCart = cart.value.map((item) => {
        return {
            book_id: item.id,
            quantity: item.pivot.quantity
        };
    });

    const isValid = cart.value.every((item) => item.error === '');

    if (dataCart.length > 0 && isValid) {
        try {
            const response = await axiosInstance.put('/cart', {
                cart: dataCart
            });
            if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
                const dataStoreToLocalStorage = cart.value.map((item) => {
                    return {
                        book_id: item.id,
                        name: item.name,
                        image: item.image,
                        quantity: item.pivot.quantity,
                        return_date: item.returnDate
                    };
                });
                localStorage.setItem(
                    'cart',
                    JSON.stringify(dataStoreToLocalStorage)
                );
                ElNotification.success('Cập nhật giỏ mượn thành công');
            }
        } catch (error) {
            ElNotification.error('Cập nhật giỏ mượn thất bại');
        }
    } else {
        ElNotification.error('Vui lòng điền đầy đủ các trường và kiểm tra ngày trả');
    }
}

async function getWishList() {
    try {
        const response = await axiosInstance.get('/wish-list');
        if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
            counterCartAndWishList.setWishList(response.data.length);
        }
    } catch (error) {}
}


async function getCart() {
    try {

        localStorage.removeItem('cart');
        const response = await axiosInstance.get('/cart');

        if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
            for (const item of response.data) {
                item.returnDate = new Date().toISOString().split('T')[0];
                item.error = '';
            }
            cart.value = response.data;
            counterCartAndWishList.setCart(response.data.length);
        }
    } catch (error) {}
}

async function removeFromCart(id) {
    try {
        const response = await axiosInstance.delete(`/cart/${id}`);
        if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
            await getCart();
            ElNotification.success('Xóa sách khỏi giỏ mượn thành công');
        }
    } catch (error) {
        ElNotification.error('Xóa sách khỏi giỏ mượn thất bại');
    }
}

function validateReturnDate(id, returnDate) {
    const newReturnDate = new Date(returnDate);
    const currentDate = new Date();
    if (newReturnDate < currentDate) {
        cart.value.find((item) => item.id === id).error =
            'Ngày trả không thể nhỏ hơn ngày hiện tại';
    } else {
        cart.value.find((item) => item.id === id).error = '';
    }
}

function validateQuantity(id, quantity) {
    cart.value.find((item) => item.id === id).borrowQuantity = quantity;
}
</script>


<style lang="scss" scoped>
@import "@/assets/scss/_variables.scss";
.cart-container {
    padding: 30px 0;
    @media (min-width: 1024px) {
        padding: 60px 0;
    }
    @media (max-width: 768px) {
        padding: 0 10px;
    }
}


.cart-body {
    display: flex;
    flex-direction: column;
    gap: 20px;
    @media (min-width: 1024px) {
        margin-top: 60px;
    }
    .cart-item-title {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        justify-content: space-between;
        align-items: center;
        text-align: center;
        gap: 20px;
        padding: 24px;
        box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.1);
    }
    .cart-item {
        display: grid;

        grid-template-columns: 1fr 1fr 1fr;
        text-align: center;
        align-items: center;
        gap: 20px;
        padding: 10px;
        box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.1);
        padding-right: 30px;
        &:hover {
            background-color: #f0f0f0;
        }
        .book-image {
            width: 54px;
            height: 54px;
            object-fit: cover;
            aspect-ratio: 1/1;
        }
        .image-column {
            display: flex;
            align-items: center;
            gap: 10px;
            position: relative;
            h3 {
                font-size: 14px;
                font-weight: 400;
                color: #000;
                text-align: left;
                @media (max-width: 768px) {
                    font-size: 12px;
                    width: 80px;
                }
            }
            .cart-item-column-icon {
                position: absolute;
                top: -10px;
                left: -20px;
                cursor: pointer;
            }
        }
        .quantity-column {
            input {
                width: 72px;
                height: 44px;
                border: 1px solid $primary-color;
                border-radius: 4px;
                color: $primary-color;
                padding: 0 10px;
                text-align: center;
                @media (max-width: 768px) {
                    width: 50px;
                }
            }
        }


        .return-date-column {
            input {
                width: 100%;
                height: 44px;
                border: 1px solid $primary-color;
                border-radius: 4px;
                color: $primary-color;
                padding: 0 10px;
                text-align: center;
                @media (max-width: 768px) {
                    width: 50%;
                }
            }
            .return-date-column-error {
                color: red;
                font-size: 12px;
                margin-top: 5px;
            }
        }
        .action-column {
            button {
                background-color: $primary-color;
                color: #fff;
                padding: 10px 20px;
                border-radius: 5px;
                border: none;
                cursor: pointer;
            }
        }
    }
}
.cart-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    margin: 24px 0 80px 0;
    button {
        width: 218px;
        height: 56px;
        border-radius: 4px;
        border: 1px solid $border-color;
        cursor: pointer;
        font-size: 16px;
        font-weight: 500;
        background-color: transparent;
        &:hover {
            background-color: $primary-color;
            color: #fff;
        }
    }
}
.cart-footer-checkout {
    display: flex;
    justify-content: flex-end;
    padding-bottom: 40px;
    @media (min-width: 1024px) {
        padding-bottom: 80px;
    }
    &-container {
        display: flex;
        flex-direction: column;
        width: 470px;
        max-height: 324px;
        border: 1px solid $border-color;
        padding: 24px;
        h1{
            margin-top: 8px;
            font-size: 20px;
            font-weight: 500;
        }
    }

    &-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid $border-color;
        padding-bottom: 16px;
        margin-top: 24px;
    }
    &-button {
        width: 100%;
        display: flex;
        justify-content: center;
        margin-top: 16px;
        a {
            background-color: $primary-color;
            width: 260px;
            height: 56px;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    }
}

@media (min-width: 1024px) {
    .cart-container {
        max-width: 1170px;
        margin: 0 auto;
    }
}
</style>
