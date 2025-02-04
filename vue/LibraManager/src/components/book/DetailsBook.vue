<template>
    <div>
        <el-dialog
            v-model="outerVisible"
            :title="`Chi tiết sách: ${props.book.name}`"
            append-to-body
            class="book-detail-dialog"
        >
            <div class="book-content">
                <div class="book-images">
                    <div class="main-image">
                        <img
                            :src="mainImage"
                            :alt="props.book.name"
                        >
                    </div>
                    <div class="image-gallery">
                        <img
                            v-for="image in props.book.images"
                            :key="image.id"
                            :src="urlImage(image.url)"
                            :alt="props.book.name"
                            class="thumbnail"
                            @click="handleClickImage(image.url)"
                        >
                    </div>
                </div>

                <div class="book-info">
                    <h2>{{ props.book.name }}</h2>
                    <div class="info-row">
                        <span class="label">Tác giả:</span>
                        <span>{{ props.book.author.name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="label">Nhà xuất bản:</span>
                        <span>{{ props.book.publisher.name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="label">Thể loại:</span>
                        <span>{{
                            props.book.categories
                                .map((cat) => cat.name)
                                .join(", ")
                        }}</span>
                    </div>
                    <div class="info-row">
                        <span class="label">Ngày xuất bản:</span>
                        <span>{{
                            new Date(
                                props.book.publication_date
                            ).toLocaleDateString("vi-VN")
                        }}</span>
                    </div>
                    <div class="info-row">
                        <span class="label">Số trang:</span>
                        <span>{{ props.book.page }}</span>
                    </div>
                    <div class="info-row">
                        <span class="label">Kích thước:</span>
                        <span>{{ props.book.size }}</span>
                    </div>
                    <div class="info-row">
                        <span class="label">Số lượng:</span>
                        <span>{{ props.book.quantity }}</span>
                    </div>
                    <div class="info-row">
                        <span class="label">Loại bìa:</span>
                        <span>{{ coverType.find(item => item.id === props.book.cover_type)?.label }}</span>
                    </div>
                    <div class="stats">
                        <div class="stat-item">
                            <span class="stat-label">Lượt xem</span>
                            <span class="stat-value">{{
                                props.book.views
                            }}</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">Lượt mượn</span>
                            <span class="stat-value">{{
                                props.book.borrowing_number
                            }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="description-section">
                <h3>Mô tả ngắn</h3>
                <p
                    class="text-description"
                    v-html="props.book.mini_description"
                />

                <h3>Mô tả chi tiết</h3>
                <p
                    class="text-description"
                    v-html="props.book.details_description"
                />
            </div>

            <template #footer>
                <div class="dialog-footer">
                    <el-button @click="outerVisible = false">
                        Đóng
                    </el-button>
                </div>
            </template>
        </el-dialog>
    </div>
</template>

<script setup>
import { ref, watch } from 'vue';
import COVER_TYPE from '@/config/coverType';
const props = defineProps({
    book: {
        type: Object,
        default: () => {}
    }
});

const outerVisible = ref(false);
const mainImage = ref('');
const coverType = Array.from(COVER_TYPE);


/**
 * The method get url image
 *
 * @param {string} url - The url
 *
 * @returns {string}
 */
const urlImage = (url) => {
    return import.meta.env.VITE_STORAGE_URL + url;
};

/**
 * The method watch book
 *
 * @returns {Promise<void>}
 */
watch(
    () => props.book,
    (newBook) => {
        if (newBook) {
            outerVisible.value = true;
            mainImage.value = urlImage(props.book.image);
        }
    }
);

/**
 * The method handle click image
 *
 * @param {string} url - The url
 *
 * @returns {Promise<void>}
 */
const handleClickImage = (url) => {
    mainImage.value = urlImage(url);
};
</script>

<style lang="scss" scoped>
.book-detail-dialog {
    :deep(.el-dialog) {
        min-width: 800px;
        max-width: 1000px;
    }

    .book-content {
        display: flex;
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .book-images {
        flex: 0 0 300px;

        .main-image {
            margin-bottom: 1rem;

            img {
                width: 100%;
                height: 400px;
                object-fit: cover;
                border-radius: 8px;
            }
        }

        .image-gallery {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;

            .thumbnail {
                width: 70px;
                height: 70px;
                object-fit: cover;
                border-radius: 4px;
                cursor: pointer;
                transition: opacity 0.2s;

                &:hover {
                    opacity: 0.8;
                }
            }
        }
    }

    .book-info {
        flex: 1;

        h2 {
            margin: 0 0 1.5rem;
            font-size: 1.5rem;
            color: #333;
        }

        .info-row {
            margin-bottom: 1rem;
            display: flex;

            .label {
                flex: 0 0 120px;
                font-weight: 600;
                color: #666;
            }
        }

        .stats {
            display: flex;
            gap: 2rem;
            margin-top: 2rem;
            padding-top: 1rem;
            border-top: 1px solid #eee;

            .stat-item {
                text-align: center;

                .stat-label {
                    display: block;
                    font-size: 0.875rem;
                    color: #666;
                    margin-bottom: 0.25rem;
                }

                .stat-value {
                    font-size: 1.25rem;
                    font-weight: 600;
                    color: #409eff;
                }
            }
        }
    }

    .description-section {
        border-top: 1px solid #eee;
        padding-top: 1.5rem;
        margin-top: 1.5rem;
        margin-bottom: 2rem;

        h3 {
            font-size: 1.125rem;
            color: #333;
            margin: 10px 0;
        }

        p {
            color: #666;
            line-height: 1.6;
            margin: 0 0 1.5rem;
            white-space: pre-wrap;
        }
    }
}

.dialog-footer {
    text-align: right;
}
</style>
