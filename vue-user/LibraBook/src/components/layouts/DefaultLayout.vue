<template>
    <div class="layout-container">
        <HeaderLayout />
        <main>
            <RouterView />
        </main>
        <FooterLayout />
    </div>
</template>

<script setup>
import HeaderLayout from '@/components/layouts/HeaderLayout.vue';
import FooterLayout from '@/components/layouts/FooterLayout.vue';
</script>

<style lang="scss" scoped>
.layout-container {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

main {
    flex: 1;
}
</style>
