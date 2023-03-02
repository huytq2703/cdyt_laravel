import axios from "axios";
import NProgress from 'nprogress'

export const AxiosInstance = axios.create({
    // baseURL: "https://www.dmc.edu.vn/api"
    baseURL: import.meta.env.VITE_API_URL,
    // timeout: 1000,
    // headers: {
    //   "any-thing": "any",
    //   Authorization: "Bearer token",
    // },
  });

  AxiosInstance.interceptors.request.use(
    (request) => {
      // Do something before request is sent
      NProgress.start();
      return request;
    },
    (error) => {
      // Do something with request error

      return Promise.reject(error);
    }
  );

  AxiosInstance.interceptors.response.use(
    (response) => {
      // Any status code that lie within the range of 2xx cause this function to trigger
      // Do something with response data
      // Disable loading
      NProgress.done();
      return response;
    },
    (error) => {
      // Any status codes that falls outside the range of 2xx cause this function to trigger
      // Do something with response error
      NProgress.done();
      return Promise.reject(error);
    }
  );
