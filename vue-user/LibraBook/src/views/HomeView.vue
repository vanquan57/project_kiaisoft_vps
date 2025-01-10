<template>
    <div class="home-container">
        <section class="sidebar-carousel">
            <div class="category">
                <ul class="category-list">
                    <li
                        v-for="(category, index) in categories"
                        :key="index"
                        class="category-list_item"
                    >
                        <router-link :to="`/list-book?category=${category.id}`">
                            {{ category.name }}
                        </router-link>
                    </li>
                </ul>
            </div>
            <CarouselItem class="carousel" />
        </section>
        <section class="top-book section-container">
            <div class="top-book__most-borrowed">
                <div class="top-book__most-borrowed__today">
                    <span>Top Sách</span>
                </div>
                <div class="top-book__most-borrowed__title">
                    <h2>Top sách mượn nhiều</h2>
                    <div class="carousel-controls">
                        <button
                            class="carousel-controls__prev"
                            @click="handlePrev"
                        >
                            <IconArrowLeft />
                        </button>
                        <button
                            class="carousel-controls__next"
                            @click="handleNext"
                        >
                            <IconArrowRight />
                        </button>
                    </div>
                </div>
                <div class="top-book__most-borrowed__list">
                    <BookCardComponent
                        v-for="book in topBooksMostBorrowed"
                        :key="book.id"
                        :book="book"
                        @quick-view="handleQuickView"
                        @add-book-to-cart="handleAddBookToCart"
                        @add-book-to-wishlist="handleAddBookToWishlist"
                    />
                </div>
            </div>
            <div class="btn-container">
                <button
                    class="top-book__most-borrowed__btn-view-all"
                    @click="
                        handleRedirectToListBook({
                            isMostBorrowed: true,
                        })
                    "
                >
                    Xem thêm
                </button>
            </div>
        </section>
        <section class="list-category section-container">
            <div class="top-book__most-borrowed__today">
                <span>Thể loại</span>
            </div>
            <div class="top-book__most-borrowed__title">
                <h2>Thể loại</h2>
                <div class="carousel-controls">
                    <button
                        class="carousel-controls__prev"
                        @click="handlePrevCategory"
                    >
                        <IconArrowLeft />
                    </button>
                    <button
                        class="carousel-controls__next"
                        @click="handleNextCategory"
                    >
                        <IconArrowRight />
                    </button>
                </div>
            </div>
            <div class="list-category__list">
                <CategoryCardComponent
                    v-for="category in listCategoryAndIcon"
                    :key="category.id"
                    :category="category"
                />
            </div>
        </section>
        <section class="section-container top-book__most-viewed">
            <div class="top-book__most-borrowed__today">
                <span>Sách được xem nhiều</span>
            </div>
            <div class="top-book__most-borrowed__title">
                <h2>Top sách được xem nhiều</h2>
                <div>
                    <button
                        class="btn-view-all"
                        @click="
                            handleRedirectToListBook({
                                isMostViewed: true,
                            })
                        "
                    >
                        Xem thêm
                    </button>
                </div>
            </div>
            <div class="top-book__most-borrowed__list">
                <BookCardComponent
                    v-for="book in topBooksMostViewed"
                    :key="book.id"
                    :book="book"
                    @quick-view="handleQuickView"
                    @add-book-to-cart="handleAddBookToCart"
                    @add-book-to-wishlist="handleAddBookToWishlist"
                />
            </div>
            <div class="btn-container">
                <button
                    class="top-book__most-borrowed__btn-view-all"
                    @click="
                        handleRedirectToListBook({
                            isMostViewed: true,
                        })
                    "
                >
                    Xem thêm
                </button>
            </div>
        </section>
        <section class="banner section-container">
            <img
                class="banner__img"
                :src="images.banner"
                alt="banner"
            >
        </section>
        <section class="section-container top-book__most-new-released">
            <div class="top-book__most-borrowed__today">
                <span>Sách mới</span>
            </div>
            <div class="top-book__most-borrowed__title">
                <h2>Sách mới</h2>
                <div>
                    <button
                        class="btn-view-all"
                        @click="
                            handleRedirectToListBook({
                                isMostNewReleased: true,
                            })
                        "
                    >
                        Xem thêm
                    </button>
                </div>
            </div>
            <div class="top-book__most-borrowed__list">
                <BookCardComponent
                    v-for="book in listNewBooks"
                    :key="book.id"
                    :book="book"
                    @quick-view="handleQuickView"
                    @add-book-to-cart="handleAddBookToCart"
                    @add-book-to-wishlist="handleAddBookToWishlist"
                />
            </div>
            <div class="btn-container">
                <button
                    class="top-book__most-borrowed__btn-view-all"
                    @click="
                        handleRedirectToListBook({
                            isMostNewReleased: true,
                        })
                    "
                >
                    Xem thêm
                </button>
            </div>
        </section>
        <section class="book_viral section-container">
            <div class="top-book__most-borrowed__today">
                <span>Sách viral</span>
            </div>
            <div class="top-book__most-borrowed__title">
                <h2>Sách viral</h2>
            </div>
            <div class="book_viral__container">
                <div class="book_viral__left">
                    <img
                        :src="images.viralLeft"
                        alt="book viral left"
                    >
                </div>
                <div class="book_viral__right">
                    <div class="book_viral__right__top">
                        <img
                            :src="images.viralRightTop"
                            alt="book viral right top"
                        >
                    </div>
                    <div class="book_viral__right__bottom">
                        <div class="book_viral__right__bottom__left">
                            <img
                                :src="images.viralBottomLeft"
                                alt="book viral right bottom left"
                            >
                        </div>
                        <div class="book_viral__right__bottom__right">
                            <img
                                :src="images.viralBottomRight"
                                alt="book viral right bottom right"
                            >
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-container">
            <div class="about-service">
                <div class="card-group-service">
                    <StatsOverviewComponent
                        v-for="fullService in fullServices"
                        :key="fullService.value"
                        :value="fullService.value"
                        :content="fullService.content"
                        :icon="fullService.icon"
                        :full-service="true"
                        :has-border="false"
                    />
                </div>
            </div>
        </section>
        <button
            v-show="showScrollTop"
            class="scroll-top"
            @click="scrollToTop"
        >
            <IconArrowUp />
        </button>
    </div>
</template>

<script setup>
import images from '@/assets/images';
import CarouselItem from '@/components/carousel/CarouselComponent.vue';
import axiosInstance from '@/config/axios';
import HTTP_STATUS_CODE from '@/config/statusCode';
import { onMounted, ref, watch, onUnmounted } from 'vue';
import IconArrowLeft from '@/components/icons/IconArrowLeft.vue';
import IconArrowRight from '@/components/icons/IconArrowRight.vue';
import BookCardComponent from '@/components/book/BookCardComponent.vue';
import DEFAULT_CONSTANTS from '@/config/constants';
import CategoryCardComponent from '@/components/book/category/CategoryCardComponent.vue';
import IconCustomerService from '@/components/icons/IconCustomerService.vue';
import IconDelivery from '@/components/icons/IconDelivery.vue';
import IconSecure from '@/components/icons/IconSecure.vue';
import StatsOverviewComponent from '@/components/StatsOverviewComponent.vue';
import { markRaw } from 'vue';
import { useRouter} from 'vue-router';
import IconArrowUp from '@/components/icons/IconArrowUp.vue';
import { ElNotification } from 'element-plus';
import { useAuthStore } from '@/stores/auth';
import { useWishListStore } from '@/stores/wishList';
import { useCounterCartAndWishList } from '@/stores/counterCartAndWishList';

const router = useRouter();
const categories = ref([]);
const listCategories = ref([]);
const topBooksMostBorrowed = ref([]);
const topBooksMostViewed = ref([]);
const listNewBooks = ref([]);
const listCategoryAndIcon = ref([]);
const currentIndex = ref(1);
const currentIndexCategory = ref(1);
const showScrollTop = ref(false);
const authStore = useAuthStore();
const wishListStore = useWishListStore();
const counterCartAndWishList = useCounterCartAndWishList();

const listImageCategory = [
    images.categoryCamera,
    images.categoryCellPhone,
    images.categoryComputer,
    images.categoryGamepad,
    images.categoryHeadphone,
    images.categorySmartWatch
];

const fullServices = ref([
    {
        icon: markRaw(IconDelivery),
        value: 'SÁCH',
        content: 'Sách đa dạng'
    },
    {
        icon: markRaw(IconCustomerService),
        value: 'GIỜ LÀM VIỆC',
        content: 'Từ thứ 2 đến thứ 7, 9 AM - 6 PM'
    },
    {
        icon: markRaw(IconSecure),
        value: 'THAM GIA',
        content: 'Khuyến mãi độc quyền và sự kiện'
    }
]);

const getCategories = async () => {
    try {
        const response = await axiosInstance.get('/categories', {
            params: {
                limit: 10000
            }
        });
        if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
            categories.value = response.data.data;
        }
    } catch (error) {}
};

const getListCategoryByPage = async (page = 1) => {
    try {
        const response = await axiosInstance.get('/categories', {
            params: {
                limit: DEFAULT_CONSTANTS.LIMIT_CATEGORY,
                page: page
            }
        });
        if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
            listCategories.value = response.data.data;
            listCategoryAndIcon.value = [];
            listCategories.value.forEach((category, index) => {
                listCategoryAndIcon.value.push({
                    name: category.name,
                    icon: listImageCategory[
                        Math.floor(Math.random() * listImageCategory.length)
                    ],
                    slug: category.slug,
                    id: category.id
                });
            });
        }
    } catch (error) {}
};

const getTopBooksMostBorrowed = async (page = 1) => {
    try {
        const response = await axiosInstance.get('/book', {
            params: {
                limit: DEFAULT_CONSTANTS.LIMIT_BOOK,
                most_borrowed: DEFAULT_CONSTANTS.TRUE,
                page: page,
                order: DEFAULT_CONSTANTS.DEFAULT_ORDER
            }
        });

        if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
            topBooksMostBorrowed.value = response.data.data;
        }
    } catch (error) {}
};

const getTopBooksMostViewed = async (page = 1) => {
    try {
        const response = await axiosInstance.get('/book', {
            params: {
                limit: DEFAULT_CONSTANTS.LIMIT_BOOK,
                most_viewed: DEFAULT_CONSTANTS.TRUE,
                page: page,
                order: DEFAULT_CONSTANTS.DEFAULT_ORDER
            }
        });
        if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
            topBooksMostViewed.value = response.data.data;
        }
    } catch (error) {}
};

const getListNewBooks = async () => {
    try {
        const response = await axiosInstance.get('/book', {
            params: {
                limit: DEFAULT_CONSTANTS.LIMIT_NEW_BOOK,
                latest: DEFAULT_CONSTANTS.TRUE,
                order: DEFAULT_CONSTANTS.DEFAULT_ORDER
            }
        });
        if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
            listNewBooks.value = response.data.data;
        }
    } catch (error) {}
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
                await getCart();
                ElNotification.success('Thêm vào giỏ hàng thành công');
            }

        } catch (error) {
            ElNotification.error('Thêm vào giỏ hàng thất bại, Hết sách !');
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
                wishListStore.addToWishList(id);
                await getWishList();
                ElNotification.success('Thêm vào danh sách yêu thích thành công');
            }


        } catch (error) {
            ElNotification.error('Sách đã tồn tại trong danh sách yêu thích');
        }
    } else {
        router.push({ name: 'auth-login' });
    }
};

const getWishList = async () => {
    try {
        const response = await axiosInstance.get('/wish-list');
        if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
            const booksInWishList = response.data;
            booksInWishList.forEach((book) => {
                wishListStore.addToWishList(book.id);
            });
            counterCartAndWishList.setWishList(booksInWishList.length);
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

onMounted(async () => {
    await getCategories();
    await getListCategoryByPage(currentIndexCategory.value);
    await getTopBooksMostBorrowed(currentIndex.value);
    await getTopBooksMostViewed(currentIndex.value);
    await getListNewBooks();
    await getWishList();
    await getCart();
    window.addEventListener('scroll', handleScroll);
});

const handlePrev = () => {
    if (currentIndex.value > 1) {
        currentIndex.value--;
    }
};

const handleNext = () => {
    if (currentIndex.value < 2) {
        currentIndex.value++;
    }
};

const handlePrevCategory = () => {
    if (currentIndexCategory.value > 1) {
        currentIndexCategory.value--;
    }
};

const handleNextCategory = () => {
    if (currentIndexCategory.value < 2) {
        currentIndexCategory.value++;
    }
};

watch(
    currentIndexCategory,
    async () => {
        await getListCategoryByPage(currentIndexCategory.value);
    },
    { immediate: true }
);

watch(
    currentIndex,
    async () => {
        await getTopBooksMostBorrowed(currentIndex.value);
    },
    { immediate: true }
);

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

const handleQuickView = (id) => {
    router.push({
        name: 'book.detail',
        params: {
            slug: id
        }
    });
};

const scrollToTop = () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
};

const handleScroll = () => {
    showScrollTop.value = window.scrollY > 500;
};

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});
</script>

<style lang="scss" scoped>
@import "@/assets/scss/_variables.scss";
.home-container {
    display: flex;
    flex-direction: column;
    margin: 0 auto;
    width: 100%;
    .sidebar-carousel {
        width: 100%;
        display: grid;
        gap: 30px;
        .category {
            border-right: 1px solid $border-color;
            height: 100%;
            box-sizing: border-box;
            overflow: hidden;
            overflow-y: scroll;
            padding-top: 40px;
            &::-webkit-scrollbar {
                display: none;
            }
            .category-list {
                padding-left: 0px;
                list-style: none;
                max-height: 344px;

                &_item {
                    padding: 8px 0;
                    a {
                        font-size: 16px;
                        font-weight: 400;
                        line-height: 24px;
                        text-align: center;
                        text-decoration: none;
                        color: $text-color-black;
                        transition: all 0.3s ease;
                        &:hover {
                            cursor: pointer;
                            color: $primary-color;
                            padding-left: 10px;
                        }
                    }
                }
            }
        }
        .carousel {
            @media (min-width: 1024px) {
                padding-top: 45px;
                padding-left: 40px;
            }
        }

    }
    .btn-container {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .top-book,
    .list-category {
        border-bottom: 1px solid $border-color;
    }
    .top-book{
        @media (min-width: 1024px) {
            margin-top: 140px;
        }
        padding-bottom: 60px;
    }
    .list-category{
        @media (min-width: 1024px) {
            margin-top: 80px;
        }
        padding-bottom: 70px;
    }
    .top-book__most-viewed{
        @media (min-width: 1024px) {
            margin-top: 70px;
        }
    }
    .top-book__most-new-released{
        @media (min-width: 1024px) {
            margin-top: 70px;
        }
    }
    .top-book__most-borrowed,
    .section-container {
        width: 100%;
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
            font-size: 36px;
            font-weight: 700;
            color: $text-color-black;
            margin-top: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            .btn-view-all {
                height: 56px;
                width: 159px;
                font-size: 16px;
                font-family: "Poppins", sans-serif;
                font-weight: 500;
                background-color: $color-red;
                color: $text-color-white;
                border: none;
                padding: 10px 20px;
                border-radius: 5px;
            }
        }
        .carousel-controls {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            button {
                width: 46px;
                height: 46px;
                border-radius: 50%;
                cursor: pointer;
                border: none;
                svg {
                    width: 24px;
                    height: 24px;
                    stroke: $text-color-black;
                }
                &:hover {
                    background-color: $primary-color;
                    svg {
                        stroke: $text-color-white !important;
                    }
                }
            }
        }
        &__list {
            margin-top: 60px;
            display: grid;
            justify-content: center;
            gap: 30px;
            overflow: hidden;
            box-sizing: border-box;
            @media (min-width: 1024px) {
                row-gap: 60px;
            }
        }
        &__btn-view-all {
            height: 56px;
            width: 234px;
            margin: 0 auto;
            margin-top: 60px;
            font-size: 16px;
            font-family: "Poppins", sans-serif;
            font-weight: 500;
            background-color: $color-red;
            color: $text-color-white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
        }
        .list-category__list {
            display: grid;
            margin-top: 60px;
            gap: 30px;
        }
        .banner__img {
            width: 100%;
            max-height: 500px;
            object-fit: cover;
            margin-top: 140px;
        }
        .about-service {
            width: 100%;
            @media (min-width: 1024px) {
                margin-top: 140px;
            }
            .card-group-service {
                width: 100%;
                margin: 0 auto;
                display: grid;
                gap: 20px;
            }
        }
    }
    .book_viral {
        overflow: hidden;
        @media (min-width: 1024px) {
            margin-top: 140px;
        }
        &__container {
            display: flex;
            gap: 30px;
            margin-top: 60px;
            .book_viral__left {
                width: 50%;
                height: 100%;
                img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }
            }
            .book_viral__right {
                width: 50%;
                display: flex;
                flex-direction: column;
                gap: 30px;
                .book_viral__right__top {
                    width: 100%;
                    height: 50%;
                    img {
                        width: 100%;
                        height: 100%;
                        object-fit: cover;
                    }
                }
                .book_viral__right__bottom {
                    display: flex;
                    gap: 30px;
                    .book_viral__right__bottom__left {
                        width: 50%;
                        height: 100%;
                        img {
                            width: 100%;
                            height: 100%;
                            object-fit: cover;
                        }
                    }
                    .book_viral__right__bottom__right {
                        width: 50%;
                        height: 100%;
                        img {
                            width: 100%;
                            height: 100%;
                            object-fit: cover;
                        }
                    }
                }
            }
        }
    }
}
@media (max-width: 768px) {
    .home-container {
        padding: 0 10px;
    }
    .category {
        display: none;
    }
    .top-book__most-borrowed__list {
        grid-template-columns: repeat(2, 1fr);
    }
    .list-category__list {
        grid-template-columns: repeat(2, 1fr);
    }
    .book_viral {
        &__container {
            gap: 10px !important;
        }
        .book_viral__right {
            gap: 10px !important;
        }
        .book_viral__right__bottom {
            gap: 10px !important;
        }
    }
}

@media (min-width: 769px) {
    .sidebar-carousel {
        grid-template-columns: 3fr 7fr;
    }
}
@media (min-width: 800px) {
    .top-book__most-borrowed__list {
        grid-template-columns: repeat(3, 1fr);
    }
    .list-category__list {
        grid-template-columns: repeat(4, 1fr);
    }
}
@media (max-width: 800px) {
    .list-category__list {
        grid-template-columns: repeat(2, 1fr);
    }
}
@media (min-width: 801px) and (max-width: 1024px) {
    .top-book__most-borrowed__list {
        grid-template-columns: repeat(3, 1fr);
    }
    .about-service .card-group-service {
        grid-template-columns: repeat(2, 1fr);
    }

    .about-service .card-group-service > *:last-child {
        grid-column: span 2;
    }
}
@media (max-width: 1024px) {
    .home-container {
        padding: 0 10px;
    }
    .about-service{
        padding: 40px 0 60px 0;
    }
}
@media (min-width: 1024px) {
    .home-container {
        max-width: 1170px;
    }
    .banner {
        max-width: 1170px;
    }
    .book_viral {
        max-width: 1170px;
    }
    .list-category__list {
        grid-template-columns: repeat(6, 1fr);
    }
    .top-book__most-borrowed__list {
        grid-template-columns: repeat(4, 1fr);
    }
    .about-service {
        margin: 0 auto;
        padding: 30px 0 140px 0;
        max-width: 950px;
    }
    .card-group-service {
        grid-template-columns: repeat(3, minmax(270px, 1fr));
    }
}
.scroll-top {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        background-color: $background-color-btn-carousel;
        color: white;
        width: 3rem;
        height: 3rem;
        border-radius: 9999px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
        border: none;
        &:hover {
        transform: translateY(-2px);
    }
}
</style>
