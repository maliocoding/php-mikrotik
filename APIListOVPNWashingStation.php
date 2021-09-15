<?php

require('routeros_api.class.php');

$API = new RouterosAPI();

//$API->debug = true;

if ($API->connect('192.168.0.101', 'soltova_api', '$v0l7)%')) {

   $API->write('/ppp/secret/print');

   $READ = $API->read(false);
   $ARRAY = $API->parseResponse($READ);

   $responseData = array();
   $x = 0;

   foreach ($ARRAY as $data){
      if(substr($data['name'],0,8) == 'cyberecs'){
         $responseData[$x]['name'] = $data['name'];
         $responseData[$x]['remote-address'] = $data['remote-address'];
         $responseData[$x]['last-logged-out'] = $data['last-logged-out'];
         $x++;

      }
   }

   echo json_encode($responseData);

   

}

?>
