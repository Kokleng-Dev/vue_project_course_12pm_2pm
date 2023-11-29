<template>
    <Master>
      <Header> 
        <h2>Staff Page</h2> 
      </Header>
      <Body>
        <div class="card" v-if="false">
          <div class="card-body" v-if="is_permission">
            No Permission
          </div>
          <div class="card-body" v-else>
            <textarea cols="30" rows="10" v-html="txt" class="form-control"></textarea>
            <img :src="`${file}docs/BQbG0H98wbbMwsW4EbkE6AbQK8mVC0lma5IAZt3Q.jpg`" alt="" style="width: 200;">
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
              <div class="col-2">
                Bookmarked
                <select v-model="is_bookmark" @change="init()" class="form-control">
                  <option value="all">All</option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
              </div>
            </div>
            <table class="table table-sm table hover" >
                <thead>
                  <tr>
                    <th>ID</th>
                    <th @click="fillterBy('name')">
                      Name 
                      <i v-if="filter.name == 'ASC'" class="fas fa-caret-down"></i> 
                      <i v-else class="fas fa-caret-up"></i> 
                    </th>
                    <th @click="fillterBy('gender')">
                      Gender
                      <i v-if="filter.gender == 'ASC'" class="fas fa-caret-down"></i> 
                      <i v-else class="fas fa-caret-up"></i> 
                    </th>
                    <th @click="fillterBy('phone')">
                      Phone
                      <i v-if="filter.phone == 'ASC'" class="fas fa-caret-down"></i> 
                      <i v-else class="fas fa-caret-up"></i> 
                    </th>
                    <th>Book Marks</th>
                    <th>Photo</th>
                    <th> Action</th>
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
                        <span v-if="staff.is_bookmark == 1" class="badge bg-danger">Marked</span>
                      </td>
                      <td>
                        <img :src="`${file}${staff.photo}`" alt="" width="100">
                      </td>
                      <td>
                        <button type="button" class="btn btn-sm btn-dark mr-1" @click="handleBookmark($event,staff.id, staff.is_bookmark)">
                          <i v-if="staff.is_bookmark == 1" class="fas fa-bookmark"></i>
                          <i v-else class="far fa-bookmark"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-dark mr-1" @click="handleArchive($event,staff.id)">
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
                        <select v-model="staffs[index].is_bookmark" class="form-control">
                          <option value="1">yes</option>
                          <option value="0">No</option>
                        </select>
                      </td>
                      <td>
                        <button type="button" class="btn btn-sm btn-danger" @click="handleRemove(index)">
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


              <h2>Bookmarked Staff</h2>
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
                  <tr v-for="(staff,index) in staff_bookmarks" :key="staff.id">
                    <td>{{ index +1 }}</td>
                    <td>{{ staff.name }}</td>
                    <td>{{ staff.gender }}</td>
                    <td>{{ staff.phone }}</td>
                    <td>
                      <button type="button" class="btn btn-sm btn-dark mr-1" @click="handleBookmark($event,staff.id, 1)">
                        <i class="fas fa-bookmark"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
          </div>

        </div>
        <div class="card">
          <div class="card-header">
            <div class="step-wrapper">
              <div :class="`step ${step == 1 ? 'active' : ''}`" @click="step = 1">
                <span>Step One</span>
              </div>
              <div :class="`step ${step == 2 ? 'active' : ''}`" v-if="step == 2 || step == 3" @click="step = 2">
                <span>Step Two</span>
              </div>
              <div :class="`step ${step == 3 ? 'active' : ''}`" v-if="step == 3">
                <span>Step Three</span>
              </div>
            </div>
          </div>
          <div class="card-body" v-show="step == 1">
            <div class="row mb-3">
              <div class="col-4">
                <label>Step 1</label>
                <input type="text" class="form-control">
              </div>
            </div>
            <button class="btn btn-sm btn-primary" @click="step = 2">Next Step</button>
          </div>
          <div class="card-body" v-show="step == 2">
            <div class="row mb-3">
              <div class="col-4">
                <label>Step 1</label>
                <input type="text" class="form-control">
              </div>
            </div>
            <button class="btn btn-sm btn-danger" @click="step = 1">Back</button>
            <button class="btn btn-sm btn-primary" @click="step = 3">Next Step</button>
          </div>
          <div class="card-body" v-show="step == 3">
            <div class="row mb-3">
              <div class="col-4">
                <label>Step 1</label>
                <input type="text" class="form-control">
              </div>
            </div>
            <button class="btn btn-sm btn-danger" @click="step = 2">Back</button>
          </div>
        </div>
        <CreateUser @reloadPage="reloadPage($event)"/>
        <EditUser :form="edit" :roles="roles" @reloadPage="init()"/>
      </Body>
    </Master>
  </template>
  

<script setup>
import { ref } from 'vue'
const step = ref(1);


</script>





  <script>
  import CreateUser from './create.vue'
  import EditUser from './edit.vue'
  import { usePermissionStore } from '../../stores/permission'
  import { domain } from '../../configs/file'
import axios from 'axios'
import { ref } from 'vue'
  
  export default {
    components : {
      CreateUser , EditUser
    },
    data(){
      return {
        file : domain,
        pagination : 3,
        orderBy : 'ASC',
        staffs : [],
        staff_archives : [],
        staff_bookmarks : [],
        edit : {},
        roles: [],
        table : {},
        i : 1,
        is_permission : false,
        filter : {
          name : 'ASC',
          phone : 'ASC',
          gender : 'ASC'
        },
        filterBy : 'id',
        action : 'ASC',
        is_bookmark : 'all',
        txt : ''
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
      reloadPage(e){

        this.txt = e;


        this.init();
      },
      async fillterBy(column){
        this.filterBy = column;
        this.filter[column] = this.filter[column] == 'ASC' ? 'DESC' : 'ASC';
        this.action = this.filter[column];

        console.log(this.filterBy, this.action)
        this.init();

        const res = await axios.get('http://localhost:8000/api/user');

        console.log(res.data);
        // {
        //   headers : {
        //     'Accept' : 'application/json',
        //     'Authorization' : this.$base64Decode(localStorage.getItem('token')),
        //     'type' : this.$base64Encode('web'),
        //     "Content-Type" : 'application/json',
        //     'api_key' : this.$base64Encode('abc')
        //   }
        // }
      },
      addStaff(){
        this.staffs.unshift({
          id : this.i++,
          name : '',
          phone : '',
          gender : 'male',
          is_bookmark : 0,
          is_new : 1,
        })
      },
      handleRemove(index){
        this.staffs = this.staffs.filter((_,i) => i != index);
      },
      async submitStaff(){
        const staffs = JSON.parse(JSON.stringify(this.staffs.filter(staff => staff.is_new == 1)));
        await this.$http.post('create_staff', staffs);
        this.init();
      },
      async init(event = false, staff_id = 0){
        try {
          const { data } = await this.$http.get(`staff?staff_id=${staff_id}&pagination=${this.pagination}&orderBy=${this.orderBy}&filterBy=${this.filterBy}&action=${this.action}&is_bookmark=${this.is_bookmark}`);
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
              this.staff_bookmarks = data.data.staff_bookmarks;
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
          const { data } = await this.$http.get(`staff?${path}&staff_id=0&pagination=${this.pagination}&orderBy=${this.orderBy}&filterBy=${this.filterBy}&action=${this.action}&is_bookmark=${this.is_bookmark}`);
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
            $(event.target).attr('disabled',false);
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
            $(event.target).attr('disabled',false);
            await this.init();
          }
        } catch (error) {
          $(event.target).attr('disabled',false);
        }
      },
      async handleBookmark(event, staff_id, is_bookmark){
        try {
          if(confirm('Are you sure ?')){
            $(event.target).attr('disabled',true);
            await this.$http.post(`staff_bookmark`,{ staff_id : staff_id, is_bookmark : is_bookmark });        
            $(event.target).attr('disabled',false);
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
.step-wrapper {
	 display: flex;
}
 .step {
	 display: flex;
	 align-items: center;
	 justify-content: center;
	 position: relative;
	 width: 200px;
	 height: 40px;
	 font-family: Arial;
	 color: green;
	 background-color: white;
}
 .step.active {
	 color: white;
	 background-color: green;
}
 .step.active:after {
	 background-color: green;
}
 .step:after {
	 content: "";
	 display: block;
	 position: absolute;
	 width: 28px;
	 height: 28px;
	 left: calc(100% - 15px);
	 top: 50%;
	 margin-top: -14px;
	 background-color: white;
	 transform: rotate(45deg);
	 box-shadow: 1px -1px 0 0 #ccc;
	 z-index: 5;
}
 
</style>