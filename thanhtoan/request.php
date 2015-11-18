<?php

require_once('constants.php');
require_once('baokim_payment_pro.php');
require_once('baokim_payment.php');

if(isset($_POST)&&$_POST){
	foreach($_POST as $key=>$value){
		$_POST[$key]=trim($value);
	}
}

if(isset($_POST['pmt_method_payment']) && $_POST['pmt_method_payment'] == 'invoid'){
	echo 'Xử lý thông tin In đơn hàng'; 
	header('Location: /gio-hang.html');

	die;
}

if(isset($_POST['pmt_method_payment']) && $_POST['pmt_method_payment'] == 1){

	if(isset($_POST['bank_payment_method_id']) && !empty($_POST['bank_payment_method_id'])){
	$data = $_POST;
	
	$baokim = new BaoKimPaymentPro();
	$result = $baokim->pay_by_card($data);
	if(!empty($result['error'])){
			echo '<p><strong style="color:red">' . $result['error'] . '</strong></p></div>';
			die;
		}
		$baokim_url = $result['redirect_url'] ? $result['redirect_url'] : $result['guide_url'];
		echo "<script>window.location='".$baokim_url."'</script>";

	}else{
		$data = $_POST;
		$baokim = new BaoKimPayment();
		$baokim_url = $baokim->createRequestUrl($data);
		echo "<script>window.location='".$baokim_url."'</script>";
		//echo "<meta http-equiv='refresh' content='0;url=$request_url' />";
	}

}

