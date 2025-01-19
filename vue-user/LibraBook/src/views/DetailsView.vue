<template>
    <div class="details-container">
        <BreadcrumbComponent
            class="breadcrumb-container"
            :breadcrumb-list="breadcrumbs"
        />
        <div class="details-content">
            <div class="details-content-left">
                <div class="detail-image-carousel">
                    <img
                        v-for="image in book.images"
                        :key="image"
                        :src="urlImage(image.url)"
                        alt=""
                        class="image-carousel__item"
                        @click="handleClickImage(image.url)"
                    >
                </div>
                <div class="detail-main-image">
                    <img
                        :src="mainImage"
                        alt=""
                        class="main-image"
                    >
                </div>
            </div>
            <div class="details-content-right">
                <h2 class="book-name">
                    {{ book.name }}
                </h2>
                <div class="book__info">
                    <div class="book__info__rating">
                        <div class="book__info__feedback">
                            <div class="book__info__rating">
                                <div
                                    v-for="i in 5"
                                    :key="i"
                                    :class="[
                                        'book__info__rating__item',
                                        { active: i <= book.average_star },
                                    ]"
                                >
                                    <IconStar />
                                </div>
                                <span class="book__info__total-feedbacks">
                                    ( {{ feedbacks.length }} Nhận xét)
                                </span>
                            </div>
                        </div>
                        <div
                            class="info-book-in-card"
                            :class="[
                                'info-book-in-card',
                                { 'out-of-stock': book.quantity === 0 },
                            ]"
                        >
                            {{ book.quantity > 0 ? "Còn sách" : "Hết sách" }}
                        </div>
                    </div>
                    <div class="book__info__categories">
                        <h3>Thể loại:</h3>
                        <p
                            v-for="category in book.categories"
                            :key="category"
                        >
                            {{ category.name }},
                        </p>
                    </div>
                    <p
                        class="book__info__description"
                        v-html="book.mini_description"
                    />
                </div>
                <div class="book__group-action">
                    <div class="book__group-action__quantity">
                        <span
                            class="book__group-action__quantity__decrement"
                            @click="handleDecrementQuantity"
                        >-</span>
                        <span class="book__group-action__quantity__number">{{
                            quantityBookAddToCart
                        }}</span>
                        <span
                            class="book__group-action__quantity__increment"
                            @click="handleIncrementQuantity"
                        >+</span>
                    </div>
                    <button
                        class="book__group-action__add-cart"
                        @click="handleAddBookToCart(book.id)"
                    >
                        Thêm vào giỏ hàng
                    </button>
                    <button
                        class="book__group-action__wishlist"
                        :class="{'active disabled': wishListStore.wishList.includes(book.id)}"
                        @click="!wishListStore.wishList.includes(book.id) && handleAddBookToWishlist(book.id)"
                    >
                        <IconHeart />
                    </button>
                </div>
                <div class="book_group-policy">
                    <div class="book_group-policy__delivery">
                        <IconDeliveryDetail />
                        <div class="book_group-policy__delivery__content">
                            <h3>Giao hàng miễn phí</h3>
                            <span>Giao hàng trong vòng 24h</span>
                        </div>
                    </div>
                    <div class="book_group-policy__return">
                        <IconReturn />
                        <div class="book_group-policy__return__content">
                            <h3>Đổi trả trong 7 ngày</h3>
                            <span>Đổi trả trong vòng 7 ngày</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="book__description">
            <h2>Mô tả sách</h2>
            <div
                class="details_description"
                v-html="book.details_description"
            />
        </div>
        <div class="details-info_book">
            <h2>Thông tin chi tiêt sách</h2>
            <div class="details-info_book__content">
                <div class="details-info_book__content__item">
                    <p>Nhà xuất bản</p>
                    <p>{{ book.publisher?.name }}</p>
                </div>
                <div class="details-info_book__content__item">
                    <p>Năm xuất bản</p>
                    <p>{{ getYear(book.publication_date) }}</p>
                </div>
                <div class="details-info_book__content__item">
                    <p>Tác giả</p>
                    <p>{{ book.author?.name }}</p>
                </div>
                <div class="details-info_book__content__item">
                    <p>Kích thước</p>
                    <p>{{ book.size }}</p>
                </div>
                <div class="details-info_book__content__item">
                    <p>Số trang</p>
                    <p>{{ book.page }}</p>
                </div>
                <div class="details-info_book__content__item">
                    <p class="last-item">
                        Loại bìa
                    </p>
                    <p class="last-item">
                        {{ coverType[book.cover_type] }}
                    </p>
                </div>
            </div>
        </div>
        <div class="book__feedback">
            <h2>Khách hàng nhận xét</h2>
            <div class="book__review__form">
                <h3>Đánh giá sách</h3>
                <div class="book__rating">
                    <label>Đánh giá : {{ selectedStar }} sao</label>
                    <div class="book__info__rating">
                        <div
                            v-for="i in 5"
                            :key="i"
                            :class="[
                                'book__info__rating__item',
                                { active: i <= selectedStar },
                            ]"
                            @click="selectStar(i)"
                        >
                            <IconStar />
                        </div>
                        <p
                            v-if="errorFeedback.star"
                            class="warning"
                        >
                            {{ errorFeedback.star }}
                        </p>
                    </div>
                </div>

                <div class="book__feedback__content">
                    <label for="feedbackContent">Nội dung đánh giá:</label>
                    <textarea
                        id="feedbackContent"
                        v-model="feedbackContent"
                        placeholder="Nhập nội dung đánh giá..."
                        required
                        @input="errorFeedback.content = ''"
                    />
                    <p
                        v-if="errorFeedback.content"
                        class="warning"
                    >
                        {{ errorFeedback.content }}
                    </p>
                </div>

                <button
                    class="submit__button"
                    :disabled="!isLoggedIn || !feedbackContent.trim()"
                    @click="submitFeedback"
                >
                    Gửi đánh giá
                </button>
                <p
                    v-if="!isLoggedIn"
                    class="warning"
                >
                    Bạn cần đăng nhập để đánh giá.
                </p>
            </div>
            <div class="book__feedback__list">
                <div
                    v-for="feedback in feedbacks"
                    :key="feedback.id"
                    class="book__feedback__list__item"
                >
                    <div class="book__feedback__list__item__user">
                        <img
                            class="book__feedback__list__item__user__avatar"
                            :src="
                                feedback.avatar ||
                                    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTgsaRe2zqH_BBicvUorUseeTaE4kxPL2FmOQ&s'
                            "
                            alt=""
                        >
                        <h2 class="book__feedback__list__item__user__name">
                            {{ feedback.name }}
                        </h2>
                    </div>
                    <div class="book__feedback__list__item__content">
                        <div class="book__info__rating">
                            <div
                                v-for="i in 5"
                                :key="i"
                                :class="[
                                    'book__info__rating__item',
                                    { active: i <= feedback.pivot.star },
                                ]"
                            >
                                <IconStar />
                            </div>
                        </div>
                        <p class="book__feedback__list__item__content__text">
                            {{ feedback.pivot.content }}
                        </p>
                        <p class="book__feedback__list__item__date">
                            {{ formatDate(feedback.pivot.created_at) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <section class="top-book section-container">
            <div class="top-book__most-borrowed__today">
                <span>Sách cùng thể loại</span>
            </div>
            <div class="top-book__most-borrowed__list">
                <BookCardComponent
                    v-for="book in listBookSameCategory"
                    :key="book.id"
                    :book="book"
                    @quick-view="handleQuickView"
                    @add-book-to-cart="handleAddBookToCart"
                    @add-book-to-wishlist="handleAddBookToWishlist"
                />
            </div>
        </section>
    </div>
</template>

<script setup>
import BookCardComponent from '@/components/Book/BookCardComponent.vue';
import BreadcrumbComponent from '@/components/Breadcrumb/BreadcrumbComponent.vue';
import IconStar from '@/components/icons/IconStar.vue';
import IconDeliveryDetail from '@/components/icons/IconDeliveryDetail.vue';
import IconReturn from '@/components/icons/IconReturn.vue';
import axiosInstance from '@/config/axios';
import HTTP_STATUS_CODE from '@/config/statusCode';
import { onMounted, ref, watch } from 'vue';
import { useRoute } from 'vue-router';
import IconHeart from '@/components/icons/IconHeart.vue';
import { ElNotification } from 'element-plus';
import { useAuthStore } from '@/stores/auth';
import { useRouter } from 'vue-router';
import { useWishListStore } from '@/stores/wishList';
import { useCounterCartAndWishList } from '@/stores/counterCartAndWishList';

const authStore = useAuthStore();
const wishListStore = useWishListStore();
const counterCartAndWishList = useCounterCartAndWishList();
const router = useRouter();
const route = useRoute();
const slug = route.params.slug;
const book = ref({});
const feedbacks = ref([]);
const mainImage = ref('');
const quantityBookAddToCart = ref(1);
const listBookSameCategory = ref([]);
const breadcrumbs = ref([
    {
        name: 'Home',
        path: '/'
    },
    {
        name: 'Sách',
        path: '/list-book'
    },
    {
        name: '',
        path: `/book/${slug}`
    }
]);
const selectedStar = ref(0);
const feedbackContent = ref('');
const errorFeedback = ref({
    content: '',
    star: ''
});
const isLoggedIn = ref(false);
const coverType = {
    1: 'Bìa mềm',
    2: 'Bìa cứng'
};

const urlImage = (url) => {
    return import.meta.env.VITE_URL_IMAGE + url;
};

onMounted(async () => {
    await getBook(slug);
    await getFeedbacks();
    isLoggedIn.value = authStore.checkTokenValidity();
    await getListBookSameCategory();
    await getWishList();
    await getCart();
});

const getWishList = async () => {
    try {
        const response = await axiosInstance.get('/wish-list');
        if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
            counterCartAndWishList.setWishList(response.data.length);
        }
    } catch (error) {}
};

const getCart = async () => {
    try {
        const response = await axiosInstance.get('/cart');
        if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
            counterCartAndWishList.setCart(response.data.length);
        }
    } catch (error) {}
};

const getYear = (date) => {
    return new Date(date).getFullYear();
};

const formatDate = (date) => {
    return new Date(date).toLocaleDateString('vi-VN', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: 'numeric',
        minute: 'numeric'
    });
};

const getBook = async (slug) => {
    try {
        const response = await axiosInstance.get(`book/${slug}`);
        if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
            book.value = response.data;
            breadcrumbs.value[2].name = book.value.name;
            mainImage.value = urlImage(book.value.image);
        }
    } catch (error) {}
};

const getFeedbacks = async () => {
    try {
        const response = await axiosInstance.get('feedbacks', {

            params: {
                book_id: book.value?.id,
                column: 'created_at',
                order: 'desc'
            }
        });
        if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
            feedbacks.value = response.data.data;
        }
    } catch (error) {}
};

const getListBookSameCategory = async () => {
    try {
        const response = await axiosInstance.get('book', {
            params: {
                limit: 4,
                category_id: book.value?.categories[0]?.id
            }
        });
        if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
            listBookSameCategory.value = response.data.data;
        }
    } catch (error) {}
};

const handleClickImage = (url) => {
    mainImage.value = urlImage(url);
};

const handleDecrementQuantity = () => {
    if (quantityBookAddToCart.value > 0) {
        quantityBookAddToCart.value--;
    }
};

const handleIncrementQuantity = () => {
    if (quantityBookAddToCart.value < book.value.quantity) {
        quantityBookAddToCart.value++;
    }

    if (quantityBookAddToCart.value > book.value.quantity) {
        ElNotification({
            title: 'Thông báo',
            message: 'Số lượng sách không đủ',
            type: 'warning'
        });
    }
};

const handleAddBookToCart = async (id) => {
    if (authStore.checkTokenValidity()) {
        try {
            const response = await axiosInstance.post('/cart', {
                cart: [
                    {
                        book_id: id,
                        quantity: quantityBookAddToCart.value
                    }
                ]
            });
            if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
                ElNotification.success('Thêm vào giỏ hàng thành công');
                quantityBookAddToCart.value = 1;
                await getCart();
            }

        } catch (error) {
            ElNotification.error('Thêm vào giỏ hàng thất bại');
        }
    } else {
        router.push({ name: 'auth-login' });
    }
};

const handleAddBookToWishlist = async (id) => {
    if (authStore.checkTokenValidity()) {
        try {
            const response = await axiosInstance.post('/wish-list', {
                book_id: id
            });
            if (response.status === HTTP_STATUS_CODE.HTTP_CREATED) {
                ElNotification.success(
                    'Thêm vào danh sách yêu thích thành công'
                );
                wishListStore.addToWishList(id);
                await getWishList();
            }
        } catch (error) {
            ElNotification.error('Thêm vào danh sách yêu thích thất bại');
        }
    } else {
        router.push({ name: 'auth-login' });
    }
};

/**
 * The method handle show details book
 *
 * @param {number} id - The id
 *
 * @returns {Promise<void>}
 */
const handleQuickView = async (id) => {
    router.push({
        name: 'book.detail',
        params: {

            slug: id
        }
    });
    await getBook(id);
};



const selectStar = (star) => {
    selectedStar.value = star;
    errorFeedback.value.star = '';
};

const submitFeedback = async () => {
    if (!authStore.checkTokenValidity()) {
        router.push({ name: 'auth-login' });
        return;
    } else {
        if (feedbackContent.value.trim() === '') {
            errorFeedback.value.content =
                'Nội dung đánh giá không được để trống';
            return;
        }
        if (feedbackContent.value.length > 254) {
            errorFeedback.value.content =
                'Nội dung đánh giá không được quá 255 ký tự';
            return;
        }

        if (selectedStar.value === 0) {
            errorFeedback.value.star = 'Chọn số sao đánh giá';
            return;
        }

        if (!errorFeedback.value.star && !errorFeedback.value.content) {
            try {
                const response = await axiosInstance.post('/feedback', {
                    book_id: book.value?.id,
                    content: feedbackContent.value,
                    star: selectedStar.value
                });
                if (response.status === HTTP_STATUS_CODE.HTTP_CREATED) {
                    feedbackContent.value = '';
                    selectedStar.value = 0;
                    ElNotification.success(
                        'Đánh giá sách thành công, và đang chờ duyệt!'
                    );
                }
            } catch (error) {
                ElNotification.error('Đánh giá sách thất bại');
            }
        }
    }
};
</script>

<style lang="scss" scoped>
@import "@/assets/scss/_variables.scss";
.details-container {
    @media (min-width: 1024px) {
        max-width: 1170px;
        margin: 0 auto;
    }
    @media (max-width: 768px) {
        padding: 0 15px;
    }
    .breadcrumb-container {
        padding: 50px 0;
    }
    .details-content {
        display: flex;
        gap: 30px;
        @media (min-width: 992px) {
            margin-bottom: 30px;
        }
        @media (max-width: 768px) {
            flex-direction: column;
        }
        &-left {
            width: 60%;
            display: flex;
            gap: 30px;
            @media (max-width: 768px) {
                width: 100%;
                flex-direction: column-reverse;
            }
            .detail-image-carousel {
                display: flex;
                gap: 16px;
                width: 25%;
                @media (min-width: 992px) {
                    flex-direction: column;
                }
                @media (max-width: 768px) {
                    width: 100%;
                    display: grid;
                    grid-template-columns: repeat(4, 1fr);
                }
                .image-carousel__item {
                    width: 100%;
                    height: 138px;
                    object-fit: cover;
                    border-radius: 4px;
                }
            }
            .detail-main-image {
                width: 75%;
                @media (max-width: 768px) {
                    width: 100%;
                }
                .main-image {
                    width: 100%;
                    height: 600px;
                    object-fit: cover;
                    border-radius: 4px;
                    @media (max-width: 768px) {
                        height: 300px;
                    }
                }
            }
        }
        &-right {
            width: 40%;
            @media (max-width: 768px) {
                width: 100%;
            }
            h2 {
                font-size: 24px;
                font-weight: 600;
                color: $text-color-black;
                line-height: 32px;
            }
            .book__info {
                display: flex;
                flex-direction: column;
                margin-top: 20px;
                padding-bottom: 24px;
                border-bottom: 1px solid $text-color-black;
                margin-top: 16px;
                .book__info__rating {
                    display: flex;
                    align-items: center;
                    gap: 5px;
                    &__item {
                        svg {
                            width: 16px;
                            height: 16px;
                            fill: $background-color-btn-carousel;
                        }
                        &.active {
                            svg {
                                width: 16px;
                                height: 16px;
                                fill: $background-color-icon-action-hover-fill;
                            }
                        }
                    }
                }
                span {
                    font-size: 14px;
                    font-weight: 400;
                    color: $text-color-black;
                    opacity: 0.5;
                    margin-right: 16px;
                }

                &__categories {
                    display: flex;
                    gap: 10px;
                    margin-top: 16px;
                }
                &__description {
                    margin-top: 24px;
                    font-size: 14px;
                    font-weight: 400;
                    text-align: justify;
                    line-height: 24px;

                }
            }

            .info-book-in-card {
                padding-left: 16px;
                border-left: 1px solid $primary-color;
                font-size: 14px;
                color: green;
                &.out-of-stock {

                    color: $color-red;
                }
            }

            .book__group-action {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-top: 24px;
                height: 44px;
                button,
                span {
                    height: 100%;
                }
                &__quantity {
                    display: flex;
                    align-items: center;
                    height: 100%;
                    &__decrement,
                    &__increment {
                        cursor: pointer;
                        width: 40px;
                        height: 100%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        border: 1px solid $text-color-black;
                        transition: all 0.3s ease;
                        font-size: 25px;
                    }
                    &__decrement {
                        border-top-left-radius: 4px;
                        border-bottom-left-radius: 4px;
                        border-right: none;
                        &:hover {
                            background-color: $primary-color;
                            color: $text-color-white;
                        }
                    }
                    &__increment {
                        border-left: none;
                        border-top-right-radius: 4px;
                        border-bottom-right-radius: 4px;
                        &:hover {
                            background-color: $primary-color;
                            color: $text-color-white;
                        }
                    }
                    &__number {
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        width: 80px;
                        text-align: center;
                        border: 1px solid $text-color-black;
                        font-size: clamp(14px, 1.2vw, 16px);
                        font-weight: 600;
                        color: $text-color-black;
                    }
                }
                &__add-cart {
                    background-color: $primary-color;
                    color: $text-color-white;
                    border: none;
                    border-radius: 4px;
                    padding: 0 20px;
                    cursor: pointer;
                    transition: all 0.3s ease;
                    &:hover {
                        background-color: $color-red;
                    }
                }
                &__wishlist {
                    border: 1px solid $border-color;
                    border-radius: 4px;
                    width: 40px;
                    height: 40px!important;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    background-color: transparent;
                    cursor: pointer;
                    transition: all 0.3s ease;
                    &.active {
                    background-color: $background-color-icon-action-hover-fill;
                    }
                    &.disabled {
                        cursor: not-allowed;
                    }
                    svg {
                        width: 20px;
                        height: 20px;
                    }
                    &:hover {
                        background-color: $background-color-icon-action-hover-fill;
                    }
                }
            }
            .book_group-policy {
                display: flex;
                flex-direction: column;
                margin-top: 30px;
                width: 100%;
                border: 1px solid $border-color;
                border-radius: 4px;
                &__delivery,
                &__return {
                    display: flex;
                    align-items: center;
                    gap: 10px;
                    padding: 20px 5px;
                    border-bottom: 1px solid $border-color;
                    &:last-child {
                        border-bottom: none;
                    }
                    h3 {
                        font-size: 16px;
                        font-weight: 500;
                        color: $text-color-black;
                    }
                    span {
                        font-size: 12px;
                        font-weight: 400;
                        color: $text-color-black;
                        opacity: 0.8;
                    }

                    &__content {
                        display: flex;
                        flex-direction: column;
                        gap: 10px;
                    }
                }
            }
        }
    }
    .book__description,
    .details-info_book,
    .book__feedback {
        margin: 30px 0;
        width: 100%;
        box-sizing: border-box;
        overflow: hidden;
        h2 {
            font-size: 24px;
            font-weight: 600;
            color: $text-color-black;
            line-height: 32px;
            border-bottom: 1px solid $border-color;
            padding: 10px 0;
        }

        .details_description {
            padding: 20px 0;
        }
    }


    .details-info_book {
        .details-info_book__content {
            display: flex;
            flex-direction: column;
            margin-top: 20px;
            .details-info_book__content__item {
                display: flex;
                :first-child {
                    width: 150px;
                }
                :last-child {
                    flex: 1;
                    border-left: none;
                }
                p {
                    font-size: clamp(14px, 1.2vw, 16px);
                    font-weight: 400;
                    color: $text-color-black;
                    border: 1px solid $border-color;
                    padding: 10px;
                    border-bottom: none;
                    opacity: 0.8;
                }
                .last-item {
                    border-bottom: 1px solid $border-color;
                }
            }
        }
    }
    .book__feedback {
        .book__review__form {
            margin: 20px auto;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            display: flex;
            flex-direction: column;
            gap: 10px;
            h3 {
                text-align: center;
                margin-bottom: 20px;
            }

            .book__rating {
                label {
                    font-weight: bold;
                    margin-bottom: 10px;
                    display: inline-block;
                }

                .book__info__rating {
                    display: flex;
                    gap: 5px;
                    margin-bottom: 10px;

                    .book__info__rating__item {
                        cursor: pointer;
                        font-size: 24px;
                        color: #ccc;
                        transition: color 0.2s;

                        &.active {
                            svg {
                                fill: gold;
                            }
                        }
                        svg {
                            fill: #0000003e;
                        }
                    }
                }
            }

            .book__feedback__content {
                margin-bottom: 15px;
                label {
                    display: block;
                    margin-bottom: 5px;
                }

                textarea {
                    width: 100%;
                    height: 100px;
                    padding: 10px;
                    border-radius: 5px;
                    border: 1px solid #ccc;
                    resize: none;
                    font-size: 14px;
                    outline: none;
                    max-width: 98%;
                    font-family: 'Poppins', sans-serif;
                    &:focus {
                        border-color: #007bff;
                    }
                }
                .warning {
                    color: red;
                    font-size: 14px;
                    text-align: left;
                }
            }

            .submit__button {
                width: 100%;
                padding: 10px 20px;
                font-size: 16px;
                background-color: #007bff;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s;

                &:hover {
                    background-color: #0056b3;
                }

                &:disabled {
                    background-color: #ccc;
                    cursor: not-allowed;
                }
            }

            .warning {
                color: red;
                font-size: 14px;
                text-align: center;
            }
        }
        .book__feedback__list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            .book__feedback__list__item {
                display: flex;
                flex-direction: column;
                padding: 1rem;
                border: 1px solid #ddd;
                border-radius: 8px;
                background-color: #f9f9f9;
                transition: background-color 0.3s ease;

                &:hover {
                    background-color: #f1f1f1;
                }

                .book__feedback__list__item__user {
                    display: flex;
                    align-items: center;
                    gap: 1rem;
                    margin-bottom: 1rem;

                    .book__feedback__list__item__user__avatar {
                        width: 50px;
                        height: 50px;
                        border-radius: 50%;
                        object-fit: cover;
                    }

                    .book__feedback__list__item__user__name {
                        font-size: 1.2rem;
                        font-weight: bold;
                        color: #333;
                    }
                }

                .book__feedback__list__item__content {
                    .book__info__rating {
                        display: flex;
                        gap: 0.2rem;
                        margin-bottom: 1rem;

                        .book__info__rating__item {
                            font-size: 1.2rem;
                            color: #ccc;

                            &.active {
                                svg {
                                    fill: #ffcc00;
                                }
                            }
                            svg {
                                fill: #0000003e;
                            }
                        }
                    }

                    p {
                        font-size: 1rem;
                        color: #555;
                        line-height: 1.5;
                        margin: 0;
                    }
                }
                .book__feedback__list__item__content__text {
                    white-space: pre-wrap;
                }
                .book__feedback__list__item__date {
                    font-size: 12px !important;
                    color: #888 !important;
                    margin-top: 6px !important;
                    text-align: right;
                }
            }
        }
    }
    .top-book,
    .list-category {
        border-bottom: 1px solid $border-color;
        padding-bottom: 60px;
    }
    .top-book__most-borrowed,
    .section-container {
        margin-top: 30px;
        width: 100%;
        @media (min-width: 1024px) {
            margin-top: 140px;
        }
        &__today {
            position: relative;
            display: flex;

            align-items: center;
            &::before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                width: 20px;
                height: 40px;
                background-color: $primary-color;
                border-radius: 5px;
            }
            span {
                font-size: 16px;
                font-weight: 600;
                color: $primary-color;
                margin-left: 30px;
                margin-top: 12px;
            }
        }
        &__title {
            font-size: clamp(36px, 2.5vw, 24px);
            font-weight: 700;
            color: $text-color-black;
            margin-top: 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        &__list {
            margin-top: 30px;
            @media (min-width: 1024px) {
                margin-top: 60px;
            }
            display: grid;
            justify-content: center;
            gap: 30px;
            overflow: hidden;
            box-sizing: border-box;
            grid-template-columns: repeat(4, 1fr);
            @media (max-width: 1024px) {
                grid-template-columns: repeat(3, 1fr);
            }
            @media (max-width: 768px) {
                grid-template-columns: repeat(2, 1fr);
            }
            @media (min-width: 1024px) {
                margin-bottom: 140px;
            }
        }
    }
}

</style>
