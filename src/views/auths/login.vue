<template>
  <div class="hold-transition login-page bg-dark">
    <div class="login-box">
      <div class="card">
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
</template>

<script setup>
import { reactive, ref } from 'vue';
import { auth } from '../../stores/auth.js';
import { useRouter } from 'vue-router';
import { getCurrentInstance, onMounted } from 'vue';


const app = getCurrentInstance();
const global =  app.appContext.config.globalProperties;
const http = app.appContext.config.globalProperties.$http;

const router = useRouter();
const defineAuth = auth();
const isAccess = ref(false);
const user = reactive({
  email : '',
  password : ''
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
      defineAuth.login(data);
      global.$alert({
        type : 'success',
        sms : data.sms,
      })
      router.push('/');
    }else if(data.status == 'error'){
      global.$alert({
        type : 'error',
        sms : data.sms,
      })
    } else {
      if(data.errors.email){
        sms.email = data.errors.email[0];
      } 
      if(data.errors.password){
        sms.password = data.errors.password[0];
      }
      global.$alert({
        type : 'warning',
        sms : data.sms,
      })
    }
  } catch (error) {
    console.log(error)
  }
  isAccess.value = false;
}

</script>

<style></style>
