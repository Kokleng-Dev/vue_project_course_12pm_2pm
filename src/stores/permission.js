import { ref, computed, reactive } from 'vue'
import { defineStore } from 'pinia'
import { base64Encode } from '../configs/encryption';

export const usePermissionStore = defineStore('counter', () => {
  const permission = ref([]);
  const role_permission = computed(() => permission.value)
  function newPermission(pers) {
    permission.value = pers;
  }
  function setPermission(pers){
    localStorage.setItem('permissions', base64Encode(pers));
    newPermission(pers);
  }

  return { role_permission, newPermission , permission, setPermission}
})
