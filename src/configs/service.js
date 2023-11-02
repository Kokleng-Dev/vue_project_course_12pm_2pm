import axios from "axios";
import { getPath } from "./api";
import { base64Decode, base64Encode } from "./encryption";
// hello 
axios.defaults.baseURL = 'http://127.0.0.1:8000/api';
axios.defaults.headers.common['Authorization'] = base64Decode(localStorage.getItem('token'));
axios.defaults.headers.common['api_key'] = base64Encode(123);
axios.defaults.headers.post['Content-Type'] = 'application/json';

export const AxiosApp = {
    get : (key) => {
        return axios.get(getPath(key));
    },
    post : (key,data) => {
        return axios.post(getPath(key), data);
    }
}