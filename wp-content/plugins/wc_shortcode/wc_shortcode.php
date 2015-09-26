<?php
/*
 Plugin Name: WC SHORT CODE
Plugin URI: None
Description: Đây là một plugin tao short code
Author: TrungTran - Duc Nguyen
Version: 1.0
Author URI: None
*/
add_action('woocommerce_single_product_summary','wc_create_button_dowload',11);

function wc_create_button_dowload()
{
	
	if(is_user_logged_in())
	{
		global $product;
		//echo var_dump($product);
		//echo get_permalink();
		wc_html_button_dowbload();
		
		if (isset($_GET['download']))
		{	
		
			if(check_user())
			{
				
				$current_user = wp_get_current_user();
				$email = $current_user->user_email;

				$linkFile = get_post_meta( $product->id, '_link_download', true );
				$attachments = array( WP_CONTENT_DIR . '/uploads/woocommerce_uploads/2015/07/1.-RA-CAN-BAI-30-NHU-CAU-tr-1-42.pdf' );
				$headers = 'From: EPAPER <epaper@epaper.com>' . "\r\n";
				wp_mail( $email, 'EPAPER - FILE YOU DOWNLOAD', 'EPAPER - THANK FOR YOU DOWNLOAD', $headers, $attachments );

				//display message based on the result.
				if ( $sent_message ) {
				    // The message was sent.

				    echo "<h3> File đã được gửi đến mail của bạn. <br>Vui lòng kiểm tra hòm thư SPAM</h3>";

				} else {
				    // The message was not sent.
				    echo '<h3> Xin vui lòng nhấn download lại hoặc đăng nhập</h3>';
				}

			} else {
				 echo '<h3>Xin vui lòng nạp thêm tiền vài tài khoản.</h3>';
			}
		}
	}
	else
	{
		echo '<a class="btn btn-success" href="'.get_permalink(2790).'" role="button">DOWNLOAD</a>';
	}
}
	
function wc_html_button_dowbload()
{
	?>
	<a class="btn btn-success" style="margin-bottom: 15px;" href="<?php echo get_permalink();?>?download=true" role="button">DOWNLOAD</a>
	<?php
}
function check_user()
{
	global $product;

	$pirce = intval($product->regular_price);
	$id_product = $product->id;
	$name_product = $product->post->post_title;
	
	$user_id = get_current_user_id();

	$results = wc_get_infor_user_detail($user_id);

	$myMoney = intval($results[0]->myMoney);
	if(wc_get_infor_user_download($user_id,$id_product))
	{
		return true;
	}
	if($myMoney >= $pirce)
	{
		//Tru tien
		$myMoney = $myMoney - $pirce;
		wc_update_user_detail($myMoney,$user_id);
		wc_add_detail_dowload($user_id,$id_product,$name_product);

		return true;

	}
	else
	{
		return false;
	}
}
function wc_get_infor_user_detail($user_id)
{
	global $wpdb;
    $table_name = $wpdb->prefix.'user_detail';
    $results = $wpdb->get_results("SELECT * FROM ".$table_name." WHERE id_user = '".$user_id."'");
    return $results;

}
function wc_get_infor_user_download($user_id,$id_product)
{
	global $wpdb;

     $table_name = $wpdb->prefix.'user_download';

     $results = $wpdb->get_results("SELECT * FROM ".$table_name." WHERE id_user = '".$user_id."' AND id_product='".$id_product."'");

     return count($results) > 0;

}
function wc_update_user_detail($myMoney,$user_id)
{
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
function wc_add_detail_dowload($user_id,$id_product,$name_product)
{
	global $wpdb;
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    $table_name = $wpdb->prefix.'user_download';

    //hàm Insert vào data base
    $result = $wpdb->insert(
        $table_name,
        array('id_user'=> $user_id,'id_product'=>$id_product,'name_product'=>$name_product),
        array('%d','%s', '%s')
    );

}