<template>
  <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <template v-for="sidebar in sidebars" :key="sidebar">
            <template v-if="sidebar.isChild == true">
                <li class="nav-item menu-open">
                    <a href="#" :class="`nav-link ${ sidebar.components.split('|').includes($route.name) ? 'active' : '' }`">
                        <i :class="sidebar.icon" class="nav-icon"></i>
                        <p>
                            {{ sidebar.name  }}
                        </p>
                        <i class="right fas fa-angle-left"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" v-for="child in sidebar.childs" :key="child">
                            <router-link :to="child.route" :class="`nav-link ${child.route.name == $route.name ? 'active' : ''}`">
                                <i :class="child.icon" class="nav-icon"></i>
                                <p>{{ child.name }}</p>
                            </router-link>
                        </li>
                    </ul>
                </li>
            </template>
            <template v-else>
                <li class="nav-item">
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

    const sidebars = ref([
        {
            name : 'Dashboard',
            route : { name : 'home' },
            icon : 'fa fa-home',
            isChild : false,
        },
        {
            name : 'Settings',
            route : { name : 'setting' },
            icon : 'fa fa-cogs',
            isChild : true,
            components : 'user|role|config',
            childs : [
                {
                    name : 'User',
                    route : { name : 'user'},
                    icon : 'far fa-circle',
                },
                {
                    name : 'Role',
                    route : { name : 'role'},
                    icon : 'far fa-circle',
                },
                {
                    name : 'Config',
                    route : { name : 'config'},
                    icon : 'far fa-circle',
                },
            ]
        }
    ]);
</script>
