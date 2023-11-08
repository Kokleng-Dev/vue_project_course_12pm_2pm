<template>
    <Master>
      <Header> 
        <h2>Permission Page</h2> 
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
                  <th>Note</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-if="permissions.length == 0">
                    <td colspan="4" class="text-center">No Data</td>
                </tr>
                <tr v-for="(permission,index) in permissions" :key="permission.id">
                  <td>{{ index +1 }}</td>
                  <td>{{ permission.name }}</td>
                  <td>{{ permission.key }}</td>
                  <td>{{ permission.note }}</td>
                  <td>
                    <router-link :to="{ name : 'permission_feature', params : { permission_id : permission.id } }" class="btn btn-warning btn-sm mr-1"> <i class="fa fa-eye"></i> </router-link>
                    <button type="button" class="btn btn-sm btn-success mr-1" @click="handleEdit($event,permission.id)">
                      <i class="fa fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-danger" @click="handleDelete($event,permission.id)">
                      <i class="fa fa-trash"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
            <div class="row my-3" v-if="permissions.length > 0">
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
        permissions : [],
        edit : {},
        table : {}
      }
    },
    methods :{
      async init(event = false, permission_id = 0){
        try {
          const { data } = await this.$http.get(`permission?permission_id=${permission_id}`);
          if(permission_id){
            $(event.target).attr('disabled',true);
            this.edit = data.data.permission;
            this.edit.permission_id = permission_id;
            $(event.target).attr('disabled',false);
            $('#editModal').modal();
          } else {
            this.permissions = data.data.permission.data
  
            this.table = data.data.permission;
  
          }
        } catch (error) {
          console.log(error)
        }
      },
      async handleEdit(event, permission_id){
        try {
          await this.init(event,permission_id);
        } catch (error) {
          
        }
      },
      async handleDelete(event, permission_id){
        try {
          if(confirm('Are you sure ?')){
            $(event.target).attr('disabled',true);
            await this.$http.post(`delete_permission`,{ permission_id : permission_id });        
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
          const { data } = await this.$http.get(`permission?${path}&permission_id=0`);
          this.permissions = data.data.permission.data
          this.table = data.data.permission;
  
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