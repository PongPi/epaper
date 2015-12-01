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
	global $product;
	?>
	<style type="text/css">
		.modal-backdrop{
			z-index: -1;
		}
	</style>
	<button type="button" style="margin-bottom: 15px;" class="btn btn-success" data-toggle="modal" data-target="#myModal">DOWNLOAD NGAY</button>
	<!-- Modal -->
		<div class="fancybox-wrap fancybox-desktop fancybox-type-ajax fancybox-opened modal fade" id="myModal" role="dialog">
		    <div class="modal-dialog" style="z-index: 1;">
		    
		      <!-- Modal content-->
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title">Nhập địa chỉ mail để chúng tôi gửi tài liệu</h4>
		        </div>
		        <div class="modal-body">

			        <div class="form-group">
					  <label for="usr">Email:</label>
					  <input type="text" class="form-control" id="email" name="email" onchange="myEmail()">
					</div>
					<script type="text/javascript">
						function myEmail(){
							var email = document.getElementById('email').value;
							if(email.split('@').length == 2){

								var a = document.getElementById("baokim_link");
								a.className = "btn btn-success";

								var b = document.getElementById("paypal_link");
								b.className = "btn btn-success";

								document.getElementById("baokim_link").href = document.getElementById("baokim_link").href + "&email=" + email; 
								document.getElementById("paypal_link").href = document.getElementById("paypal_link").href + "&email=" + email;

							} else {
								var a = document.getElementById("baokim_link");
								a.className = "disabled btn btn-success";

								var b = document.getElementById("paypal_link");
								b.className = "disabled btn btn-success";
							}
						}
					</script>
					<div class="form-group">
					  <label for="usr" style="min-width: 250px;">Thanh toán bằng Bảo Kim  </label>
					  <a id="baokim_link" href="/thanhtoan/index.php?id=<?=$product->id?>&price=<?=$product->price?>" class="disabled btn btn-success" style="min-width: 250px;">Bảo Kim</a>
					  
					  <form action="https://baokim.vn/payment/product/version11" method="get" target="_blank">
				          <input type="hidden" name="business" value="">
				          <input type="hidden" name="product_name" value="booking">
				          <input type="hidden" name="product_price" value="5000">
				          <input type="hidden" name="product_quantity" value="1">
				          <input type="hidden" name="total_amount" value="5000">
				          <input type="hidden" name="url_detail" value="lab.hoangdoan.io:8080">
				          <input type="hidden" name="url_success" value="http://lab.hoangdoan.io:8080/baokim.php">
				          <input type="hidden" name="url_cancel" value="http://lab.hoangdoan.io:8080/my-account">
				          <input type="hidden" name="order_description" value="">
				          <input type="hidden" name="id" value="">
				          <input type="image" src="http://www.baokim.vn/developers/uploads/baokim_btn/thanhtoan-l.png" border="0" name="submit" alt="Thanh toán an to[0m| n v[0m~[i Bảo Kim !" title="Thanh toán trực tuyến an to[0m| n dùng t[0m| i khoản Ngân h[0m| ng (VietcomBank, Techcoo
				mBank, [0m~Pông [0m~A, VietinBank, Quân [0m~P[0m~Yi, VIB, SHB,... v[0m|  thẻ Qu[0m~Qc tế (Visa, Master Card...) qua C[0m~Ung thanh toán �c tuyến BảoKim.vn">
					</form>

					</div>

					<div class="form-group">
					  <label for="usr" style="min-width: 250px;">Thanh toán bằng PayPal    </label>
					  <a id="paypal_link" href="#" class="disabled btn btn-success" style="min-width: 250px;">PayPal</a>
					</div>


		        </div>
		        <div class="modal-footer">
		          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        </div>
		      </div>
		      
		    </div>
		</div>
	

	<?
	
	if(is_user_logged_in())
	{
		
		//echo var_dump($product);
		//echo get_permalink();
		wc_html_button_dowbload();
		
		if (isset($_GET['download']))
		{	
			
			$linkFile = get_post_meta( $product->id, '_link_download', true );
			$arr = explode("/uploads", $linkFile);

			if(isset($linkFile) && sizeof($arr) > 1){
				$dirFile = $arr[1];
				if(file_exists(WP_CONTENT_DIR .'/uploads'.$dirFile)){
					$attachments = array( WP_CONTENT_DIR .'/uploads'.$dirFile );

					if(check_user())
					{
						
						$current_user = wp_get_current_user();
						$email = $current_user->user_email;

						
						$headers = 'From: EPAPER <epaper@epaper.com>' . "\r\n";
						$name = $product->post->post_title;
						wp_mail( $email, 'EPAPER - FILE YOU DOWNLOAD', 'EPAPER - THANK FOR YOU DOWNLOAD - '.$name, $headers, $attachments );

						//display message based on the result.
						echo "<h3> File đã được gửi đến mail của bạn. <br>Vui lòng kiểm tra hòm thư SPAM</h3>";
						
						// if ( $sent_message ) {
						//     // The message was sent.

						//     echo "<h3> File đã được gửi đến mail của bạn. <br>Vui lòng kiểm tra hòm thư SPAM</h3>";

						// } else {
						//     // The message was not sent.
						//     echo '<h3> Xin vui lòng nhấn download lại hoặc đăng nhập</h3> ';
						// }

					} else {
						 echo '<h3>Xin vui bạn hết lượt tải trong ngày hoặc tài khoản hết hạn.</h3>';
					}

				} else {
					echo "Lỗi không tìm thấy file PDF".WP_CONTENT_DIR .'/uploads'.$dirFile;
				}
				
			} else {
				echo "Tài liệu này chưa có file PDF";
			}
		}
	}
	else
	{
		echo '<a class="btn btn-success" href="/my-account" role="button">DOWNLOAD</a>';
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

	//$pirce = intval($product->regular_price);
	$price = get_option('epaper_option_money_for_download');

	$id_product = $product->id;
	$name_product = $product->post->post_title;
	
	$user_id = get_current_user_id();

	$results = wc_get_infor_user_detail($user_id);

	$myMoney = intval($results[0]->myMoney);
	// if(wc_get_infor_user_download($user_id,$id_product))
	// {
	// 	return true;
	// }
	$count = wc_get_count_user_download($user_id);
	$limit = get_option('epaper_option_limit_download');

	if( $myMoney > $price) 
	{
		//Tru tien
		$myMoney = $myMoney - $price;
		wc_update_user_detail($myMoney,$user_id);
		wc_add_detail_dowload($user_id,$id_product,$name_product);

		return true;
	}
	else
	{
		echo 'Tài khoản không đủ tiền.';
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

function wc_get_count_user_download($user_id)
{
	global $wpdb;
    $table_name = $wpdb->prefix.'user_detail';
    $results = $wpdb->get_results("SELECT count(*) as count FROM ep_user_download WHERE id_user = ".$user_id." and DAY(downloadDate) = DAY(NOW()) and MONTH(downloadDate) = MONTH(NOW()) and YEAR(downloadDate) = YEAR(NOW())");
    return $results[0]->count;

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
?>