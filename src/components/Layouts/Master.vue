<template>
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"
            ><i class="fas fa-bars"></i
          ></a>
        </li>
        <li class="nav-item">
          <a
            class="nav-link"
            data-widget="control-sidebar"
            data-slide="true"
            href="#"
            role="button"
          >
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-user"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right">
              <button class="dropdown-item text-danger" @click="handleLogout()"><i class="fa fa-reply"></i> Logout</button>
            </div>
          </div>
        </li>
      </ul>
    </nav>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <a href="index3.html" class="brand-link">
        <img
          src="dist/img/AdminLTELogo.png"
          alt="AdminLTE Logo"
          class="brand-image img-circle elevation-3"
          style="opacity: 0.8"
        />
        <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>

      <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img
              src="dist/img/user2-160x160.jpg"
              class="img-circle elevation-2"
              alt="User Image"
            />
          </div>
          <div class="info">
            <a href="#" class="d-block">Alexander Pierce</a>
          </div>
        </div>

        <SideBar />
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- <Header>
    <slot name="header"></slot>
  </Header>
  <Body>
    <slot name="body"></slot>
  </Body> -->
      <slot></slot>
    </div>
    <footer class="main-footer">
      <strong
        >Copyright &copy; 2014-2021
        <a href="https://adminlte.io">AdminLTE.io</a>.</strong
      >
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0
      </div>
    </footer>
    <aside class="control-sidebar control-sidebar-dark" style="display: block">
      <div class="p-3 control-sidebar-content" style="">
        <h5>Customize AdminLTE</h5>
        <hr class="mb-2" />
        <div class="mb-4">
          <input
            type="checkbox"
            @click="handleDarkmode()"
            value="1"
            class="mr-1"
          /><span>Dark Mode</span>
        </div>
        <h6>Header Options</h6>
        <div class="mb-1">
          <input type="checkbox" value="1" class="mr-1" /><span>Fixed</span>
        </div>
        <div class="mb-1">
          <input type="checkbox" value="1" class="mr-1" /><span
            >Dropdown Legacy Offset</span
          >
        </div>
        <div class="mb-4">
          <input type="checkbox" value="1" class="mr-1" /><span>No border</span>
        </div>
        <h6>Sidebar Options</h6>
        <div class="mb-1">
          <input type="checkbox" value="1" class="mr-1" /><span>Collapsed</span>
        </div>
        <div class="mb-1">
          <input type="checkbox" value="1" class="mr-1" /><span>Fixed</span>
        </div>
        <div class="mb-1">
          <input
            type="checkbox"
            value="1"
            checked="checked"
            class="mr-1"
          /><span>Sidebar Mini</span>
        </div>
        <div class="mb-1">
          <input type="checkbox" value="1" class="mr-1" /><span
            >Sidebar Mini MD</span
          >
        </div>
        <div class="mb-1">
          <input type="checkbox" value="1" class="mr-1" /><span
            >Sidebar Mini XS</span
          >
        </div>
        <div class="mb-1">
          <input type="checkbox" value="1" class="mr-1" /><span
            >Nav Flat Style</span
          >
        </div>
        <div class="mb-1">
          <input type="checkbox" value="1" class="mr-1" /><span
            >Nav Legacy Style</span
          >
        </div>
        <div class="mb-1">
          <input type="checkbox" value="1" class="mr-1" /><span
            >Nav Compact</span
          >
        </div>
        <div class="mb-1">
          <input type="checkbox" value="1" class="mr-1" /><span
            >Nav Child Indent</span
          >
        </div>
        <div class="mb-1">
          <input type="checkbox" value="1" class="mr-1" /><span
            >Nav Child Hide on Collapse</span
          >
        </div>
        <div class="mb-4">
          <input type="checkbox" value="1" class="mr-1" /><span
            >Disable Hover/Focus Auto-Expand</span
          >
        </div>
        <h6>Footer Options</h6>
        <div class="mb-4">
          <input type="checkbox" value="1" class="mr-1" /><span>Fixed</span>
        </div>
        <h6>Small Text Options</h6>
        <div class="mb-1">
          <input type="checkbox" value="1" class="mr-1" /><span>Body</span>
        </div>
        <div class="mb-1">
          <input type="checkbox" value="1" class="mr-1" /><span>Navbar</span>
        </div>
        <div class="mb-1">
          <input type="checkbox" value="1" class="mr-1" /><span>Brand</span>
        </div>
        <div class="mb-1">
          <input type="checkbox" value="1" class="mr-1" /><span
            >Sidebar Nav</span
          >
        </div>
        <div class="mb-4">
          <input type="checkbox" value="1" class="mr-1" /><span>Footer</span>
        </div>
        <h6>Navbar Variants</h6>
        <div class="d-flex">
          <select class="custom-select mb-3 text-light border-0 bg-white">
            <option class="bg-primary">Primary</option>
            <option class="bg-secondary">Secondary</option>
            <option class="bg-info">Info</option>
            <option class="bg-success">Success</option>
            <option class="bg-danger">Danger</option>
            <option class="bg-indigo">Indigo</option>
            <option class="bg-purple">Purple</option>
            <option class="bg-pink">Pink</option>
            <option class="bg-navy">Navy</option>
            <option class="bg-lightblue">Lightblue</option>
            <option class="bg-teal">Teal</option>
            <option class="bg-cyan">Cyan</option>
            <option class="bg-dark">Dark</option>
            <option class="bg-gray-dark">Gray dark</option>
            <option class="bg-gray">Gray</option>
            <option class="bg-light">Light</option>
            <option class="bg-warning">Warning</option>
            <option class="bg-white">White</option>
            <option class="bg-orange">Orange</option>
          </select>
        </div>
        <h6>Accent Color Variants</h6>
        <div class="d-flex"></div>
        <select class="custom-select mb-3 border-0">
          <option>None Selected</option>
          <option class="bg-primary">Primary</option>
          <option class="bg-warning">Warning</option>
          <option class="bg-info">Info</option>
          <option class="bg-danger">Danger</option>
          <option class="bg-success">Success</option>
          <option class="bg-indigo">Indigo</option>
          <option class="bg-lightblue">Lightblue</option>
          <option class="bg-navy">Navy</option>
          <option class="bg-purple">Purple</option>
          <option class="bg-fuchsia">Fuchsia</option>
          <option class="bg-pink">Pink</option>
          <option class="bg-maroon">Maroon</option>
          <option class="bg-orange">Orange</option>
          <option class="bg-lime">Lime</option>
          <option class="bg-teal">Teal</option>
          <option class="bg-olive">Olive</option>
        </select>
        <h6>Dark Sidebar Variants</h6>
        <div class="d-flex"></div>
        <select class="custom-select mb-3 text-light border-0 bg-primary">
          <option>None Selected</option>
          <option class="bg-primary">Primary</option>
          <option class="bg-warning">Warning</option>
          <option class="bg-info">Info</option>
          <option class="bg-danger">Danger</option>
          <option class="bg-success">Success</option>
          <option class="bg-indigo">Indigo</option>
          <option class="bg-lightblue">Lightblue</option>
          <option class="bg-navy">Navy</option>
          <option class="bg-purple">Purple</option>
          <option class="bg-fuchsia">Fuchsia</option>
          <option class="bg-pink">Pink</option>
          <option class="bg-maroon">Maroon</option>
          <option class="bg-orange">Orange</option>
          <option class="bg-lime">Lime</option>
          <option class="bg-teal">Teal</option>
          <option class="bg-olive">Olive</option>
        </select>
        <h6>Light Sidebar Variants</h6>
        <div class="d-flex"></div>
        <select class="custom-select mb-3 border-0">
          <option>None Selected</option>
          <option class="bg-primary">Primary</option>
          <option class="bg-warning">Warning</option>
          <option class="bg-info">Info</option>
          <option class="bg-danger">Danger</option>
          <option class="bg-success">Success</option>
          <option class="bg-indigo">Indigo</option>
          <option class="bg-lightblue">Lightblue</option>
          <option class="bg-navy">Navy</option>
          <option class="bg-purple">Purple</option>
          <option class="bg-fuchsia">Fuchsia</option>
          <option class="bg-pink">Pink</option>
          <option class="bg-maroon">Maroon</option>
          <option class="bg-orange">Orange</option>
          <option class="bg-lime">Lime</option>
          <option class="bg-teal">Teal</option>
          <option class="bg-olive">Olive</option>
        </select>
        <h6>Brand Logo Variants</h6>
        <div class="d-flex"></div>
        <select class="custom-select mb-3 border-0">
          <option>None Selected</option>
          <option class="bg-primary">Primary</option>
          <option class="bg-secondary">Secondary</option>
          <option class="bg-info">Info</option>
          <option class="bg-success">Success</option>
          <option class="bg-danger">Danger</option>
          <option class="bg-indigo">Indigo</option>
          <option class="bg-purple">Purple</option>
          <option class="bg-pink">Pink</option>
          <option class="bg-navy">Navy</option>
          <option class="bg-lightblue">Lightblue</option>
          <option class="bg-teal">Teal</option>
          <option class="bg-cyan">Cyan</option>
          <option class="bg-dark">Dark</option>
          <option class="bg-gray-dark">Gray dark</option>
          <option class="bg-gray">Gray</option>
          <option class="bg-light">Light</option>
          <option class="bg-warning">Warning</option>
          <option class="bg-white">White</option>
          <option class="bg-orange">Orange</option>
          <a href="#">clear</a>
        </select>
      </div>
    </aside>
  </div>
</template>

<script setup>
import { ref } from "vue";
import SideBar from "./SideBar.vue";
import {auth} from '@/stores/auth.js'

const isDarkmode = ref(false);
const defineAuth = auth();

function handleDarkmode() {
  if (isDarkmode.value == false) {
    $("body").addClass("dark-mode");
    isDarkmode.value = true;
  } else {
    $("body").removeClass("dark-mode");
    isDarkmode.value = false;
  }
}

function handleLogout(){
  defineAuth.logout();
}
</script>