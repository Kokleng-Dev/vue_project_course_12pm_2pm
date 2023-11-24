import axios from "axios";
import { getPath } from "./api";
import { base64Decode, base64Encode } from "./encryption";
import { alerts } from './alert.js'
// hello 

axios.defaults.baseURL = 'http://127.0.0.1:8000/api';
axios.defaults.headers.common['Authorization'] = base64Decode(localStorage.getItem('token'));
axios.defaults.headers.common['api_key'] = base64Encode('abc');
axios.defaults.headers.common['type'] = base64Encode('web');
axios.defaults.headers.post['Content-Type'] = 'multipart/form-data';

var lat = '';
var lng = '';

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
    console.log("Geolocation is not supported by this browser.");
    }
}

function showPosition(position) {
    lat = position.coords.latitude
    lng = position.coords.longitude
}

getLocation();

export const AxiosApp = {
    get : (key) => {

        return axios.get(`${getPath(key)}&lat=${lat}&lng=${lng}`);
    },
    post : async (key,data) => {
        const res = await axios.post(getPath(key), data);
        alerts({type : res.data.status == 'no_permission' ? 'warning' : res.data.status, sms : res.data.sms});
        return res;
    }
}