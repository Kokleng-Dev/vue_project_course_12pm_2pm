<template>
  <Master>
    <Header> 
      <h2>Role Page</h2> 
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
                <th>Note</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(role,index) in roles" :key="role.id">
                <td>{{ index +1 }}</td>
                <td>{{ role.name }}</td>
                <td>{{ role.note }}</td>
                <td>
                  <router-link :to="{ name : 'role_permission', params : { role_id : role.id } }" class="btn btn-sm btn-warning mr-1"><i class="fa fa-eye"></i></router-link>
                  <button type="button" class="btn btn-sm btn-success mr-1" @click="handleEdit($event,role.id)">
                    <i class="fa fa-edit"></i>
                  </button>
                  <button type="button" class="btn btn-sm btn-danger" @click="handleDelete($event,role.id)">
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
      roles : [],
      edit : {},
      table : {}
    }
  },
  methods :{
    async init(event = false, role_id = 0){
      try {
        const { data } = await this.$http.get(`role?role_id=${role_id}`);
        if(role_id){
          $(event.target).attr('disabled',true);
          this.edit = data.data.role;
          this.edit.role_id = role_id;
          $(event.target).attr('disabled',false);
          $('#editModal').modal();
        } else {
          this.roles = data.data.role.data

          this.table = data.data.role;

        }
      } catch (error) {
        console.log(error)
      }
    },
    async handleEdit(event, role_id){
      try {
        await this.init(event,role_id);
      } catch (error) {
        
      }
    },
    async handleDelete(event, role_id){
      try {
        if(confirm('Are you sure ?')){
          $(event.target).attr('disabled',true);
          await this.$http.post(`delete_role`,{ role_id : role_id });        
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
        const { data } = await this.$http.get(`role?${path}&rold_id=0`);
        this.roles = data.data.role.data
        this.table = data.data.role;

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