export {
    base64Encode,
    base64Decode,
}

function base64Encode(data){
    data = JSON.stringify(data);
    data = btoa(data);
    data = `${data}$$$kpaskdpaksd1231#!^@&*SADKAJD123#$$!#!FAS`;
    data = btoa(data);
    data = `$jahsdj123$!*(#!*!!#!#@@${data}`;
    data = btoa(data);

    return data;
}


function base64Decode(data){
    data = atob(data);
    data = data.split('@@');
    if(data.length != 2 || data[0] != '$jahsdj123$!*(#!*!!#!#'){
        return 0;
    }
    data = data[1];
    data = atob(data);

    data = data.split('$$$');
    if(data.length != 2 || data[1] != 'kpaskdpaksd1231#!^@&*SADKAJD123#$$!#!FAS'){
        return 0;
    }

    data = atob(data[0]);
    data = JSON.parse(data);

    return data;
}