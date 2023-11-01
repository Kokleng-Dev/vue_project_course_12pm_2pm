export function getPath(key){
    return paths.hasOwnProperty(key) ? paths[key] : '' ;
}


const paths = {
    product : '/products',
}

