import { defineStore } from 'pinia'
import { reactive, ref , computed} from 'vue'
import { useRouter } from 'vue-router';
import { base64Encode, base64Decode } from '../configs/encryption';
import axios from 'axios';
import { usePermissionStore } from './permission';

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
            localStorage.setItem('permissions', base64Encode(data.permission));
            axios.defaults.headers.common['Authorization'] = token.value;
            axios.defaults.headers.common['user_id'] = data.data.user.id;
            
        }
    }

    function init(){
        if(localStorage.getItem('token') && localStorage.getItem('auth')){
            const permission = usePermissionStore();
            token.value = base64Decode(localStorage.getItem('token'));
            auth.value = base64Decode(localStorage.getItem('auth'));
            permission.newPermission(base64Decode(localStorage.getItem('permissions')));
            isAuth.value = true
            axios.defaults.headers.common['Authorization'] = token.value;
            axios.defaults.headers.common['user_id'] = auth.value.id;
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