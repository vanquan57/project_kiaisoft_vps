<template>
    <transition :name="transitionEffect">
        <div
            v-show="index === currentSlide"
            class="carousel-item"
        >
            <img
                :src="slide"
                alt=""
            >
        </div>
    </transition>
</template>

<script setup>
import { computed } from 'vue';


const props = defineProps({
    slide: {
        type: String,
        required: true
    },
    index: {
        type: Number,
        required: true
    },
    currentSlide: {
        type: Number,
        required: true
    }
});

const transitionEffect = computed(() => {
    return props.index === props.currentSlide ? 'slide-in' : 'slide-out';
});
</script>

<style lang="scss" scoped>
.carousel-item {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    img {
        width: 100%;
        height: 100%;
    }
}
.slide-in-enter-active,
.slide-in-leave-active,
.slide-out-enter-active,
.slide-out-leave-active {
  transition: all 0.6s ease-in-out;
}
.slide-in-enter-from {
  transform: translateX(200%);
}
.slide-in-leave-to {
  transform: translateX(100%);
}
.slide-out-enter-from {
  transform: translateX(100%);
}
.slide-out-leave-to {
  transform: translateX(-100%);
}
</style>
