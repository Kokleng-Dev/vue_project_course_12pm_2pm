<template>
    <Master>
      <Header> 
        <h2>Api Key Page</h2> 
      </Header>
      <Body>
        <div class="card">
          <div class="card-body">
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#createModal">
              <i class="fa fa-plus"></i> Create
            </button>
            <table class="table table-bordered table-sm table hover">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Key</th>
                  <th>Api Key</th>
                  <th>Note</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(api_key,index) in api_keys" :key="api_key.id">
                  <td>{{ index +1 }}</td>
                  <td>{{ api_key.name }}</td>
                  <td>{{ api_key.key }}</td>
                  <td>{{ api_key.api_key }}</td>
                  <td>{{ api_key.note }}</td>
                  <td>{{ api_key.status == 0 ? 'inactive' : 'active' }}</td>
                  <td>
                    <button type="button" class="btn btn-sm btn-success mr-1" @click="handleEdit($event,api_key_id)">
                      <i class="fa fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-danger" @click="handleDelete($event,api_key_id)">
                      <i class="fa fa-trash"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
            <div class="row my-3">
              <div class="col-12">
                <nav aria-label="Page navigation">
                  <ul class="pagination float-right pagination-sm">
                    <li :class="`page-item ${link.active == true ? 'active' : ''} ${link.url == null ? 'disabled' : ''}`" v-for="(link,index) in table.links" :key="`${index}${table.current_page}`" @click="changePage(link)">
                      <button type="button" class="page-link">
                        <span v-html="link.label"></span>
                      </button>
                    </li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>
        <CreateUser @reloadPage="init()"/>
        <EditUser :form="edit" @reloadPage="init()"/>
      </Body>
    </Master>
  </template>
  
  <script>
  import CreateUser from './create.vue'
  import EditUser from './edit.vue'
  
  export default {
    components : {
      CreateUser , EditUser
    },
    data(){
      return {
        api_keys : [],
        edit : {},
        table : {}
      }
    },
    methods :{
      async init(event = false, api_key_id = 0){
        try {
          const { data } = await this.$http.get(`api_key?api_key_id=${api_key_id}`);
          if(api_key_id){
            $(event.target).attr('disabled',true);
            this.edit = data.data.api_key;
            this.edit.api_key_id = api_key_id;
            $(event.target).attr('disabled',false);
            $('#editModal').modal();
          } else {
            this.api_keys = data.data.api_key.data
  
            this.table = data.data.api_key;
  
          }
        } catch (error) {
          console.log(error)
        }
      },
      async handleEdit(event, api_key_id){
        try {
          await this.init(event,api_key_id);
        } catch (error) {
          
        }
      },
      async handleDelete(event, api_key_id){
        try {
          if(confirm('Are you sure ?')){
            $(event.target).attr('disabled',true);
            await this.$http.post(`delete_api_key`,{ api_key_id : api_key_id });        
            await this.init();
          }
        } catch (error) {
          $(event.target).attr('disabled',false);
        }
      },
      async changePage(link){
        try {
          if(link.url == null) return ;
  
          const path = link.url.split('?')[1];
          const { data } = await this.$http.get(`api_key?${path}&rold_id=0`);
          this.api_keys = data.data.api_key.data
          this.table = data.data.api_key;
  
        } catch (error) {
            console.log(error);
        }
      }
    },
    mounted(){
      this.init();
    }
  }
  </script>
  
  <style>
  
  </style>