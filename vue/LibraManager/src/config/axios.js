import axios from 'axios';
import HTTP_STATUS_CODE from './statusCode';

const axiosInstance = axios.create({
    baseURL: import.meta.env.VITE_URL_BACKEND,
    timeout: 10000,
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    }
});

axiosInstance.interceptors.request.use(
    async config => {
        const token = localStorage.getItem('token');
        if (token) {
            config.headers.Authorization = `Bearer ${token}`;
        }
        return config;
    },
    error => {
        return Promise.reject(error);
    }
);

axiosInstance.interceptors.response.use(
    response => {
        return response;
    },
    error => {
        if (error.response.status === HTTP_STATUS_CODE.HTTP_UNAUTHORIZED && error.response.config.url !== '/auth/login') {
            window.location.href = '/auth/login';
            localStorage.removeItem('token');
        }

        return Promise.reject(error.response);
    }
);

export default axiosInstance;
