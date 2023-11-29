<template>
    <Master>
      <Header> 
        <h2>Student Page / Edit</h2> 
      </Header>
      <Body>
        <form @submit.prevent="handleSubmit($event)">
            <div class="row">
                <div class="col-4">
                    <label>Name</label>
                    <input type="text" class="form-control" v-model="form.name">
                </div>
                <div class="col-4">
                    <label>Age</label>
                    <input type="text" class="form-control" v-model="form.age">
                </div>
            </div>
             <button class="btn btn-primary mt-2" type="submit">Submit</button>
        </form>
      </Body>
    </Master>
  </template>
  
  <script setup>
import axios from 'axios';
import { onMounted, reactive } from 'vue';
import { AxiosApp } from '@/configs/service.js'
import { useRoute, useRouter } from 'vue-router';

const route = useRouter();
const router = useRoute();

    const form = reactive({
        name : '',
        age : '',
        id : 0
    })
    async function handleSubmit(e){
        const { data } = await AxiosApp.post('update_student', {...form});
        if(data.status == 'success'){
            route.push({ name : "student"});
        }
    }

    async function init(){
        try {
          const { data } = await AxiosApp.get(`edit_student?id=${router.params.student_id}`);

          form.name = data.data.student.name
          form.age = data.data.student.age
          form.id = data.data.student.id
        } catch (error) {
          console.log(error)
        }
    }

    onMounted(() => {
        init();
    })
</script>
