<template>
    <div class="wishlist-container">
        <div class="wishlist-header">
            <div class="breadcrumb-container">
                <h2>Danh sách yêu thích ( {{ wishlist.length }} )</h2>
            </div>
            <div class="wishlist-header__action">
                <button
                    class="btn btn-move-all-to-cart"
                    @click="handleMoveAllToCart"
                >
                    Thêm tất cả vào giỏ hàng
                </button>
            </div>
        </div>
        <div class="wishlist-body">
            <div class="wishlist-body__item">
                <BookCardComponent
                    v-for="item in wishlist"
                    :key="item.id"
                    :book="item"
                    :is-wishlist="true"
                    @remove-book-from-wishlist="handleRemoveBookFromWishlist"
                    @add-book-to-cart="handleAddBookToCart"
                />
            </div>
            <section class="top-book section-container">
                <div class="top-book__most-borrowed__today">
                    <span>Sách mới nhất</span>
                    <button
                        class="btn btn-move-all-to-cart"
                        @click="
                            handleRedirectToListBook({
                                isNewBook: true,
                            })
                        "
                    >
                        Xem thêm
                    </button>
                </div>
                <div class="top-book__most-borrowed__list">
                    <BookCardComponent
                        v-for="book in newBooks"
                        :key="book.id"
                        :book="book"
                        :is-new-book="true"
                        @quick-view="handleQuickView"
                        @add-book-to-cart="handleAddBookToCart"
                        @add-book-to-wishlist="handleAddBookToWishlist"
                    />
                </div>
            </section>
        </div>
    </div>
</template>

<script setup>
import BookCardComponent from '@/components/book/BookCardComponent.vue';
import axiosInstance from '@/config/axios';
import HTTP_STATUS_CODE from '@/config/statusCode';
import { useAuthStore } from '@/stores/auth';
import { onMounted, ref } from 'vue';
import { useRouter } from 'vue-router';
import { ElNotification } from 'element-plus';
import { useWishListStore } from '@/stores/wishList';
import { useCounterCartAndWishList } from '@/stores/counterCartAndWishList';
import DEFAULT_CONSTANTS from '@/config/constants';

const authStore = useAuthStore();
const router = useRouter();
const wishListStore = useWishListStore();
const counterCartAndWishList = useCounterCartAndWishList();
const wishlist = ref([]);
const newBooks = ref([]);

onMounted(async () => {
    if (!authStore.checkTokenValidity()) {
        router.push('/auth/login');
    } else {
        await getWishlist();
        await getCart();
        await getNewBooks();
    }
});

const getWishlist = async () => {
    const response = await axiosInstance.get('/wish-list');

    if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
        wishlist.value = response.data;
        counterCartAndWishList.setWishList(wishlist.value.length);
    }
};

const getCart = async () => {
    const response = await axiosInstance.get('/cart');
    if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
        counterCartAndWishList.setCart(response.data.length);
    }
};

const handleAddBookToCart = async (id) => {
    if (authStore.checkTokenValidity()) {
        try {
            const response = await axiosInstance.post('/cart', {
                cart: [
                    {
                        book_id: id,
                        quantity: 1
                    }
                ]
            });
            if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
                ElNotification.success('Thêm vào giỏ hàng thành công');
                counterCartAndWishList.incrementCounterCart();
            }

        } catch (error) {
            ElNotification.error('Thêm vào giỏ hàng thất bại');
        }
    } else {
        router.push({ name: 'auth-login' });
    }
};

const handleMoveAllToCart = async () => {
    const inStockBooks = [];
    let outOfStockBooks = [];

    const dataAddToCart = wishlist.value
        .filter((item) => {
            if (item.quantity > 1) {
                inStockBooks.push(item.name);
                return true;
            } else {
                outOfStockBooks.push(item.name);
                return false;
            }
        })
        .map((item) => ({
            book_id: item.id,
            quantity: 1
        }));

    if (outOfStockBooks.length > 0) {
        ElNotification.error({
            message: `Các sách ${outOfStockBooks.join(', ')} đã hết hàng`,
            duration: 2000
        });
    }

    if (dataAddToCart.length > 0) {
        try {
            const response = await axiosInstance.post('/cart', {
                cart: dataAddToCart
            });

            if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
                await getCart();
                ElNotification.success({
                    message: `Đã thêm ${inStockBooks.join(', ')} vào giỏ hàng`,
                    duration: 2000
                });
            }
        } catch (error) {
            setTimeout(() => {
                ElNotification.error('Thêm tất cả vào giỏ hàng thất bại');
            }, 2000);
        }
    }
};

const handleRemoveBookFromWishlist = async (bookId) => {
    try {
        const response = await axiosInstance.delete(`/wish-list/${bookId}`);
        if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
            await getWishlist();
            wishListStore.removeFromWishList(bookId);
            ElNotification.success('Xóa sách khỏi danh sách yêu thích thành công');
        }
    } catch (error) {
        ElNotification.error('Xóa sách khỏi danh sách yêu thích thất bại');
    }
};

/**
 * Get list new books
 *
 * @returns {Promise<void>}
*/
const getNewBooks = async (page = 1) => {
    try {
        const response = await axiosInstance.get('/book', {
            params: {
                limit: DEFAULT_CONSTANTS.LIMIT_BOOK,
                latest: DEFAULT_CONSTANTS.TRUE,
                order: DEFAULT_CONSTANTS.DEFAULT_ORDER,
                page: page
            }
        });

        if (response.success) {
            newBooks.value = response.data.data;
        }
    } catch (error) {}
};

/**
 * Handle redirect to list book
 *
 * @param {Object} props - The props
 *
 * @returns {Promise<void>}
*/
const handleRedirectToListBook = ({ ...props }) => {
    const query = Object.fromEntries(
        Object.entries(props).filter(
            ([key, value]) => value !== undefined && value !== null
        )
    );
    router.push({
        name: 'list-book',
        query: query
    });
};

/**
 * Handle quick view
 *
 * @param {number} id - The book id
 *
 * @returns {Promise<void>}
*/
const handleQuickView = (id) => {
    router.push({
        name: 'book.detail',
        params: {
            slug: id
        }
    });
};
</script>

<style lang="scss" scoped>
.wishlist-container {
    .wishlist-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        @media (min-width: 1024px) {
            margin-top: 80px;
        }

        .breadcrumb-container {
            display: flex;
            align-items: center;
            gap: 10px;
            h2 {
                font-size: clamp(16px, 2vw, 20px);
                font-weight: 400;
                font-family: "Poppins", sans-serif;
            }
        }
        .wishlist-header__action {
            .btn-move-all-to-cart {
                border: 1px solid #000;
                border-radius: 5px;
                background-color: transparent;
                font-size: 16px;
                font-weight: 500;
                font-family: "Poppins", sans-serif;
                color: #000;
                width: 223px;
                height: 56px;
                cursor: pointer;
                transition: all 0.3s ease;
                &:hover {
                    background-color: #000;
                    color: #fff;
                }
            }
        }
    }
    .wishlist-body {
        .wishlist-body__item {
            width: 100%;
            display: grid;
            row-gap: 80px;
        }
    }
}

@media (max-width: 768px) {
    .wishlist-container {
        padding: 60px 0;
    }
    .wishlist-body {
        width: 100%;
        padding: 0 10px;
    }
    .wishlist-body__item {
        margin-top: 40px;
        row-gap: 40px;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }
}
@media (min-width: 768px) and (max-width: 1024px) {
    .wishlist-container {
        max-width: 1170px;
        margin: 0 auto;
    }
    .wishlist-body {
        width: 100%;
        padding: 0 10px;
    }
    .wishlist-body__item {
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }
}
@media (min-width: 1024px) {
    .wishlist-container {
        max-width: 1170px;
        margin: 0 auto;
    }
    .wishlist-body {
        max-width: 1170px;
        margin: 0 auto;
        margin-top: 60px;
        margin-bottom: 140px;
    }
    .wishlist-body__item {
        grid-template-columns: repeat(4, 1fr);
        gap: 30px;
    }
}
</style>
