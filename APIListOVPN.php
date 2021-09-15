<?php

require('routeros_api.class.php');

$API = new RouterosAPI();


if (!isset($_GET['password'])) {
    die(json_encode(array(
        'status' 	=> 'ERROR',
        'errorCode' => 'PASSWORD_IS_NOT_SET',
        'errorDesc' => 'Password is not set !'
    )));
} else {
    if (trim($_GET['password']) == ''){
        die(json_encode(array(
            'status' 	=> 'ERROR',
            'errorCode' => 'RPASSWORD_IS_EMPTY',
            'errorDesc' => 'Password is required !'
        )));
    } else {
        if (!preg_match('/^[\d\w\s\(\)\.\%\$\/\-,]+$/', trim($_GET['password']))) {
            die(json_encode(array(
                'status' 	=> 'ERROR',
                'errorCode' => 'INVALID_PASSWORD',
                'errorDesc' => 'Invalid Password'
            )));
        }
    }
}

if (!isset($_GET['user'])) {
    die(json_encode(array(
        'status' 	=> 'ERROR',
        'errorCode' => 'USER_IS_NOT_SET',
        'errorDesc' => 'User is not set !'
    )));
} else {
    if (trim($_GET['user']) == ''){
        die(json_encode(array(
            'status' 	=> 'ERROR',
            'errorCode' => 'USER_IS_EMPTY',
            'errorDesc' => 'User is required !'
        )));
    } else {
        if (!preg_match('/^[\d\w\s\(\)\.\/\-,]+$/', trim($_GET['user']))) {
            die(json_encode(array(
                'status' 	=> 'ERROR',
                'errorCode' => 'INVALID_USER',
                'errorDesc' => 'Invalid User'
            )));
        }
    }
}


if (!isset($_GET['ovpn_name'])) {
    die(json_encode(array(
        'status' 	=> 'ERROR',
        'errorCode' => 'OVPN_NAME_IS_NOT_SET',
        'errorDesc' => 'OVPN Name is not set !'
    )));
} else {
    if (trim($_GET['ovpn_name']) == ''){
        die(json_encode(array(
            'status' 	=> 'ERROR',
            'errorCode' => 'OVPN_NAME_EMPTY',
            'errorDesc' => 'OVPN Name is required !'
        )));
    } else {
        if (!preg_match('/^[\d\w\s\(\)\.\/\-,]+$/', trim($_GET['ovpn_name']))) {
            die(json_encode(array(
                'status' 	=> 'ERROR',
                'errorCode' => 'INVALID_OVPN_NAME',
                'errorDesc' => 'Invalid OVPN Name'
            )));
        }
    }
}

if (!isset($_GET['host'])) {
    die(json_encode(array(
        'status' 	=> 'ERROR',
        'errorCode' => 'HOST_IS_NOT_SET',
        'errorDesc' => 'Host is not set !'
    )));
} else {
    if (trim($_GET['host']) == ''){
        die(json_encode(array(
            'status' 	=> 'ERROR',
            'errorCode' => 'HOST_IS_EMPTY',
            'errorDesc' => 'Host is required !'
        )));
    } else {
        if (!preg_match('/^[\d\w\s\(\)\.\/\-,]+$/', trim($_GET['host']))) {
            die(json_encode(array(
                'status' 	=> 'ERROR',
                'errorCode' => 'INVALID_HOST',
                'errorDesc' => 'Invalid Host'
            )));
        }
    }
}



if ($API->connect($_GET['host'], $_GET['user'], $_GET['password'])) {

    $last_up = '-';

    $lastlogout = $API->comm("/ppp/secret/getall", 
        array(
    ".proplist"=> ".id,name,last-logged-out",
    "?name" => $_GET['ovpn_name'],
    ));

    $lastactive = $API->comm("/ppp/active/getall", 
        array(
    ".proplist"=> ".id,name",
    "?name" => $_GET['ovpn_name'],
    ));
   

    if($lastlogout){
        $last_up = $lastlogout[0]['last-logged-out'];
    }

    if($lastactive){
        $ovpn_status = '1';
    } else {
        $ovpn_status = '0';
    }
 
    echo json_encode(array(
        'last_up' => $last_up,
        'ovpn_status' => $ovpn_status
    ));
    $API->disconnect();
  

} else {
    echo json_encode(array(
        'status' 	=> 'ERROR',
        'errorCode' => 'CONNECTION_MIKROTIK_FAILED',
        'errorDesc' => 'Connection to Mikrotik Failed'
    ));
}

?>
