<template>
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form @submit.prevent="handleSubmit($event)">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="ename">Name</label>
                        <input id="ename" type="text" v-model="form.name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="ephone">Phone</label>
                        <input id="ephone" type="number" v-model="form.phone" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="egender">Gender</label>
                        <select id="egender" class="form-control" v-model="form.gender" required>
                            <option value="male">Male</option>
                            <option value="female">female</option>
                            <option value="other">other</option>
                        </select>
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
    export default {
        emits : ['reloadPage'],
        props : {
            form : {
                type : [Object, Array],
                default : {
                    id : '',
                    phone : '',
                    name : '',
                    gender : '',
                }
            },
            roles : {
                type : [Object, Array],
                default : []
            }
        },
        data(){
            return {
                isSubmit : false
            }
        },
        methods : {
            async handleSubmit($event){
                this.isSubmit = true;
                await this.$http.post('update_staff', this.form);
                this.isSubmit = false;

                $('#editModal').modal('hide');
                this.$emit('reloadPage');
            }
        }
    }
    </script>
    
    <style>
    
    </style>