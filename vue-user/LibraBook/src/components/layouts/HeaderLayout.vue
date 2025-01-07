<template>
    <header>
        <section class="top-header">
            <div class="top-header__container">
                <div class="sale-banner">
                    <p class="sale-banner__text">
                        Khuyến Mãi Đọc Sách: Giảm Giá Lên Đến 50% Cho Tất Cả Gói Thành Viên và Đăng Ký Miễn Phí!
                        <span class="promo-link">Mua Ngay tại</span>
                    </p>
                </div>
                <div class="language">
                    <select id="choose_language">
                        <option value="en">
                            English
                        </option>
                        <option value="es">
                            Viet Nam
                        </option>
                        <option value="fr">
                            Japanese
                        </option>
                    </select>
                </div>
            </div>
        </section>
        <nav class="nav-bar">
            <div class="logo">
                <router-link to="/">
                    Kiai-Libra
                </router-link>
            </div>
            <div class="menu">
                <ul>
                    <li>
                        <router-link to="/">
                            Trang Chủ
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/contact">
                            Liên Hệ
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/about">
                            Giới Thiệu
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/auth/register">
                            Đăng Ký
                        </router-link>
                    </li>
                </ul>
            </div>
            <div class="search">
                <form action="">
                    <div class="search-group">
                        <input
                            type="text"
                            placeholder="Tìm kiếm sách"
                        >
                        <button type="submit">
                            <IconSearch />
                        </button>
                    </div>
                </form>
                <div
                    v-if="isShowGroupAction"
                    class="actions"
                >
                    <div class="action-item">
                        <router-link to="/wishlist">
                            <IconHeart />
                        </router-link>
                    </div>
                    <div class="action-item">
                        <router-link to="/cart">
                            <IconCart />
                        </router-link>
                    </div>
                    <div class="action-item">
                        <span
                            class="action-item__user"
                            :class="{ active: isShowAction }"
                            @click="isShowAction = !isShowAction"
                        >
                            <IconUser
                                :color-stroke="isShowAction ? 'white' : 'black'"
                            />
                        </span>
                        <div
                            v-if="isShowAction"
                            class="user-menu-dropdown"
                        >
                            <ul class="user-menu">
                                <li class="user-menu__item">
                                    <IconUser
                                        class="icon"
                                        :color-stroke="'white'"
                                    />
                                    <router-link
                                        to="/my-account"
                                        @click="isShowAction = false"
                                    >
                                        Tài Khoản Của Tôi
                                    </router-link>
                                </li>

                                <li class="user-menu__item">
                                    <IconMyOrder class="icon" />
                                    <router-link 
                                        to="/my-account/orders"
                                        @click="isShowAction = false"
                                    >
                                        Đơn Hàng Của Tôi
                                    </router-link>
                                </li>
                                <li class="user-menu__item">
                                    <IconHeart
                                        class="icon"
                                        :color-stroke="'white'"
                                    />
                                    <router-link
                                        to="/wishlist"
                                        @click="isShowAction = false"
                                    >
                                        Danh Sách Yêu Thích
                                    </router-link>
                                </li>

                                <li class="user-menu__item">
                                    <IconLogout />
                                    <button @click="logout">
                                        Đăng Xuất
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</template>

<script setup>
import IconSearch from '@/components/icons/IconSearch.vue';
import IconCart from '../icons/IconCart.vue';
import IconHeart from '../icons/IconHeart.vue';
import IconUser from '../icons/IconUser.vue';
import IconMyOrder from '../icons/IconMyOrder.vue';
import IconLogout from '../icons/IconLogout.vue';
import { ref, watchEffect } from 'vue';
import { useRoute } from 'vue-router';
import { useRouter } from 'vue-router';

const router = useRouter();
const route = useRoute();
const isShowAction = ref(false);
const isShowGroupAction = ref(true);

watchEffect(() => {
    if (
        route.name === 'auth-login' ||
        route.name === 'auth-register' ||
        route.name === 'auth-verify-email' ||
        route.name === 'reset-password'
    ) {
        isShowGroupAction.value = false;
    } else {
        isShowGroupAction.value = true;
    }
});

const logout = () => {
    localStorage.removeItem('token');
    router.push('/auth/login');
};
</script>

<style lang="scss" scoped>
@import "@/assets/scss/_variables.scss";

header {
    display: flex;
    justify-content: center;
    flex-direction: column;
    border-bottom: 0.5px solid $line-color-orange;
    position: sticky;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 1000;
    background-color: white;
    .top-header {
        display: flex;
        background-color: $primary-color;
        &__container {
            height: 48px;
            margin: 0 auto;
            color: $text-color-white;
            font-size: 14px;
            display: flex;
            align-items: center;
            .sale-banner {
                flex: 1;
                display: flex;
                align-items: center;
                text-align: center;
                gap: 10px;
                .sale-banner__text {
                    width: 100%;
                }
                .promo-link {
                    font-weight: 600;
                }
            }
            .language {
                #choose_language {
                    background-color: transparent;
                    border: none;
                    color: $text-color-white;
                    outline: none;
                    option {
                        color: $text-color-black;
                    }
                }
            }
        }
    }
    .nav-bar {
        width: 100%;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 38px 0px 16px 5px;
        .logo {
            font-size: 24px;
            font-weight: 600;
            a {
                color: $text-color-black;
                text-decoration: none;
            }
        }
        .menu {
            ul {
                display: flex;
                gap: 48px;
                list-style: none;
                li {
                    a {
                        list-style: none;
                        font-size: 16px;
                        font-weight: 500;
                        color: $text-color-black;
                        text-decoration: none;
                        transition: all 0.3s;
                        &:hover {
                            cursor: pointer;
                            text-decoration: underline;
                            color: $primary-color;
                        }
                    }
                }
            }
        }
        .search {
            display: flex;
            align-items: center;
            gap: 24px;
            form {
                display: flex;
                width: 243px;
                height: 38px;
                gap: 34px;
                .search-group {
                    position: relative;
                    input {
                        height: 100%;
                        width: 100%;
                        border: none;
                        outline: none;
                        width: 100%;
                        background-color: $background-color-input;
                        opacity: 0.5;
                        border-radius: 4px;
                        padding: 0 10px;
                    }
                    button {
                        position: absolute;
                        right: -15px;
                        top: 50%;
                        transform: translateY(-50%);
                        background-color: transparent;
                        border: none;
                        border-radius: 5px;
                        cursor: pointer;
                        svg {
                            width: 24px;
                            height: 24px;
                        }
                    }
                }
            }
            .actions {
                display: flex;
                gap: 16px;
                justify-content: center;
                align-items: center;
                height: 32px;
                width: 128px;
                .action-item {
                    width: 32px;
                    height: 100%;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }
                .action-item:last-child {
                    position: relative;
                    .action-item__user {
                        border-radius: 100%;
                        padding: 3px 5px;
                        cursor: pointer;
                        transition: all 0.3s;
                    }
                    .action-item__user:hover {
                        background-color: $primary-color;
                    }
                    .action-item__user.active {
                        background-color: $primary-color;
                    }
                    .user-menu-dropdown {
                        position: absolute;
                        top: 30px;
                        right: 0;
                        z-index: 100;
                        .user-menu {
                            width: 225px;
                            box-sizing: border-box;
                            overflow: hidden;
                            list-style: none;
                            background: $color-grown-bold;
                            backdrop-filter: blur(150px);
                            border-radius: 4px;
                            padding: 0px;
                            &__item {
                                &:hover {
                                    background-color: $primary-color;
                                    a {
                                        color: $text-color-white;
                                    }
                                    button {
                                        color: $text-color-white;
                                    }
                                }
                                .icon {
                                    width: 24px;
                                    height: 24px;
                                }
                                padding: 5px 10px;
                                display: flex;
                                align-items: center;
                                gap: 16px;
                                width: 100%;
                                height: 32px;
                                margin-bottom: 13px;
                                transition: all 0.3s;
                                &:last-child {
                                    margin-bottom: 0;
                                }
                                a {
                                    color: $text-color-white;
                                    text-decoration: none;
                                    font-size: 14px;
                                    font-weight: 500;
                                }
                                button {
                                    width: 100%;
                                    height: 100%;
                                    background: none;
                                    border: none;
                                    color: $text-color-white;
                                    font-size: 14px;
                                    font-weight: 500;
                                    cursor: pointer;
                                    text-align: left;
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

// Mobile
@media (max-width: 576px) {
    .top-header {
        &__container {
            width: 100%;
            padding: 0 10px;
            .sale-banner {
                flex: 1;
                display: flex;
                align-items: center;
                text-align: left;
            }
        }
    }
}
// Tablet
@media (max-width: 768px) {
    header {
        .top-header {
            &__container {
                width: 100%;
                padding: 0 10px;
            }
        }
        .sale-banner__text {
            font-size: 13px;
            text-align: left;
        }
        .nav-bar {
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
            padding: 10px 0;
            .logo {
                width: 100%;
                text-align: center;
            }
            .menu {
                width: 100%;
                display: flex;
                justify-content: center;
                ul {
                    gap: 24px;
                }
            }
            .search {
                width: 80%;
                display: flex;
                justify-content: center;
                form {
                    width: 100%;
                    .search-group {
                        width: 100%;
                        input {
                            width: 100%;
                        }
                    }
                }
            }
        }
    }
}

@media (min-width: 769px) and (max-width: 1024px) {
    .top-header {
        display: flex;
        background-color: $primary-color;
        &__container {
            width: 100%;
        }
    }
    .nav-bar {
        max-width: 900px;
    }
}

@media (min-width: 1024px) {
    .top-header {
        display: flex;
        background-color: $primary-color;
        &__container {
            width: 1170px;
        }
    }
    .nav-bar {
        max-width: 1170px;
    }
}
</style>
