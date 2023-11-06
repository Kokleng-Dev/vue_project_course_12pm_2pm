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
    user : '/user',
    update_user : '/user/update',
    create_user : '/user/store',
    delete_user : '/user/delete',
}

