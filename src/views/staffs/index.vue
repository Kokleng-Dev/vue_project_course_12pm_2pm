<template>
    <Master>
      <Header> 
        <h2>Staff Page</h2> 
      </Header>
      <Body>
        <div class="card">
          <div class="card-body" v-if="is_permission">
            No Permission
          </div>
          <div class="card-body" v-else>
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#createModal">
              <i class="fa fa-plus"></i> Create
            </button>
            <table class="table table-sm table hover" >
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(staff,index) in staffs" :key="staff.id">
                    <td>{{ index +1 }}</td>
                    <td>{{ staff.name }}</td>
                    <td>{{ staff.phone }}</td>
                    <td>
                      <button type="button" class="btn btn-sm btn-success mr-1" @click="handleEdit($event,staff.id)">
                        <i class="fa fa-edit"></i>
                      </button>
                      <button type="button" class="btn btn-sm btn-danger" @click="handleDelete($event,user.id)">
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
        <EditUser :form="edit" :roles="roles" @reloadPage="init()"/>
      </Body>
    </Master>
  </template>
  
  <script>
  import CreateUser from './create.vue'
  import EditUser from './edit.vue'
  import { usePermissionStore } from '../../stores/permission'
  
  export default {
    components : {
      CreateUser , EditUser
    },
    data(){
      return {
        staffs : [],
        edit : {},
        roles: [],
        table : {},
        is_permission : false
      }
    },
    methods :{
      async init(event = false, staff_id = 0){
        try {
          const { data } = await this.$http.get(`staff?staff_id=${staff_id}`);
          if(data.status == 'no_permission'){
            this.is_permission = true;
            this.$alert({ type : 'error', sms : data.sms })
          } else {
            this.is_permission = false;
            const permission = usePermissionStore();
            permission.setPermission(data.permission);
            if(staff_id){
              $(event.target).attr('disabled',true);
              this.edit = data.data.staff;
              this.edit.staff_id = staff_id;
              $(event.target).attr('disabled',false);
              $('#editModal').modal();
            } else {
              this.staffs = data.data.staff.data
  
              this.table = data.data.staff;
  
            }
          }
          
        } catch (error) {
          console.log(error)
        }
      },
      async handleEdit(event, staff_id){
        try {
          await this.init(event,staff_id);
        } catch (error) {
          
        }
      },
      async handleDelete(event, staff_id){
        try {
          if(confirm('Are you sure ?')){
            $(event.target).attr('disabled',true);
            await this.$http.post(`delete_staff`,{ staff_id : staff_id });        
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
          const { data } = await this.$http.get(`staff?${path}&staff_id=0`);
          this.staffs = data.data.staff.data
          this.table = data.data.staff;
  
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