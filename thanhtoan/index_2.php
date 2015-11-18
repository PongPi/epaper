<?php
require_once('constants.php');
require_once('baokim_payment_pro.php');
require_once('baokim_payment.php');

@session_start();
error_reporting(E_ERROR | E_PARSE);
$baokim = new BaoKimPaymentPro();

$banks = $baokim->get_seller_info();

function checkVal($data){
    if(isset($data))
        echo $data;
    else
        echo "";
}

if(isset($_SESSION['cart2'])&& !empty($_SESSION['cart2'])){

    $_SESSION['cart'] = $_SESSION['cart2'];
}
else{
    header('Location: /thanhtoan/');
    exit;
}
    
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="keywords" content="Mobile, Laptop, rao vặt, sản phẩm, hỏi đáp, tin tức, cửa hàng" />
    <meta name="description" content="Website thương mại điện tử hàng đầu tại Việt Nam, cung cấp hàng trăm nghìn sản phẩm từ hàng nghìn nhà cung cấp khác nhau" />
    
    <title>Sản phẩm | Rao vặt | Hỏi đáp tư vấn | Đánh giá (Review) | Cửa hàng | Tin tức</title>
    <style type="text/css" media="all">
    @import "/payment/css/css_payment.css";
    </style>

    <style type="text/css" media="all">
    @import "/payment/css/simpleTip.css";
    </style>
    <style type="text/css" media="all">
    @import "/payment/css/windowPrompt.css";
    </style>
    <style type="text/css" media="all">
    @import "/payment/css/css_main.css";
    </style>
    <style type="text/css" media="all">
    @import "/payment/css/css_product.css";
    </style>

    <script type="text/javascript" src="/payment/js/jquery.min.js"></script>
    <script type="text/javascript">
        $( document ).ready(function() {
           
           $.ajax({
                url : "/cart/get-province-order", // gửi ajax đến file result.php
                type : "get", // chọn phương thức gửi là get
                success : function (result){
                    // Sau khi gửi và kết quả trả về thành công thì gán nội dung trả về
                    // đó vào thẻ div có id = result
                    $('#ord_city').html(result);
                    $('#ord_city option[value="<?php echo @$_SESSION['info']['province_id'] ?>"]').attr('selected', 'selected');
                    CityOnChange($('#ord_city'));
                }
            });
        });
        
        function loadDistrictOrder(obj){
            var id = $(obj).val();
            $.ajax({
                url : "http://lksshop.vn/cart/get-districts-order?id="+id, // gửi ajax đến file result.php
                type : "post", // chọn phương thức gửi là get
                dateType:"text", // dữ liệu trả về dạng text
                success : function (result){
                    // Sau khi gửi và kết quả trả về thành công thì gán nội dung trả về
                    // đó vào thẻ div có id = result
                    $('#ord_district').html(result);
                }
            });


        }

        function addFee(){
            var fee = $('#cart-delivery').val();

            fee = parseInt(fee);
            var number = String(fee).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
            $('#order_shipping_cost').html(number);
            addTotal();
        }

        

        function addTotal(){
            var myMoney = $('#total_amount_pay').data("total");
            myMoney = parseInt(myMoney);
           
            var fee = $('#cart-delivery').val();
            fee = parseInt(fee);

            myMoney = myMoney + fee;

            $('#cart-total').val(myMoney);
            var number = String(myMoney).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
            $('#total_money_pay').html(number);
        }
        function CityOnChange(option){

            var selected = $('#ord_city option:selected');
            $.ajax({
                url : "/cart/get-districts-order?id=" + selected.val() , // gửi ajax đến file result.php
                type : "get", // chọn phương thức gửi là get
                success : function (result){
                    // Sau khi gửi và kết quả trả về thành công thì gán nội dung trả về
                    // đó vào thẻ div có id = result
                    $('#ord_district').html(result);

                    var district = $('#ord_district option[value="<?php echo @$_SESSION['info']['district_id'] ?>"]');
                    if(district.length > 0)
                        district.attr('selected', 'selected');
                }
            });

            var fee = parseInt(selected.data('transportfee'));
            $('input[id=cart-delivery]').attr('value',fee);
            addFee();

            return false;
        }
        $(document).on('change', '#ord_city', function () {
            CityOnChange(this);
        });
    </script>
</head>

<body>
    <div id="body">

        
<div id="container_body">
    <div id="container_content">
	<div style="text-align: center; margin-top: 30px">
	<a>
	<img width="200" style="margin: 0 auto;" src="http://lksshop.vn/assets/images/logo_03.png" /></a>
	</div>
	<div class="login_tab_payment" style="display:none;">
	<table cellpadding="0" cellspacing="0" border="0">
	<tr>
	<td><p><a href="javascripts:;" class="payment_login_idvg">Đăng nhập</a> tài khoản để quản lý đơn hàng của bạn tốt hơn. Hoặc sử dụng:</p></td>
	<td>
	<a class="payment_login_facebook facebook"></a>
	</td>
	<td>
	<a class="payment_login_google google"></a>
	</td>
	</tr>
	</table>
	</div>
    <div class="payment">
    <form class="form" name="frmPayment" id="frmPayment" action="/thanhtoan/request.php" method="post" enctype="multipart/form-data">
    <div class="payment_detail">
    <table class="form_table" cellpadding="0" cellspacing="0" align="center"></table><table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr id="rowPaymentDetail">
    <td valign="top" class="payment_user"><div class="title"><span class="icon">1</span>Thông tin người mua</div>
        <div class="content">
    <div class="form_content">

    <table class="form_table form_add_address" cellpadding="0" cellspacing="0" width="100%">
    <tr >
    <td colspan="2">
    <input class="form_control" type="text" autocomplete="name" title="Họ và tên người nhận" id="ord_name" name="payer_name" placeholder="Họ và tên" value="<?php checkVal(@$_SESSION['info']['full_name']); ?>" maxlength="250" tabindex="1" /></td>
    </tr>
    <tr >
    <td colspan="2">
    <input class="form_control" type="text" autocomplete="email" title="Email" id="ord_email" name="payer_email" placeholder="Email" maxlength="250" tabindex="2" value="<?php checkVal(@$_SESSION['info']['email']); ?>"/>
    <i style="font-size: 11px; color: #999;" id="ord_email_note">* lksshop.vn sẽ gửi thông báo xác nhận đơn hàng theo email này <?php checkVal(@$_SESSION['info']['email']); ?></i>
    </td>
    </tr>
    <tr>
    <td colspan="2"><input class="form_control" type="text" autocomplete="tel" onkeyup="checkPhone('ord_phone');" maxlength="12" title="Số điện thoại" id="ord_phone" name="payer_phone_no" placeholder="Số điện thoại" value="<?php checkVal(@$_SESSION['info']['tel']); ?>" maxlength="250" tabindex="3" /></td>
    </tr>
    <tr>
    <td style="padding-left: 1px; padding-right: 6px;">
    <select tabindex="4" id="ord_city" name="ord_city" class="form_control" onChange="loadDistrictOrder(this);">
    <option id="province" value="">Tỉnh/Thành phố</option>

    </select>
    </td>
    <td>
    <select tabindex="5" id="ord_district" name="ord_district" class="form_control">
    <option value="0">Quận/Huyện</option>
    </select>
    </td>
    </tr>
    <tr>
    <td colspan="2">
    <textarea class="form_control" id="ord_address" name="address" placeholder="Số nhà, đường phố, tòa nhà, thôn, xã,..." rows="2" tabindex="6"><?php echo @$_SESSION['info']['address']; ?></textarea>


    <?php
    $total = 0; 
    foreach ($_SESSION['cart']['products'] as $key => $value){
        $total += intval($value[0]['price']) * intval($value[0]['number']);
    }

    ?>
    <input id="total_amount_pay" type="hidden" data-total="<?php echo $total; ?>" value="<?php echo $total; ?>" name="total_amount">
    <input type="hidden" name="active_submit" value="submit"/>
    <input type="hidden" name="bank_payment_method_id" id="bank_payment_method_id" value=""/>
    <input type="hidden" name="shipping_address" size="30" value="Hà Nội"/>
    <input type="hidden" name="payer_message" size="30" value="Ok"/>
    <input type="hidden" name="extra_fields_value" size="30" value=""/>
    <input type="hidden" name="extra_payment" id="extra_payment" value=""/>    
    <input type="hidden" name="extra_payment" id="cart-total" value=""/>
    <input type="text" id="cart-delivery" name="cart-delivery" hidden="hidden" value="0">
    </td>
    </tr>
    </table>
    </div>

    <div class="info_shipping">
    <table class="" cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr id="loadingListCarrierShipping" style="display: none;">
    <td>
    <div class="loading_data" >Đang tải dữ liệu...</div>
    </td>
    </tr>
    <tr id="listCarrierShipping">
    <td>
    <div class="text">Dịch vụ giao hàng</div>
    <div class="listFeeShipping"><span style="font-size: 11px; color: #999;">Vui lòng nhập địa chỉ để biết phí giao hàng</span></div>
    </td>
    </tr>
    </table>
    </div>
    </div>
    <script type="text/javascript">
    function confirm_del_add(id) {
        windowPrompt({
            content: "Bạn có muốn xóa địa chỉ nhận hàng này không?",
            confirm: {
                valueTrue: "Đồng ý",
                valueFalse: "Hủy bỏ",
                classTrue: "button_change",
                classFalse: "button_change",
                callback: function(c) {
                    if (c == true) {
                        $("#button_cancel").attr("disabled", "disabled").css("cursor", "not-allowed");
                        delete_user_saddress(id);
                    }
                }
            }
        });
    }

    function show_edit_address(id, name, email, phone, address, city, district) {
        var id = parseInt(id);
        var city = parseInt(city);
        var district = parseInt(district);

        $('#ua_record').val(id);
        /*Set lại giá trị form*/
        $("#ua_name").val(name);
        $("#ua_email").val(email);
        $("#ua_phone").val(phone);
        $("#ua_address").val(address);

        $('#ua_city').attr('onChange', "loadDistrict('ua_city', 'ua_district', " + district + ");");

        $("#edit_user_address").show();

        $('#ua_city').val(city).trigger('change');

        $(".detail_address").hide();
        $(".form_add_more_address").hide();
        $('#note_edit_address').html("* Bạn cần hoàn thành sửa địa chỉ trước khi đặt hàng.");
        //ẩn nút đặt hàng
        $("#pmt_button").attr("onclick", "return false;").css({
            background: '#E8E8E8',
            color: '#999999'
        });

    }

    function hide_edit_address() {
        /*Set lại giá trị form*/
        $("#ua_name").val('');
        $("#ua_email").val('');
        $("#ua_phone").val('');
        $("#ua_address").val('');

        $('#edit_user_address').hide();
        $('.detail_address').show();
        // Xóa các thông báo lỗi nếu có
        $(".form_control_onError").parent().find(".errorMsgControl").remove();
        $(".form_control_onError").removeClass('form_control_onError');
        $('#note_edit_address').html("");

        //ẩn nút đặt hàng
        $("#pmt_button").attr("onclick", "$('form[name=frmPayment]').submit();").css({
            background: '',
            color: ''
        });
    }

    // Xử lý khi blur khỏi các input nhập sửa thông tin user

    $(document).on('blur', "#edit_user_address .form_control", function() {

        var arrayValidateForm = new Array();
        arrayValidateForm['ua_name'] = "Vui lòng nhập Họ và tên";
        arrayValidateForm['ua_phone'] = "Vui lòng nhập Số điện thoại";
        arrayValidateForm['ua_email'] = "Vui lòng nhập đúng địa chỉ Email";
        arrayValidateForm['ua_address'] = "Vui lòng nhập địa chỉ nhận hàng";

        var name_control = $(this).attr("name");
        var value_control = $(this).val();
        var check_scroll = 0;
        $(this).parent().find(".errorMsgControl").remove();
        switch (name_control) {
            case 'ua_name':
            case 'ua_phone':
            case 'ua_address':
                if (value_control == "") {
                    $(this).addClass('form_control_onError');
                    $(this).parent().find(".typeSuccess").remove();
                    $("<div class='errorMsgControl'>" + arrayValidateForm[name_control] + "</div>").insertAfter($(this));
                    check_scroll++;
                } else {
                    $("<i class='typeSuccess'></i>").insertAfter($(this));
                    $(this).parent().find(".errorMsgControl").remove();
                    $(this).removeClass('form_control_onError');
                    check_scroll--;
                }
                break;
            case 'ua_email':
                if (!isEmail(value_control)) {
                    $("<div class='errorMsgControl'>" + arrayValidateForm[name_control] + "</div>").insertAfter($(this));
                    $(this).addClass('form_control_onError');
                    $(this).parent().find(".typeSuccess").remove();
                    check_scroll++;
                } else {
                    $(this).removeClass('form_control_onError');
                    $(this).parent().find(".errorMsgControl").remove();
                    $("<i class='typeSuccess'></i>").insertAfter($(this));
                    check_scroll--;
                }
                break;

            case 'ua_city':
            case 'ua_district':
                if (value_control <= 0) {
                    $(this).addClass('form_control_onError');
                } else {
                    $(this).addClass('form_control_onSuccess');
                }
                break;
        }

    });
    </script>
    </td>
    <td valign="top" class="payment_method">
<div class="title">
<span class="icon">2</span>Hình thức thanh toán
</div>
<div class="content">
<div class="list_method">
<div class="detail_method" id="pmt_method_name_cod">
<input type="radio" checked="checked" name="pmt_method_payment" class="method_radio fl" id="pmt_method_cod" iPayCod="1" iDetail="1" value="invoid" pmtType="2">
<label for="pmt_method_cod"><div class="method_name">Thanh toán khi nhận hàng</div></label>
<div class="clear"></div>
<div class="method_content" style="display:none;">
<div id="method_decription_postpaid" class="method_decription" style="color: #b7b7b7; line-height: 16px; font-size: 12px; font-style: italic;">
Bạn cần thanh toán thêm <span id="txt_cod_fee">10.000</span>đ phí thu tiền tận nơi.(Phí thu hộ)
</div>
</div></div><input type="radio" class="fl show_list_paymentonline" name="pmt_method_payment" id="show_list_paymentonline" value="payment">
   <label for="show_list_paymentonline" ><div class="txt_list_paymentonline">Thanh toán online</div></label>
<div class="list_paymentonline" id="">

<div class="detail_method" id="pmt_method_name_1">
<input type="radio" name="pmt_method_payment" class="method_radio fl" id="pmt_method_1" value="1" pmtType="1">
<label for="pmt_method_1"><div class="method_name">Bằng thẻ ATM quốc tế&nbsp;<span class="method_explain"></span></div></label>
<div class="clear"></div>
<div class="method_content" style="display:none;">
<div class="method_action">
<div style="padding-bottom: 4px; color: #b7b7b7; font-size: 12px; font-style: italic;">Vui lòng chọn ngân hàng thanh toán</div>
<div class="list_data bank_list method">
<ul id="b_l">
<?php echo $baokim->generateBankImage($banks,PAYMENT_METHOD_TYPE_CREDIT_CARD); ?>
</ul>
<div class="clear"></div>
</div>
</div>
</div>
</div>

<div class="detail_method" id="pmt_method_name_1">
<input type="radio" name="pmt_method_payment" class="method_radio fl" id="pmt_method_1" value="1" pmtType="1">
<label for="pmt_method_1"><div class="method_name">Bằng thẻ ATM có Internet Banking&nbsp;<span class="method_explain">Miễn phí</span></div></label>
<div class="clear"></div>
<div class="method_content" style="display:none;">
<div class="method_action">
<div style="padding-bottom: 4px; color: #b7b7b7; font-size: 12px; font-style: italic;">Vui lòng chọn ngân hàng thanh toán</div>
<div class="list_data bank_list method">
<ul id="b_l">
<?php echo $baokim->generateBankImage($banks,PAYMENT_METHOD_TYPE_LOCAL_CARD); ?>
</ul>
<div class="clear"></div>
</div>
</div>
</div>
</div>
<div class="detail_method" id="pmt_method_name_3">
<input type="radio" name="pmt_method_payment" class="method_radio fl" id="pmt_method_3" value="3" pmtType="1">
<label for="pmt_method_3"><div class="method_name">Bằng Internet Banking&nbsp;<span class="method_explain"></span></div></label>
<div class="clear"></div>
<div class="method_content" style="display:none;">
<div class="method_action">
<div style="padding-bottom: 4px; color: #b7b7b7; font-size: 12px; font-style: italic;">Vui lòng chọn ngân hàng thanh toán</div>
<div class="list_data bank_list method">
<ul id="b_l">
<?php echo $baokim->generateBankImage($banks,PAYMENT_METHOD_TYPE_INTERNET_BANKING); ?>
</ul>
<div class="clear"></div>
</div>
</div>
</div>
</div>
</div><div class="box_escrow_timeout hidden" style="padding: 8px 0px; font-size:17px; display:none">
<input type="radio" class="form_control" id="escrow_7_days" name="ord_escrow_timeout" value="7" checked="checked"> <label for="escrow_7_days" style="color: #60a433">Thanh toán an toàn <a class="simple_tip text_link" href="javascript:;" content="Trong 7 ngày tiền thanh toán sẽ được hoàn lại nếu bạn hủy đơn hàng">(?)</a></label> &nbsp; &nbsp;
<input type="radio" class="form_control" id="escrow_0_days" name="ord_escrow_timeout" value="0"> <label for="escrow_0_days" style="color: #0e76bd">Thanh toán ngay <a class="simple_tip text_link" href="javascript:;" content="Tiền thanh toán sẽ được chuyển trực tiếp cho người bán<br />Vì vậy bạn cần kiểm tra và xác thực thông tin người bán trước khi tiến hành thanh toán.">(?)</a></label>
</div><div class="bk_ttonline_required">
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
<td rowspan="3" valign="top">
<i class="bk_ttonline_logo"></i>
</td>
    <td>
<p class="bk_ttonline_txt">Thanh toán online tại lksshop.vn được cam kết bảo mật theo chính sách của Cổng thanh toán Baokim.vn <a href="https://www.baokim.vn/ho-tro/a/gioi-thieu-ve-bao-kim/chinh-sach-bao-mat" target="_blank">Xem chi tiết</a></p>
</td>
    </tr>
    <tr>
<td>
<p class="fl bk_ttonline_utility" style="width:102px;"><i></i>An toàn 100%</p>
<p class="fl bk_ttonline_utility"><i></i>Bảo hiểm 20.000.000đ</p>
<p class="fl bk_ttonline_utility" style="width:102px;"><i></i>Miễn phí hoàn toàn</p>
<p class="fl bk_ttonline_utility"><i></i>Đơn giản - nhanh chóng</p>
</td>
</tr>
    <tr id="bk_ttonline_check" class="hidden">
<td style="padding-top: 10px;">
<input type="checkbox" checked="checked" id="bk_ttonline_checked" class="fl" style="margin-top: 1px;">
<label for="bk_ttonline_checked" style="font-size: 11px; color: #666; font-weight: bold;">Đồng ý với nội dung bảo mật thanh toán</label>
</td>
</tr>
    </table>
    </div>
    <p id="bk_ttonline_error" class="hidden">Bạn không thể chọn thanh toán online nếu không đồng ý với nội dung bảo mật trên.</p>
    </div>
    </div>
    </td>
    <td valign="top" class="payment_bill"><div class="title">
<span class="icon"><i class="icon_bill"></i></span>Hóa đơn mua hàng
</div>
<div class="content">
<div class="box_product_info">
<div class="b_head">

Gian hàng bán: <a title="" href=""><?php echo $_SESSION['product'][0]['shop_name']; ?></a></div>
<div class="b_body">
<div class="listProducts" >
<div class="out_range_tooltip" style="display: none;">
<div class="out_range_content">
<span class="out_range_small_icon"></span>
<p class="out_range_content_txt">Sản phẩm chỉ hỗ trợ giao hàng tại Hồ Chí Minh</p>
<a href="javascripts:;" title="" class="out_range_click"></a>
</div>
</div>
<table id="table-product" cellspacing="5" cellpadding="0" width="100%">
<?php $i = 0; foreach ($_SESSION['cart']['products'] as $key => $value):?>
<?php if(count($value) && $value[$i]['name'] != ''):?>
    <tr class="rowProduct" iPrice="">

        <td align="center" width="40">

        <div class="product_picture picture_small">
        <a target="_blank" href="" rel="nofollow" title="<?php echo $value[$i]['name']; ?>">
        <img border="0" style="max-width:40px; max-height:50px" height="50px" src="<?php echo $value[$i]['image'] ?>" /></a>
        </div>

        </td>
            <td valign="top">

        <div class="product_info">

                <div class="product_name"><b>
                <a target="_blank" class="text_normal" href="" rel="nofollow" title="<?php echo $value[$i]['name']; ?>"><?php echo $value[$i]['name']; ?></a></b></div>
                <div class="clear"></div>
                <div class="product_action fl">
                
                </div>
                <div class="product_quantity fr">
                <input type="text" readonly class="select_product_quantity changQuantityProduct" id="changQuantityProduct<?php echo $value[$i]['id'] ?>" value="<?php echo $value[$i]['number'] ?>" style="width: 20px;"/>
                 x <?php echo $value[$i]['price']; ?>₫</div>
                <input type="hidden" class="price" id="price<?php echo $value[$i]['id'] ?>" value="<?php echo $value[$i]['price']; ?>">

                <div class="clear"></div>
            
        </div>
        </td>
    </tr>
<?php endif; ?>
<?php endforeach; $i++; ?>   
    </table>
    </div>
    </div>
    </div>
    <table class="table_order_fee" cellpadding="0" cellspacing="0" style="width: 100%;">
<tr>
<td class="name">Tổng tiền hàng:</td>
<td class="value" align="right">
<span class="" id="total_amount" data="<?php echo $total; ?>">
<?php echo $total; ?></span><span style="font-size: 14px;">₫</span></td>
</tr>
<tr id="row_order_shipping">
<td class="name" style="padding-top: 5px;">Phí giao hàng:</td>
<td class="value" style="padding-top: 5px;" align="right" id="order_shipping_cost_show"><span class="cart-delivery" id="order_shipping_cost">0</span><span style="font-size: 14px;">₫</span></td>
</tr>
<tr id="note_fee_cod" style="display: none;">
<td class="name" style="padding-top: 5px;">Phí thu hộ:</td>
<td class="value" style="padding-top: 0px;" align="right">
<span class="" id="show_cod_fee" >0</span> <span style="font-size: 12px;">₫</span>
</td>
</tr>
<tr id="row_order_amount" class="hidden">
<td class="name" style="padding-top: 5px;">Tiền thưởng:</td>
<td class="value" style="padding-top: 5px;" align="right"><span id="order_amount_money">0</span><span style="font-size: 14px;">₫</span></td>
</tr>
<tr id="row_total_fee" class="hidden">
<td class="name">Phí vận chuyển <a target="_blank" class="text_link simple_tip active" content="Phí dịch vụ thanh toán trực tuyến do ngân hàng thu.<br />Phí này sẽ không được trả lại khi người mua hủy đơn hàng." style="text-decoration:none;" href="javascript:;">(?)</a></td>
<td class="value" align="right">
<span class="" id="total_fee" class="cart-delivery">0</span><span style="font-size: 14px;">₫</span>
<input type="hidden" id="payment_fee" name="payment_fee" value="0" />
</td>
</tr>
<tr class="row_code_promotion" style="display: none;">
<td class="name">Mã giảm giá:</td>
<td align="right">
<input class="form_control" type="text" autocomplete="off" title="Nhập mã giảm giá bạn muốn sử dụng" id="discount_code" name="discount_code" value="" />
<input type="hidden" id="discount" name="discount" value="0" />
<input class="order_coupon_btn" type="button" value="Kiểm tra" style="cursor:pointer" onClick="check_coupon_available();" />
</td>
</tr>
<tr class="row_code_promotion_toshow hidden">
<td class="name">Mã giảm giá:</td>
<td align="right">
<a class="change_val_coupon" href="javascript:;" onClick="remove_discount();">Dùng mã khác</a> <span class="discount_show">(<span id="discount_show">0</span><span style="font-size: 14px;">₫</span>)</span>
</td>
</tr>
<tr>
<td colspan="2" align="right">
<i style="color:red; font-size: 11px;" id="code_promotion_alert" class="hidden"></i>
</td>
</tr>
<tr id="row_total_money_pay">
<td class="name">Tổng thanh toán:</td>
<td class="value" align="right" style="color: #f74f00;" class="cart-total">
<span id="total_money_pay" style="font-size: 14px;"></span>
<span>₫</span></td>
</tr>
</table>
    
    <div>
<a class="pmt_button" id="pmt_button" href="javascript:;" onclick="$('form[name=frmPayment]').submit();">
<div class="fl icon"></div>
    <div class="text">
<div class="pmt_button_label">Đặt hàng</div>
    </div>
    <div class="clear"></div>
    </a>
    </div>
    <div id="note_next_action_bank" class="text_link" style="color: #999999; font-size: 11px;"></div>
    <div id="note_out_of_range" class="text_link" style="margin-top: 5px; color: #999999; font-size: 11px;"></div>
    <div id="note_edit_address" class="text_link" style="margin-top: 5px; color: #999999; font-size: 11px;"></div>
    <div class="clear"></div>
    </div>
    </td>
    </tr>
    <tr id="rowMsgVirtual" class="payment_faile hidden">
<td colspan="3" align="center">
<table style="margin: 40px 0px;" align="center" cellpadding="10" cellspacing="0">
<tr>
<td align="right" width="160px"><i class="icon_payment_faile"></i></td>
<td valign="top" id="msgvirtual"></td>
</tr>
    <tr>
 <td colspan="2"><div>Vui lòng liên hệ chăm sóc khách hàng để được hỗ trợ <i class="icon_hotline"></i> <b>19002055</b> hoặc <a href="javascript:;" onclick="create_chat_box({id:1515941});"><i class="icon_chat"></i><b class="text_support">Chat ngay</b></a></div></td>
</tr>
    <tr>
 <td colspan="2" align="center" style="padding-top: 20px;"><a style="color: #f44f00;" href="/home/showcart.php">Quay lại giỏ hàng <span style='font-size:16px'>››</span></a></td>
</tr>
    </table>
    </td>
    </tr>
    </table>
    </div>
    <input type="hidden" id="action" name="action" value="step_1" />
    <input type="hidden" id="ord_address_id" name="ord_address_id" value="0" />
    <input type="hidden" id="ord_sname" name="ord_sname" value="" />
    <input type="hidden" id="ord_semail" name="ord_semail" value="" />
    <input type="hidden" id="ord_sphone" name="ord_sphone" value="" />
    <input type="hidden" id="ord_scity" name="ord_scity" value="0" />
    <input type="hidden" id="ord_sdistrict" name="ord_sdistrict" value="0" />
    <input type="hidden" id="ord_saddress" name="ord_saddress" value="" />
    <input type="hidden" id="payment_type" name="payment_type" value="0" />
    <input type="hidden" id="payment_method" name="payment_method" value="0" />
    <input type="hidden" id="next_action_bank" name="next_action_bank" value="" />
    <input type="hidden" id="bank_payment_method" name="bank_payment_method" value="" />
    <input type="hidden" id="payment_method_baokim" name="payment_method_baokim" value="" />
    <input type="hidden" id="shipping_cost" name="shipping_cost" value="-1" />
    <input type="hidden" id="shipping_cod_fee" name="shipping_cod_fee" value="0" />
    <input type="hidden" id="shipping_cod_loaded" name="shipping_cod_loaded" value="0" />
    <input class="form_control" type="hidden" autocomplete="off" title="Nhập số tiền thưởng bạn muốn sử dụng" id="txtbox_vpoint_use" value="0" style="width:120px; height:20px; text-align:right" maxlength="11" onKeyUp="updateTotalCost();" />
    <input type="hidden" id="vpoint_use" name="vpoint_use" value="0" />
    <input type="hidden" id="ord_shipping_carried" name="ord_shipping_carried" value="0" />
    <input type="hidden" id="ord_shipping_service" name="ord_shipping_service" value="0" />
    <input type="hidden" id="order_id" name="order_id" value="0" />
    <input type="hidden" id="replaceFBV" name="replaceFBV" value="0" />
    <input type="hidden" id="checkcapcha" name="checkcapcha" value="0" />
    <input type="hidden" id="shipping_cost_type" name="shipping_cost_type" value="1" />
    </form>
    <script type="text/javascript">
    // Khai báo một số biến toàn cục
    var fix_fee = 0;
    var percent_fee = 0;
    var min_bank_fee = 0;
    var max_bank_fee = 0;
    var con_ajax_path = "/ajax_v4/";
    var con_currency = "₫";
    var vatgiaUserLogged = 0;
    var payment_method_baokim = 0;
    var estore_city_id = 7; // City của địa chỉ gian hàng
    var allow_pay_cod = 0; // Được thanh toán khi nhận hàng hay không

    function addCommas(nStr) {
        nStr += '';
        x = nStr.split(',');
        x1 = x[0];
        x2 = "";
        x2 = x.length > 1 ? ',' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + '.' + '$2');
        }
        return x1 + x2;
    }

    function formatCurrency(id, number) {
        document.getElementById(id).innerHTML = addCommas(number);
    }

    function open(elem) {
        if (document.createEvent) {
            var e = document.createEvent("MouseEvents");
            e.initMouseEvent("mousedown", true, true, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
            elem[0].dispatchEvent(e);
        } else if (element.fireEvent) {
            elem[0].fireEvent("onmousedown");
        }
    }

    function checkPhone() {
        var user_phone = $("#user_phone").val();
        if (user_phone != "undefined" && user_phone != undefined) {
            user_phone = user_phone.replace(/[^0-9]/g, '');
        } else {
            user_phone = "";
        }
        $("#user_phone").val(user_phone);
    }

    // Load danh sách Quận/Huyện
    function loadDistrict(div_city, div_district, current) {
        $("#" + div_district).html('<option value="0">Quận/Huyện</option>');
        var iCit = $("#" + div_city).val();
        if (iCit > 0) {
            var ajaxURL = "/ajax/ajax_get_list_district.php?iCit=" + iCit;
            if (current > 0) ajaxURL += "&iDist=" + current;
            $("#" + div_district).load(ajaxURL, function(response, status, xhr) {
                if (status == "success") {
                    // Mở luôn ô chọn quận huyện
                    if ($("#" + div_district).val() <= 0) open($("#" + div_district));
                }
            });
            $("#" + div_district).removeClass('form_control_onSuccess');
        }
    }

    /**
     * showShippingCost Hiển thị phí vận chuyển tương ứng với sp đặt mua của từng GH
     *
     * @param mixed estoreId      ID gian hàng.
     * @param mixed listProductId Danh sách ID sản phẩm.
     *
     * @access public
     *
     * @return mixed Value.
     */
    function showShippingCost(estoreId, listProductId, city_id, district_id) {
        var dataDefault = {
            estoreId: estoreId,
            listProductId: listProductId,
            paymentType: "online"
        };
        if (city_id > 0) dataDefault['ord_scity'] = city_id;
        if (district_id > 0) dataDefault['ord_sdistrict'] = district_id;
        if (estoreId > 0 && listProductId != "" && city_id > 0 && district_id > 0) {
            $("#loadingListCarrierShipping").show();
            $.ajax({
                type: "POST",
                url: con_ajax_path + "nhanh_get_shipping_merchant.php",
                data: dataDefault,
                dataType: "json",
                success: function(data) {
                    if (data) {
                        var freeShip = data.freeShip;
                        var contactShip = data.contactShip;
                        var freeShipBuyOnline = data.freeShipBuyOnline;
                        var receivedAdress = data.receivedAdress;
                        var listMerchant = data.listMerchant;
                        var estoreTransport = data.estoreTransport;
                        var replaceFBV = data.replaceFBV;
                        var shippingFee = 0;
                        var shippingCODFee = 0;
                        var codCarrier = 'Hãng vận chuyển';
                        var configEnhanceSuccess = (data.configEnhanceSuccess != undefined && data.configEnhanceSuccess != "undefined") ? data.configEnhanceSuccess : "";

                        // Box lựa chọn hãng vận chuyển
                        var i = 0;
                        HTMLSelectShippingMerchant = "";
                        $.each(listMerchant, function(index, carrierInfo) {
                            i++;
                            carrierId = ("carrierId" in carrierInfo) ? parseInt(carrierInfo.carrierId) : 0;
                            carrierName = ("carrierName" in carrierInfo) ? carrierInfo.carrierName : "";
                            serviceId = ("serviceId" in carrierInfo) ? parseInt(carrierInfo.serviceId) : 0;
                            serviceName = ("serviceName" in carrierInfo) ? carrierInfo.serviceName : "";
                            serviceDescription = ("serviceDescription" in carrierInfo) ? carrierInfo.serviceDescription : "-";
                            codFee = ("codFee" in carrierInfo) ? parseInt(carrierInfo.codFee) : 0;
                            shipFee = ("shipFee" in carrierInfo) ? parseInt(carrierInfo.shipFee) : 0;
                            serviceNameVatgia = ("nameServiceVatgia" in carrierInfo) ? carrierInfo.nameServiceVatgia : "";
                            if (serviceNameVatgia == "") serviceNameVatgia = carrierName + "-" + serviceName;

                            // Mặc định lấy phí của ông đầu tiên
                            var selected_service = "";
                            if (i == 1) {
                                shippingFee = shipFee;
                                shippingCODFee = codFee;
                                codCarrier = carrierName;
                                shippingDate = serviceDescription;
                                selected_service = "checked='checked'";
                            }

                            HTMLSelectShippingMerchant += '<div class="box_radio fl"><input type="radio" ' + selected_service + ' name="ord_shipping_merchant" id="ord_shipping_merchant_' + carrierId + '_' + serviceId + '" iEstore="' + estoreId + '" value="' + carrierId + '_' + serviceId + '" shippingFee="' + shipFee + '" codFee="' + codFee + '" nCarrierName="' + carrierName + '" nShippingDate="' + serviceDescription + '"></div>';
                            HTMLSelectShippingMerchant += '<div class="box_text fl"><label for="ord_shipping_merchant_' + carrierId + '_' + serviceId + '">' + serviceNameVatgia + ' với phí:&nbsp;&nbsp;' + addCommas(shipFee) + '<b style="font-size: 14px;">' + con_currency + '</b>' + '<br /><i>Thời gian chuyển hàng: ' + serviceDescription + '</i></label></div>';
                            HTMLSelectShippingMerchant += '<div class="clear"></div>';
                            HTMLSelectShippingMerchant += '<br />';
                        });

                        // Có sử dụng phí của FBV không
                        $("#replaceFBV").val(replaceFBV);

                        // Nếu cần liên hệ để biết phí thì phí vận chuyển = 0
                        if (contactShip == 1 || freeShip == 1) {
                            shippingFee = 0;
                            shippingCODFee = 0;
                        }
                        //-- End Box lựa chọn hãng vận chuyển

                        // Hiển thị text liên hệ GH để biết phí cho TH mục set default weight = 0
                        if (contactShip == 1) {
                            $("#listCarrierShipping").fadeIn(400);
                            $("#showFeeShipping").fadeIn(400);
                            $("#listCarrierShipping .text").html("Dịch vụ giao hàng");
                            var htmlContactShip = '<span style="font-style: italic; margin-bottom: 10px; display: block;">Hiện chúng tôi không tính được phí giao hàng cho sản phẩm bạn đặt mua</span>';
                            htmlContactShip += '<div class="box_radio fl"><input type="radio" name="ord_shipping_merchant" id="ord_shipping_merchant_0_0" checked="checked" iEstore="' + estoreId + '" value="0_0" shippingFee="0" codFee="0" nCarrierName="" nShippingDate=""></div>';
                            htmlContactShip += '<div class="box_text fl"><label for="ord_shipping_merchant_0_0">Đặt hàng chưa bao gồm phí</label></div>';
                            htmlContactShip += '<div class="clear"></div>';
                            htmlContactShip += '<br />';
                            htmlContactShip += '<div class="box_radio fl"><input type="radio" name="ord_shipping_merchant" id="ord_shipping_merchant_contact" iEstore="' + estoreId + '" value="0_0" shippingFee="-1" codFee="0" nCarrierName="" nShippingDate=""></div>';
                            htmlContactShip += '<div class="box_text fl"><label for="ord_shipping_merchant_contact">Gọi để biết phí giao hàng&nbsp;<br/><div style="padding-top: 4px; color: #f88000;">ĐT: 0946576177 / 0919535935</div><div style="padding-top: 4px;"><span class="fl" style="display: block; margin: 8px 0px 0px 0px;">Phí giao hàng:</span><div class="box_shipping_contact fr"><input type="text" id="fee_shipping_contact" class="form_control" value="" disabled="disabled" onkeyup="setFeeContact();"/><span style="font-size: 14px;">' + con_currency + '</span></div></div><div class="clear"></div></label></div>';

                            htmlContactShip += '<div class="clear"></div>';
                            htmlContactShip += '<i id="fee_shipping_contact_txt" style="color: red; padding: 3px 0px 0px 18px; font-size: 11px; font-style: italic;"></i>';

                            $("#listCarrierShipping .listFeeShipping").html(htmlContactShip);

                            // Gán lại giá trị mặc định dạng tính phí vc là 3=> đặt hàng chưa bao gôm phí
                            $("#shipping_cost_type").val(3);
                        } else {

                            if (freeShip == 1) {
                                $("#listCarrierShipping .text").html("Miễn phí giao hàng");
                                $("#listCarrierShipping .listFeeShipping").html("");
                                // Nếu là miễn phí vận chuyển gán type = 2
                                $("#shipping_cost_type").val(2);
                            } else {
                                $("#listCarrierShipping .text").html("Dịch vụ giao hàng");
                                $("#listCarrierShipping .listFeeShipping").html(configEnhanceSuccess + HTMLSelectShippingMerchant);
                                // đặt lại dạng chọn phí vc là tính theo giá phí của hệ thống
                                $("#shipping_cost_type").val(1);
                            }
                            $("#listCarrierShipping").fadeIn(400);
                            $("#showFeeShipping").fadeIn(400);
                        }

                        // Cập nhật phí vận chuyển và phí thu hộ mới
                        $("#shipping_cost").val(shippingFee);
                        $("#shipping_cod_loaded").val(shippingCODFee);
                        // Nếu đang chọn thanh toán qua bảo kim thì kiểm tra lại số tiền
                        var payment_method_baokim = $("input[name=payment_method_baokim]").val();
                        if (payment_method_baokim == 9) {
                            $("#pmt_method_9").trigger('click');
                        } else {
                            // Cập nhật lại toán bộ phí
                            updateTotalCost();
                        }

                        if (contactShip == 1) {
                            $("#ord_shipping_merchant_0_0").trigger("click");
                        }

                        // Gọi ajax lưu thông tin vào user_tracking
                        /*
                        var frm= $("form[name='frmPayment']");
                        $.ajax({
                        type: "POST",
                        url: con_ajax_path + "add_info_user_tracking.php?estore_id="+ estoreId,
                        data: frm.serialize(),
                        dataType: "json",
                        success: function(data){
                        }
                        });
                        */
                    }
                    $("#loadingListCarrierShipping").hide();
                }
            });
        }

        // Khi chưa có quận huyện thì thông báo text mặc định
        if (district_id <= 0) {
            $("#listCarrierShipping .text").html("Dịch vụ giao hàng");
            $("#listCarrierShipping .listFeeShipping").html('<span style="font-size: 11px; color: #999;">Vui lòng nhập địa chỉ để biết phí giao hàng</span>');
            $("#shipping_cost").val(0);
            $("#shipping_cod_loaded").val(0);
            // Đồng thời cập nhật lại toán bộ phí
            updateTotalCost();
        }
    }

    // Cập nhật toàn bộ phí
    function updateTotalCost() {
        // Tiền giảm trừ nếu có dử dụng mã giảm giá
        var discount = $("#discount").val();
        discount = parseInt(discount);
        if (isNaN(discount) || discount < 0) discount = 0;

        // Số Vpoint có thể sử dụng
        var vpoint_remain = $("#info_useVpoint").attr("iData");
        vpoint_remain = parseInt(vpoint_remain);
        if (isNaN(vpoint_remain) || vpoint_remain < 0) vpoint_remain = 0;

        // Số Vpoint sử dụng
        var vpoint_use = $("#vpoint_remain").val();
        if (vpoint_use != "undefined" && vpoint_use != undefined) {
            vpoint_use = vpoint_use.replace(/[^0-9]/g, '');
        } else {
            vpoint_use = 0;
        }
        vpoint_use = parseInt(vpoint_use);
        if (isNaN(vpoint_use) || vpoint_use < 0) vpoint_use = 0;

        // Nếu số Vpoint muốn dùng lớn hơn số Vpoint khả dụng thì gán bằng số Vpoint khả dụng
        if (vpoint_use > vpoint_remain) {
            $("#notice_vpoint_use .notice").html("Số dư tiền thưởng tối đa bạn có thể sử dụng là " + addCommas(vpoint_remain) + " <span style='font-size: 14px;'>" + con_currency + "</span>");
            $("#notice_vpoint_use").show();
            vpoint_use = vpoint_remain;
        } else {
            $("#notice_vpoint_use").hide();
            $("#notice_vpoint_use .notice").html('');
        }

        $("#vpoint_remain").val(addCommas(vpoint_use));
        $("#vpoint_use").val(vpoint_use);

        if (vpoint_use > 0) {
            $("#row_order_amount").show();
            $("#row_order_amount").find("#order_amount_money").html(addCommas(vpoint_use));
        } else {
            $("#row_order_amount").hide();
        }

        // Phí vận chuyển
        var shipping_cost = $("#shipping_cost").val();
        shipping_cost = parseInt(shipping_cost);
        if (isNaN(shipping_cost) || shipping_cost < 0) shipping_cost = 0;

        // Phí thu hộ
        var codFee = $("#shipping_cod_loaded").val();
        if (codFee != undefined && codFee != "undefined") {
            codFee = parseInt(codFee, 10);
        } else {
            codFee = 0;
        }

        // Thanh toán khi nhận hàng thì mới tính phí thu hộ, các trường hợp khác phí thu hộ = 0;
        var payment_type = $("input[name=payment_type]").val();
        if (payment_type != 2 || allow_pay_cod != 1) codFee = 0;

        // Phí giao hàng = phí vận chuyển + phí thu hộ
        var free_delivery = shipping_cost + codFee;
        free_delivery = parseInt(free_delivery);
        if (isNaN(free_delivery) || free_delivery < 0) free_delivery = 0;

        // Tổng giá trị sản phẩm
        var total_amout = $("#total_amount").attr("data");
        total_amout = parseInt(total_amout);
        if (isNaN(total_amout) || total_amout < 0) total_amout = 0;

        // Tổng tiền= Tổng giá trị sản phẩm + Phí vận chuyển
        var total_money = free_delivery + total_amout;

        // Tổng phí tiện ích
        var total_fee = getBankFeeAmount(total_money, fix_fee, percent_fee);
        total_fee = parseFloat(total_fee);
        // Kiểm tra phí tiện ích tối thiểu tối đa
        if (max_bank_fee > 0 && total_fee > max_bank_fee) total_fee = parseFloat(max_bank_fee);
        if (min_bank_fee > 0 && total_fee < min_bank_fee) total_fee = parseFloat(min_bank_fee);

        // Tổng tiền phải trả= Tổng tiền(total_money) + Tổng phí tiện ích(total_fee) + phí thu hộ - Discount(nếu có) - Vpoint sử dụng(vpoint_use)
        var total_money_pay = total_money + total_fee - discount - vpoint_use;
        total_money_pay = parseInt(total_money_pay);
        if (total_money_pay < 0) total_money_pay = 0;

        /* Show text + gán dữ liệu vào input*/
        $("#order_shipping_cost").html(addCommas(shipping_cost));
        $("#total_money_pay").html(addCommas(total_money_pay));

        // Phí thu hộ
        $("#shipping_cod_fee").val(codFee);
        $("#txt_cod_fee").html(addCommas(codFee));

        if (codFee > 0) {
            $("#note_fee_cod").show();
            $("#show_cod_fee").html(addCommas(codFee));
            if ($("#check_same_buyer").is(":checked")) {
                $("#pmt_method_name_cod .method_decription").html("Bạn cần thanh toán thêm <span id='txt_cod_fee'>" + addCommas(codFee) + "</span>đ phí thu hộ (Phí thu tiền tận nơi).");
            } else {
                $("#pmt_method_name_cod .method_decription").html("Người nhận sẽ thanh toán cho đơn hàng này.</br>Phí thu hộ (Phí thu tiền tận nơi): <span id='txt_cod_fee'>" + addCommas(codFee) + "</span>đ.");
            }
            $("#method_decription_postpaid").parent().show();
        } else {
            $("#method_decription_postpaid").parent().hide();
            $("#note_fee_cod").hide();
            $("#show_cod_fee").html(0);
        }

        // Nếu có phí tiện ích thanh toán thì mới show
        if (total_fee > 0) {
            $("#row_total_fee").removeClass("hidden");
            $("#payment_fee").val(total_fee);
            formatCurrency("total_fee", total_fee);
        } else {
            $("#row_total_fee").addClass("hidden");
            $("#payment_fee").val(0);
        }
    }

    // Function trả về phí tiện ích
    function getBankFeeAmount(total_amount, fix_fee_amount, percent_fee) {
        total_amount = parseFloat(total_amount);
        fix_fee_amount = parseFloat(fix_fee_amount);

        // Tính tổng số tiền cần thanh toán
        var total_pay = parseFloat((total_amount + fix_fee_amount) * 100 / (100 - percent_fee));
        var bankFeeAmount = parseFloat(total_pay - total_amount);
        bankFeeAmount = Math.ceil(bankFeeAmount);
        if (bankFeeAmount < 0) bankFeeAmount = 0;

        return bankFeeAmount;
    }

    /**
     * [beforeReloadAccountBaokim Xử lý trước khi lấy lại tài khoản bảo kim]
     * @return {[type]} [description]
     */
    function beforeReloadAccountBaokim() {
        $('#baokimAccountNotEnought').html('');
        $(".button_show_reload").show();
        $("#button_show_reload_baokim").show();
    }

    // Function load tài khoản Bảo kim
    function reloadUserBalanceInfo(uEmail) {
        $("#baokim_account_err").html('<div class="loading_data" >Đang tải dữ liệu...</div>');
        $("#button_show_reload_baokim").hide();
        // Show tải dữ liệu
        $.get('/ajax/ajax_get_baokim_account_info.php?email=' + uEmail, function(data) {
            if (data.balance !== undefined && data.balance != "undefined") {

                $("#baokim_account_err").html('');
                var balance = data.balance;
                var point = data.point;

                /** Tính tổng tiền phải trả */
                // Phí vận chuyển
                var shipping_cost = $("#shipping_cost").val();
                shipping_cost = parseInt(shipping_cost);
                if (isNaN(shipping_cost) || shipping_cost < 0) shipping_cost = 0;
                // Phí thu hộ
                var codFee = $("#shipping_cod_fee").val();
                codFee = parseInt(codFee);
                if (isNaN(codFee) || codFee < 0) codFee = 0;

                // Tổng giá trị sản phẩm
                var total_amout = $("#total_amount").data("total");
                total_amout = parseInt(total_amout);
                if (isNaN(total_amout) || total_amout < 0) total_amout = 0;

                // Mã giảm giá
                var discount_value = $("#discount").val();
                discount_value = parseInt(discount_value);
                if (isNaN(discount_value) || discount_value < 0) discount_value = 0;

                // Tổng tiền= Tổng giá trị sản phẩm + Phí vận chuyển
                var total_money = shipping_cost + codFee + total_amout - discount_value;
                $("#info_useBaokimBalance").attr("iData", balance).html(addCommas(balance));
                $("#info_useVpoint").attr("iData", point).html(addCommas(point));
                // Cộng thêm tk phụ cũng không đủ thông báo không đủ thanh toán, ẩn nút mua hàng
                var total_money_baokim = parseFloat(balance + point);
                if (total_money_baokim < total_money) {
                    $("#baokimAccountNotEnought").html('<div class="baokimAccountNotEnought">Số dư tài khoản của bạn không đủ. Vui lòng nạp tiền hoặc lựa chọn hình thức thanh toán khác.<br /><br /><a onclick="beforeReloadAccountBaokim();" href="https://www.baokim.vn/giao-dich/nap-tien" target="_blank" style="width: 90px;" class="btn_naptien">Nạp tiền</a></div>');
                    $(".payment_detail .pmt_button").hide();
                    // Ẩn tiền thưởng, reset số tiền thưởng sử dụng là 0
                    $("#row_user_vpoint").hide();
                    var point_user = 0;
                    $("#vpoint_remain").val(0);
                    $("#vpoint_use").val(0);
                } else {
                    $("#baokimAccountNotEnought").html('');
                    // Nếu số Vpoint lớn hơn 0 thì mới hiện box cho sử dụng Vpoint
                    if (point > 0) {
                        $("#row_user_vpoint").show();
                        var point_user = (point < total_money) ? point : total_money;
                        $("#vpoint_remain").val(addCommas(point_user));
                        $("#vpoint_use").val(point_user);
                    }
                }
                // Cập nhật lại toàn bộ phí
                updateTotalCost();
            } else {
                // Thông báo xác thực tài khoản
                var linkconfirm = 'https://id.vatgia.com/thiet-lap/xac-thuc-tai-khoan/?_cont=http%3A%2F%2Fwww.vatgia.com%2Fhome%2Fcheckout.php%3Freturn%3D%26estore_id%3D2024967%26iPro%3D5196950%26refererfrom%3Ddetail%26payment_method%3Dbk_9';
                var htmlStatusBaokim = '<div style="margin-top: 10px; padding: 8px; background: #fffff6; border: 1px dotted #e2e2df;">';
                htmlStatusBaokim += '<div>Tài khoản của bạn chưa được xác thực trên hệ thống Bảo Kim!</div>';
                htmlStatusBaokim += '<div style="margin-top: 5px;"><a class="btn_naptien" style="display: inline-block; width: 100px;" href="' + linkconfirm + '">XÁC THỰC</a>&nbsp;&nbsp;&nbsp;&nbsp;<a class="text_link" style="text-decoration: underline;" target="_blank" href="https://www.baokim.vn/ho-tro/a/fc-ho-so-tai-khoan/fc-dang-ky-tai-khoan-bao-kim/">Xem hướng dẫn</a></div>';
                htmlStatusBaokim += '</div>';
                $("#baokim_account_err").html(htmlStatusBaokim);
            }
        }, "json");
    }

    // Hàm thực hiện lưu giá trị Hình thức trả tiền được chọn 1 = trả trước, 2 = tại nhà, 3 = tại cửa hàng
    function setPaymentType(iType) {
        $("input[name=payment_type]").val(iType);
        // Lưu lại phương thức thanh toán
        if (iType == 1) {
            $("input[name=payment_method]").val(0); // Trả trước
        } else {
            $("input[name=payment_method]").val(1); // Trả sau
        }
    }

    // Hàm thực hiện lưu giá trị Hình thức trả tiền khi chọn ngân hàng (TH group hình thức tại máy ATM và tại quầy)
    function setPaymentMethodBaokim(payment_method_baokim) {
        $("input[name=payment_method_baokim]").val(payment_method_baokim);
    }

    // Kiểm tra dữ liệu khi chọn Hình thức thanh toán
    function checkPaymentMedthod() {

        var payment_type = $("input[name=payment_type]").val();
        if (payment_type <= 0) {
            alert('Bạn chưa chọn hình thức thanh toán');
            return false;
        }

        // Nếu là trả tiền trước thì mới check
        if (payment_type == 1) {

            var payment_method = $("input[name=payment_method]").val();
            var payment_method_baokim = $("input[name=payment_method_baokim]").val();

            // Trường hợp tích hợp kiểu mới payment_method luôn bằng 0 và payment_method_baokim > 0 (Tất cả đều là sử dụng BK)
            if (payment_method == 0 && payment_method_baokim > 0) {
                // Gán payment_method = 9 => Thanh toán qua Bảo Kim
                payment_method = 9;
            }

            if (payment_method <= 0 || isNaN(payment_method)) {
                alert('Bạn chưa chọn hình thức thanh toán');
                return false;
            }

            /************* Thanh toán sử dụng Bảo Kim *************/
            if (payment_method_baokim > 0) {
                // Sử dụng số dư TK Bảo Kim
                if (payment_method_baokim == 9) {
                    var ord_email_baokim = $("input[name=ord_email_baokim]").val();
                    if (ord_email_baokim == "") {
                        alert('Bạn cần nhập Email đăng nhập Bảo Kim trước');
                        return false;
                    }
                }
                // Sử dụng thẻ ngân hàng
                else {
                    var bank_payment_method = $("input[name=bank_payment_method]").val();
                    if (bank_payment_method == "" || isNaN(bank_payment_method) || bank_payment_method <= 0) {
                        alert('Bạn chưa chọn Ngân hàng bạn muốn sử dụng thanh toán');
                        return false;
                    }

                }
            }
            /************* End Thanh toán sử dụng Bảo Kim *************/
        }

        /************** Begin: Yêu cầu người mua liên hệ với gian hàng và nhập phí vận chuyển đã thỏa thuận trước ************/
        shipping_cost = $("#shipping_cost").val();
        shipping_cost = parseInt(shipping_cost);

        if (shipping_cost == -1 || isNaN(shipping_cost)) {
            $("#fee_shipping_contact").addClass('form_control_onError').focus();
            $("#fee_shipping_contact_txt").html("Vui lòng nhập phí giao hàng hoặc chọn đặt hàng không gồm phí.");
            //alert('Bạn cần liên hệ với gian hàng về phí vận chuyển và điền vào ô phí vận chuyển trước');
            return false;
        }
        /************** End: Yêu cầu người mua liên hệ với gian hàng và nhập phí vận chuyển đã thỏa thuận trước ************/

        return true;
    }

    // Kiểm tra thông tin user trước khi cho đặt hàng
    function checkPaymentUser() {
        var ord_name = "";
        var ord_email = "";
        var ord_phone = "";
        var ord_city = 0;
        var ord_district = 0;
        var ord_address = "";
        var ord_sname = "";
        var ord_semail = "";
        var ord_sphone = "";
        var ord_scity = 0;
        var ord_sdistrict = 0;
        var ord_saddress = "";

        var statusCheckAddInfo = 0; // Biến kiểm tra xem có cần thêm thông tin user không

        /* 1 Thông tin người mua*/
        var arrControl = Array("0{#}{#}ord_name{#}Họ và tên",
            "3{#}{#}ord_email{#}địa chỉ Email",
            "0{#}{#}ord_phone{#}Số điện thoại",
            "2{#}0{#}ord_city{#}Tỉnh/Thành phố",
            "2{#}0{#}ord_district{#}Quận/Huyện",
            "0{#}{#}ord_address{#}địa chỉ nhận hàng"
        );

        /* 2 Thông tin người nhận*/
        // Nếu địa chỉ người nhận trùng địa chỉ người mua
        if ($("#check_same_buyer").is(":checked")) {
            // Lấy dữ liệu vào form POST
            $("#ord_sname").val($("#ord_name").val());
            $("#ord_semail").val($("#ord_email").val());
            $("#ord_sphone").val($("#ord_phone").val());
            $("#ord_scity").val($("#ord_city").val());
            

            $("#ord_sdistrict").val($("#ord_district").val());
            $("#ord_saddress").val($("#ord_address").val());
        } else {
            /* Trường hợp user đã đăng nhập*/
            if (vatgiaUserLogged == 1) {
                // Nếu user không chọn thêm địa chỉ nhận hàng khác
                if (!$("#form_add_more_address").is(':visible')) {
                    if ($("#list_user_address .detail_address_active").length < 1) {
                        alert("Vui lòng chọn 1 địa chỉ nhận hàng hoặc click thêm địa chỉ nhận hàng khác!");
                        return false;
                    }
                } else {
                    statusCheckAddInfo = 1;
                }
            }

            if (vatgiaUserLogged != 1 || statusCheckAddInfo == 1) {
                var arrControl = Array(
                    "0{#}{#}ord_name{#}Họ và tên",
                    "3{#}{#}ord_email{#}địa chỉ Email",
                    "0{#}{#}ord_phone{#}Số điện thoại",
                    "2{#}0{#}ord_city{#}Tỉnh/Thành phố",
                    "2{#}0{#}ord_district{#}Quận/Huyện",
                    "0{#}{#}ord_address{#}địa chỉ nhận hàng",
                    "0{#}{#}user_name{#}Họ và tên",
                    "0{#}{#}user_phone{#}Số điện thoại",
                    "2{#}0{#}user_city{#}Tỉnh/Thành phố",
                    "2{#}0{#}user_district{#}Quận/Huyện",
                    "0{#}{#}user_address{#}địa chỉ nhận hàng"
                );
                // Lấy dữ liệu vào form POST
                $("#ord_sname").val($("#user_name").val());
                $("#ord_semail").val($("#user_email").val());
                $("#ord_sphone").val($("#user_phone").val());
                $("#ord_scity").val($("#user_city").val());
                $("#ord_sdistrict").val($("#user_district").val());
                $("#ord_saddress").val($("#user_address").val());
            }
        }

        var hasError = 0;
        for (i = 0; i < arrControl.length; i++) {
            if (arrControl[i] === undefined) continue;
            arrTemp = arrControl[i].split("{#}");
            type = arrTemp[0];
            defVal = arrTemp[1];
            control = arrTemp[2];
            title = arrTemp[3];
            domEle = $("#" + control);
            value = domEle.val();
            errMsg = "";
            statusErr = 0;
            switch (type) {
                case "0":
                    if ($.trim(value) == "" || $.trim(value) == defVal) {
                        errMsg = "Vui lòng nhập " + title;
                        statusErr = 1;
                    }
                    break;
                case "1":
                    if (parseFloat(value) <= parseFloat(defVal)) {
                        errMsg = title + " phải lớn hơn " + addCommas(defVal);
                        statusErr = 1;
                    }
                    break;
                case "2":
                    if (value == defVal) {
                        errMsg = "";
                        statusErr = 1;
                    }
                    break;
                case "3":
                    if (!isEmail(value)) {
                        errMsg = "Vui lòng nhập đúng " + title;
                        statusErr = 1;
                    }
                    break;
                case "4":
                    if ($.trim(value).length < defVal) {
                        errMsg = title + " phải có ít nhất " + addCommas(defVal) + " ký tự";
                        statusErr = 1;
                    }
                    break;
                case "5":
                    if (!isUrl(value)) {
                        errMsg = title + " không hợp lệ.";
                        statusErr = 1;
                    }
                    break;
                case "6":
                    if (parseFloat(value) < parseFloat(defVal)) {
                        errMsg = title + " phải lớn hơn hoặc bằng " + addCommas(defVal) + ".";
                        statusErr = 1;
                    }
                    break;
                case "7":
                    if (parseFloat(value) > parseFloat(defVal)) {
                        errMsg = title + " phải nhỏ hơn hoặc bằng " + addCommas(defVal) + ".";
                        statusErr = 1;
                    }
                    break;
            }

            if (statusErr == 1) {
                domEle.parent().find(".errorMsgControl").remove();
                if (hasError == 0) {
                    domEle.addClass("form_control_onError").focus().val(domEle.val());
                } else {
                    domEle.addClass("form_control_onError");
                }

                if (errMsg != "") {
                    $("<div class='errorMsgControl'>" + errMsg + "</div>").insertAfter(domEle);
                } else {
                    if (hasError == 0) open(domEle);
                }
                hasError = 1;
            } else {
                domEle.removeClass("form_control_onError");
            }
        }

        if (hasError == 1) {
            return false;
        }

        return true;
    }





    // Chọn địa chỉ nhận hàng
    $(document).on('click', '.list_address .radio_address input[type=radio]', function() {

        $(".detail_address").removeClass("detail_address_active");
        $(this).parents(".detail_address").addClass("detail_address_active");

        // Lấy thông tin địa chỉ đã chọn
        var iData = $(this).attr("iData");
        iData = parseInt(iData);
        var strData = $(this).attr("strData");
        arrData = (strData != "undefined" && strData != undefined) ? strData.split("_|_") : "";
        ord_sname = (arrData[0] != undefined && arrData[0] != "undefined") ? arrData[0] : "";
        ord_semail = (arrData[1] != undefined && arrData[1] != "undefined") ? arrData[1] : "";
        ord_sphone = (arrData[2] != undefined && arrData[2] != "undefined") ? arrData[2] : "";
        ord_scity = (arrData[3] != undefined && arrData[3] != "undefined") ? arrData[3] : 0;
        ord_sdistrict = (arrData[4] != undefined && arrData[4] != "undefined") ? arrData[4] : 0;
        ord_saddress = (arrData[5] != undefined && arrData[5] != "undefined") ? arrData[5] : "";

        // Kiểm tra có được thanh toán khi nhận hàng không
        var received_postpaid_detail = $('#pmt_method_cod').attr("iDetail");
        var received_postpaid = $('#pmt_method_cod').attr("iPayCod");
        if (received_postpaid == 1) {
            if (received_postpaid_detail == 1) {
                if (ord_scity != estore_city_id) {
                    allow_pay_cod = 0; // Không được thanh toán khi nhận hàng
                } else {
                    allow_pay_cod = 1; // Được được thanh toán khi nhận hàng
                }
            } else {
                allow_pay_cod = 1; // Được thanh toán khi nhận hàng
            }
        }

        if (allow_pay_cod == 1) {
            $("#pmt_method_cod").removeAttr("disabled");
            $("#pmt_method_name_cod .method_name").removeClass("disabled");
            $("#pmt_method_name_cod .method_decription").html('Bạn cần thanh toán thêm <span id="txt_cod_fee">10.000</span>đ phí thu tiền tận nơi.');
        } else {
            $("#pmt_method_cod").prop('checked', false);
            $("#pmt_method_cod").attr("disabled", "disabled");
            $("#pmt_method_name_cod .method_name").addClass("disabled");
            $("#pmt_method_name_cod .method_decription").html("<div class='not_allow_pay_code'>Gian hàng <b>dienmay234</b> không hỗ trợ thanh toán khi nhận hàng. Vui lòng chọn hình thức thanh toán khác</div>");
            $("#pmt_method_name_cod .method_content").show();
            // Chưa chọn phương thức thanh toán
            setPaymentType(0);
        }

        $("#ord_address_id").val(iData);
        $("#ord_sname").val(ord_sname);
        $("#ord_semail").val(ord_semail);
        $("#ord_sphone").val(ord_sphone);
        $("#ord_scity").val(ord_scity);
        $("#ord_sdistrict").val(ord_sdistrict);
        $("#ord_saddress").val(ord_saddress);

        // Lấy lại các dịch vụ vận chuyển
        showShippingCost(2024967, '5196950', ord_scity, ord_sdistrict);

        // Kiểm tra lại sp có nằm ngoài phạm vi vận chuyển không
        check_product_inrange(ord_scity);

        // Ẩn form Sửa địa chỉ nếu đang hiển thị
        hide_edit_address();

    });

    var arrayValidateForm = new Array();
    arrayValidateForm['user_name'] = "Vui lòng nhập Họ và tên";
    arrayValidateForm['user_phone'] = "Vui lòng nhập Số điện thoại";
    arrayValidateForm['user_email'] = "Vui lòng nhập đúng địa chỉ Email";
    arrayValidateForm['user_address'] = "Vui lòng nhập địa chỉ nhận hàng";
    arrayValidateForm['ord_name'] = "Vui lòng nhập Họ và tên";
    arrayValidateForm['ord_phone'] = "Vui lòng nhập Số điện thoại";
    arrayValidateForm['ord_email'] = "Vui lòng nhập đúng địa chỉ Email";
    arrayValidateForm['ord_address'] = "Vui lòng nhập địa chỉ nhận hàng";

    // Xử lý khi blur khỏi các input nhập thông tin user
    $(document).on('blur', ".form_add_address .form_control", function() {
        var name_control = $(this).attr("name");
        var value_control = $(this).val();
        $(this).parent().find(".errorMsgControl").remove();
        switch (name_control) {
            case 'user_name':
            case 'user_phone':
            case 'user_address':
            case 'ord_name':
            case 'ord_phone':
            case 'ord_address':
                if (value_control == "") {
                    $(this).addClass('form_control_onError');
                    $(this).parent().find(".typeSuccess").remove();
                    $("<div class='errorMsgControl'>" + arrayValidateForm[name_control] + "</div>").insertAfter($(this));
                } else {
                    $("<i class='typeSuccess'></i>").insertAfter($(this));
                    $(this).parent().find(".errorMsgControl").remove();
                    $(this).removeClass('form_control_onError');
                }
                break;
            case 'user_email':
            case 'ord_email':
                if (!isEmail(value_control)) {
                    $("<div class='errorMsgControl'>" + arrayValidateForm[name_control] + "</div>").insertAfter($(this));
                    $(this).addClass('form_control_onError');
                    $(this).parent().find(".typeSuccess").remove();
                    // Ẩn note thông báo email
                    $('#ord_email_note').hide();
                } else {
                    $(this).removeClass('form_control_onError');
                    $(this).parent().find(".errorMsgControl").remove();
                    $("<i class='typeSuccess'></i>").insertAfter($(this));
                    $('#ord_email_note').show().css("color", "#999");
                }
                break;

            case 'user_city':
            case 'user_district':
            case 'ord_city':
            case 'ord_district':
                if (value_control <= 0) {
                    $(this).addClass('form_control_onError');
                } else {
                    $(this).addClass('form_control_onSuccess');
                }
                break;
        }
    });


    $(document).on('focus', ".form_add_address .form_control", function() {
        $(this).removeClass('form_control_onSuccess');
        $(this).parent().find(".errorMsgControl").remove();

        //hiển thị note email
        if ($(this).attr("name") == 'user_email') {
            $('#user_email_note').show().css("color", "#333");
        }
    });

    // Xử lý khi click chọn hình thức trả tiền
    $(".detail_method .method_radio").click(function() {
        $(".payment_detail .pmt_button").show();
        // Kiểm tra có được thanh toán khi nhận hàng không
        if (allow_pay_cod == 0) {
            $(".detail_method .method_content:not(#pmt_method_name_cod .method_content)").slideUp();
        } else {
            $(".detail_method .method_content").slideUp();
        }
        $(this).parents(".detail_method").find(".method_content").stop(true, true).slideDown();
        $(this).parents(".list_method").find(".method_name").css('font-weight', 'normal');
        $(this).parents(".detail_method").find(".method_name").css('font-weight', 'bold').find('.method_explain').css('font-weight', 'normal');

        // Reset lại lựa chọn ngân hàng
        $(".detail_method .list_data a").removeClass("selected");
        $("#bank_payment_method").val(0);

        // Chuyển hình thức thanh toán thì reset lại toàn bộ phần phí
        $("#note_next_action_bank").html("");
        fix_fee = 0;
        percent_fee = 0;
        max_bank_fee = 0;
        min_bank_fee = 0;

        $("#txtbox_vpoint_use").val(0);
        $("#vpoint_use").val(0);

        // Hình thức trả tiền 1 = trả trước, 2 = tại nhà, 3 = tại cửa hàng
        var pmtType = $(this).attr("pmtType");
        pmtType = parseInt(pmtType);
        if (pmtType != 2 && pmtType != 3) pmtType = 1;
        setPaymentType(pmtType);

        // Cập nhật hình thức trả tiền cụ thể được bọn (BK = ví BK / dùng ATM / Internet Banking ...)
        payment_method_baokim = $(this).val();
        $("input[name=payment_method_baokim]").val(payment_method_baokim);

        // Nếu là thanh toán dùng ví BK và số dư Vpoint khả dụng lớn hơn 0 thì show box điền Vpoint muốn tiêu
        $(".payment_detail .right .pmt_button").show();
        $('#back_to_cart').show();
        if (payment_method_baokim == 9) {
            if (vatgiaUserLogged == 1) {
                var ord_email_baokim = $("#ord_email_baokim").val();
                if (ord_email_baokim != "undefined " && ord_email_baokim != undefined && ord_email_baokim != "") reloadUserBalanceInfo(ord_email_baokim);
            } else {
                $(".payment_detail .pmt_button").hide();
            }
        } else {
            // Số Vpoint có thể sử dụng
            $("#info_useVpoint").attr("iData", 0);
            $("#vpoint_remain").val(0);
            $("#vpoint_use").val(0);
        }

        if ($(this).attr("id") != "pmt_method_2") {
            // Cập nhật lại toàn bộ phí
            updateTotalCost();
        }

        if ($(this).attr("id") == "pmt_method_cod") {
            $("#show_list_paymentonline").removeAttr("checked");
            $(".list_paymentonline").slideUp();
            $(".txt_list_paymentonline").css('font-weight', 'normal');
        }

        // Gọi ajax lưu thông tin vào user_tracking
        /*
        var frm= $("form[name='frmPayment']");
        $.ajax({
        type: "POST",
        url: con_ajax_path + "add_info_user_tracking.php?estore_id=2024967",
        data: frm.serialize(),
        dataType: "json",
        success: function(data){
        }
        });
        */
    });

    // Xử lý phần chọn 2 phương thức thanh toán
    $("#show_list_paymentonline").click(function() {
        $(".list_paymentonline").slideDown();
        $(".txt_list_paymentonline").css('font-weight', 'bold');
        $("#pmt_method_cod").removeAttr("checked").parents(".list_method").find(".method_name").css('font-weight', 'normal');

        //Hiển thị phần check đồng ý điều khoản của BK
        $("#bk_ttonline_check").show();
    })

    // Xử lý khi click lựa chọn ngân hàng
    $(".detail_method .list_data a").click(function() {

        // Reset lại lựa chọn ngân hàng
        $(".detail_method .list_data a").removeClass("item_bank_selected");
        $(this).addClass("item_bank_selected");

        // Lưu lại ngân hàng đã chọn
        var bank_payment_method = $(this).attr("iData");
        $("#bank_payment_method").val(bank_payment_method);
        var next_action_bank = $(this).attr("nAction");
        $("#next_action_bank").val(next_action_bank);

        if (next_action_bank == "redirect") {
            $("#note_next_action_bank").html("<b>* </b>Click <b>Đặt hàng</b> màn hình sẽ chuyển sang cổng thanh toán để bạn trả tiền cho đơn hàng này.");
        } else {
            $("#note_next_action_bank").html("");
        }

        // Phí tiện ích thanh toán
        fix_fee = $(this).attr("fix_fee");
        fix_fee = parseFloat(fix_fee);
        percent_fee = $(this).attr("percent_fee");
        percent_fee = parseFloat(percent_fee);
        max_bank_fee = $(this).attr("max_fee");
        max_bank_fee = parseFloat(max_bank_fee);
        min_bank_fee = $(this).attr("min_fee");
        min_bank_fee = parseFloat(min_bank_fee);
        // Gọi hàm tính lại phí
        updateTotalCost();

    });

    // Khi chọn hình thức thanh toán Bằng thẻ quốc tế Visa/MasterCard thì chọn sẵn ngân hàng và ẩn ngân hàng đi(chỉ có 1 ngân hàng nên tránh user phải thao tác)
    $("#pmt_method_2").click(function() {
        $("#pmt_method_name_2 .list_data a").trigger("click");
        $("#pmt_method_name_2 .method_content").hide();
    });
    </script>
    </div>
    </div>
    <script type="text/javascript" src="/payment/js/avim.js"></script>
    <script type="text/javascript" src="/payment/js/simpleTip.js"></script>
    <script type="text/javascript" src="/payment/js/windowPrompt.js"></script>
    <script type="text/javascript" src="/payment/js/jquery.ajaxQueue.js"></script>
    <script type="text/javascript" src="/payment/js/jquery.autocomplete.js"></script>
    <script type="text/javascript" src="/payment/js/jquery.carousel.js"></script>
    <script type="text/javascript" src="/payment/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="/payment/js/jquery.easing.js"></script>
    <script type="text/javascript" src="/payment/js/jquery.hoverIntent.js"></script>
    <script type="text/javascript" src="/payment/js/jquery.lazyload.js"></script>
    <script type="text/javascript" src="/payment/js/jquery.menu-aim.js"></script>
    <script type="text/javascript" src="/payment/js/jquery.number.min.js"></script>
    <script type="text/javascript" src="/payment/js/jquery.slimScroll.js"></script>
    <script type="text/javascript" src="/payment/js/jquery.sticky-kit.js"></script>
    </div>
    </div>
    </div>
    <style type="text/css">
	.list_data li{
		float: left;
	
	}
	.img-active {
		border: 2px solid blue !important
	}

	.img-bank {
		border: 2px solid white
	}
    .error{
        color: red;
    }
    </style>
    <script>
		$("#total_amount").number( true, 0 , ',','.' );
	    //$("#total_money_pay").number( true, 0 , ',','.' );

        
		$(function () {

			$('#check_bk').click(function(){
				$('#bank_payment_method_id').val(0);
			});

			$('.img-bank').click(function () {
				$('.method img').removeClass('img-active');
				$(this).addClass('img-active');
				var id = $(this).attr('id');
				$('#bank_payment_method_id').val(id);
			});

			$('.method').click(function () {
				$(this).siblings().children().find('img').removeClass('img-active');
				$('.method').removeClass('selected');
				$('.check_box').removeClass('checked_box');
				$(this).addClass('selected');
				$('.selected .check_box').addClass('checked_box');
				var method = $(this).attr('id');
				if (method != 0) {
					//$('.mode').css('display','block');
					$('.info1').slideDown();
					$('.selected img').click(function () {
						$('.method img').removeClass('img-active');
						$(this).addClass('img-active');
						var id = $(this).attr('id');
						$('#bank_payment_method_id').val(id);

					});
				}
				else {
					//$('.mode').css('display','none');
					$('.info1').slideUp('slow');
					$('.method img').removeClass('img-active');
				}
				$('#form-action').attr('action', 'request.php');
			});

			$('.input-mode').click(function () {
				var a = $(this).val();
				if (a == 2) {
					$('#daykeep').css('display', 'block');
				}
				if (a == 1) {
					$('#daykeep').css('display', 'none');
				}

			});
		});
	</script>
    <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
    <script>
        
        // When the browser is ready...
        $(function() {

            // Setup form validation on the #register-form element
            $("#frmPayment").validate({

                // Specify the validation rules
                rules: {
                    payer_email: {
                        required: true,
                        email: true
                    },
                    payer_name: {
                        required: true,
                        minlength: 6
                    },
                    payer_phone_no: {
                        required: true,
                        minlength: 10
                    },
                    address: {
                        required: true,
                        minlength: 10
                    },
                    ord_city: {
                        required: true
                    },
                    ord_district: {
                        required: true
                    }
                },
                
                // Specify the validation error messages
                messages: {
                    payer_name: {
                        required: "Vui lòng nhập vào Họ tên",
                        minlength: "Họ tên ít nhất 6 ký tự"
                    },
                    payer_phone_no: {
                        required: "Vui lòng nhập vào số điện thoại",
                        minlength: "Số điện thoại tên ít nhất 10 số"
                    },
                    address: {
                        required: "Vui lòng nhập vào địa chỉ",
                        minlength: "Địa chỉ ít nhất 10 ký tự"
                    },
                    ord_city: {
                        required: "Vui lòng chọn Tỉnh/Thành phố"
                    },
                    ord_district: {
                        required: "Vui lòng chọn Quận/Huyện"
                    },
                    payer_email: "Vui lòng nhập vào email"
                },
                
                submitHandler: function(form) {
                    form.submit();
                }
            });

        });
      
    </script>
</body>

</html>



