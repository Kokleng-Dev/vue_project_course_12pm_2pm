<template>
    <Master>
      <Header> 
        <h2>Permission Feature Page</h2> 
      </Header>
      <Body>
        <div class="card">
            <div class="card-header">
                <h2>Permission : {{  permission.name }}</h2>
            </div>
            <div class="card-body">
            <router-link class="btn btn-danger mb-3 mr-2" :to="{ name : 'permission' }"><i class="fa fa-reply"></i> Back</router-link>
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
                <tr v-if="permission_features.length == 0">
                    <td colspan="4" class="text-center">No Data</td>
                </tr>
                <tr v-for="(permission_feature,index) in permission_features" :key="permission_feature.id">
                    <td>{{ index +1 }}</td>
                    <td>{{ permission_feature.name }}</td>
                    <td>{{ permission_feature.key }}</td>
                    <td>{{ permission_feature.note }}</td>
                    <td>
                    <button type="button" class="btn btn-sm btn-success mr-1" @click="handleEdit($event,permission_feature.id)">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-danger" @click="handleDelete($event,permission_feature.id)">
                        <i class="fa fa-trash"></i>
                    </button>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="row my-3" v-if="permission_features.length > 0">
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
        permission_features : [],
        edit : {},
        table : {},
        permission : {}
      }
    },
    methods :{
      async init(event = false, permission_feature_id = 0){
        try {
          const { data } = await this.$http.get(`permission_feature?permission_feature_id=${permission_feature_id}&permission_id=${this.$route.params.permission_id}`);
          if(permission_feature_id){
            $(event.target).attr('disabled',true);
            this.edit = data.data.permission_feature;
            this.edit.permission_feature_id = permission_feature_id;
            $(event.target).attr('disabled',false);
            $('#editModal').modal();
          } else {
            this.permission_features = data.data.permission_feature.data
            this.permission = data.data.permission;
            this.table = data.data.permission_feature;
  
          }
        } catch (error) {
          console.log(error)
        }
      },
      async handleEdit(event, permission_feature_id){
        try {
          await this.init(event,permission_feature_id);
        } catch (error) {
          
        }
      },
      async handleDelete(event, permission_feature_id){
        try {
          if(confirm('Are you sure ?')){
            $(event.target).attr('disabled',true);
            await this.$http.post(`delete_permission`,{ permission_feature_id : permission_feature_id });        
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
          const { data } = await this.$http.get(`permission_feature?${path}&permission_feature_id=0`);
          this.permission_features = data.data.permission_feature.data
          this.permission = data.data.permission;
          this.table = data.data.permission_feature;
  
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