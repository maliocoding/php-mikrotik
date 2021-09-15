<?php

/* Example for adding a VPN user */

require('routeros_api.class.php');


$API = new RouterosAPI();

//$API->debug = true;


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
           'errorCode' => 'PASSWORD_IS_EMPTY',
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

if (!isset($_GET['remote-address'])) {
   die(json_encode(array(
       'status' 	=> 'ERROR',
       'errorCode' => 'REMOTE_ADDRESS_IS_NOT_SET',
       'errorDesc' => 'Remote Address is not set !'
   )));
} else {
   if (trim($_GET['remote-address']) == ''){
       die(json_encode(array(
           'status' 	=> 'ERROR',
           'errorCode' => 'REMOTE_ADDRESS_IS_EMPTY',
           'errorDesc' => 'Remote Address is required !'
       )));
   } else {
       if (!preg_match('/^[\d\w\s\(\)\.\/\-,]+$/', trim($_GET['remote-address']))) {
           die(json_encode(array(
               'status' 	=> 'ERROR',
               'errorCode' => 'INVALID_REMOTE_ADDRESS',
               'errorDesc' => 'Invalid Remote Address'
           )));
       }
   }
}

if (!isset($_GET['local-address'])) {
   die(json_encode(array(
       'status' 	=> 'ERROR',
       'errorCode' => 'LOCAL_ADDRESS_IS_NOT_SET',
       'errorDesc' => 'Local Address is not set !'
   )));
} else {
   if (trim($_GET['local-address']) == ''){
       die(json_encode(array(
           'status' 	=> 'ERROR',
           'errorCode' => 'LOCAL_ADDRESS_IS_EMPTY',
           'errorDesc' => 'Local Address is required !'
       )));
   } else {
       if (!preg_match('/^[\d\w\s\(\)\.\/\-,]+$/', trim($_GET['local-address']))) {
           die(json_encode(array(
               'status' 	=> 'ERROR',
               'errorCode' => 'INVALID_LOCAL_ADDRESS',
               'errorDesc' => 'Invalid Local Address'
           )));
       }
   }
}


if (!isset($_GET['ovpn-name'])) {
   die(json_encode(array(
       'status' 	=> 'ERROR',
       'errorCode' => 'OVPN_NAME_IS_NOT_SET',
       'errorDesc' => 'OVPN Name is not set !'
   )));
} else {
   if (trim($_GET['ovpn-name']) == ''){
       die(json_encode(array(
           'status' 	=> 'ERROR',
           'errorCode' => 'OVPN_NAME_IS_EMPTY',
           'errorDesc' => 'OVPN Name is required !'
       )));
   } else {
       if (!preg_match('/^[\d\w\s\(\)\.\%\$\/\-,]+$/', trim($_GET['ovpn-name']))) {
           die(json_encode(array(
               'status' 	=> 'ERROR',
               'errorCode' => 'INVALID_OVPN_NAME',
               'errorDesc' => 'Invalid OVPN Name'
           )));
       }
   }
}

if (!isset($_GET['ovpn-password'])) {
   die(json_encode(array(
       'status' 	=> 'ERROR',
       'errorCode' => 'OVPN_PASSWORD_IS_NOT_SET',
       'errorDesc' => 'OVPN Password is not set !'
   )));
} else {
   if (trim($_GET['ovpn-password']) == ''){
       die(json_encode(array(
           'status' 	=> 'ERROR',
           'errorCode' => 'OVPN_PASSWORD_IS_EMPTY',
           'errorDesc' => 'OVPN Password is required !'
       )));
   } else {
       if (!preg_match('/^[\d\w\s\(\)\.\%\$\/\-,]+$/', trim($_GET['ovpn-password']))) {
           die(json_encode(array(
               'status' 	=> 'ERROR',
               'errorCode' => 'INVALID_OVPN_PASSWORD',
               'errorDesc' => 'Invalid OVPN Password'
           )));
       }
   }
}

if ($API->connect($_GET['host'], $_GET['user'], $_GET['password'])) {

    $insert = $API->comm("/ppp/secret/add", array(
        "name"     => $_GET['ovpn-name'],
        "password" => $_GET['ovpn-password'],
        "remote-address" => $_GET['remote-address'],
        "local-address" => $_GET['local-address'],
        "service"  => "any",
        "profile"  => "default"
    ));
    if($insert){
        echo "success add secret";
    }else{
        echo 'not insert';
    }

    $API->disconnect();
    }





?>