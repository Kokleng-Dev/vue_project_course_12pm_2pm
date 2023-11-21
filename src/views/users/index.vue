<template>
  <Master>
    <Header> 
      <h2>User Page</h2> 
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
                  <th>Google Map</th>
                  <th>Email</th>
                  <th>Name</th>
                  <th>Role</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(user,index) in users" :key="user.id">
                  <td>{{ index +1 }}</td>
                  <td>
                    <iframe 
                      class="w-100" 
                      frameborder="0" 
                      :src="`https://maps.google.com/maps?q=${user.lat},${user.lng}&hl=es;z=20&amp;output=embed`">
                    </iframe>
                  </td>
                  <td>{{ user.email }}</td>
                  <td>{{ user.name }}</td>
                  <td>{{ user.role_name }}</td>
                  <td>
                    <button type="button" class="btn btn-sm btn-success mr-1" @click="handleEdit($event,user.id)">
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
      <CreateUser :roles="roles" @reloadPage="init()"/>
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
      users : [],
      edit : {},
      roles: [],
      table : {},
      is_permission : false
    }
  },
  methods :{
    async init(event = false, user_id = 0){
      try {
        const { data } = await this.$http.get(`user?user_id=${user_id}`);
        console.log(data);
        if(data.status == 'no_permission'){
          this.is_permission = true;
          this.$alert({ type : 'error', sms : data.sms })
        } else {
          this.is_permission = false;
          const permission = usePermissionStore();
          permission.setPermission(data.permission);
          if(user_id){
            $(event.target).attr('disabled',true);
            this.edit = data.data.user;
            this.edit.user_id = user_id;
            $(event.target).attr('disabled',false);
            $('#editModal').modal();
          } else {
            this.users = data.data.user.data
            this.roles = data.data.roles

            this.table = data.data.user;

          }
        }
        
      } catch (error) {
        console.log(error)
      }
    },
    async handleEdit(event, user_id){
      try {
        await this.init(event,user_id);
      } catch (error) {
        
      }
    },
    async handleDelete(event, user_id){
      try {
        if(confirm('Are you sure ?')){
          $(event.target).attr('disabled',true);
          await this.$http.post(`delete_user`,{ user_id : user_id });        
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
        const { data } = await this.$http.get(`user?${path}&user_id=0`);
        this.users = data.data.user.data
        this.roles = data.data.roles
        this.table = data.data.user;

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