import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import User from '@/views/users/index.vue';
import Role from '@/views/roles/index.vue';
import Config from '@/views/configs/index.vue';
import { auth } from '@/stores/auth'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
    },
    {
      path: '/user',
      name: 'user',
      component: User,
    },
    {
      path: '/permission',
      name: 'permission',
      component: () => import('@/views/permissions/index.vue'),
    },
    {
      path: '/permission_feature/:permission_id',
      name: 'permission_feature',
      component: () => import('@/views/permission_features/index.vue'),
    },
    {
      path: '/role',
      name: 'role',
      component: Role,
    },
    {
      path: '/role_permission/:role_id',
      name: 'role_permission',
      component: () => import('@/views/role_permissions/index.vue'),
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('@/views/auths/login.vue'),
    },
    {
      path: '/api-key',
      name: 'api_key',
      component: () => import('@/views/api_keys/index.vue'),
    },
    {
      path: '/config',
      name: 'config',
      component: Config,
    },
    {
      path: '/:pathMatch(.*)*',
      name: 'notFound',
      component: () => import('@/views/auths/not_found.vue'),
    }
  ]
});

router.beforeEach((to, from, next) => {
  const defineAuth = auth();
  defineAuth.init();

  if(to.name == 'login'){
    if(defineAuth.isAuth != true){
      next();
    } else {
      next({name : 'home'})
    }
  } else {
    if(to.name == 'notFound'){
      next();
    } else {
      if(defineAuth.isAuth == true){
        next();
      } else {
        next({ name : 'login' });
      }
    }
  }
});

export default router
