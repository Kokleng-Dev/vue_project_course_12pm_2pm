<template>
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
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
                                    <button class="btn btn-sm btn-danger" type="button" @click="removeStaff(index)"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
    export default {
        emits : ['reloadPage'],
        data(){
            return {
                staffs : [],
                isSubmit : false,
                i : 0
            }
        },
        methods : {
            clearform(){
                this.staffs = [];
            },
            addStaff(){
                this.staffs.push({
                    name : '',
                    phone : '',
                    gender : 'male',
                });
                this.i++;
            },
            removeStaff(_index){
                this.staffs = this.staffs.filter((_,index) => index != _index);
            },
            async handleSubmit($event){
                this.isSubmit = true;
                await this.$http.post('create_staff', this.staffs);
                this.isSubmit = false;
                this.clearform();
                $('#createModal').modal('hide');
                this.$emit('reloadPage');
            }
        }
    }
    </script>
    
    <style>
    
    </style>