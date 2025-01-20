<template>
    <aside class="sidebar">
        <nav class="sidebar-nav">
            <div class="logo">
                <img
                    :src="images.logoKiaisoft"
                    alt="logo"
                    class="nav-icon"
                >
            </div>
            <ul class="nav-list">
                <li
                    v-for="(item, index) in navItems"
                    :key="index"
                    class="nav-item"
                    :class="isActive(item.path)"
                >
                    <router-link
                        :to="item.path"
                        class="nav-link"
                    >
                        <component
                            :is="item.icon"
                        />
                        {{ item.name }}
                    </router-link>
                </li>
            </ul>
            <hr class="nav-divider">
            <h2 class="nav-section-title">
                OPTIONS
            </h2>
            <hr class="nav-divider">
            <ul class="nav-list">
                <li
                    class="nav-item"
                    :class="isActive('/admin/setting')"
                >
                    <router-link
                        to="#"
                        class="nav-link"
                    >
                        <component
                            :is="IconSetting"
                        />
                        Cài đặt
                    </router-link>
                </li>
                <li
                    class="nav-item"
                >
                    <router-link
                        to="#"
                        class="nav-link"
                        @click="handleLogout"
                    >
                        <component
                            :is="IconLogout"
                        />
                        Đăng xuất
                    </router-link>
                </li>
            </ul>
        </nav>
    </aside>
</template>

<script setup>
import IconDashboard from '@/components/icons/IconDashboard.vue';
import IconOrderList from '@/components/icons/IconOrderList.vue';
import IconUser from '@/components/icons/IconUser.vue';
import IconCategory from '@/components/icons/IconCategory.vue';
import IconSetting from '@/components/icons/IconSetting.vue';
import IconLogout from '@/components/icons/IconLogout.vue';
import IconBook from '@/components/icons/IconBook.vue';
import IconFeedback from '@/components/icons/IconFeedback.vue';
import { computed } from 'vue';
import { useRoute } from 'vue-router';
import images from '@/assets/images';

const route = useRoute();
const emit = defineEmits(['logout']);
const navItems = [
    {
        name: 'Trang chủ',
        path: '/',
        icon: IconDashboard
    },
    {
        name: 'Người dùng',
        path: '/user',
        icon: IconUser
    },
    {
        name: 'Danh mục',
        path: '/category',
        icon: IconCategory
    },
    {
        name: 'Tác giả',
        path: '/author',
        icon: IconUser
    },
    {
        name: 'Nhà xuất bản',
        path: '/publisher',
        icon: IconUser
    },
    {
        name: 'Sách',
        path: '/book',
        icon: IconBook
    },
    {
        name: 'Đơn hàng',
        path: '/order',
        icon: IconOrderList
    },
    {
        name: 'Phản hồi',
        path: '/feedback',
        icon: IconFeedback
    }
];

/**
 * A computed property that returns a function to determine if a given path is active.
 *
 * @returns {Function} A function that takes a path as an argument and returns "active" if the current route path matches the given path, otherwise returns an empty string.
 */
const isActive = computed(() => (path) => {
    if (route.path === '/' && path === '/') {
        return 'active';
    }

    if (route.path.startsWith(path) && path !== '/') {
        return 'active';
    }

    return '';
});

/**
 * Handles the logout process for the admin user.
 *
 * This function calls the `store.handleLogout` method to initiate the logout process.
 * Once the response is received, it checks the status code of the response.
 * If the status code is either HTTP_OK or HTTP_UNAUTHORIZED, the user is redirected to the admin login page.
 *
 * @returns {void}
 */
function handleLogout() {
    emit('logout');
}
</script>

<style lang="scss" scoped>
@import "@/assets/scss/_variables.scss";
.sidebar {
    width: 240px;
    background-color: #fff;
    color: #202224;
    .sidebar-nav {
        display: flex;
        flex-direction: column;
        .logo {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 20px 0;
        }

        .logo > img {
            width: 129px;
            height: 40px;
            object-fit: contain;
        }
        .nav-list {
            display: flex;
            flex-direction: column;
            list-style-type: none;
            justify-content: center;
            .nav-item {
                border-left: 2px solid transparent;
                a {
                    padding: 13px 0px;
                    margin: 0px 20px;
                    display: flex;
                    border-radius: 10px;
                    align-items: center;
                    color: #202224;
                    text-decoration: none;
                    svg {
                        width: 17px;
                        height: 17px;
                        margin: 0px 10px;
                    }
                }
            }
            .nav-item:hover {
                border-left: 2px solid #4880ff;
                a {
                    color: white;
                    background-color: #4880ff;
                }
            }
            .nav-item.highlight {
                background-color: #007bff;
                color: #fff;
                border-radius: 0;
            }
            .nav-item.active {
                border-left: 2px solid #4880ff;
                a {
                    color: white;
                    background-color: #4880ff;
                }
            }
        }

        .nav-divider {
            width: 100%;
            border: none;
            border-top: 1px solid #e0e0e0;
            margin: 16px 0;
        }
        .nav-section-title {
            font-size: 12px;
            line-height: 16.37px;
            letter-spacing: 0.2571428120136261px;
            text-align: left;
            color: #202224;
            opacity: 0.6;
            margin-left: 20px;
        }
    }
}
</style>
