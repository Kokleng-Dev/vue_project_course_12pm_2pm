<template>
  <router-view></router-view>
</template>

<script>

</script>
<!-- <script setup>
import { onMounted } from 'vue';
import { auth } from './stores/auth';
import { useRouter } from 'vue-router';

const router = useRouter();
const defineAuth = auth();

onMounted(()=>{
  console.log(defineAuth.init());
  if(defineAuth.init()){
    router.push('/')
  } else {
    router.push('/login')
  }
})
</script> -->

<style>

</style>