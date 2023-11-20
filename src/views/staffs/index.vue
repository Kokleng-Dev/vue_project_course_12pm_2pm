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
            <button type="button" class="btn btn-primary mb-3 mr-2" data-toggle="modal" data-target="#createModal">
              <i class="fa fa-plus"></i> Create
            </button>
            <button class="btn btn-dark mb-3" @click="addStaff()">ADD</button>
            <button type="button" class="btn btn-primary mb-3 ml-2" @click="submitStaff()">Submit</button>
            <div class="row">
              <div class="col-1">
              Order By
                <select v-model="orderBy" class="form-control">
                  <option value="ASC">ASC</option>
                  <option value="DESC">DESC</option>
                </select>
              </div>
              <div class="col-1">
                Pagination
                <select class="form-control" v-model="pagination">
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="10">10</option>
                  <option value="15">15</option>
                  <option value="All">All</option>
                </select>
              </div>
            </div>
            <table class="table table-sm table hover" >
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Phone</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <template v-for="(staff,index) in staffs" :key="staff.id">
                    <tr v-if="!staff.is_new">
                      <td>{{ index +1 }}</td>
                      <td>{{ staff.name }}</td>
                      <td>{{ staff.gender }}</td>
                      <td>{{ staff.phone }}</td>
                      <td>
                        <button type="button" class="btn btn-sm btn-warning mr-1" @click="handleArchive($event,staff.id)">
                          <i class="fa fa-box"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-success mr-1" @click="handleEdit($event,staff.id)">
                          <i class="fa fa-edit"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger" @click="handleDelete($event,staff.id)">
                          <i class="fa fa-trash"></i>
                        </button>
                      </td>
                    </tr>
                    <tr v-else>
                      <td>{{ index +1 }}</td>
                      <td><input type="text" class="form-control" v-model="staffs[index].name"></td>
                      <td>
                        <select class="form-control" v-model="staffs[index].gender">
                          <option value="male">Male</option>
                          <option value="female">Female</option>
                          <option value="other">Other</option>
                        </select>
                      </td>
                      <td><input type="text" class="form-control" v-model="staffs[index].phone"></td>
                      <td>
                        <button type="button" class="btn btn-sm btn-warning mr-1" @click="handleArchive($event,staff.id)">
                          <i class="fa fa-box"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-success mr-1" @click="handleEdit($event,staff.id)">
                          <i class="fa fa-edit"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger" @click="handleDelete($event,staff.id)">
                          <i class="fa fa-trash"></i>
                        </button>
                      </td>
                    </tr>
                  </template>
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


              <h2>Archive Staff</h2>
              <table class="table table-sm table hover" >
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Phone</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(staff,index) in staff_archives" :key="staff.id">
                    <td>{{ index +1 }}</td>
                    <td>{{ staff.name }}</td>
                    <td>{{ staff.gender }}</td>
                    <td>{{ staff.phone }}</td>
                    <td>
                      <button type="button" class="btn btn-sm btn-danger" @click="handleArchiveBack($event,staff.id)">
                        ArchiveBack
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
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
        pagination : 3,
        orderBy : 'ASC',
        staffs : [],
        staff_archives : [],
        edit : {},
        roles: [],
        table : {},
        i : 1,
        is_permission : false
      }
    },
    watch: {
      pagination : function(after, before){
        if(after != before){
          this.init();
        }
      },
      orderBy : function(after, before){
        if(after != before){
          this.init();
        }
      },
    },
    methods :{
      addStaff(){
        this.staffs.unshift({
          id : this.i++,
          name : '',
          phone : '',
          gender : 'male',
          is_new : 1,
        })
      },
      async submitStaff(){
        const staffs = JSON.parse(JSON.stringify(this.staffs.filter(staff => staff.is_new == 1)));
        await this.$http.post('create_staff', staffs);
        this.init();
      },
      async init(event = false, staff_id = 0){
        try {
          const { data } = await this.$http.get(`staff?staff_id=${staff_id}&pagination=${this.pagination}&orderBy=${this.orderBy}`);
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
              $(event.target).attr('disabled',false);
              $('#editModal').modal();
            } else {
              this.staffs = data.data.staff.data
              this.staff_archives = data.data.staff_archives;
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
            await this.$http.post(`delete_staff`,{ id : staff_id });        
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
      },
      async handleArchive(event, staff_id){
        try {
          if(confirm('Are you sure ?')){
            $(event.target).attr('disabled',true);
            await this.$http.post(`archive_staff`,{ staff_id : staff_id });        
            await this.init();
          }
        } catch (error) {
          $(event.target).attr('disabled',false);
        }
      },
      async handleArchiveBack(event, staff_id){
        try {
          if(confirm('Are you sure ?')){
            $(event.target).attr('disabled',true);
            await this.$http.post(`archive_staff_back`,{ staff_id : staff_id });        
            await this.init();
          }
        } catch (error) {
          $(event.target).attr('disabled',false);
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