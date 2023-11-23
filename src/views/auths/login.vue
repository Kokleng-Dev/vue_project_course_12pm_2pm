<template>
  <div class="hold-transition login-page bg-dark">
    <div class="login-box">
      <div class="card">
        <div class="card-header pb-2">
          <iframe 
            class="w-100" 
            frameborder="0" 
            :src="`https://maps.google.com/maps?q=${user.lat},${user.lng}&hl=es;z=20&amp;output=embed`">
          </iframe>
        </div>
        <div class="card-body login-card-body">
          <h2 class="login-box-msg">Login</h2>

          <form action="#" method="post" @submit.prevent="handleLogin()">
            <div class="input-group mb-3">
              <input type="email" class="form-control" placeholder="Email" v-model="user.email"/>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <p class="text-danger">{{ sms.email }}</p>
            <div class="input-group mb-3">
              <input
                type="password"
                class="form-control"
                placeholder="Password"
                v-model="user.password"
              />
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <p class="text-danger">{{ sms.password }}</p>
            <div class="row">
              <div class="col-12">
                <button :disabled="isAccess" type="submit" class="btn btn-primary btn-block">
                  <div v-if="isAccess" class="spinner-border text-light" role="status" style="width: 15px; height: 15px;">
                    <span class="sr-only">Loading...</span>
                  </div>
                  Login
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <TwoFactor :userId="userId"/>
</template>

<script setup>
import TwoFactor from '@/views/auths/two_factor.vue'
import { reactive, ref } from 'vue';
import { auth } from '../../stores/auth.js';
import { useRouter } from 'vue-router';
import { getCurrentInstance, onMounted } from 'vue';
import { usePermissionStore } from '../../stores/permission';


const app = getCurrentInstance();
const global =  app.appContext.config.globalProperties;
const http = app.appContext.config.globalProperties.$http;

const userId = ref('');
const router = useRouter();
const defineAuth = auth();
const isAccess = ref(false);
const permission = usePermissionStore();
const user = reactive({
  email : '',
  password : '',
  lat : '',
  lng : ''
})
const sms = reactive({
  email : '',
  password : '',
})

async function handleLogin(){
  isAccess.value = true;
  sms.email = '';
  sms.password = '';
  try {
    const { data } = await http.post('login',user);
    if(data.status == 'success'){
      permission.newPermission(data.permission);
      console.log(permission.role_permission);
      defineAuth.login(data);
      router.push('/');
    }else if(data.status == 'error'){
    } else if(data.status == 'is_two_factor'){
      userId.value = global.$base64Decode(data.user_id);
      $('#twoFactor').modal();
      global.$alert({
        type : 'success',
        sms : data.sms,
      })
    }
     else {
      if(data.errors.email){
        sms.email = data.errors.email[0];
      } 
      if(data.errors.password){
        sms.password = data.errors.password[0];
      }
    }
  } catch (error) {
    console.log(error)
  }
  isAccess.value = false;
}




 

function getLocation() {
  console.log('asda')
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    console.log("Geolocation is not supported by this browser.");
  }
}

function showPosition(position) {
  user.lat = position.coords.latitude
  user.lng = position.coords.longitude
}

onMounted(()=>{
  getLocation();
})

</script>

<style></style>
