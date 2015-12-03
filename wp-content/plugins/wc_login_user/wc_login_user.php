<?php
/*
 Plugin Name: WC LOGIN USER
Plugin URI: None
Description: Đây là một plugin dùng để quản lý user 
Author: TrungTran - Duc Nguyen
Version: 1.0
Author URI: None
*/

// Hàm khởi tạo bảng dât khi kích hoạt plugin
function wc_create_table() 
{
	global $wpdb;
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

	$table_name = $wpdb->prefix.'user_detail';

	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
      id_user int(11) NOT NULL AUTO_INCREMENT,
      name varchar(255) DEFAULT NULL,
      myMoney int(11) DEFAULT NULL,
      myEmail varchar(255) DEFAULT NULL,

      startDate timestamp DEFAULT CURRENT_TIMESTAMP,
      endDate timestamp DEFAULT CURRENT_TIMESTAMP,
      
      UNIQUE KEY id (id_user)
    );";

    dbDelta($sql);

}

function wc_create_table_order_now() 
{
  global $wpdb;
  require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

  $table_name = $wpdb->prefix.'order_now';

  $sql = "CREATE TABLE IF NOT EXISTS $table_name (
      id int(11) NOT NULL AUTO_INCREMENT,
      email varchar(255) DEFAULT NULL,
      orderId varchar(255) DEFAULT NULL,
      productId varchar(255) DEFAULT NULL,
      status varchar(255) DEFAULT 'Chua thanh toan',
      orderTimeDate timestamp DEFAULT CURRENT_TIMESTAMP,
      UNIQUE KEY id (id)
    );";
    dbDelta($sql);
}

function wc_create_table_download() 
{
  global $wpdb;
  require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

  $table_name = $wpdb->prefix.'user_download';

  $sql = "CREATE TABLE IF NOT EXISTS $table_name (
      id int(11) NOT NULL AUTO_INCREMENT,
      id_user int(11) NOT NULL,
      id_product varchar(255) NOT NULL,
      name_product varchar(255) NOT NULL,
      downloadDate timestamp DEFAULT CURRENT_TIMESTAMP,
      UNIQUE KEY id (id)
    );";

    dbDelta($sql);

}

register_activation_hook( __FILE__, 'wc_create_table' );
register_activation_hook( __FILE__, 'wc_create_table_download' );
register_activation_hook( __FILE__, 'wc_create_table_order_now' );

//Ham insert id user vào dữ liệu vào data base
function wc_add_id_user($user_id)
{
	global $wpdb;
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

  $id = $user_id;

  $name = $_POST["email"];
  $myMoney = 0;
  $myEmail = $_POST["email"];

  $table_name = $wpdb->prefix.'user_detail';

  //hàm Insert vào data base
  $result = $wpdb->insert(
      $table_name,
      array('id_user'=>$id,'name'=>$name,'myEmail'=>$myEmail,'myMoney'=>$myMoney),
      array('%d','%s', '%s', '%s')
  );
}
//Hook vào hành động regíter
add_action('user_register','wc_add_id_user');

// Thêm menu plug-in vào menu admin
add_action('admin_menu','wc_create_menu');

function wc_create_menu()
{
	//vị trị display_init là gọi hàm
	add_menu_page('Manager Customer','Quản lý khách hàng','manage_options','manager-customer','display_menu','dashicons-admin-network');
	add_submenu_page( 'manager-customer', 'Danh sách tải', 'Danh sách tải', 'manage_options', 'epaper-manager-customer', 'display_init');
  add_submenu_page( 'manager-customer', 'Tuỳ chỉnh',     'Tuỳ chỉnh',     'manage_options', 'epaper-manager-options', 'display_options');

}

// Hàm gọi hiển thị menu name "Danh sach" va "Thêm mới"
function display_menu()
{
	echo 'Danh sách Khách Hàng';
	//Hàm xuất dữ liệu từ table users
	//get_table_user();

  tt_render_list_page();
	
}
//Hàm gọi hiển thị cho menu name "Quản lý khách hàng"
function display_init()
{
    render_list_table_dowload();

}
function display_options()
{ 
    global $wpdb;
    $add_money = get_option('epaper_option_add_money');
    if(!isset($add_money) || $add_money == ''){
      add_option( 'epaper_option_add_money', '50000', '', 'yes' );
    }

    $limit_download = get_option('epaper_option_limit_download');
    if(!isset($limit_download) || $limit_download == ''){
      add_option( 'epaper_option_limit_download', '10', '', 'yes' );
    }

    $day_vip = get_option('epaper_option_day_vip');
    if(!isset($day_vip) || $day_vip == ''){
      add_option( 'epaper_option_day_vip', '30', '', 'yes' );
    }

    if(isset($_POST['add_money'])){
      update_option( 'epaper_option_add_money', $_POST['add_money'] );
    }
    if(isset($_POST['limit_download'])){
      update_option( 'epaper_option_limit_download', $_POST['limit_download'] );
    }
    if(isset($_POST['day_vip'])){
      update_option( 'epaper_option_day_vip', $_POST['day_vip'] );
    }
    
    if(isset($_POST['email_paypal'])){
      update_option( 'epaper_option_email_paypal', $_POST['email_paypal'] );
    }
    if(isset($_POST['email_baokim'])){
      update_option( 'epaper_option_email_baokim', $_POST['email_baokim'] );
    }

    if(isset($_POST['merchant_id'])){
      update_option( 'epaper_option_merchant_id_baokim', $_POST['merchant_id'] );
    }

    if(isset($_POST['money_for_download'])){
      update_option( 'epaper_option_money_for_download', $_POST['money_for_download'] );
    }
    
    

    render_epaper_options();

}
function my_create_user()
{
    //html_form_register();
    // Gọi hàm chức năng insert vào data base
    insert_data();
}
// //Hàm tạo form đăng ký
// function html_form_register()
// {
// 	echo '<form action="' . esc_url( $_SERVER['REQUEST_URI'] ) . '" method="post">';

//         echo '<p>';
//         echo 'ID (required) <br />';
//         echo '<input type="text" name="wc-id" size="40" />';
//         echo '</p>';

//         echo '<p>';
//         echo 'Engine (required) <br />';
//         echo '<input type="text" name="wc-name" size="40" />';
//         echo '</p>';

//         echo '<p><input type="submit" name="wc-submit" value="Add"/></p>';
//         echo '</form>';
// }
function detail_user($id){
    echo 'day laf thong tin user';
}
// Hàm insert dữ liệu vào data
function insert_data()
{
	global $wpdb;

    if(isset($_POST['wc-submit']))
    {
        $id = $_POST['wc-id'];
        $name = $_POST['wc-id'];

        $table_name = $wpdb->prefix.'user_detail';

        //hàm Insert vào data base
        $result = $wpdb->insert(
            $table_name,
            array('id_user'=>$id,'name' => $name),
            array('%d','%s')
        );

        if($result)
        {
           echo 'Luu ket qua thanh cong';     
        }
        else
        {
            echo 'Insert bi loi !!!!';
        }
    }
}
function render_epaper_options()
    {
            // Logged in.
            global $wpdb;
            $add_money = get_option('epaper_option_add_money');
            if(!isset($add_money) || $add_money == ''){
              add_option( 'epaper_option_add_money', '50000', '', 'yes' );
            }

            $money_for_download = get_option('epaper_option_money_for_download');
            if(!isset($money_for_download) || $money_for_download == ''){
              add_option( 'epaper_option_money_for_download', '5000', '', 'yes' );
            }

            // $limit_download = get_option('epaper_option_limit_download');
            // if(!isset($limit_download) || $limit_download == ''){
            //   add_option( 'epaper_option_limit_download', '10', '', 'yes' );
            // }

            // $day_vip = get_option('epaper_option_day_vip');
            // if(!isset($day_vip) || $day_vip == ''){
            //   add_option( 'epaper_option_day_vip', '30', '', 'yes' );
            // }

            $email_paypal = get_option('epaper_option_email_paypal');
            $email_baokim = get_option('epaper_option_email_baokim');
            $merchant_id = get_option('epaper_option_merchant_id_baokim');


            ?>
            <div class="clearfix"></div>
            <div class="container wrap">
                <div class="row">
                    <div class="col-md-4">
                <form action="<?php echo esc_url( $_SERVER['REQUEST_URI'] ); ?>" method="post">
                  <div class="form-group">
                    <label for="name">Số tiền mỗi lần khách hàng nạp vào</label>
                    <input type="text" value="<?php echo $add_money; ?>" class="form-control" id="add_money" name="add_money">
                  </div>

                  <div class="form-group">
                    <label for="name">Số tiền cho mỗi lượt </label>
                    <input type="text" value="<?php echo $money_for_download; ?>" class="form-control" id="money_for_download" name="money_for_download">
                  </div>
                  
                  <!--<div class="form-group">
                    <label for="name">Số lần download trong 1 ngày</label>
                    <input type="text" value="<?php echo $limit_download; ?>" class="form-control" id="limit_download" name="limit_download">
                  </div>-->
                  
                  <!--<div class="form-group">
                    <label for="name">Số ngày vip</label>
                    <input type="text" value="<?php echo $day_vip; ?>" class="form-control" id="day_vip" name="day_vip">
                  </div>-->

                  <div class="form-group">
                    <label for="name">Email Paypal</label>
                    <input type="text" value="<?php echo $email_paypal; ?>" class="form-control" id="email_paypal" name="email_paypal">
                  </div>

                  <div class="form-group">
                    <label for="name">Email Bao kim</label>
                    <input type="text" value="<?php echo $email_baokim; ?>" class="form-control" id="email_baokim" name="email_baokim">
                  </div>

                  <div class="form-group">
                    <label for="name">Merchant ID Bao kim</label>
                    <input type="text" value="<?php echo $merchant_id; ?>" class="form-control" id="merchant_id" name="merchant_id">
                  </div>

                  
                  <button type="submit" class="btn btn-success" name="wc-submit">Lưu thông tin</button>
                </form>

            <?php
    }
function wc_get_infor_user_detail_by_id($user_id)
{
  global $wpdb;
    $table_name = $wpdb->prefix.'user_detail';
    $results = $wpdb->get_results("SELECT * FROM ".$table_name." WHERE id_user = '".$user_id."'");
    return $results;

}
// Hàm lấy xuất dữ liệu ra bảng
//Ở đâu tau lấy bảng ep_user tý nữa mi thêm trường rồi lấy từ bảng user_detail nhé
function get_table_user()
{
    if(isset($_GET["id"]))
    { 
      $id = $_GET["id"];
      echo $_GET["id"]."<br>";
      
      $current_user = wc_get_infor_user_detail_by_id($id)[0];
      var_dump($current_user);
        ?>
        <br>
        <div class="form-horizontal" style="border: solid 1px;border-radius: 5px;">
          <div class="form-group">
            <label class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
              <p class="form-control-static"><?php echo $current_user->name ?></p>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
              <p class="form-control-static"><?php echo $current_user->myEmail ?></p>
            </div>
          </div>

        </div>

        <div class="row">
            <div class="main-content col-md-12">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Tên tài liệu</th>
                      <th>Thời gian đã tải</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    global $wpdb;

                    //$table_name = $wpdb->prefix.'users';
                    $table_name_download = $wpdb->prefix.'user_download';

                    $results = $wpdb->get_results("SELECT * FROM ".$table_name_download." where id_user = ".$current_user->id_user);
                    $i = 0;
                    foreach ($results as $result)
                    {

                    ?>
                    <tr>
                      <th scope="row"><?php echo $i; ?></th>
                      <td><?php echo $results->name_product; ?></td>
                      <td><?php echo $results->downloadDate; ?></td>
                    </tr>

                    <?php 
                    $i ++;
                    }
                    ?>

                  </tbody>
                </table>    
            </div>

            
        </div>
        <?php
    } else {
        ?>
        <table class="wp-list-table widefat fixed striped media">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>NAME</td>
                    <td>MONEY</td>
                </tr>
            </thead>
            <tbody class="the-list">
        <?php
            global $wpdb;

            //$table_name = $wpdb->prefix.'users';
            $table_name = $wpdb->prefix.'user_detail';

            $results = $wpdb->get_results("SELECT * FROM ".$table_name);

            foreach ($results as $result)
            {
                echo '<tr>';
                echo '<td><a href="#">'.$result->id_user.'</a></td>';
                // echo '<td>'.$result->user_login.'</td>';
                echo '<td>'.$result->myEmail.'</td>';
                 
                if( strtotime($result->endDownload) < strtotime(date('Y-m-d H:i:s'))) 
                { 
                  echo '<td>'."Hết hạn".'</td>';
                } else 
                { 
                  echo '<td>'.$detailUser->endDownload.'</td>';
                } 
              
                echo '</tr>';
            }

        ?>
            </tbody>
        </table>
        <?php
    }
    
}
function get_detail_user(){

    $current_user = wp_get_current_user();
    if ( 0 == $current_user->ID ) {
        // Not logged in.
        // Chuyển trang login
        echo "LOGIN";
    } else {
        // Logged in.
        global $wpdb;

        //$table_name = $wpdb->prefix.'users';
        $table_name_download = $wpdb->prefix.'user_download';

        $products = $wpdb->get_results("SELECT * FROM ".$table_name_download." where id_user = ".$current_user->ID);

        $detailUser = wc_get_infor_user_detail($current_user->ID)[0];
        setlocale(LC_MONETARY, 'vi_VND');

        ?>
        <br>
        <style type="text/css">
          .woocommerce{
            display: none;
          }
          #content{
            padding: 55px;
          }
        </style>
        <div id="user-info">

        <div class="col-sm-3">
          <form action="https://baokim.vn/payment/product/version11" method="get" target="_blank">
          <input type="hidden" name="business" value="<?php echo get_option('epaper_option_email_baokim'); ?>">
          <input type="hidden" name="product_name" value="booking">
          <input type="hidden" name="product_price" value="50000">
          <input type="hidden" name="product_quantity" value="1">
          <input type="hidden" name="total_amount" value="50000">
          <input type="hidden" name="url_detail" value="lab.hoangdoan.io:8080">
          <input type="hidden" name="url_success" value="http://lab.hoangdoan.io:8080/baokim.php">
          <input type="hidden" name="url_cancel" value="http://lab.hoangdoan.io:8080/my-account">
          <input type="hidden" name="order_description" value="">
          <input type="hidden" name="id" value="">
          <input type="image" src="http://www.baokim.vn/developers/uploads/baokim_btn/thanhtoan-l.png" border="0" name="submit" alt="Thanh toán an to[0m| n v[0m~[i Bảo Kim !" title="Thanh toán trực tuyến an to[0m| n dùng t[0m| i khoản Ngân h[0m| ng (VietcomBank, Techcoo
mBank, [0m~Pông [0m~A, VietinBank, Quân [0m~P[0m~Yi, VIB, SHB,... v[0m|  thẻ Qu[0m~Qc tế (Visa, Master Card...) qua C[0m~Ung thanh toán �c tuyến BảoKim.vn"></form>

	  <br></br>
	  <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
	  <input type="hidden" name="cmd" value="_xclick">
	  <input type="hidden" name="business" value="<?php echo get_option('epaper_option_email_paypal'); ?>">
	  <input type="hidden" name="lc" value="VN">
	  <input type="hidden" name="item_name" value=<?php echo $current_user->user_email; ?>>
	  <input type="hidden" name="amount" value="6.00">
	  <input type="hidden" name="currency_code" value="USD">
	  <input type="hidden" name="button_subtype" value="services">
	  <input type="hidden" name="no_note" value="0">
	  <input type="hidden" name="return" value="http://localhost/payment">
	  <input type="hidden" name="rm" value="2">
	  <input type="hidden" name="cancel_return" value="http://localhost/my-account">
	  <input type="hidden" name="bn" value="PP-BuyNowBF:btn_paynowCC_LG.gif:NonHostedGuest">
	  <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
	  <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
	  </form>
        </div>

        <div class="form-horizontal col-sm-9" style="border: solid 1px;border-radius: 2px;padding:10px;">
          <h3>THÔNG TIN TÀI KHOẢN <small><code><?php echo $current_user->user_email ?></code></small></h3>
          <div class="form-group">
            <label class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
              <p class="form-control-static"><code><?php echo $current_user->user_login ?></code></p>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
              <p class="form-control-static"><code><?php echo $detailUser->myEmail; ?></code></p>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label">Số tài liệu đã tải</label>
            <div class="col-sm-10">
              <p class="form-control-static"><code><?php echo sizeof($products); ?> lượt</code></p>
            </div>
          </div>
        </div>
        

        <div class="row">
            <div class="main-content col-md-12">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Tên tài liệu</th>
                      <th>Thời gian đã tải</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i = 1;
                    foreach ($products as $product)
                    {

                    ?>
                    <tr>
                      <th scope="row"><?php echo $i; ?></th>
                      <td><a href="<?php echo post_permalink($product->id_product); ?>"><?php echo $product->name_product; ?></a></td>
                      <td><?php echo $product->downloadDate; ?></td>
                    </tr>

                    <?php 
                    $i ++;

                    }
                    ?>

                  </tbody>
                </table>    
            </div>

            
        </div>


        </div>
        <?php

    }
}

//Tạo short code danh user cho plugin 
//Vị trí đầu tiên là tên shortcode wc_list_user
//get_table_user là gọi dến hàm.(Viết hàm mới thay thế để hiển thị khác đừng sửa trong này)
// Cách sử dụng: copy [wc_list_user] vào một nội dung của một post(bài viết)
add_shortcode( 'wc_list_user', 'get_table_user');
add_shortcode( 'wc_detail_user', 'get_detail_user');

//Hàm điều hướng sau khi đăng nhập
function set_reaload_session($user_login){

    global $wpdb;
    $table_name_user = $wpdb->prefix.'users';

    $users = $wpdb->get_results("SELECT * FROM ".$table_name_user." where user_login = '".$user_login."'");
    if(isset($users[0])){
      $user = $users[0];
      //var_dump($user);die;
      $table_meta_user = $wpdb->prefix.'usermeta';
      $results = $wpdb->get_results("SELECT meta_value FROM ".$table_meta_user." where user_id = '".$user->ID."' and meta_key = 'ep_user_level'");
      if($results[0]->meta_value == 0){
        $url = home_url()."/my-account";
        wp_redirect($url);
        exit;
      } else {
        $url = home_url()."/wp-admin";
        wp_redirect($url);
        exit;
      }
    }
}

function set_reaload_session_register($user_id){

    $user = get_user_by( 'email', trim( $_POST['email'] ));
    if(isset($user)){
      if($_POST['ws_plugin__s2member_custom_reg_field_user_pass1'] == $_POST['ws_plugin__s2member_custom_reg_field_user_pass2'] && strlen($_POST['ws_plugin__s2member_custom_reg_field_user_pass1']) > 6 )
      {
        reset_password($user, $_POST['ws_plugin__s2member_custom_reg_field_user_pass1']);
      }
    }
    $url = home_url()."/";
    wp_redirect($url);
    exit;
}

add_action('wp_login', 'set_reaload_session');
add_action('user_register','set_reaload_session_register');


// Khai báo link file
define('WC_SETTING_PLUGIN_URL',plugin_dir_url(__FILE__));
define('WC_SETTING_PLUGIN_DIR',plugin_dir_path(__FILE__));
define('WC_SETTING_PLUGIN_INCLUDES_DIR',plugin_dir_path( __FILE__ ));
define('WC_SETTING_VIEWS_DIR',plugin_dir_path( __FILE__ ));

if(!is_admin())
{
	require WC_SETTING_PLUGIN_INCLUDES_DIR.'includes/frontend.php';
}
else
{
	require WC_SETTING_PLUGIN_INCLUDES_DIR.'includes/backend.php';
  require WC_SETTING_PLUGIN_INCLUDES_DIR.'includes/list_table_download.php';
}

?>
