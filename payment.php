<?php

require_once('./wp-config.php');

function Paypal_return()
{
  if(isset($_GET['tx'])) {
    $transaction_id = $_GET['tx'];
  }

  $token = "nZhbvhwVV3jpXyU2yj8hD3kIah1XBsNUsYVtvtgKHuvOJ6fFiU26weQ4Ogi";
  $request = curl_init();

  curl_setopt_array($request, array
(
  CURLOPT_URL => 'https://www.sandbox.paypal.com/cgi-bin/webscr',
  CURLOPT_POST => TRUE,
  CURLOPT_POSTFIELDS => http_build_query(array
    (
      'cmd' => '_notify-synch',
      'tx' => $transaction_id,
      'at' => $token,
    )),
  CURLOPT_RETURNTRANSFER => TRUE,
  CURLOPT_HEADER => FALSE,
));

  $response = curl_exec($request);
  $status   = curl_getinfo($request, CURLINFO_HTTP_CODE);
  $response = str_replace(' ',"\n",$response);
  //echo $response;
  $lines = explode("\n", $response);
  if (strcmp ($lines[0], "SUCCESS") != 0)
  {
    echo "Invalid transaction.";
    exit();
  }

  //print_r( $lines);
  $keyarray = array();

  for ($i=1; $i<count($lines);$i++){
    list($key,$val) = explode("=", $lines[$i]);
    $keyarray[urldecode($key)] = urldecode($val);
  }
  print_r( $keyarray);
  //echo $response;
  //echo $status;
  //exit();
  $payment_gross = $keyarray['payment_gross'];
  $receiver_email = $keyarray['receiver_email'];
  if ( $payment_gross != "6.00" || $receiver_email != "dthoang92-facilitator@gmail.com")
  {
    echo '<script> alert("Phát hiện lừa đảo !!!!") && window.location="htab.hoangdoan.io:8080"  </script>';
    exit();
  }
  $user_id = get_current_user_id();
  global $wpdb;
  $table_name = $wpdb->prefix.'user_detail'; 
  $results = $wpdb->get_results("SELECT * FROM ".$table_name." WHERE id_user = '".$user_id."'");  
  $myMoney = intval($results[0]->myMoney);
  $myMoney = $myMoney + (int)$payment_gross * 22000;
  $wpdb->update( 
    $table_name, 
    array( 
      'myMoney' => $myMoney , 
    ),
    array( 'id_user' => $user_id ),  
    array( 
      '%d',   
    ),
    array( '%s' ) 
    );
}

Paypal_return();

?>
