<?php

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

   $API->write('/ppp/secret/print');

   $READ = $API->read(false);
   $ARRAY = $API->parseResponse($READ);

        echo json_encode(array(
            'status' 	=> 'SUCCESS',
            'errorCode' => 'DATA_SUCCESS_RETRIVED',
            'errorDesc' => 'Data Success Retrived',
            'data'  => $ARRAY
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
