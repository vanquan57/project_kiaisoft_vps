<template>
    <div class="not-found-container">
        <BreadcrumbComponent
            class="bread-crumb"
            :breadcrumbList="breadcrumbs"
        />
        <div class="not-found-content">
            <h1>404 Không tồn tại</h1>
            <p>Trang bạn đang tìm kiếm không tồn tại. Bạn có thể trở về trang chủ.</p>
            <router-link to="/"> Trở về trang chủ </router-link>
        </div>
    </div>
</template>


<script setup>
import BreadcrumbComponent from "@/components/Breadcrumb/BreadcrumbComponent.vue";

const breadcrumbs = [
    {
        name: "Trang chủ",
        path: "/",
    },

    {
        name: "404 Không tồn tại",
        path: "/404",
    },

];
</script>

<style lang="scss" scoped>
@import "@/assets/scss/_variables.scss";
.not-found-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    .bread-crumb {
        width: 100%;
        @media (min-width: 1024px) {
            margin-top: 60px;
            margin-bottom: 120px;
        }
    }

    .not-found-content {
        width: 100%;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        align-items: center;
        h1 {
            font-weight: 500;
            line-height: 115px;
            letter-spacing: 0.03em;
            margin: 0;
        }
        p {
            font-size: 16px;
            font-weight: 400;
            line-height: 24px;
            @media (min-width: 1024px) {
                margin-top: 40px;
            }
            text-align: center;

        }
        a {
            width: 215px;
            height: 56px;
            border-radius: 5px;
            background-color: $primary-color;
            border: none;
            font-size: 16px;
            font-weight: 500;
            color: $text-color-white;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;  
            @media (min-width: 1024px) {
                margin-top: 80px;
                margin-bottom: 140px;
            }
            margin-top: 50px;
            margin-bottom: 50px;
            &:hover {
                background-color: darken($primary-color, 10%);
            }

        }
    }
}
@media (min-width: 1201px) {
    .not-found-container {
        max-width: 1170px;
        margin: 0 auto;
    }
    .not-found-content {
        h1 {
            font-size: 110px;
        }
        p {
            font-size: 16px;
        }
    }
}
@media (max-width: 1200px) {
    .not-found-container {
        padding: 0 20px;
    }
    .not-found-content {
        h1 {
            text-align: center;
            font-size: 80px;
        }
        p {
            font-size: 14px;
        }
    }
}
@media (max-width: 992px) {
    .bread-crumb {
        display: flex;
        justify-content: center;
    }
}

/* Desktop small */
@media (min-width: 1025px) and (max-width: 1280px) {
    .bread-crumb {
        max-width: 1200px;
    }
    .not-found-content {
        max-width: 1200px;
    }
}

/* Desktop medium */
@media (min-width: 1281px) and (max-width: 1440px) {
    .bread-crumb {
        max-width: 1300px;
    }
    .not-found-content {
        max-width: 1300px;
    }
}

/* Desktop small big */
@media (min-width: 1441px) and (max-width: 1680px) {
    .bread-crumb {
        max-width: 1500px;
    }
    .not-found-content {
        max-width: 1500px;
    }
}

/* Desktop big */
@media (min-width: 1681px) and (max-width: 1920px) {
    .bread-crumb {
        max-width: 1800px;
    }
    .not-found-content {
        max-width: 1800px;
    }
}
</style>
