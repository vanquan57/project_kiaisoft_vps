<template>
    <div class="container">
        <SidebarLayout @logout="handleLogout" />
        <div class="main-container">
            <HeaderLayout
                class="header-layout"
                @logout="handleLogout"
            />
            <div class="content">
                <RouterView />
            </div>
        </div>
    </div>
</template>

<script setup>
import HTTP_STATUS_CODE from '@/config/statusCode';
import HeaderLayout from './HeaderLayout.vue';
import SidebarLayout from './SidebarLayout.vue';
import axiosInstance from '@/config/axios';
import { useRouter } from 'vue-router';

const router = useRouter();

/**
 * Handle logout
 *
 * @returns {void}
*/
const handleLogout = async () => {
    try {
        const response = await axiosInstance.post('auth/logout');

        if (response.status === HTTP_STATUS_CODE.HTTP_OK) {
            localStorage.removeItem('token');
            router.push('/auth/login');
        }
    } catch (error) {
    }
};
</script>

<style lang="scss" scoped>
.container {
    display: flex;
    width: 100%;
    padding: 5px 0;
    box-sizing: border-box;
}

.main-container {
    flex: 1;
    display: flex;
    flex-direction: column;
    width: 100%;
    max-width: calc(100% - 240px);
    height: 100vh;
}
.content {
    flex: 1;
    margin: 10px 20px 5px 20px;
    box-sizing: border-box;
    background-color: #F5F6FA;
    border-radius: 10px;
}
</style>
