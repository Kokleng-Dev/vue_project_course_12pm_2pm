<template>
    <Master>
      <Header> 
        <h2>Student Page</h2> 
      </Header>
      <Body>
        <div class="card">
          <div class="card-body">
            <router-link :to="{ name : 'create_student'}" class="btn btn-sm btn-primary mr-1 mb-3">
                <i class="fa fa-plus"></i> Create
            </router-link>

            <a :href="export" target="_blank" class="btn btn-sm btn-dark mr-1 mb-3">Export Excel</a>

            <a :href="importExcel" target="_blank" class="btn btn-sm btn-dark mr-1 mb-3">Import Excel Example</a>

           <div class="row">
            <div class="col-4">
              <div class="mb-3">
                <label for="">Import Student</label>
                <input type="file" class="form-control" @change="impExcel = $event.target.files[0]">
              </div>
              <button class="btn btn-warning" @click="submtImport()">Submit</button>
            </div>
           </div>

            <table class="table table-bordered table-sm table hover">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Age</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-show="students.length == 0">
                    <td colspan="4" class="text-center">No Data</td>
                </tr>
                <tr v-for="(stu,index) in students" :key="stu.id">
                  <td>{{ index +1 }}</td>
                  <td>{{ stu.name }}</td>
                  <td>{{ stu.age }}</td>
                  <td>
                    <router-link :to="{ name : 'edit_student', params : { student_id : stu.id } }" class="btn btn-sm btn-warning mr-1"><i class="fa fa-edit"></i></router-link>
                    <button class="btn btn-sm btn-danger mr-1" @click="handleDelete(stu.id)"><i class="fa fa-trash"></i></button>
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
      </Body>
    </Master>
  </template>
  
  <script>
  
  export default {
    data(){
      return {
        students : [],
        table : {},
        export : '',
        importExcel : '',
        impExcel : ''
      }
    },
    methods :{
      async submtImport(){
        const info = new FormData();
        info.append('excel', this.impExcel);

        const { data } = await this.$http.post('import_excel', info);
        if(data.status == 'success'){
          this.init();
        }
      },
      async init(){
        try {
          const { data } = await this.$http.get('student');
          this.students = data.data.students.data
          this.table = data.data.students;
          this.export = data.data.export;
          this.importExcel = data.data.import;
        } catch (error) {
          console.log(error)
        }
      },
      async changePage(link){
        try {
          if(link.url == null) return ;
  
          const path = link.url.split('?')[1];
          const { data } = await this.$http.get(`student?${path}`);
          this.students = data.data.students.data
          this.table = data.data.students;
  
        } catch (error) {
            console.log(error);
        }
      },
      async handleDelete(student_id){
        if(confirm('Are you sure ?')){
            await this.$http.post(`delete_student`,{id : student_id});
          await this.init();
        }
      }
    },
    mounted(){
      this.init();

      setTimeout(() => {
        console.log(this.students)
      }, 1000);
    }
  }
  </script>
  
  <style>
  
  </style>