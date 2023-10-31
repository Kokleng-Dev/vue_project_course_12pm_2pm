<template>
  <div class="hold-transition login-page bg-dark">
    <div class="login-box">
      <div class="card">
        <div class="card-body login-card-body">
          <h2 class="login-box-msg">Login</h2>

          <form action="#" method="post">
            <div class="input-group mb-3">
              <input type="email" class="form-control" placeholder="Email" />
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input
                type="password"
                class="form-control"
                placeholder="Password"
              />
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <button type="button" class="btn btn-primary btn-block" @click="handleLogin()">
                  Login
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { auth } from '../../stores/auth.js';

const defineAuth = auth();

function handleLogin(){
    defineAuth.login();
}

</script>

<style></style>
