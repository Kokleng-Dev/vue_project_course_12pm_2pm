import { defineStore } from 'pinia'
import { reactive, ref , computed} from 'vue'
import { useRouter } from 'vue-router';
import { base64Encode, base64Decode } from '../configs/encryption';
import axios from 'axios';

// composition api
export const auth = defineStore('auth', () => {
    const router = useRouter();
    const isAuth = ref(false);
    const auth = ref({});
    const token = ref('Bearer');

    function login(data){
        if(data.status == 'success'){
            auth.value = data.data.user;
            token.value = `Bearer ${data.data.token}`;
            isAuth.value = true

            localStorage.setItem('token', base64Encode(token.value));
            localStorage.setItem('auth', base64Encode(auth.value));
            axios.defaults.headers.common['Authorization'] = token.value;
        }
    }

    function init(){
        if(localStorage.getItem('token') && localStorage.getItem('auth')){
            token.value = base64Decode(localStorage.getItem('token'));
            auth.value = base64Decode(localStorage.getItem('auth'));
            isAuth.value = true
            axios.defaults.headers.common['Authorization'] = token.value;
            return 
        }
        isAuth.value = false
    }

    function logout(){
        localStorage.removeItem('token');
        localStorage.removeItem('auth');


        isAuth.value = false;
        auth.value = {};
        token.value = 'Bearer';

        router.push('/login');
    }

    const tokenBearer = function(){
        return token.value
    }


    return { isAuth, login , logout, init, tokenBearer}
})


// option api 

// export const auth = defineStore('auth',{
//     state : () => ( {
//         isAuth : false,
//         $router : useRouter(),
//         user : {}
//     }),
//     getters : {

//     },
//     actions : {
//         login(){
//             this.isAuth = true;
//             this.user = {
//                 id : 1,
//                 name : 'kokleng'
//             }
//             this.$router.push('/')
//         },
//         logout(){
//             this.isAuth = false;
//             this.user = {};
//             this.$router.push('/login')
//         }
//     }
// })