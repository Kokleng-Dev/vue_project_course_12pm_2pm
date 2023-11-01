<?php


function base64Encode($data){

    $data = json_encode($data);
    $data =  base64_encode($data);
    $data = $data . '$$$kpaskdpaksd1231#!^@&*SADKAJD123#$$!#!FAS';
    $data = base64_encode($data);
    $data = '$jahsdj123$!*(#!*!!#!#@@' . $data;
    $data = base64_encode($data);

    return $data;
}

function base64Decode($data){
    $data = base64_decode($data);
    $data = explode('@@', $data);
    if(count($data) != 2 || $data[0] != '$jahsdj123$!*(#!*!!#!#'){
        return 0;
    }

    $data = $data[1];
    $data = base64_decode($data);

    $data = explode('$$$', $data);

    if(count($data) != 2 || $data[1] != 'kpaskdpaksd1231#!^@&*SADKAJD123#$$!#!FAS'){
        return 0;
    }



    $data = base64_decode($data[0]);
    $data = json_decode($data);

    return $data;
}

?>