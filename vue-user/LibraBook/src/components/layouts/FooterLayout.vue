<template>
    <footer class="main-footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3 class="footer-logo">
                    Độc Quyền
                </h3>
                <h4 class="footer-subtitle">
                    Đăng Ký Nhận Thông Tin
                </h4>
                <p class="footer-text">
                    Nhận ngay giảm giá 10% cho đơn hàng đầu tiên
                </p>
                <form class="footer-form">
                    <input
                        id="footer-email"
                        type="email"
                        placeholder="Nhập email của bạn"
                        class="footer-input"
                    >
                    <button
                        type="submit"
                        class="footer-submit"
                        aria-label="Submit email"
                    >
                        <IconSend />
                    </button>
                </form>
            </div>
            <div class="footer-section">
                <h4 class="footer-title">
                    Hỗ Trợ
                </h4>
                <address class="footer-address">
                    Tầng 3, Tòa nhà Ricco, 363 Nguyễn Hữu Thọ, Khuê Trung, Quận Cẩm Lệ, Đà Nẵng
                </address>
                <a
                    href="#"
                    class="footer-link"
                >dn.contact@kiaisoft.com</a>
                <a
                    href="#"
                    class="footer-link"
                >(+84) 982-851-486</a>
            </div>
            <div class="footer-section">
                <h4 class="footer-title">
                    Tài Khoản
                </h4>
                <nav class="footer-nav">
                    <ul>
                        <li>
                            <router-link
                                to="/account"
                                class="footer-link"
                            >
                                Tài Khoản Của Tôi
                            </router-link>
                        </li>
                        <li>
                            <router-link
                                to="/auth/login"
                                class="footer-link"
                            >
                                Đăng Nhập / Đăng Ký
                            </router-link>
                        </li>
                        <li>
                            <router-link
                                to="/cart"
                                class="footer-link"
                            >
                                Giỏ Hàng
                            </router-link>
                        </li>
                        <li>
                            <router-link
                                to="/wishlist"
                                class="footer-link"
                            >
                                Danh Sách Yêu Thích
                            </router-link>
                        </li>
                        <li>
                            <router-link
                                to="/"
                                class="footer-link"
                            >
                                Cửa Hàng
                            </router-link>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="footer-section">
                <h4 class="footer-title">
                    Liên Kết Nhanh
                </h4>
                <nav class="footer-nav">
                    <ul>
                        <li>
                            <a
                                href="#"
                                class="footer-link"
                            >Chính Sách Bảo Mật</a> 
                        </li>
                        <li>
                            <a
                                href="#"
                                class="footer-link"
                            >Điều Khoản Sử Dụng</a>
                        </li>
                        <li>
                            <a
                                href="#"
                                class="footer-link"
                            >Câu Hỏi Thường Gặp (FAQ)</a>
                        </li>
                        <li>
                            <router-link
                                to="/contact"
                                class="footer-link"
                            >
                                Liên Hệ
                            </router-link>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="footer-section">
                <h4 class="footer-title">
                    Tải Ứng Dụng
                </h4>
                <p class="app-promo">
                    Tiết kiệm 3 USD dành riêng cho người dùng mới trên ứng dụng
                </p>
                <div class="app-download">
                    <img
                        :src="images.qrCode"
                        alt="Mã QR để tải ứng dụng"
                        class="qr-code"
                    >
                    <div class="app-stores">
                        <img
                            :src="images.appStore"
                            alt="Tải trên App Store"
                            class="app-store-badge"
                        >
                        <img
                            :src="images.googlePlay"
                            alt="Tải trên Google Play"
                            class="play-store-badge"
                        >
                    </div>
                </div>
                <div class="social-links">
                    <a
                        href="#"
                        aria-label="Facebook"
                    ><IconFacebook /></a>
                    <a
                        href="#"
                        aria-label="Twitter"
                    >
                        <IconTwitter />
                    </a>
                    <a
                        href="#"
                        aria-label="Instagram"
                    >
                        <IconInstagram />
                    </a>
                    <a
                        href="#"
                        aria-label="LinkedIn"
                    ><IconLinkedin /> </a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p class="copyright">
                BẢN QUYỀN © 2019 KIAISOFT CO., LTD. MỌI QUYỀN ĐƯỢC BẢO LƯU.
            </p>
        </div>
    </footer>
</template>

<script setup>
import images from '@/assets/images';
import IconFacebook from '@/components/icons/IconFacebook.vue';
import IconInstagram from '@/components/icons/IconInstagram.vue';
import IconLinkedin from '@/components/icons/IconLinkedin.vue';
import IconTwitter from '@/components/icons/IconTwitter.vue';
import IconSend from '@/components/icons/IconSend.vue';
</script>

<style lang="scss" scoped>
@import "@/assets/scss/_variables.scss";
.main-footer {
    background: var(--Button, rgba(255, 69, 0, 0.78));
    color: #fafafa;
    width: 100%;
    padding: 40px 0px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    .footer-content {
        display: grid;
        width: 100%;
        margin: 0 auto;
        justify-content: space-between;
        gap: 20px;
        .footer-section {
            flex: 1;
            min-width: 200px;
            .footer-logo {
                font: 700 24px/1 Inter, sans-serif;
                margin-bottom: 24px;
            }

            .footer-subtitle {
                font: 500 20px/1.4 Poppins, sans-serif;
                margin-bottom: 24px;
            }

            .footer-text {
                font: 400 16px Poppins, sans-serif;
                margin-bottom: 16px;
            }

            .footer-form {
                display: flex;
                border: 1.5px solid #fafafa;
                border-radius: 4px;
                position: relative;
                .footer-input {
                    flex-grow: 1;
                    background: transparent;
                    border: none;
                    outline: none;
                    padding: 12px 16px;
                    color: #fafafa;
                    font: 400 16px Poppins, sans-serif;
                    &::placeholder {
                        color: #fafafa;
                    }
                }

                .footer-submit {
                    position: absolute;
                    right: 5px;
                    top: 50%;
                    transform: translateY(-50%);
                    background: transparent;
                    border: none;
                    padding: 12px;
                    cursor: pointer;
                }
            }
            .footer-title {
                font: 500 20px/1.4 Poppins, sans-serif;
                margin-bottom: 24px;
            }
            .footer-address,
            .footer-link {
                display: block;
                font: 400 16px Poppins, sans-serif;
                margin-bottom: 16px;
                color: #fafafa;
                text-decoration: none;
            }
            .footer-nav ul {
                list-style: none;
                padding: 0;
            }
            .app-promo {
                font: 500 12px Poppins, sans-serif;
                margin-bottom: 8px;
            }

            .app-download {
                display: flex;
                gap: 8px;
                margin-bottom: 24px;
                .qr-code {
                    width: 80px;
                    height: 80px;
                }

                .app-stores {
                    display: flex;
                    flex-direction: column;
                    gap: 4px;
                    .app-store-badge,
                    .play-store-badge {
                        width: 150px;
                        height: 40px;
                        object-fit: contain;
                    }
                }
            }
            .social-links {
                display: flex;
                gap: 24px;
                .social-icon {
                    width: 24px;
                    height: 24px;
                }
            }
        }
    }
    .footer-bottom {
        margin-top: 20px;
        padding-top: 16px;
        .copyright {
            display: flex;
            align-items: center;
            justify-content: center;
            font: 400 16px Poppins, sans-serif;
            .copyright-icon {
                width: 20px;
                height: 20px;
                margin-right: 6px;
            }
        }
    }
}

/* Mobile */
@media (max-width: 576px) {
    .footer-content {
        grid-template-columns: repeat(1, 1fr);
        gap: 20px;
        padding: 0 20px;
        .footer-section{
            text-align: center;
        }
        .app-download {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .social-links {
            justify-content: center;
        }

    }
    .footer-bottom {
        padding: 0 20px;
        text-align: center;
    }
}

/* Tablet small */
@media (min-width: 577px) and (max-width: 768px) {
    .footer-content {
        max-width: 600px;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
}

/* Desktop medium */
@media (min-width: 769px) and (max-width: 1024px) {
    .footer-content {
        max-width: 900px;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        padding: 0 20px;
    }
}
@media (min-width: 1024px) {
    .footer-content  {
        max-width: 1170px;
        grid-template-columns: repeat(4, 1fr);

    }
}
@media (min-width: 1279px) {
    .footer-content  {
        max-width: 1170px;
        grid-template-columns: repeat(5, 1fr);

    }
}
</style>
