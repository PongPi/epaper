<?php
/*
* Plugin Name: Wc Upload File
* Plugin URI: http://wordpress.org
* Description: Plugin hỗ trợ up load file
* Author: TranTrung
* Version: 1.0
* Author URI: None
*/

// LINK huong dan http://dobsondev.com/using-the-wordpress-media-uploader/
// Khai báo meta box

function wc_upload_meta_box()
{
    add_meta_box( 'thong-tin', 'Up load PDF', 'wc_display_upload', 'product');
}
add_action('add_meta_boxes','wc_upload_meta_box');

function wc_display_upload($post)
{

    $link_download = get_post_meta( $post->ID, '_link_download', true );

    echo  '<input id="image-url" type="text" name="image" value="'.esc_attr( $link_download ).'" />';
    echo  '<input id="upload-button" type="button" class="button" value="Upload Image" />';

}
/**
 Lưu dữ liệu meta box khi nhập vào
 @param post_id là ID của post hiện tại
**/
function wc_save_link( $post_id )
{
 $link_download = sanitize_text_field( $_POST['image'] );
 update_post_meta( $post_id, '_link_download', $link_download );
}
add_action( 'save_post', 'wc_save_link' );

/* Add the media uploader script */
function my_media_lib_uploader_enqueue() 
{
    wp_enqueue_media();
    wp_enqueue_script('jquery');
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_register_script( 'media-lib-uploader-js', plugins_url( 'js/media-lib-uploader.js' , __FILE__ ), array('jquery') );
    wp_enqueue_script( 'media-lib-uploader-js' );
}

add_action('admin_print_scripts', 'my_media_lib_uploader_enqueue');
add_action('admin_enqueue_scripts', 'my_media_lib_uploader_enqueue');
?>