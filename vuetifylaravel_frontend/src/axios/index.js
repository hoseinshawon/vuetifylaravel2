import axios from 'axios';

const ax = axios.create({
    baseURL: 'http://127.0.0.1:8000/api/'
});

ax.interceptors.request.use(function (config) {

    const token = localStorage.getItem('token');

    if(token){
        config.headers.common['Authorization'] = `Bearer ${token}`;
    }

    return config;

  }, function (error) {

    return Promise.reject(error);
  });

  
export default ax;