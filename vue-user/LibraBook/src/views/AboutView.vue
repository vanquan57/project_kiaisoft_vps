<template>
    <div class="about-container">
        <BreadcrumbComponent
            class="breadcrumb-container"
            :breadcrumb-list="breadcrumbs"
        />
        <section class="about-our_story">
            <div class="about-text">
                <h1>Câu chuyện của chúng tôi</h1>
                <p>
                    Kiai-Libra là phần mềm quản lý thư viện được phát triển bởi KIAISOFT.
                    Được khởi động vào năm 2024, Kiai-Libra không chỉ cung cấp một giải pháp quản lý thư viện hiệu quả mà còn
                    thể hiện sự cam kết của chúng tôi đến việc cung cấp dịch vụ đáp ứng được cả tiêu chuẩn Việt Nam và Nhật Bản,
                    kết hợp với sự đam mê và chu đáo.
                </p>
                <p>
                    Với slogan "Phấn đấu đáp ứng nhu cầu người dùng và nâng cao
                    kinh nghiệm của họ", Kiai-Libra tối ưu hóa quy trình cho
                    tìm kiếm, lưu trữ và quản lý tài nguyên thư viện,
                    nâng cao hiệu quả công việc và tạo ra một môi trường thuận lợi hơn
                    môi trường học tập và nghiên cứu.
                </p>
            </div>
            <div class="about-image">
                <img
                    :src="images.sideImageAbout"
                    alt=""
                >
            </div>
        </section>
        <div class="about-general">
            <div class="card-group-general">
                <StatsOverviewComponent
                    v-for="cardGeneral in cardGenerals"
                    :key="cardGeneral.value"
                    :value="cardGeneral.value"
                    :content="cardGeneral.content"
                    :icon="cardGeneral.icon"
                />
            </div>
        </div>
        <div class="about-service">
            <div class="card-group-service">
                <StatsOverviewComponent
                    v-for="fullService in fullServices"
                    :key="fullService.value"
                    :value="fullService.value"
                    :content="fullService.content"
                    :icon="fullService.icon"
                    :full-service="true"
                    :has-border="false"
                />
            </div>
        </div>
    </div>
</template>

<script setup>
import images from '@/assets/images';
import IconCustomerService from '@/components/icons/IconCustomerService.vue';
import IconDelivery from '@/components/icons/IconDelivery.vue';
import IconMoneyBag from '@/components/icons/IconMoneyBag.vue';
import IconSale from '@/components/icons/IconSale.vue';
import IconSecure from '@/components/icons/IconSecure.vue';
import IconShop from '@/components/icons/IconShop.vue';
import IconShoppingBag from '@/components/icons/IconShoppingBag.vue';
import BreadcrumbComponent from '@/components/Breadcrumb/BreadcrumbComponent.vue';
import StatsOverviewComponent from '@/components/StatsOverviewComponent.vue';
import { markRaw } from 'vue';
import { reactive } from 'vue';

const breadcrumbs = [
    {
        name: 'Trang chủ',
        path: '/'
    },
    {
        name: 'Về chúng tôi',
        path: '/about'
    }
];

const cardGenerals = reactive([
    {
        icon: markRaw(IconMoneyBag),
        value: '12.5k',
        content: 'Số lượng người dùng đăng ký'
    },
    {
        icon: markRaw(IconSale),
        value: '13.5k',
        content: 'Số lượng đơn hàng được đặt'
    },
    {
        icon: markRaw(IconShop),
        value: '14.5k',
        content: 'Số lượng sách trong thư viện'
    },
    {
        icon: markRaw(IconShoppingBag),
        value: '15.5k',
        content: 'Số lượng sách yêu thích'
    }
]);

const fullServices = reactive([
    {
        icon: markRaw(IconDelivery),
        value: 'SÁCH',
        content: 'Số lượng sách có sẵn'
    },
    {
        icon: markRaw(IconCustomerService),
        value: 'THỜI GIAN',
        content: 'Thứ 2 - Thứ 7, 9 AM - 6 PM'
    },
    {
        icon: markRaw(IconSecure),
        value: 'SÁCH MỚI',
        content: 'Sách mới cập nhật'
    }
]);
</script>

<style lang="scss" scoped>
.about-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    .breadcrumb-container{
        width: 100%;
        margin-top: 60px;
        margin-bottom: 22px;
    }
    .about-our_story {
        display: flex;
        align-items: center;
        margin-left: auto;
        gap: 40px;
        .about-text {
            display: flex;
            flex-direction: column;
            text-align: justify;
            p {
                padding: 20px 0;
            }
        }
    }
    .about-general {
        margin: 140px 0;
        width: 100%;
        .card-group-general {
            width: 100%;
            margin: 0 auto;
            display: grid;
            gap: 20px;
        }
    }
    .about-service {
        margin-bottom: 140px;
        width: 100%;
        .card-group-service {
            width: 100%;
            margin: 0 auto;
            display: grid;
            gap: 20px;
        }
    }
}
@media (min-width: 1201px) {
    .about-our_story {
        display: flex;
        align-items: center;
        margin-left: auto;
        gap: 40px;
        .about-text {
            width: 45%;
            display: flex;
            flex-direction: column;
            h1 {
                font-size: clamp(42px, 2.5vw, 54px);
            }
            p {
                font-size: clamp(16px, 1.5vw, 18px);
                padding: 20px 0;
                line-height: 26px;
            }
        }
        .about-image {
            flex: 1;
            display: flex;
            justify-content: flex-end;
            img {
                width: 90%;
                object-fit: cover;
                aspect-ratio: 1/1;
            }
        }
    }
    .about-service {
        max-width: 950px;
    }
    .card-group-general {
        max-width: 1170px;
        grid-template-columns: repeat(4, minmax(270px, 1fr));
    }
    .card-group-service {
        grid-template-columns: repeat(3, minmax(270px, 1fr));
    }
}
/* Extra large devices (large laptops, desktops) */
@media (max-width: 1200px) {
    .about-container {
        padding: 0 20px;
    }
    .about-text {
        width: 100%;
        margin-left: 0;
        max-width: 100%;
        h1 {
            font-size: clamp(42px, 2.5vw, 54px);
            text-align: center;
        }
        p {
            font-size: clamp(16px, 1.5vw, 18px);
            padding: 20px 0;
            line-height: 26px;
        }
    }
    .card-group-general {
        grid-template-columns: repeat(2, 1fr);
    }
    .card-group-service {
        grid-template-columns: repeat(2, 1fr);
    }
}

/* Large devices (tablets in landscape, small laptops) */
@media (max-width: 992px) {
    .about-our_story {
        flex-direction: column;
        gap: 20px;
    }
    .breadcrumb-container{
        display: flex;
        justify-content: center;
    }
    .about-image {
        width: 100%;
        img {
            width: 100%;
            object-fit: cover;
        }
    }

    .about-general .card-group-general {
        grid-template-columns: repeat(2, 1fr);
    }

    .about-service .card-group-service {
        grid-template-columns: repeat(2, 1fr);
    }

    .about-service .card-group-service > *:last-child {
        grid-column: span 2;
    }
}

/* Small devices (phones) */
@media (max-width: 768px) {
    .about-text {
        width: 100%;
        max-width: 100%;
    }
    .breadcrumb-container{
        display: flex;
        justify-content: center;
    }
    .about-image {
        width: 100%;
        img {
            width: 100%;
            object-fit: cover;
        }
    }

    .about-general .card-group-general {
        grid-template-columns: 1fr;
    }

    .about-service .card-group-service {
        grid-template-columns: 1fr;
    }

    .about-service .card-group-service > *:last-child {
        grid-column: span 1;
    }
}

/* Desktop small */
@media (min-width: 1025px) and (max-width: 1280px) {
    .breadcrumb-container{
        max-width: 1200px;
    }
    .about-our_story {
        max-width: 1230px;
    }
    .about-general {
        max-width: 1200px;
    }
}

/* Desktop medium */
@media (min-width: 1281px) and (max-width: 1440px) {
    .breadcrumb-container{
        max-width: 1300px;
    }
    .about-our_story {
        max-width: 1330px;
    }
    .about-general {
        max-width: 1300px;
    }
}

/* Desktop small big */
@media (min-width: 1441px) and (max-width: 1680px) {
    .breadcrumb-container{
        max-width: 1500px;
    }
    .about-our_story {
        max-width: 1580px;
    }
    .about-general {
        max-width: 1500px;
    }
}

/* Desktop big */
@media (min-width: 1681px) and (max-width: 1920px) {
    .breadcrumb-container{
        max-width: 1800px;
    }
    .about-our_story {
        max-width: 1830px;
    }
    .about-general {
        max-width: 1800px;
    }
}
</style>
