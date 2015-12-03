<?php
include('BaoKimPayment.php');
require_once('./wp-config.php');
global $wpdb;
$table_name = $wpdb->prefix.'order_now';

$results = $wpdb->get_results("SELECT * FROM ".$table_name." WHERE id_user = '".$user_id."'");  

if(isset($_POST["email"]))
{	
	$orderId = createRandomOrderId();
    

	$result = $wpdb->insert(
        $table_name,
        array('email'=> $_POST["email"], 'orderId' => $orderId, 'productId'=> $_POST["productId"]),
        array('%s', '%s', '%s')
    );

    $product_name = $_POST['productName'];

    $bk = new BaoKimPayment();

    $order_id = $orderId;

    $business = 'nguyenduc1222@gmail.com';

    $total_amount = 5000;

    $shipping_fee = 0;

    $tax_fee = 0;

    $order_description = $product_name;

    $url_success = '#';

    $url_cancel = '#';

    $url_detail = '#';

    echo $bk->createRequestUrl($order_id, $business, $total_amount, $shipping_fee, $tax_fee, $order_description, $url_success, $url_cancel, $url_detail);

}

function createRandomOrderId() { 

    $chars = "abcdefghijkmnopqrstuvwxyz023456789"; 
    srand((double)microtime()*1000000); 
    $i = 0; 
    $OrderId = '' ; 

    while ($i <= 7) { 
        $num = rand() % 33; 
        $tmp = substr($chars, $num, 1); 
        $OrderId = $OrderId . $tmp; 
        $i++; 
    } 

    return $OrderId; 

} 

?>