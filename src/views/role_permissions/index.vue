<template>
    <Master>
        <Header> 
        <h2>Role Permission Page</h2> 
        </Header>
        <Body>
            <div class="card"></div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(permission, index) in permissions" :key="permission.id">
                                <td>{{ index + 1  }}</td>
                                <td>{{ permission.name  }}</td>
                                <td class="p-0">
                                    <table class="w-100 table m-0 p-0">
                                        <tr>
                                            <td :class="`border-left-0 border-top-0 border-bottom-0 ${permission.features.length - 1 == j? 'border-right-0' : ''}`" v-for="(sub_permission, j) in (permission.features).sort((a,b) => (a.id > b.id) ? 1 : ((b.id > a.id) ? -1 : 0))" :key="sub_permission">
                                                <input :id="`per${sub_permission.id}${permission.id}`" type="checkbox" @click="handlePermission({ permission_feature_id : sub_permission.id, role_id : $route.params.role_id, permission_id : sub_permission.permission_id })" class="mr-1" :checked="sub_permission.permission == 1"> 
                                                <label :for="`per${sub_permission.id}${permission.id}`" class="mb-0">{{ sub_permission.name }}</label>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </Body>
    </Master>
</template>

<script>
import { usePermissionStore } from '../../stores/permission';
export default {

    data(){
        return {
            permissions : []
        }
    },
    methods : {
        async init(){
            const { data } = await this.$http.get(`role_permission?role_id=${this.$route.params.role_id}`);
            this.permissions = data.permissions;
        },
        async handlePermission(objs){
            const { data } = await this.$http.post('role_permission_update', objs);
            const permission = usePermissionStore()
            permission.setPermission(data.permission);
        }
    },
    async mounted(){
        await this.init();
    }
}
</script>
