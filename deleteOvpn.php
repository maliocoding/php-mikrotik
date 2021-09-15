<?php

/* Example for adding a VPN user */

require('routeros_api.class.php');

$API = new RouterosAPI();

//$API->debug = true;
$valid = false;
if(!empty($_GET['name'])) {
   $valid = true;
   $name = $_GET['name'];

} else {
   die ('Parameter missing');
}


// die();


if($valid){
   if ($API->connect('192.168.0.101', 'soltova_api', '$v0l7)%')) {

    $arrID = $API->comm("/ppp/secret/getall", 
        array(
    ".proplist"=> ".id",
    "?name" => $name,
    ));


      if($arrID){
      //   print_r($arrID);
      }else{
         die('not found');
      }

      $API->comm("/ppp/secret/remove",
        array(
            ".id" => $arrID[0][".id"],
            )
        );

          echo "data success remove";
     
      $API->disconnect();
      }
} else {
   echo ('not valid');
}




?>