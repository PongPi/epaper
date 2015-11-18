<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SilverHand" />
	<title>BPN</title>
</head>
<body>
<?php
//Baokim Payment Notification (BPN) Sample
//Lay thong tin tu Baokim POST sang
$req = '';
foreach ( $_POST as $key => $value ) {
	$value = urlencode ( stripslashes ( $value ) );
	$req .= "&$key=$value";
}
$dbhost="localhost";
$dbuser="root";
$dbpass="hellokhungiu";
$dbname="demo";
$db = mysql_connect($dbhost,$dbuser,$dbpass) or die("cant connect db");
mysql_select_db($dbname) or die("cant select db");
//thuc hien  ghi log cac tin nhan BPN
$myFile = "logs/bpn.log";
$fh = fopen($myFile, 'a') or die("can't open file");
fwrite($fh, $req);

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
	//...
	
	//kiem tra trang thai giao dich
if ($transaction_status == 4||$transaction_status == 13){//Trang thai giao dich =4 la thanh toan truc tiep = 13 la thanh toan an toan
		//xac nhan la da thanh toan thanh cong don hang
		// Thao tac voi co so du lieu
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
?>
<script type="text/javascript">
	window.location = "http://google.com.vn";
</script>
</body>
</html>