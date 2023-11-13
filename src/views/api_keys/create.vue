<template>
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form @submit.prevent="handleSubmit($event)">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input id="name" type="text" v-model="form.name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="key">Key</label>
                        <input id="key" type="text" v-model="form.key" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="api_key">Api Key</label>
                        <input id="api_key" type="text" v-model="form.api_key" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="note">Note</label>
                        <input id="note" type="note" v-model="form.note" class="form-control" required>
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
        data(){
            return {
                form : {
                    name : '',
                    note : '',
                    api_key : '',
                    key : '',
                },
                isSubmit : false
            }
        },
        methods : {
            clearform(){
                this.form = {
                    name : '',
                    note : '',
                    api_key : '',
                    key : '',
                }
            },
            async handleSubmit($event){
                this.isSubmit = true;
                await this.$http.post('create_api_key', this.form);
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