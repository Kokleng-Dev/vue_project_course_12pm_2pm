import axios from "axios";
import { getPath } from "./api";

axios.defaults.baseURL = 'https://fakestoreapi.com/api';
axios.defaults.headers.common['Authorization'] = 'Bearer';
axios.defaults.headers.post['Content-Type'] = 'application/json';

export const AxiosApp = {
    get : (key) => {
        return axios.get(getPath(key));
    },
    post : (key,data) => {
        return axios.post(getPath(key), data);
    }
}