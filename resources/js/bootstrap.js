import axios from 'axios';

// Create axios instance
window.axios = axios.create({
    baseURL: '/',
    timeout: 10000,
    headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json'
    }
});

// Add CSRF token to all requests
const token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
}

// Add authorization header if logged in
if (localStorage.getItem('token')) {
    window.axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`;
}

// Response interceptors
window.axios.interceptors.response.use(
    response => response,
    error => {
        if (error.response && error.response.status === 401) {
            // Handle unauthorized access
            window.location.href = '/login';
        }
        
        if (error.response && error.response.status === 419) {
            // CSRF token mismatch - refresh page
            window.location.reload();
        }
        
        return Promise.reject(error);
    }
);