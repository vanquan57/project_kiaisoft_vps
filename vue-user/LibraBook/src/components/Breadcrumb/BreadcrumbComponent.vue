<template>
    <div class="breadcrumb">
        <el-breadcrumb separator="/">
            <el-breadcrumb-item
                v-for="item in breadcrumbList"
                :key="item.path"
                :to="{ path: item.path }"
            >
                <router-link :to="item.path">
                    {{ item.name }}
                </router-link>
            </el-breadcrumb-item>
        </el-breadcrumb>
    </div>
</template>

<script setup>
const props = defineProps({
    breadcrumbList: {
        type: Array,
        default: () => []
    }
});
</script>

<style lang="scss" scoped>
.breadcrumb {
    padding: 20px 0;
    font-size: 14px;
    font-family: "Poppins", sans-serif;
}
</style>
