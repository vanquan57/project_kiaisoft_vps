<template>
    <div class="book-listing">
        <button
            class="toggle-sidebar"
            @click="toggleSidebar"
        >
            <IconHamb />
        </button>
        <aside class="sidebar">
            <h2>Danh mục</h2>

            <div class="filter-section">
                <h3>Thể loại</h3>
                <div class="filter-list">
                    <label
                        v-for="category in categories"
                        :key="category.id"
                    >
                        <input
                            v-model="selectedCategory"
                            type="radio"
                            :value="category.id"
                        >
                        <span>{{ category.name }}</span>
                    </label>
                </div>
            </div>

            <!-- Authors -->
            <div class="filter-section">
                <h3>Tác giả</h3>
                <div class="filter-list">
                    <label
                        v-for="author in authors"
                        :key="author.id"
                    >
                        <input
                            v-model="selectedAuthors"
                            type="checkbox"
                            :value="author.id"
                        >
                        <span>{{ author.name }}</span>
                    </label>
                </div>
            </div>

            <!-- Publishers -->
            <div class="filter-section">
                <h3>Nhà xuất bản</h3>
                <div class="filter-list">
                    <label
                        v-for="publisher in publishers"
                        :key="publisher.id"
                    >
                        <input
                            v-model="selectedPublishers"
                            type="checkbox"
                            :value="publisher.id"
                        >
                        <span>{{ publisher.name }}</span>
                    </label>
                </div>
            </div>
        </aside>
        <aside
            class="sidebar-mobile"
            :class="{ active: isSidebarHidden }"
        >
            <div class="sidebar-mobile-header">
                <h2>Danh mục</h2>
                <button
                    class="toggle-sidebar-mobile"
                    @click="toggleSidebar"
                >
                    <IconHamb />
                </button>
            </div>

            <div class="filter-section">
                <h3>Thể loại</h3>
                <div class="filter-list">
                    <label
                        v-for="category in categories"
                        :key="category.id"
                    >
                        <input
                            v-model="selectedCategory"
                            type="radio"
                            :value="category.id"
                        >
                        <span>{{ category.name }}</span>
                    </label>
                </div>
            </div>

            <div class="filter-section">
                <h3>Tác giả</h3>
                <div class="filter-list">
                    <label
                        v-for="author in authors"
                        :key="author.id"
                    >
                        <input
                            v-model="selectedAuthors"
                            type="checkbox"
                            :value="author.id"
                        >
                        <span>{{ author.name }}</span>
                    </label>
                </div>
            </div>

            <div class="filter-section">
                <h3>Nhà xuất bản</h3>
                <div class="filter-list">
                    <label
                        v-for="publisher in publishers"
                        :key="publisher.id"
                    >
                        <input
                            v-model="selectedPublishers"
                            type="checkbox"
                            :value="publisher.id"
                        >
                        <span>{{ publisher.name }}</span>
                    </label>
                </div>
            </div>
        </aside>

        <main class="main-content">
            <div class="top-filters">
                <button
                    v-for="filter in filters"
                    :key="filter.id"
                    :class="[
                        'filter-btn',
                        { active: activeFilter === filter.id },
                    ]"
                    @click="setActiveFilter(filter.id)"
                >
                    {{ filter.name }}
                </button>
            </div>

            <div class="book-grid">
                <book-card
                    v-for="book in books"
                    :key="book.id"
                    :book="book"
                    @quick-view="handleQuickView"
                    @add-book-to-cart="handleAddBookToCart"
                    @add-book-to-wishlist="handleAddBookToWishlist"
                />
            </div>

            <div
                v-if="books.length > 0"
                class="book-management-pagination"
            >
                <PaginationComponent
                    :total="dataPagination.total"
                    :current-page="dataPagination.currentPage"
                    :page-size="dataPagination.limit"
                    @current-page="handlePageChange"
                />
            </div>
        </main>

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
import { ref, onMounted, onUnmounted, watch, watchEffect } from 'vue';
import BookCard from '@/components/book/BookCardComponent.vue';
import PaginationComponent from '@/components/pagination/PaginationComponent.vue';
import IconHamb from '@/components/icons/IconHamb.vue';
import axiosInstance from '@/config/axios';
import { useAuthStore } from '@/stores/auth';
import { ElNotification } from 'element-plus';
import HTTP_STATUS_CODE from '@/config/statusCode';
import IconArrowUp from '@/components/icons/IconArrowUp.vue';
import { useRouter, useRoute } from 'vue-router';
import DEFAULT_CONSTANTS from '@/config/constants';
import { useWishListStore } from '@/stores/wishList';
import { useCounterCartAndWishList } from '@/stores/counterCartAndWishList';

const router = useRouter();
const route = useRoute();
const selectedCategory = ref(null);
const selectedAuthors = ref([]);
const selectedPublishers = ref([]);
const activeFilter = ref('most-borrowed');
const showScrollTop = ref(false);
const isSidebarHidden = ref(false);
const categories = ref([]);
const authors = ref([]);
const publishers = ref([]);
const books = ref([]);
const authStore = useAuthStore();
const dataSearch = ref({});
const searchQuery = ref('');
const wishListStore = useWishListStore();
const counterCartAndWishList = useCounterCartAndWishList();

const filters = ref([
    { id: 'most-borrowed', name: 'Mượn nhiều nhất' },
    { id: 'most-viewed', name: 'Xem nhiều nhất' },
    { id: 'most_loved', name: 'Yêu thích nhiều nhất' }
]);
const dataPagination = ref({
    limit: 24,
    total: 0,
    currentPage: 1
});

const scrollToTop = () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
};

const toggleSidebar = () => {
    isSidebarHidden.value = !isSidebarHidden.value;
};

const handleScroll = () => {
    showScrollTop.value = window.scrollY > 500;
};


const setActiveFilter = async (filterId) => {
    if (filterId === 'most-borrowed') {
        activeFilter.value = 'most-borrowed';
        dataSearch.value.most_borrowed = DEFAULT_CONSTANTS.TRUE;
        delete dataSearch.value.most_viewed;
        delete dataSearch.value.most_loved;
        dataSearch.value.order = DEFAULT_CONSTANTS.DEFAULT_ORDER;
        await getBooks(1, dataSearch.value);
    }

    if (filterId === 'most-viewed') {
        activeFilter.value = 'most-viewed';
        delete dataSearch.value.most_borrowed;
        delete dataSearch.value.most_loved;
        dataSearch.value.most_viewed = DEFAULT_CONSTANTS.TRUE;
        dataSearch.value.order = DEFAULT_CONSTANTS.DEFAULT_ORDER;
        await getBooks(1, dataSearch.value);
    }

    if (filterId === 'most_loved') {
        activeFilter.value = 'most_loved';
        delete dataSearch.value.most_borrowed;
        delete dataSearch.value.most_viewed;
        dataSearch.value.most_loved = DEFAULT_CONSTANTS.TRUE;
        dataSearch.value.order = DEFAULT_CONSTANTS.DEFAULT_ORDER;
        await getBooks(1, dataSearch.value);
    }
};

onMounted(async () => {
    window.addEventListener('scroll', handleScroll);
    window.scrollTo(0, 0);
    await getCategories();
    await getAuthors();
    await getPublishers();
    await getWishList();
    await getCart();
    if (route.fullPath === '/list-book') {
        await getBooks();
    }

    if (route.query.search) {
        dataSearch.value.name = route.query.search;
        await getBooks(1, dataSearch.value);
    }

    if (route.query.category && Number.isInteger(Number(route.query.category))) {
        dataSearch.value.category_id = route.query.category;
        await getBooks(1, dataSearch.value);
    }

    if (route.query.isMostBorrowed) {
        activeFilter.value = 'most-borrowed';
        delete dataSearch.value.most_viewed;
        delete dataSearch.value.most_loved;
        dataSearch.value.most_borrowed = DEFAULT_CONSTANTS.TRUE;
        dataSearch.value.order = DEFAULT_CONSTANTS.DEFAULT_ORDER;
        await getBooks(1, dataSearch.value);
    }

    if (route.query.isMostViewed) {
        activeFilter.value = 'most-viewed';
        delete dataSearch.value.most_borrowed;
        delete dataSearch.value.most_loved;
        dataSearch.value.most_viewed = DEFAULT_CONSTANTS.TRUE;
        dataSearch.value.order = DEFAULT_CONSTANTS.DEFAULT_ORDER;
        await getBooks(1, dataSearch.value);
    }

    if (route.query.isMostNewReleased) {
        activeFilter.value = 'most-new-released';
        delete dataSearch.value.most_borrowed;
        delete dataSearch.value.most_viewed;
        delete dataSearch.value.most_loved;
        dataSearch.value.latest = DEFAULT_CONSTANTS.TRUE;
        dataSearch.value.order = DEFAULT_CONSTANTS.DEFAULT_ORDER;
        await getBooks(1, dataSearch.value);
    }
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});

watch(selectedCategory, async () => {
    if (selectedCategory.value) {
        delete dataSearch.value.category_id;
        dataSearch.value.category_id = selectedCategory.value;
        await getBooks(1, dataSearch.value);
        router.push({
            path: '/list-book',
            query: {
                ...route.query,
                category: categories.value.find(category => category.id === selectedCategory.value).slug
            }
        });
    }
});

watch(selectedAuthors, async () => {
    if (selectedAuthors.value.length) {
        dataSearch.value.author_id = selectedAuthors.value;
        await getBooks(1, dataSearch.value);
        const selectedAuthorSlugs = selectedAuthors.value
            .map(authorId => {
                const author = authors.value.find(a => a.id === authorId);
                return author ? author.slug : null;
            })
            .filter(slug => slug);

        router.push({
            path: '/list-book',
            query: {
                ...route.query,
                author: selectedAuthorSlugs.join(',')
            }
        });
    }

    if (selectedAuthors.value.length === 0) {
        delete dataSearch.value.author_id;
        await getBooks(1, dataSearch.value);
        router.push({
            path: '/list-book',
            query: {
                ...route.query,
                author: ''
            }
        });
    }
});

watch(selectedPublishers, async () => {
    if (selectedPublishers.value.length) {
        dataSearch.value.publisher_id = selectedPublishers.value;
        await getBooks(1, dataSearch.value);
        const selectedPublisherSlugs = selectedPublishers.value
            .map(publisherId => {
                const publisher = publishers.value.find(p => p.id === publisherId);
                return publisher ? publisher.slug : null;
            })
            .filter(slug => slug);
        router.push({
            path: '/list-book',
            query: {
                ...route.query,
                publisher: selectedPublisherSlugs.join(',')
            }
        });
    }

    if (selectedPublishers.value.length === 0) {
        delete dataSearch.value.publisher_id;
        await getBooks(1, dataSearch.value);
        // remove publisher query
        router.push({
            path: '/list-book',
            query: {
                ...route.query,
                publisher: ''
            }
        });
    }
});

watchEffect(() => {
    if (route.query.search) {
        searchQuery.value = route.query.search;
    }
});

watch(searchQuery, async () => {
    if (searchQuery.value) {
        dataSearch.value.name = searchQuery.value;
        await getBooks(1, dataSearch.value);
    }
}, { immediate: true });

const getCategories = async () => {
    try {
        const response = await axiosInstance.get('/categories', {
            params: {
                limit: 10000
            }
        });
        categories.value = response.data.data;
    } catch (error) {}
};

const getAuthors = async () => {
    try {
        const response = await axiosInstance.get('/authors', {
            params: {
                limit: 10000
            }
        });
        authors.value = response.data.data;
    } catch (error) {}
};

const getPublishers = async () => {
    try {
        const response = await axiosInstance.get('/publishers', {
            params: {
                limit: 10000
            }
        });
        publishers.value = response.data.data;
    } catch (error) {}
};

const getBooks = async (page = 1, dataSearch = {}) => {
    try {
        const response = await axiosInstance.get('/book', {
            params: {
                limit: 24,
                page: page,
                ...dataSearch
            }
        });
        if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
            books.value = response.data.data;
            dataPagination.value.total = response.data.total;
            dataPagination.value.currentPage = response.data.current_page;
            dataPagination.value.limit = response.data.limit;
        }
    } catch (error) {}
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

/**
 * The method handle page change
 *
 * @param {number} page - The page number
 *
 * @returns {Promise<void>}
 */
const handlePageChange = (page) => {
    dataPagination.value.currentPage = page;
    getBooks(page, dataSearch.value);
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
                await getWishList();
                ElNotification.success(
                    'Thêm vào danh sách yêu thích thành công'
                );
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
@import '@/assets/scss/variables.scss';

@mixin flex-center {
    display: flex;
    align-items: center;
    justify-content: center;
}

@mixin button-base {
    padding: 0.5rem 1rem;
    border-radius: 0.375rem;
    transition: all 0.2s;
    cursor: pointer;

    &:hover {
        opacity: 0.9;
    }
}

.book-listing {
    display: flex;
    min-height: 100vh;
    background-color: $background-color;
    @media (min-width: 1280px) {
        max-width: 1170px;
        margin: 0 auto;
    }
    .toggle-sidebar{
        width: 30px;
        height: 30px;
        background-color: $primary-color;
        color: white;
        border-radius: 50%;
        top: 125px;
        left: 5px;
        display: none;
        position: fixed;
        z-index: 1000;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    .sidebar, .sidebar-mobile {
        width: 250px;
        background-color: #f8f9fa;
        padding: 20px;
        transition: transform 0.3s ease-in-out;

        h2 {
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 1rem;
            color: $text-color;
        }
    }
    .sidebar-mobile{
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        z-index: 1000;
        .sidebar-mobile-header{
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            h2{
                margin-bottom: 0;
            }
            .toggle-sidebar-mobile{
                width: 30px;
                height: 30px;
                background-color: $primary-color;
                color: white;
                border-radius: 5px;
                border: none;
                cursor: pointer;
            }
        }
    }


    .sidebar-mobile.active {
        transform: translateX(0);
    }

    .sidebar-mobile {
        transform: translateX(-100%);
    }

    @media (max-width: 768px) {
        .sidebar {
            display: none;
        }
        .toggle-sidebar{
            display: block;
        }
    }
    .filter-section {
        margin-bottom: 1.5rem;

        h3 {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: $text-color;
        }

        .filter-list {
            label {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                margin-bottom: 0.5rem;
                cursor: pointer;

                input {
                    cursor: pointer;
                }

                span {
                    color: $text-color;
                }
            }
        }
    }

    .main-content {
        flex: 1;
        padding: 1.5rem;

        .top-filters {
            background-color: white;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            box-shadow: $shadow;
            display: flex;
            gap: 1rem;

            .filter-btn {
                @include button-base;
                background-color: #edf2f7;

                &.active {
                    background-color: $primary-color;
                    color: white;
                }
            }
        }

        .book-grid {
            display: grid;
            gap: 1.5rem;
            grid-template-columns: repeat(2, 1fr);

            @media (min-width: 768px) {
                grid-template-columns: repeat(2, 1fr);
            }

            @media (min-width: 1024px) {
                grid-template-columns: repeat(3, 1fr);
                row-gap: 30px;
            }
        }

        .book-management-pagination {
            @include flex-center;
            margin-top: 2rem;
            gap: 0.5rem;

            .page-btn {
                @include button-base;
                background-color: #edf2f7;
                min-width: 2.5rem;
                height: 2.5rem;
                @include flex-center;

                &.active {
                    background-color: $primary-color;
                    color: white;
                }
            }
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
        @include flex-center;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
        border: none;
        &:hover {
            transform: translateY(-2px);
        }
    }
}
</style>
