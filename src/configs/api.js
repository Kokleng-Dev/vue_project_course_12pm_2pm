export function getPath(key){
    const k = key.split('?');
    if(k.length >= 2){
        return paths.hasOwnProperty(k[0]) ? `${paths[k[0]]}?${k[1]}` : ''; 
    }
    return paths.hasOwnProperty(key) ? `${paths[key]}?` : '' ;
}



const paths = {
    api_key : '/api-key',
    update_api_key: '/api-key/update',
    create_api_key: '/api-key/store',
    delete_api_key: '/api-key/delete',

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

    //staff
    staff : '/staff',
    update_staff : '/staff/update',
    create_staff : '/staff/store',
    delete_staff : '/staff/delete',
    archive_staff : '/staff/archive',
    archive_staff_back : '/staff/archive/back',
    staff_bookmark : '/staff/bookmark',

    //student
    student : '/student',
    edit_student : '/student/edit',
    update_student : '/student/update',
    create_student : '/student/store',
    delete_student : '/student/delete',
    import_excel : '/student/import'
}

