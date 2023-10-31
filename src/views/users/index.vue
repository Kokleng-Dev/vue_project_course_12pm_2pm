<template>
  <Master>
    <Header> 
      <h2>User Page</h2> 
    </Header>
    <Body>
      <h2>Store of counter is : {{  counterStore.doubleCount }}</h2>

      <p>Length : {{   counterStore.count.toString().length }}</p>

      <br>

      <router-link to="/login" class="btn btn-sm btn-danger">Go to Login</router-link>

    </Body>
  </Master>
</template>

<script setup>
import { useCounterStore } from '@/stores/counter.js'

const counterStore = useCounterStore();


</script>

<style>

</style>