<?php
require_once('./wp-config.php');

//Baokim Payment Notification (BPN) Sample
//Lay thong tin tu Baokim POST sang

$req = ''; 
foreach ( $_POST as $key => $value ) { 
        $value = urlencode ( stripslashes ( $value ) );
        $req .= "&$key=$value";
}

//thuc hien  ghi log cac tin nhan BPN
$myFile = "logs/baokim.log".date("Y-m-d");
$fh = fopen($myFile, 'a') or die("can't open file");
fputcsv($fh, $_POST); 

$ch = curl_init();

//Dia chi chay BPN test
//curl_setopt($ch, CURLOPT_URL,'http://sandbox.baokim.vn/bpn/verify');

//Dia chi chay BPN that
curl_setopt($ch, CURLOPT_URL,'https://www.baokim.vn/bpn/verify');
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
$result = curl_exec($ch);
$status = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
$error = curl_error($ch);

if($result != '' && strstr($result,'VERIFIED') && $status==200){
	//thuc hien update hoa don
	fwrite($fh, ' => VERIFIED');
	
	$order_id = $_POST['order_id'];
	$transaction_id = $_POST['transaction_id'];
	$transaction_status = $_POST['transaction_status'];
	$total_amount = $_POST['total_amount'];
	
	//Mot so thong tin khach hang khac
	$customer_name = $_POST['customer_name'];
	$customer_address = $_POST['customer_address'];
	$pay_amount = $_POST['net_amount'];
	$merchant_id = $_POST['merchant_id'];
	$my_merchant = get_option('epaper_option_merchant_id_baokim');
	//...
	
	//kiem tra trang thai giao dich
if ($transaction_status == 4||$transaction_status == 13){//Trang thai giao dich =4 la thanh toan truc tiep = 13 la thanh toan an toan
  if ( intval($pay_amount) != 50000 || $merchant_id != $my_merchant )
  {
    echo '<script> alert("Phát hiện lừa đảo !!!!") && window.cation="http://lab.hoangdoan.io:8080"  </script>';
    exit();
  }
  $user_id = get_current_user_id();
  global $wpdb;
  $table_name = $wpdb->prefix.'user_detail';
  $results = $wpdb->get_results("SELECT * FROM ".$table_name." WHERE id_user = '".$user_id."'");  
  $myMoney = intval($results[0]->myMoney);
  $myMoney = $myMoney + intval($pay_amount) ;
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
	
	/**
	 * Neu khong thi bo qua
	 */
}else{
	fwrite($fh, ' => INVALID');
}

if ($error){
	fwrite($fh, " | ERROR: $error");
}

fwrite($fh, "\r\n");
fclose($fh);
header("HTTP/1.1 301 Moved Permanently"); 
header("Location: /my-account"); 
exit();
?>
