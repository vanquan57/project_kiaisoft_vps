<template>
    <div>
        <div class="contact-container">
            <BreadcrumbComponent
                class="breadcrumb-container"
                :breadcrumb-list="breadcrumbs"
            />
            <section class="contact-content">
                <div class="contact-content__left">
                    <div class="content-left__header">
                        <div class="header-title">
                            <span class="icon-box">
                                <IconPhone />
                            </span>
                            <h2>Gọi đến chúng tôi</h2>
                        </div>
                        <p>Chúng tôi hoạt động 24/7, 7 ngày một tuần.</p>
                        <p>Điện thoại: +8801611112222</p>
                    </div>
                    <div class="content-left__footer">
                        <div class="header-title">
                            <span class="icon-box">
                                <IconBoxMessage />
                            </span>
                            <h2>Gửi tin nhắn cho chúng tôi</h2>
                        </div>
                        <p>
                            Điền vào biểu mẫu của chúng tôi và chúng tôi sẽ liên hệ với bạn trong 24
                            giờ.
                        </p>
                        <p>dn.contact@kiaisoft.com</p>
                        <p>contact@kiaisoft.com</p>
                    </div>
                </div>
                <div class="contact-content__right">
                    <form class="contact-form">
                        <div class="group-form__input">
                            <div class="input-field__item">
                                <input
                                    type="text"
                                    placeholder="Họ tên"
                                    class="input-field"
                                >
                            </div>
                            <div class="input-field__item">
                                <input
                                    type="email"
                                    placeholder="Email"
                                    class="input-field"
                                >
                            </div>
                            <div class="input-field__item">
                                <input
                                    type="text"
                                    placeholder="Số điện thoại"
                                    class="input-field"
                                >
                            </div>
                        </div>
                        <div class="input-area">
                            <textarea
                                type="textarea"
                                placeholder="Tin nhắn"
                                class="input-field"
                            />
                        </div>
                        <div class="group-form__button">
                            <div>
                                <button class="btn-submit">
                                    Gửi tin nhắn
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</template>

<script setup>
import IconBoxMessage from '@/components/icons/IconBoxMessage.vue';
import IconPhone from '@/components/icons/IconPhone.vue';
import BreadcrumbComponent from '@/components/Breadcrumb/BreadcrumbComponent.vue';

const breadcrumbs = [
    {
        name: 'Home',
        path: '/'
    },
    {
        name: 'Liên hệ',
        path: '/contact'
    }
];
</script>

<style lang="scss" scoped>
@import "@/assets/scss/_variables.scss";
.contact-container {
    display: flex;
    flex-direction: column;
    box-sizing: border-box;
    margin: 0 auto;
    padding-bottom: 140px;
    .breadcrumb-container{
        margin: 60px 0;
    }
    .contact-content {
        width: 100%;
        display: grid;
        gap: 30px;
        .contact-content__left {
            display: flex;
            flex-direction: column;
            box-shadow: 0px 1px 13px 0px #0000000d;
            .content-left__header {
                position: relative;
            }

            .content-left__header::after {
                content: "";
                position: absolute;
                bottom: 0;
                width: 80%;
                left: 50%;
                transform: translateX(-50%);
                border-bottom: 1px solid $border-color;
            }
            .content-left__header {
                padding: 40px 35px 32px 35px;
            }
            .content-left__footer {
                padding: 40px 35px 51px 35px;
            }
            .content-left__header,
            .content-left__footer {
                .header-title {
                    display: flex;
                    align-items: center;
                    gap: 16px;
                    .icon-box {
                        width: 40px;
                        height: 40px;
                        border-radius: 100%;
                        background-color: $primary-color;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                    }
                    h2 {
                        font-size: clamp(14px, 1.2vw, 16px);
                        font-weight: 500;
                        line-height: 24px;
                        text-align: left;
                        font-family: Poppins, sans-serif;
                    }
                }
            }
            p {
                font-size: clamp(12px, 1.2vw, 14px);
                font-weight: 400;
                line-height: 21px;
                text-align: left;
                margin: 16px 0;
                font-family: Poppins, sans-serif;
            }
        }
        .contact-content__right {
            width: 100%;
            display: flex;
            flex-direction: column;
            box-shadow: 0px 1px 13px 0px #0000000d;
            .contact-form {
                width: 100%;
                display: flex;
                flex-direction: column;
                padding: 40px 32px;
                .group-form__input {
                    display: grid;
                    .input-field__item {
                        width: 100%;
                        input {
                            width: 100%;
                            font-size: clamp(14px, 1.2vw, 16px);
                            height: 40px;
                            border-radius: 5px;
                            border-radius: 5px;
                            border: 1px solid #e0e0e0;
                            background-color: $text-color-grown;
                            padding: 0 10px;
                            box-sizing: border-box;
                            font-family: Poppins, sans-serif;
                        }
                    }
                }
                .input-area {
                    width: 100%;
                    margin-top: 20px;
                    textarea {
                        width: 100%;
                        min-height: 200px;
                        font-size: clamp(14px, 1.2vw, 16px);
                        border-radius: 5px;
                        border: 1px solid #e0e0e0;
                        background-color: $text-color-grown;
                        padding: 10px;
                        box-sizing: border-box;
                        resize: none;
                        font-family: Poppins, sans-serif;
                    }
                }
                .group-form__button {
                    margin-top: 32px;
                    .btn-submit {
                        width: 215px;
                        height: 56px;
                        border-radius: 5px;
                        margin-left: calc(100% - 215px);
                        background-color: $primary-color;
                        border: none;
                        align-self: flex-end;
                        color: #fff;
                        &:hover {
                            background-color: darken($primary-color, 10%);
                        }
                    }
                }
            }
        }
    }
}

@media (min-width: 1201px) {
    .contact-container {
        max-width: 1170px !important;
    }
    .contact-content {
        grid-template-columns: 3fr 7fr;
    }
    .group-form__input {
        grid-template-columns: 1fr 1fr 1fr;
        gap: 20px;
    }
}

/* Extra large devices (large laptops, desktops) */
@media (max-width: 1200px) {
    .contact-content {
        grid-template-columns: 3fr 7fr;
    }
    .group-form__input {
        grid-template-columns: 1fr 1fr 1fr;
    }
}

/* Large devices (tablets in landscape, small laptops) */
@media (max-width: 992px) {
    .contact-content {
        grid-template-columns: 1fr;
    }
    .breadcrumb-container{
        padding: 0 20px;
    }
    .group-form__input {
        grid-template-columns: 1fr;
        .input-field__item {
            margin: 10px 0;
        }
    }
    .input-area {
        margin-top: 20px;
    }
    .group-form__button{
        margin-top: 20px;
        .btn-submit {
            width: 100% !important;
            margin-left: 0 !important;
        }
    }

}

/* Small devices (phones) */
@media (max-width: 768px) {
    .contact-container {
        grid-template-columns: 1fr;
    }
    .group-form__input {
        grid-template-columns: 1fr;
    }
}

/* Desktop small */
@media (min-width: 1025px) and (max-width: 1280px) {
    .contact-container{
        max-width: 1200px;
    }
}

/* Desktop medium */
@media (min-width: 1281px) and (max-width: 1440px) {
    .contact-container{
        max-width: 1300px;
    }
}

/* Desktop small big */
@media (min-width: 1441px) and (max-width: 1680px) {
    .contact-container{
        max-width: 1500px;
    }
}

/* Desktop big */
@media (min-width: 1681px) and (max-width: 1920px) {
    .contact-container{
        max-width: 1800px;
    }
}
</style>
