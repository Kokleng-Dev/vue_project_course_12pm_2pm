import { defineStore } from 'pinia'
import { ref } from 'vue'
import { useRouter } from 'vue-router';


// composition api
// export const auth = defineStore('auth', () => {
//     const router = useRouter();
//     const isAuth = ref(false);
//     const auth = ref({});

//     function login(){
//         isAuth.value = true
//         router.push('/');
//     }

//     function logout(){
//         isAuth.value = false
//         router.push('/login');
//     }


//     return { isAuth, login , logout}
// })


// option api 

export const auth = defineStore('auth',{
    state : () => ( {
        isAuth : false,
        $router : useRouter(),
        user : {}
    }),
    getters : {

    },
    actions : {
        login(){
            this.isAuth = true;
            this.user = {
                id : 1,
                name : 'kokleng'
            }
            this.$router.push('/')
        },
        logout(){
            this.isAuth = false;
            this.user = {};
            this.$router.push('/login')
        }
    }
})