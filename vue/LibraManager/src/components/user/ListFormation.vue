<template>
    <div class="list-user-container">
        <el-table
            class="table-user"
            :data="tableData"
            :scrolling="true"
        >
            <el-table-column
                prop="id"
                label="ID"
                width="50"
                fixed
            />
            <el-table-column
                prop="code"
                label="Mã nhân viên"
                fixed
            />
            <el-table-column
                prop="name"
                label="Họ và tên"
                fixed
            />
            <el-table-column
                prop="email"
                label="Email"
            />
        </el-table>
    </div>
</template>

<script setup>

const props = defineProps({
    tableData: {
        type: Array,
        default: () => []
    }
});


</script>

<style lang="scss" scoped>
.list-user-container {
    width: 100%;
    padding: 10px;
    box-sizing: border-box;
    overflow: hidden;
}
.status-active {
    color: green;
    font-weight: bold;
}

.status-inactive {
    color: gray;
    font-weight: bold;
}

.status-locked {
    color: red;
    font-weight: bold;
}
</style>
