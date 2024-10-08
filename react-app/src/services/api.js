// src/services/api.js
import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost:8000',
  headers: {
    'Content-Type': 'application/json',
  },
});

// Kullanıcıları çekmek için API fonksiyonu
export const fetchUsers = () => api.get('/users');

// Postları çekmek için API fonksiyonu
export const fetchPosts = () => api.get('/posts');

// Belirli bir postu silmek için API fonksiyonu
export const deletePost = (id) => api.delete(`/posts/${id}`);

export default api;
