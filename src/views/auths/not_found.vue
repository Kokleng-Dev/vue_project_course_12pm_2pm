<template>
    <div class="hold-transition login-page bg-dark">
        <div class="error-page bg-white p-5 rounded">
            <h2 class="headline text-warning">404</h2>
            <div class="error-content">
            <h3>
                <i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page not
                found.
            </h3> 
            <p>
                We could not find the page you were looking for. Meanwhile, you may
                <router-link to="/" v-if="defineAuth.isAuth">Return to dashboard</router-link>
                <router-link v-else to="/login">Return to Login</router-link>
                Please Contact to admin.
            </p>
            </div>
        </div>
    </div>
</template>

<script>
import { auth } from '../../stores/auth';
export default {
    data(){
        return {
            defineAuth : auth()
        }
    }
};
</script>

<style>
</style>