import { defineStore } from 'pinia';
export const useAuthStore = defineStore('auth', {
    state: () => ({}),
    getters: {},
    actions: {
        /**
         * Checks the validity of a JWT token.
         *
         * @function checkTokenValidity
         *         *
         * @returns {boolean} - Returns true if the token is valid, false otherwise.
         */
        checkTokenValidity(token) {
            try {
                const token = localStorage.getItem('token');

                if (!token) {
                    return false;
                }

                const payload = JSON.parse(atob(token.split('.')[1]));

                // Check if the token has expired (exp field)
                if (payload.exp * 1000 < Date.now()) {
                    return false;
                }

                return true;
            } catch (error) {
                return false;
            }
        }
    }
});
