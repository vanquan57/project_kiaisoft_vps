<template>
    <div class="book-card">
        <div class="book-card__image">
            <router-link :to="`/book/${book.id}`">
                <img
                    :src="urlImage(book.image)"
                    alt=""
                    loading="lazy"
                >
            </router-link>
            <div class="book-card__image__action">
                <div
                    class="book-card__image__action__item"
                    :class="{'active disabled': wishListStore.wishList.includes(book.id)}"
                    @click="!wishListStore.wishList.includes(book.id) && handleAddBookToWishlist(book.id)"
                >
                    <IconWishlist />
                </div>
                <div
                    class="book-card__image__action__item"
                    @click="handleQuickView(book.id)"
                >
                    <IconQuickView />
                </div>
            </div>
            <button
                class="book-card__image__btn-add"
                @click="handleAddBookToCart(book.id)"
            >
                Thêm vào giỏ mượn
            </button>
        </div>
        <div class="book-card__info">
            <h2 class="book-card__info__name">
                {{ book.name }}
            </h2>
            <h3 class="book-card__info__author">
                {{ book.author.name }}
            </h3>
            <div class="book-card__info__rating">
                <div
                    v-for="i in 5"
                    :key="i"
                    :class="[
                        'book-card__info__rating__item',
                        { active: i <= book.average_star },
                    ]"
                >
                    <IconStar />
                </div>
                <span class="book-card__info__total-feedbacks">( {{ book.feedbacks_count }})</span>
            </div>
        </div>
    </div>
</template>

<script setup>
import IconStar from '@/components/icons/IconStar.vue';
import IconWishlist from '@/components/icons/IconWishlist.vue';
import IconQuickView from '@/components/icons/IconQuickView.vue';
import { useWishListStore } from '@/stores/wishList';

const wishListStore = useWishListStore();
const props = defineProps({
    book: {
        type: Object,
        required: true
    }
});

const emit = defineEmits(['quickView', 'addBookToCart', 'addBookToWishlist']);

const urlImage = (url) => {
    return import.meta.env.VITE_URL_IMAGE + url;
};

const handleQuickView = (id) => {
    emit('quickView', id);
};

const handleAddBookToCart = (id) => {
    emit('addBookToCart', id);
};

const handleAddBookToWishlist = (id) => {
    emit('addBookToWishlist', id);
};
</script>

<style lang="scss" scoped>
@import "@/assets/scss/_variables.scss";
.book-card {
    &__image {
        width: 100%;
        height: 250px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: $background-color-btn-carousel;
        border-radius: 4px;
        &:hover {
            .book-card__image__btn-add {
                display: block;
            }
        }
        img {
            width: 190px;
            height: 180px;
            object-fit: cover;
            border-radius: 4px;
            aspect-ratio: 9/16;
        }
        &__action {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            cursor: pointer;
            &__item {
                width: 44px;
                height: 44px;
                padding: 10px;
                border-radius: 50%;
                background-color: white;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.3s ease;
                &:hover {
                    background-color: $background-color-icon-action-hover-fill;
                }
                svg {
                    width: 24px;
                    height: 24px;
                }
                &.active {
                    background-color: $background-color-icon-action-hover-fill;
                }
                &.disabled {
                    cursor: not-allowed;
                }
            }
        }


        &__btn-add {
            position: absolute;
            width: 100%;
            height: 40px;
            bottom: 0;
            left: 0;
            padding: 10px 20px;
            background-color: #ff4500c7;
            color: $text-color-white;
            border-radius: 0 0 4px 4px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: none;
        }
    }
    &__info {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-top: 10px;
        &__name {
            font-size: clamp(16px, 1.5vw, 18px);
            font-weight: 500;
            color: $text-color-black;
            line-height: 24px;
        }
        &__author {
            font-size: clamp(14px, 1.2vw, 16px);
            font-weight: 400;
            color: $text-color-black;
            line-height: 24px;
        }
        &__rating {
            display: flex;
            align-items: center;
            gap: 5px;
            &__item {
                svg {
                    width: 16px;
                    height: 16px;
                    fill: $background-color-btn-carousel;
                }
                &.active {
                    svg {
                        width: 16px;
                        height: 16px;
                        fill: $background-color-icon-action-hover-fill;
                    }
                }
            }
        }
    }
}

@media (max-width: 768px) {
    .book-card {
        max-width: 270px;
        max-height: 350px;
    }
    .category {
        display: none;
    }
    .sidebar-carousel {
        grid-template-columns: 1fr;
    }
    .top-book__most-borrowed__list {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (min-width: 800px) {
    .book-card {
        width: 270px;
        height: 350px;
    }
}
</style>
