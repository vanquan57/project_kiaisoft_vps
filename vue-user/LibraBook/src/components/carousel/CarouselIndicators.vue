<template>
    <div class="carousel-indicators">
        <button
            v-for="(item, index) in total"
            :key="index"
            class="carousel-indicator-item"
            :class="{ active: currentIndex === index }"
            @click="handleSwitch(index)"
        />
    </div>
</template>

<script setup>
const emit = defineEmits(['switch']);
const props = defineProps({
    currentIndex: {
        type: Number,
        default: 0
    },
    total: {
        type: Number,
        default: 0
    }
});

const handleSwitch = (index) => {
    emit('switch', index);
};


</script>

<style lang="scss" scoped>
@import "@/assets/scss/_variables.scss";

.carousel-indicators {
    position: absolute;
    transform: translateX(-50%);
    left: 50%;
    bottom: 1.5em;
    z-index: 2;
}
.carousel-indicator-item {
    width: 12px;
    height: 12px;
    border: none;
    background: #FFFFFF;
    opacity: 0.5;
    margin: 0.2em;
    border-radius: 50%;
    cursor: pointer;
}
.active {
    background: $primary-color;
    opacity: 1;
}
</style>
