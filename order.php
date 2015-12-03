<?php

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


	echo $orderId;
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