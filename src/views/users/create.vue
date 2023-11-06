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
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input id="name" type="text" v-model="form.name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="role">Role</label>
                    <select id="role" class="form-control" v-model="form.role_id" required>
                        <option value="">Please Select</option>
                        <option :value="role.id" v-for="role in roles" :key="role.id">{{ role.name  }}</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input id="email" type="email" v-model="form.email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password">Password</label>
                    <input id="password" type="text" v-model="form.password" class="form-control" required>
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
        roles : {
            type : [Object, Array],
            default : []
        }
    },
    data(){
        return {
            form : {
                name : '',
                password : '',
                email : '',
                role_id : ''
            },
            isSubmit : false
        }
    },
    methods : {
        clearform(){
            this.form = {
                name : '',
                password : '',
                email : '',
                role_id : ''
            }
        },
        async handleSubmit($event){
            this.isSubmit = true;
            await this.$http.post('create_user', this.form);
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