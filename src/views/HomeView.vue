<template>
   <Master>
    <!-- <template v-slot:header>
      <h2>Header</h2>
    </template>
    <template v-slot:body>
    </template> -->
    <Header> 
      <h2>Home Page</h2> 
    </Header>
    <Body>

      {{ counterStore().count  }}

      <button @click="counterStore().count++">+</button>

      <br>
      <router-link to="/login" class="btn btn-sm btn-danger">Go to Login</router-link>
    </Body>
  </Master>
</template>

<script>
import { useCounterStore } from '@/stores/counter.js'
 export default {
  data(){
    return {
      counterStore : useCounterStore
    }
  },
 }
</script>

<style>

</style>