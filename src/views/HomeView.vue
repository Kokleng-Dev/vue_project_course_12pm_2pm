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
      <button class="btn btn-primary" @click="fetchData()">Get Data</button>
      <br>
      <pre>
        {{ data }}
      </pre>
    </Body>
  </Master>
</template>

<script>
import { useCounterStore } from '@/stores/counter.js'
import axios from 'axios';
 export default {
  data(){
    return {
      counterStore : useCounterStore,
      data : [],
    }
  },
  methods: {
    async fetchData(){
      // this.data = await this.$http.get('product');
      // this.data = await axios.get('.....')
    }
  }
 }
</script>

<script setup>
import { getCurrentInstance, onMounted } from 'vue';

const app = getCurrentInstance();
const global =  app.appContext.config.globalProperties;
const http = app.appContext.config.globalProperties.$http;

async function getData(){
  const data = await http.post('login');

  console.log(data);
}

const e = global.$base64Encode([
  'hello',
  {id: 1, name : 'kokleng'}
]);
const d = global.$base64Decode(e);


// console.log(global.$base64Encode(123))
// console.log(e);
// console.log(d);

onMounted(()=>{
  // getData()
})
</script>
