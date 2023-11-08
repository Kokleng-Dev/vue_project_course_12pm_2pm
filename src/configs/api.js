export function getPath(key){
    const k = key.split('?');
    if(k.length >= 2){
        return paths.hasOwnProperty(k[0]) ? `${paths[k[0]]}?${k[1]}` : ''; 
    }
    return paths.hasOwnProperty(key) ? paths[key] : '' ;
}


const paths = {
    login : '/login',
    logout : '/logout',
    check_otp : '/check/otp',

    //permission
    permission : '/permission',
    update_permission : '/permission/update',
    create_permission : '/permission/store',
    delete_permission : '/permission/delete',

     //permission feature
     permission_feature : '/permission/feature',
     update_permission_feature : '/permission/feature/update',
     create_permission_feature : '/permission/feature/store',
     delete_permission_feature : '/permission/feature/delete',

    //role
    role : '/role',
    update_role : '/role/update',
    create_role : '/role/store',
    delete_role : '/role/delete',

    //role_permission
    role_permission : '/role/permission',
    role_permission_update : '/role/permission/update',


    //user
    user : '/user',
    update_user : '/user/update',
    create_user : '/user/store',
    delete_user : '/user/delete',
}

