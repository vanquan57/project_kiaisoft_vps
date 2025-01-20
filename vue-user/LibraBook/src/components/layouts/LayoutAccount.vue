<template>
    <div class="account-container">
        <div class="account-container__header">
            <BreadcrumbComponent
                class="breadcrumb-container"
                :breadcrumb-list="breadcrumbs"
            />
            <span class="welcome-text">Chào mừng <strong>{{ user?.name }}</strong></span>
        </div>
        <div class="account-container__content">
            <div class="account-container__left">
                <div class="account-container__left-sidebar">
                    <ul class="account-container__left-sidebar__list">
                        <li class="account-container__left-sidebar__list__item">
                            <span
                                class="account-container__left-sidebar__list__item__title"
                            >
                                Quản lý tài khoản
                            </span>
                            <ul
                                class="account-container__left-sidebar__list__item__list"
                            >
                                <li
                                    class="account-container__left-sidebar__list__item__list__item"
                                >
                                    <router-link to="/my-account">
                                        Tài khoản của tôi
                                    </router-link>
                                </li>
                                <li
                                    class="account-container__left-sidebar__list__item__list__item"
                                >
                                    <router-link to="/my-account/change-password">
                                        Thay đổi mật khẩu
                                    </router-link>
                                </li>
                            </ul>
                        </li>

                        <li class="account-container__left-sidebar__list__item">
                            <span
                                class="account-container__left-sidebar__list__item__title"
                            >
                                Quản lý đơn mượn
                            </span>
                            <ul
                                class="account-container__left-sidebar__list__item__list"
                            >
                                <li
                                    class="account-container__left-sidebar__list__item__list__item"
                                >
                                    <router-link to="/my-account/orders">
                                        Đơn mượn của tôi
                                    </router-link>
                                </li>
                            </ul>
                        </li>

                        <li class="account-container__left-sidebar__list__item">
                            <span
                                class="account-container__left-sidebar__list__item__title"
                            >
                                Danh sách yêu thích
                            </span>
                            <ul
                                class="account-container__left-sidebar__list__item__list"
                            >
                                <li
                                    class="account-container__left-sidebar__list__item__list__item"
                                >
                                    <router-link to="/wishlist">
                                        Sách yêu thích
                                    </router-link>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="account-container__right">
                <RouterView />
            </div>
        </div>
    </div>
</template>

<script setup>
import BreadcrumbComponent from '@/components/Breadcrumb/BreadcrumbComponent.vue';
import axiosInstance from '@/config/axios';
import { onMounted, ref, watchEffect } from 'vue';
import { useRoute } from 'vue-router';
const route = useRoute();
const breadcrumbs = ref([
    { name: 'Trang chủ', path: '/' },
    { name: 'Tài khoản của tôi', path: '/my-account' }
]);

const user = ref(null);
onMounted(() => {
    getUser();
});
watchEffect(() => {
    if (route.fullPath === '/my-account') {
        breadcrumbs.value = [
            { name: 'Trang chủ', path: '/' },
            { name: 'Tài khoản của tôi', path: '/my-account' }
        ];
    }
    if (route.fullPath === '/my-account/orders') {
        breadcrumbs.value = [
            { name: 'Trang chủ', path: '/' },
            { name: 'Tài khoản của tôi', path: '/my-account' },
            { name: 'Đơn mượn của tôi', path: '/my-account/orders' }
        ];
    }
    if (route.fullPath === '/my-account/change-password') {
        breadcrumbs.value = [
            { name: 'Trang chủ', path: '/' },
            { name: 'Tài khoản của tôi', path: '/my-account' },
            { name: 'Thay đổi mật khẩu', path: '/my-account/change-password' }
        ];
    }
});
const getUser = async () => {
    try {
        const response = await axiosInstance.get('/profile');
        user.value = response.data;
    } catch (error) {
    }
};
</script>

<style lang="scss" scoped>
@import "@/assets/scss/_variables.scss";
.account-container {
    @media (min-width: 1024px) {
        max-width: 1170px;
        margin: 0 auto;
    }
    @media (max-width: 768px) {
        padding: 0 15px;
    }

    .account-container__header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        @media (max-width: 768px) {
            flex-direction: column;
        }
        @media (min-width: 1024px) {
            padding: 30px 0;
        }
        .welcome-text {
            font-family: "Poppins";
            font-size: 16px;
            font-weight: 400;
            line-height: 24px;
            text-align: left;
            color: $text-color-black;
            strong {
                color: green;
                font-weight: 600;
            }
        }
    }
    .breadcrumb-container {
        padding: 50px 0;
    }
    .account-container__content {
        width: 100%;
        display: flex;
        gap: 20px;
        margin-bottom: 30px;
        @media (min-width: 1024px) {
            margin-bottom: 140px;
        }
        @media (max-width: 768px) {
            flex-direction: column;
        }
        .account-container__left {
            width: 26%;
            @media (max-width: 768px) {
                width: 100%;
            }
            &-sidebar {
                @media (max-width: 768px) {
                    display: flex;
                    flex-direction: column;
                    width: 100%;
                    text-align: center;
                    margin-top: 20px;
                }
                &__list {
                    &__item {
                        &__title {
                            font-family: "Poppins";
                            font-size: 16px;
                            font-weight: 600;
                            line-height: 24px;
                            text-align: left;
                        }
                        &__list {
                            &__item {
                                margin-bottom: 5px;
                                margin-left: 25px;
                                a {
                                    font-family: "Poppins";
                                    font-size: 16px;
                                    font-weight: 400;
                                    line-height: 24px;
                                    text-align: left;
                                    color: $text-color-black;
                                    text-decoration: none;
                                    &:hover {
                                        color: $primary-color;
                                    }
                                    &.router-link-active {
                                        color: $primary-color;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        .account-container__right {
            width: 74%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            @media (max-width: 768px) {
                width: 100%;
            }
        }
    }
}
</style>

