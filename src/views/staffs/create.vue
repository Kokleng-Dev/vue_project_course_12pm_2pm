<template>
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form @submit.prevent="handleSubmit($event)">
                <div class="modal-body">
                    <button class="btn btn-sm btn-primary mb-2" type="button" @click="addStaff()">Add</button>
                    <div class="row">
                        <div class="col-6">
                            <div class="my-3">
                                <label>File</label>
                                <input type="file" @change="handleFile($event)" class="form-control">
                            </div>

                            <table class="table table-sm table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Gender</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(staff,index) in staffs" :key="staff.i">
                                        <td>{{ index + 1 }}</td>
                                        <td><input id="name" type="text" v-model="staffs[index].name" class="form-control" required></td>
                                        <td><input id="phone" type="number" v-model="staffs[index].phone" class="form-control" required></td>
                                        <td>
                                            <select v-model="staffs[index].gender" class="form-control">
                                                <option value="female">Famale</option>
                                                <option value="male">Male</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="file" @change="staff.photo = $event.target.files[0]">
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-danger" type="button" @click="removeStaff(index)"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-6">
                            <div v-if="file">
                                <img v-if="type == 'pic'" :src="file" alt="">
                                <iframe v-else :src="file" frameborder="0" class="w-100" style="min-height: 400px;"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" :disabled="isSubmit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    </template>
    
    <script>
    import { domain } from '../../configs/file.js';
    export default {
        emits : ['reloadPage'],
        data(){
            return {
                staffs : [],
                isSubmit : false,
                i : 0,
                file : '',
                type : '',
                doc : ''
            }
        },
        methods : {
            handleFile(e){
                const ext = e.target.files[0].name.split('.');
                if(ext[1] == 'pdf'){
                    this.type = 'aksdkaks';
                } else {
                    this.type = 'pic';
                }
                this.file = URL.createObjectURL(e.target.files[0]);
                this.doc = e.target.files[0];
            },
            clearform(){
                this.staffs = [];
            },
            addStaff(){
                this.staffs.push({
                    name : '',
                    phone : '',
                    photo : '',
                    gender : 'male',
                });
                this.i++;
            },
            removeStaff(_index){
                this.staffs = this.staffs.filter((_,index) => index != _index);
            },
            async handleSubmit($event){

                const data = new FormData();
                this.staffs.forEach((staff,index) => {
                    data.append(`staffs[${index}][name]`, staff.name);
                    data.append(`staffs[${index}][phone]`, staff.phone);
                    data.append(`staffs[${index}][photo]`, staff.photo);
                    data.append(`staffs[${index}][gender]`, staff.gender);
                });

                data.append('file', this.doc);


                this.isSubmit = true;
                const res = await this.$http.post('create_staff', data);

                this.isSubmit = false;
                this.clearform();
                $('#createModal').modal('hide');

                console.log(`${domain}${res.data.path}`);

                const link = document.createElement('a');
                link.href = `${domain}${res.data.path}`;
                link.download = `${domain}${res.data.path}`;
                link.click();

                


                this.$emit('reloadPage', res.data.text);
            }
        }
    }
    </script>
    
    <style>
    
    </style>