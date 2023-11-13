<template>
  <nav class="mt-2">
    <!-- data-widget="treeview" role="menu" data-accordion="false" -->
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" >
        <template v-for="sidebar in sidebars" :key="sidebar">
            <template v-if="sidebar.isChild == true">
                <li class="nav-item menu-open" @click="handleLi($event)" v-if="checkPermission(sidebar.permissions)">
                    <a href="#" :class="`nav-link ${ sidebar.components.split('|').includes($route.name) ? 'active' : '' }`">
                        <i :class="sidebar.icon" class="nav-icon"></i>
                        <p>
                            {{ sidebar.name  }}
                        </p>
                        <i class="right fas fa-angle-left"></i>
                    </a>
                    <!-- nav-treeview -->
                    <ul class="nav nav-treeview">
                        <template  v-for="child in sidebar.childs" :key="child">
                            <li class="nav-item" v-if="checkPermission(child.permissions)">
                            <router-link :to="child.route" :class="`nav-link ${child.components.split('|').includes($route.name) ? 'active' : '' }`">
                                <i :class="`${child.icon} nav-icon`"></i>
                                <p>{{ child.name }}</p>
                            </router-link>
                        </li>
                        </template>
                    </ul>
                </li>
            </template>
            <template v-else>
                <li class="nav-item" v-if="checkPermission(sidebar.permissions)">
                    <router-link :to="sidebar.route" :class="`nav-link  ${ sidebar.route.name == $route.name ? 'active' : '' }`">
                        <i :class="sidebar.icon" class="nav-icon"></i>
                        <p>{{ sidebar.name }}</p>
                    </router-link>
                </li>
            </template>
        </template>
      </ul>
    </nav>
</template>

<script setup>
import { ref } from "vue";
import { usePermissionStore } from "../../stores/permission";

function checkPermission(sidebarPermission){
    const usePermission = usePermissionStore();
    const permissions = usePermission.permission;
    const sidebar = sidebarPermission.split('|');
    let isCheck = false;
    sidebar.forEach(sidebar => {
        permissions.forEach(permission => {
            if(permission == sidebar){
                isCheck = true;
            }
        });
    });

    return isCheck;
}


function handleLi(e){
    $($(e.target).parent().children().get(1)).slideToggle(150)
}
    const sidebars = ref([
        {
            name : 'Dashboard',
            route : { name : 'home' },
            icon : 'fa fa-home',
            isChild : false,
            permissions : 'home'
        },
        {
            name : 'Settings',
            route : { name : 'setting' },
            icon : 'fa fa-cogs',
            isChild : true,
            components : 'user|role|config|permission|permission_feature|role_permission|api_key',
            permissions : 'permission|role|user|config|api_key',
            childs : [
                {
                    name : 'Permission',
                    route : { name : 'permission'},
                    components : 'permission|permission_feature',
                    icon : 'far fa-circle',
                    permissions : 'permission'
                },
                {
                    name : 'Role',
                    route : { name : 'role'},
                    components : 'role|role_permission',
                    icon : 'far fa-circle',
                    permissions : 'role'
                },
                {
                    name : 'User',
                    route : { name : 'user'},
                    components : 'user',
                    icon : 'far fa-circle',
                    permissions : 'user'
                },
                {
                    name : 'Config',
                    route : { name : 'config'},
                    components : 'config',
                    icon : 'far fa-circle',
                    permissions : 'config'
                },
                {
                    name : 'Api Key',
                    route : { name : 'api_key'},
                    components : 'api_key',
                    icon : 'far fa-circle',
                    permissions : 'api_key'
                },
            ]
        }
    ]);
</script>
<style>
.rotate0{
    transform: rotate(0deg) !important;
}
</style>
