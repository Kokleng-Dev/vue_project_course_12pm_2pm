export function getPath(key){
    return paths.hasOwnProperty(key) ? paths[key] : '' ;
}


const paths = {
    login : '/login',
    logout : '/logout'
}

