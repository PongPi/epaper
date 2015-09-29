<?php


function Paypay_return()
{
  $email = $_POST['item_name'];
  $payment_gross = $_POST['payment_gross'];
  $mc_currency = $_POST['mc_currency'];
  if ( (int)$payment_gross != 6 )
  {
    echo '<script> alert("Phát hiện lừa đảo !!!!") && window.location="http://localhost:8080"  </script>';
    exit();
  }
  $user_id = get_current_user_id();
  $myMoney = $myMoney + $mc_currency * 22000;
  global $wpdb;
  $table_name = $wpdb->prefix.'user_detail';

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
 
function Nganluong_return()
{
 	 //Lấy thông tin giao dịch
	$transaction_info=$_GET["transaction_info"];
	//Lấy mã đơn hàng 
	$order_code=$_GET["order_code"];
	//Lấy tổng số tiền thanh toán tại ngân lượng 
	$price=$_GET["price"];
	//Lấy mã giao dịch thanh toán tại ngân lượng
	$payment_id=$_GET["payment_id"];
	//Lấy loại giao dịch tại ngân lượng (1=thanh toán ngay ,2=thanh toán tạm giữ)
	$payment_type=$_GET["payment_type"];
	//Lấy thông tin chi tiết về lỗi trong quá trình giao dịch
	$error_text=$_GET["error_text"];
	//Lấy mã kiểm tra tính hợp lệ của đầu vào 
	$secure_code=$_GET["secure_code"];
	
	if ( $price != 50000 )
	{
	  echo '<script> alert("Phát hiện lừa đảo !!!!") && window.location="http://localhost:8080"  </script>';
	  exit();
	}
	
	$user_id = get_current_user_id();
	$myMoney = $myMoney + $price;
	
	global $wpdb; 
	$table_name = $wpdb->prefix.'user_detail';

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

	if ( $_SERVER['HTTP_REFERER'] != "paypal.com" && $_SERVER['HTTP_REFERER'] != "nganluong.vn" )
	{
	  echo 	"Lỗi xảy ra trong quá trình xác thực";
	  exit();
	}
	elseif ($_SERVER['HTTP_REFERER'] != "paypal.com")
	{
	  Paypal_return;
	}
	else 
	{
	  Nganluong_return;
	}

?>
