<template>
    <header class="top-bar">
        <div class="top-bar-left">
            <div class="top-bar-icon_left">
                <button>
                    <component :is="IconHamb" />
                </button>
            </div>
            <form
                class="search-form"
                role="search"
            >
                <component :is="IconSearch" />
                <input
                    id="search-input"
                    type="search"
                    class="search-input"
                    placeholder="Tìm kiếm ..."
                >
            </form>
        </div>
        <div class="user-controls">
            <button class="btn-bell">
                <p class="total-notification">
                    9
                </p>
                <component :is="IconBell" />
            </button>
            <div class="language-selector">
                <img
                    :src="images.flag"
                    alt="Language flag"
                    class="language-flag"
                >
                <select>
                    <option value="vi">
                        Vietnamese
                    </option>
                    <option value="en">
                        English
                    </option>
                    <option value="jp">
                        Japanese
                    </option>
                </select>
            </div>
            <div
                class="user-profile"
                @click="showPopup"
            >
                <img
                    :src="images.imgProfile"
                    alt="User avatar"
                    class="user-avatar"
                >
                <div class="user-info">
                    <h5 class="user-name">
                        Moni Roy
                    </h5>
                    <span class="user-role">Admin</span>
                </div>
                <button class="btn-profile-menu-icon">
                    <img
                        src="https://cdn.builder.io/api/v1/image/assets/TEMP/b20169eda56be3aa0d5a801d2c4bcc650bc2f445c19e2b878c9b494edee515d8?placeholderIfAbsent=true&apiKey=4255145e56f84e14926ae9843aa02290"
                        alt="Profile menu"
                        :class="['profile-menu-icon', { rotate: isActive }]"
                    >
                </button>
                <div
                    v-if="isActive"
                    class="user-profile-popup"
                >
                    <ul class="list-profile-options">
                        <li>
                            <component :is="IconSetting" />
                            <a href="#">Change Password</a>
                        </li>
                        <li @click="handleLogout">
                            <component :is="IconLogout" />
                            <a href="#">Log out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
</template>

<script setup>
import images from '@/assets/images';
import { ref } from 'vue';
import IconLogout from '@/components/icons/IconLogout.vue';
import IconSetting from '@/components/icons/IconSetting.vue';
import IconBell from '@/components/icons/IconBell.vue';
import IconHamb from '@/components/icons/IconHamb.vue';
import IconSearch from '@/components/icons/IconSearch.vue';
const isActive = ref(false);
const emit = defineEmits(['logout']);
/**
 * Toggles the visibility of the popup by changing the value of `isActive`.
 * When called, it inverts the current boolean value of `isActive`.
 */
const showPopup = () => {
    isActive.value = !isActive.value;
};

const handleLogout = () => {
    emit('logout');
};
</script>

<style lang="scss" scoped>
.top-bar {
    width: 100%;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-sizing: border-box;
    padding: 0 20px;

    .top-bar-left {
        display: flex;
        align-items: center;
        .top-bar-icon_left {
            margin-right: 20px;
            button {
                background-color: transparent;
                border: none;
            }
            button:hover {
                background-color: #f5f6fa;
                cursor: pointer;
            }
        }
    }
    .search-form {
        position: relative;
        display: flex;
        align-items: center;
        svg {
            position: absolute;
            top: 50%;
            z-index: 1;
            transform: translateY(-50%);
            right: 15px;
            color: #202224;
        }
        input {
            width: 100%;
            height: 40px;
            border: 1px solid #e0e0e0;
            width: 388px;
            height: 38px;
            border-radius: 19px;
            background-color: #f5f6fa;
            letter-spacing: 0.3142857255935669px;
            color: #202224;
            padding: 0px 40px;
        }
        input:focus {
            outline: none;
        }
    }
    .user-controls {
        display: flex;
        align-items: center;
        gap: 20px;
        .btn-bell {
            position: relative;
        }
        .total-notification {
            padding: 5px 8px;
            position: absolute;
            top: -10px;
            right: -15px;
            font-size: 10px;
            background-color: #ff4d4f;
            color: white;
            border-radius: 100%;
        }
        button {
            background-color: transparent;
            border: none;
            margin-right: 20px;
            animation: bell_animation 0.5s infinite;
        }
        button:hover {
            cursor: pointer;
        }
        @keyframes bell_animation {
            0% {
                transform: rotate(10deg);
            }

            50% {
                transform: translateY(-10deg);
            }

            100% {
                transform: translateY(0deg);
            }
        }
        .language-selector {
            display: flex;
            align-items: center;
            gap: 11px;
            color: #646464;
            select {
                background-color: transparent;
                border: none;
                outline: none;
            }
            select:focus {
                outline: none;
            }
        }
        .user-profile {
            display: flex;
            position: relative;
            gap: 10px;
            .user-info {
                display: flex;
                flex-direction: column;
                justify-content: center;
                span {
                    font-size: 12px;
                    line-height: 16.37px;
                    letter-spacing: 0.2571428120136261px;
                    color: #202224;
                    opacity: 0.6;
                }
            }
            .btn-profile-menu-icon {
                background-color: transparent;
                border: none;
                .profile-menu-icon {
                    transition: transform 0.5s ease;
                }
                .profile-menu-icon.rotate {
                    transform: rotate(180deg);
                }
            }
            .user-profile-popup {
                position: absolute;
                top: 50px;
                right: 40px;
                z-index: 10;
                background-color: #ffffff;
                width: 200px;
                border-radius: 10px;
                box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
                .list-profile-options {
                    width: 100%;
                    height: 100%;
                    li {
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        padding: 10px 10px;
                        border-bottom: 1px solid #f5f6fa;
                        svg {
                            width: 18px;
                            height: 18px;
                            margin-right: 10px;
                            object-fit: contain;
                        }
                        a {
                            flex: 1;
                            font-family: "Nunito Sans", sans-serif;
                            font-size: 14px;
                            line-height: 19.1px;
                            text-align: left;
                            text-decoration: none;
                            color: #202224;
                        }
                    }
                    li:hover {
                        background-color: #f5f6fa;
                        cursor: pointer;
                    }
                    li:first-child {
                        border-top-left-radius: 10px;
                        border-top-right-radius: 10px;
                    }
                    li:last-child {
                        border-bottom-left-radius: 10px;
                        border-bottom-right-radius: 10px;
                        border-bottom: none;
                    }
                }
            }
        }
    }
}
svg {
    width: 24px;
    height: 24px;
}
</style>
