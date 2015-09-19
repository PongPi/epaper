// Porto Config Less File
// Created at <?php echo date("Y-m-d H:i:s") ?>

<?php
$b = porto_check_theme_options();
$dark = $b['css-type'] == 'dark';
?>

@dark: <?php echo $dark ? '1' : '0' ?>;

// Border radius
<?php if ($b['border-radius']) : ?>
    @border_medium: 6px;
<?php else : ?>
    @border_medium: 0;
<?php endif; ?>

// Skin
@skinColor: <?php echo $b['skin-color'] ?>;
@container_width: <?php echo $b['container-width'] ?>px;
@grid_gutter_width: <?php echo $b['grid-gutter-width'] ?>px;
@screen_large: <?php echo $b['container-width'] + 29 ?>px;

// Body
@body_font_family: <?php echo $b['body-font']['font-family'] ?>;
@body_font_weight: <?php echo $b['body-font']['font-weight'] ?>;
@body_font_size: <?php echo $b['body-font']['font-size'] ?>;
@body_line_height: <?php echo $b['body-font']['line-height'] ?>;
@body_color: <?php echo $b['body-font']['color'] ?>;

@alt_font_family: <?php echo $b['alt-font']['font-family'] ?>;
@alt_font_weight: <?php echo $b['alt-font']['font-weight'] ?>;

// Body, Page
@body_bg_color: <?php echo $b['body-bg']['background-color'] ?>;
@body_bg_repeat: <?php echo $b['body-bg']['background-repeat'] ?>;
@body_bg_size: <?php echo $b['body-bg']['background-size'] ?>;
@body_bg_attachment: <?php echo $b['body-bg']['background-attachment'] ?>;
@body_bg_position: <?php echo $b['body-bg']['background-position'] ?>;
<?php
$image = str_replace(array('http://', 'https://'), array('//', '//'), $b['body-bg']['background-image']);
?>
@body_bg_image: <?php echo $image != 'none'?'url("'.esc_url($image).'")':$image ?>;

<?php if ($b['body-bg-gradient'] && $b['body-bg-gcolor']['from'] && $b['body-bg-gcolor']['to']) : ?>
    @body_bg_gradient: true;
    @body_bg_from: <?php echo $b['body-bg-gcolor']['from'] ?>;
    @body_bg_to: <?php echo $b['body-bg-gcolor']['to'] ?>;
<?php else : ?>
    @body_bg_gradient: false;
    @body_bg_from: <?php echo $b['body-bg']['background-color'] ?>;
    @body_bg_to: <?php echo $b['body-bg']['background-color'] ?>;
<?php endif; ?>

@content_bg_color: <?php echo $b['content-bg']['background-color'] ?>;
@content_bg_repeat: <?php echo $b['content-bg']['background-repeat'] ?>;
@content_bg_size: <?php echo $b['content-bg']['background-size'] ?>;
@content_bg_attachment: <?php echo $b['content-bg']['background-attachment'] ?>;
@content_bg_position: <?php echo $b['content-bg']['background-position'] ?>;
<?php
$image = str_replace(array('http://', 'https://'), array('//', '//'), $b['content-bg']['background-image']);
?>
@content_bg_image: <?php echo $image != 'none'?'url("'.esc_url($image).'")':$image ?>;

<?php if ($b['content-bg-gradient'] && $b['content-bg-gcolor']['from'] && $b['content-bg-gcolor']['to']) : ?>
    @content_bg_gradient: true;
    @content_bg_from: <?php echo $b['content-bg-gcolor']['from'] ?>;
    @content_bg_to: <?php echo $b['content-bg-gcolor']['to'] ?>;
<?php else : ?>
    @content_bg_gradient: false;
    @content_bg_from: <?php echo $b['content-bg']['background-color'] ?>;
    @content_bg_to: <?php echo $b['content-bg']['background-color'] ?>;
<?php endif; ?>

// Mobile Panel

@panel_bg_color: <?php echo $b['panel-bg-color'] ?>;
@panel_text_color: <?php echo $b['panel-text-color'] ?>;
@panel_link_color: <?php echo $b['panel-link-color']['regular'] ?>;
@panel_hover_color: <?php echo $b['panel-link-color']['hover'] ?>;

// Header Top
@header_top_bg_color: <?php echo $b['header-top-bg-color'] ?>;
@header_top_text_color: <?php echo $b['header-top-text-color'] ?>;
@header_top_link_color: <?php echo $b['header-top-link-color']['regular'] ?>;
@header_top_hover_color: <?php echo $b['header-top-link-color']['hover'] ?>;
@header_top_bottom_border_width: <?php echo $b['header-top-bottom-border']['border-top'] ?>;
@header_top_bottom_border_color: <?php echo $b['header-top-bottom-border']['border-color'] ?>;

// Header
@header_border_top_width: <?php echo $b['header-top-border']['border-top'] ?>;
@header_border_top_color: <?php echo $b['header-top-border']['border-color'] ?>;
@header_bg_color: <?php echo $b['header-bg']['background-color'] ?>;
@header_bg_repeat: <?php echo $b['header-bg']['background-repeat'] ?>;
@header_bg_size: <?php echo $b['header-bg']['background-size'] ?>;
@header_bg_attachment: <?php echo $b['header-bg']['background-attachment'] ?>;
@header_bg_position: <?php echo $b['header-bg']['background-position'] ?>;
<?php
$image = str_replace(array('http://', 'https://'), array('//', '//'), $b['header-bg']['background-image']);
?>
@header_bg_image: <?php echo $image != 'none'?'url("'.esc_url($image).'")':$image ?>;

<?php if ($b['header-bg-gradient'] && $b['header-bg-gcolor']['from'] && $b['header-bg-gcolor']['to']) : ?>
    @header_bg_gradient: true;
    @header_bg_from: <?php echo $b['header-bg-gcolor']['from'] ?>;
    @header_bg_to: <?php echo $b['header-bg-gcolor']['to'] ?>;
<?php else : ?>
    @header_bg_gradient: false;
    @header_bg_from: <?php echo $b['header-bg']['background-color'] ?>;
    @header_bg_to: <?php echo $b['header-bg']['background-color'] ?>;
<?php endif; ?>

@sticky_header_bg_color: <?php echo $b['sticky-header-bg']['background-color'] ?>;
@sticky_header_bg_repeat: <?php echo $b['sticky-header-bg']['background-repeat'] ?>;
@sticky_header_bg_size: <?php echo $b['sticky-header-bg']['background-size'] ?>;
@sticky_header_bg_attachment: <?php echo $b['sticky-header-bg']['background-attachment'] ?>;
@sticky_header_bg_position: <?php echo $b['sticky-header-bg']['background-position'] ?>;
<?php
$image = str_replace(array('http://', 'https://'), array('//', '//'), $b['sticky-header-bg']['background-image']);
?>
@sticky_header_bg_image: <?php echo $image != 'none'?'url("'.esc_url($image).'")':$image ?>;

<?php if ($b['sticky-header-bg-gradient'] && $b['sticky-header-bg-gcolor']['from'] && $b['sticky-header-bg-gcolor']['to']) : ?>
    @sticky_header_bg_gradient: true;
    @sticky_header_bg_from: <?php echo $b['sticky-header-bg-gcolor']['from'] ?>;
    @sticky_header_bg_to: <?php echo $b['sticky-header-bg-gcolor']['to'] ?>;
<?php else : ?>
    @sticky_header_bg_gradient: false;
    @sticky_header_bg_from: <?php echo $b['sticky-header-bg']['background-color'] ?>;
    @sticky_header_bg_to: <?php echo $b['sticky-header-bg']['background-color'] ?>;
<?php endif; ?>

@header_text_color: <?php echo $b['header-text-color'] ?>;
@header_link_color: <?php echo $b['header-link-color']['regular'] ?>;
@header_hover_color: <?php echo $b['header-link-color']['hover'] ?>;

@header_opacity: <?php echo $b['header-opacity'] ?>;
@searchform_opacity: <?php echo $b['searchform-opacity'] ?>;
@menuwrap_opacity: <?php echo $b['menuwrap-opacity'] ?>;
@menu_opacity: <?php echo $b['menu-opacity'] ?>;

// Side Social, Copyright
@side_social_bg_color: <?php echo $b['side-social-bg-color'] ?>;
@side_social_color: <?php echo $b['side-social-color'] ?>;
@side_copyright_color: <?php echo $b['side-copyright-color'] ?>;

// Switcher
@header_switcher_bg_color: <?php echo $b['switcher-bg-color'] ?>;
@header_switcher_hbg_color: <?php echo $b['switcher-hbg-color'] ?>;
@header_switcher_link_color: <?php echo $b['switcher-link-color']['regular'] ?>;
@header_switcher_hover_color: <?php echo $b['switcher-link-color']['hover'] ?>;

// Searchform
@searchform_bg_color: <?php echo $b['searchform-bg-color'] ?>;
@searchform_border_color: <?php echo $b['searchform-border-color'] ?>;
@searchform_popup_border_color: <?php echo $b['searchform-popup-border-color'] ?>;
@searchform_text_color: <?php echo $b['searchform-text-color'] ?>;
@searchform_hover_color: <?php echo $b['searchform-hover-color'] ?>;

// Mini Cart
@minicart_icon_color: <?php echo $b['minicart-icon-color'] ?>;
@minicart_item_color: <?php echo $b['minicart-item-color'] ?>;
@minicart_border_color: <?php echo $b['minicart-border-color'] ?>;
@minicart_bg_color: <?php echo $b['minicart-bg-color'] ?>;
@minicart_popup_border_color: <?php echo $b['minicart-popup-border-color'] ?>;

// Main Menu
@main_menu_wrapper_bg_color: <?php echo $b['mainmenu-wrap-bg-color'] ?>;
<?php if (is_rtl()) : ?>
@main_menu_wrapper_padding: <?php echo porto_config_value($b['mainmenu-wrap-padding']['padding-top']) ?>px <?php echo porto_config_value($b['mainmenu-wrap-padding']['padding-left']) ?>px <?php echo porto_config_value($b['mainmenu-wrap-padding']['padding-bottom']) ?>px <?php echo porto_config_value($b['mainmenu-wrap-padding']['padding-right']) ?>px;
<?php else : ?>
@main_menu_wrapper_padding: <?php echo porto_config_value($b['mainmenu-wrap-padding']['padding-top']) ?>px <?php echo porto_config_value($b['mainmenu-wrap-padding']['padding-right']) ?>px <?php echo porto_config_value($b['mainmenu-wrap-padding']['padding-bottom']) ?>px <?php echo porto_config_value($b['mainmenu-wrap-padding']['padding-left']) ?>px;
<?php endif; ?>
@main_menu_bg_color: <?php echo $b['mainmenu-bg-color'] ?>;
@main_menu_popup_border: <?php echo $b['mainmenu-popup-border'] ? '1' : '0' ?>;
@main_menu_popup_border_color: <?php echo $b['mainmenu-popup-border-color'] ?>;
@main_menu_popup_bg_color: <?php echo $b['mainmenu-popup-bg-color'] ?>;
@main_menu_popup_heading_color: <?php echo $b['mainmenu-popup-heading-color'] ?>;
@main_menu_popup_link_color: <?php echo $b['mainmenu-popup-text-color']['regular'] ?>;
@main_menu_popup_hover_color: <?php echo $b['mainmenu-popup-text-color']['hover'] ?>;
@main_menu_popup_link_hbg_color: <?php echo $b['mainmenu-popup-text-hbg-color'] ?>;
@main_menu_level1_link_color: <?php echo $b['mainmenu-toplevel-link-color']['regular'] ?>;
@main_menu_level1_hover_color: <?php echo $b['mainmenu-toplevel-link-color']['hover'] ?>;
@main_menu_level1_hbg_color: <?php echo $b['mainmenu-toplevel-hbg-color'] ?>;
<?php if (is_rtl()) : ?>
@main_menu_level1_padding1_right: <?php echo porto_config_value($b['mainmenu-toplevel-padding1']['padding-left']) ?>px;
@main_menu_level1_padding1_left: <?php echo porto_config_value($b['mainmenu-toplevel-padding1']['padding-right']) ?>px;
<?php else : ?>
@main_menu_level1_padding1_left: <?php echo porto_config_value($b['mainmenu-toplevel-padding1']['padding-left']) ?>px;
@main_menu_level1_padding1_right: <?php echo porto_config_value($b['mainmenu-toplevel-padding1']['padding-right']) ?>px;
<?php endif; ?>
@main_menu_level1_padding1_top: <?php echo porto_config_value($b['mainmenu-toplevel-padding1']['padding-top']) ?>px;
@main_menu_level1_padding1_bottom: <?php echo porto_config_value($b['mainmenu-toplevel-padding1']['padding-bottom']) ?>px;
<?php if (is_rtl()) : ?>
@main_menu_level1_padding2_right: <?php echo porto_config_value($b['mainmenu-toplevel-padding2']['padding-left']) ?>px;
@main_menu_level1_padding2_left: <?php echo porto_config_value($b['mainmenu-toplevel-padding2']['padding-right']) ?>px;
<?php else : ?>
@main_menu_level1_padding2_left: <?php echo porto_config_value($b['mainmenu-toplevel-padding2']['padding-left']) ?>px;
@main_menu_level1_padding2_right: <?php echo porto_config_value($b['mainmenu-toplevel-padding2']['padding-right']) ?>px;
<?php endif; ?>
@main_menu_level1_padding2_top: <?php echo porto_config_value($b['mainmenu-toplevel-padding2']['padding-top']) ?>px;
@main_menu_level1_padding2_bottom: <?php echo porto_config_value($b['mainmenu-toplevel-padding2']['padding-bottom']) ?>px;
@main_menu_narrow_type: <?php echo isset($b['mainmenu-popup-narrow-type']) && $b['mainmenu-popup-narrow-type'] ? '1' : '0' ?>;
@main_menu_tip_bg_color: <?php echo $b['mainmenu-tip-bg-color'] ?>;
@main_menu_custom_text_color: <?php echo $b['menu-custom-text-color'] ?>;
@main_menu_custom_link_color: <?php echo $b['menu-custom-link']['regular'] ?>;
@main_menu_custom_link_hcolor: <?php echo $b['menu-custom-link']['hover'] ?>;
@sticky_menu_bg_color: <?php if ($b['mainmenu-bg-color'] && $b['mainmenu-bg-color'] != 'transparent') echo $b['mainmenu-bg-color']; else if ($b['mainmenu-wrap-bg-color'] && $b['mainmenu-wrap-bg-color'] != 'transparent') echo $b['mainmenu-wrap-bg-color']; else echo $b['sticky-header-bg']['background-color'] ?>;

// Footer

@footer_bg_color: <?php echo $b['footer-bg']['background-color'] ?>;
@footer_bg_repeat: <?php echo $b['footer-bg']['background-repeat'] ?>;
@footer_bg_size: <?php echo $b['footer-bg']['background-size'] ?>;
@footer_bg_attachment: <?php echo $b['footer-bg']['background-attachment'] ?>;
@footer_bg_position: <?php echo $b['footer-bg']['background-position'] ?>;
<?php
$image = str_replace(array('http://', 'https://'), array('//', '//'), $b['footer-bg']['background-image']);
?>
@footer_bg_image: <?php echo $image != 'none'?'url("'.esc_url($image).'")':$image ?>;

<?php if ($b['footer-bg-gradient'] && $b['footer-bg-gcolor']['from'] && $b['footer-bg-gcolor']['to']) : ?>
    @footer_bg_gradient: true;
    @footer_bg_from: <?php echo $b['footer-bg-gcolor']['from'] ?>;
    @footer_bg_to: <?php echo $b['footer-bg-gcolor']['to'] ?>;
<?php else : ?>
    @footer_bg_gradient: false;
    @footer_bg_from: <?php echo $b['footer-bg']['background-color'] ?>;
    @footer_bg_to: <?php echo $b['footer-bg']['background-color'] ?>;
<?php endif; ?>

@footer_heading_color: <?php echo $b['footer-heading-color'] ?>;
@footer_text_color: <?php echo $b['footer-text-color'] ?>;
@footer_link_color: <?php echo $b['footer-link-color']['regular'] ?>;
@footer_link_hcolor: <?php echo $b['footer-link-color']['hover'] ?>;

@footer_bottom_bg_color: <?php echo $b['footer-bottom-bg']['background-color'] ?>;
@footer_bottom_bg_repeat: <?php echo $b['footer-bottom-bg']['background-repeat'] ?>;
@footer_bottom_bg_size: <?php echo $b['footer-bottom-bg']['background-size'] ?>;
@footer_bottom_bg_attachment: <?php echo $b['footer-bottom-bg']['background-attachment'] ?>;
@footer_bottom_bg_position: <?php echo $b['footer-bottom-bg']['background-position'] ?>;
<?php
$image = str_replace(array('http://', 'https://'), array('//', '//'), $b['footer-bottom-bg']['background-image']);
?>
@footer_bottom_bg_image: <?php echo $image != 'none'?'url("'.esc_url($image).'")':$image ?>;

<?php if ($b['footer-bottom-bg-gradient'] && $b['footer-bottom-bg-gcolor']['from'] && $b['footer-bottom-bg-gcolor']['to']) : ?>
    @footer_bottom_bg_gradient: true;
    @footer_bottom_bg_from: <?php echo $b['footer-bottom-bg-gcolor']['from'] ?>;
    @footer_bottom_bg_to: <?php echo $b['footer-bottom-bg-gcolor']['to'] ?>;
<?php else : ?>
    @footer_bottom_bg_gradient: false;
    @footer_bottom_bg_from: <?php echo $b['footer-bottom-bg']['background-color'] ?>;
    @footer_bottom_bg_to: <?php echo $b['footer-bottom-bg']['background-color'] ?>;
<?php endif; ?>

@footer_bottom_text_color: <?php echo $b['footer-bottom-text-color'] ?>;
@footer_bottom_link_color: <?php echo $b['footer-bottom-link-color']['regular'] ?>;
@footer_bottom_link_hcolor: <?php echo $b['footer-bottom-link-color']['hover'] ?>;
@footer_opacity: <?php echo (int)($b['footer-opacity']) . '%' ?>;
@footer_social_bg_color: <?php echo $b['footer-social-bg-color'] ?>;
@footer_social_link_color: <?php echo $b['footer-social-link-color'] ?>;

// Breadcrumbs

@breadcrumbs_bg_color: <?php echo $b['breadcrumbs-bg']['background-color'] ?>;
@breadcrumbs_bg_repeat: <?php echo $b['breadcrumbs-bg']['background-repeat'] ?>;
@breadcrumbs_bg_size: <?php echo $b['breadcrumbs-bg']['background-size'] ?>;
@breadcrumbs_bg_attachment: <?php echo $b['breadcrumbs-bg']['background-attachment'] ?>;
@breadcrumbs_bg_position: <?php echo $b['breadcrumbs-bg']['background-position'] ?>;
<?php
$image = str_replace(array('http://', 'https://'), array('//', '//'), $b['breadcrumbs-bg']['background-image']);
?>
@breadcrumbs_bg_image: <?php echo $image != 'none'?'url("'.esc_url($image).'")':$image ?>;

<?php if ($b['breadcrumbs-bg-gradient'] && $b['breadcrumbs-bg-gcolor']['from'] && $b['breadcrumbs-bg-gcolor']['to']) : ?>
    @breadcrumbs_bg_gradient: true;
    @breadcrumbs_bg_from: <?php echo $b['breadcrumbs-bg-gcolor']['from'] ?>;
    @breadcrumbs_bg_to: <?php echo $b['breadcrumbs-bg-gcolor']['to'] ?>;
<?php else : ?>
    @breadcrumbs_bg_gradient: false;
    @breadcrumbs_bg_from: <?php echo $b['breadcrumbs-bg']['background-color'] ?>;
    @breadcrumbs_bg_to: <?php echo $b['breadcrumbs-bg']['background-color'] ?>;
<?php endif; ?>

@breadcrumbs_border_top_width: <?php echo $b['breadcrumbs-top-border']['border-top'] ?>;
@breadcrumbs_border_top_color: <?php echo $b['breadcrumbs-top-border']['border-color'] ?>;
@breadcrumbs_border_bottom_width: <?php echo $b['breadcrumbs-bottom-border']['border-top'] ?>;
@breadcrumbs_border_bottom_color: <?php echo $b['breadcrumbs-bottom-border']['border-color'] ?>;
@breadcrumbs_text_color: <?php echo $b['breadcrumbs-text-color'] ?>;
@breadcrumbs_link_color: <?php echo $b['breadcrumbs-link-color'] ?>;
@breadcrumbs_title_color: <?php echo $b['breadcrumbs-title-color'] ?>;
<?php if (is_rtl()) : ?>
@breadcrumbs_padding: <?php echo porto_config_value($b['breadcrumbs-padding']['padding-top']) ?>px <?php echo porto_config_value($b['breadcrumbs-padding']['padding-left']) ?>px <?php echo porto_config_value($b['breadcrumbs-padding']['padding-bottom']) ?>px <?php echo porto_config_value($b['breadcrumbs-padding']['padding-right']) ?>px;
<?php else : ?>
@breadcrumbs_padding: <?php echo porto_config_value($b['breadcrumbs-padding']['padding-top']) ?>px <?php echo porto_config_value($b['breadcrumbs-padding']['padding-right']) ?>px <?php echo porto_config_value($b['breadcrumbs-padding']['padding-bottom']) ?>px <?php echo porto_config_value($b['breadcrumbs-padding']['padding-left']) ?>px;
<?php endif; ?>

// Container Width
@calc_banner_width: <?php echo ($b['header-bg']['background-color'] == 'transparent' && $b['header-bg']['background-image'] == 'none') && ($b['content-bg']['background-color'] != 'transparent' || $b['content-bg']['background-image'] != 'none') ? '1' : '0' ?>;
@calc_breadcrumbs_width: <?php echo ($b['header-bg']['background-color'] == 'transparent' && $b['header-bg']['background-image'] == 'none') && ($b['breadcrumbs-bg']['background-color'] != 'transparent' || $b['breadcrumbs-bg']['background-image'] != 'none') ? '1' : '0' ?>;
@calc_content_width: <?php echo ($b['header-bg']['background-color'] == 'transparent' && $b['header-bg']['background-image'] == 'none') && ($b['content-bg']['background-color'] != 'transparent' || $b['content-bg']['background-image'] != 'none') ? '1' : '0' ?>;
@calc_footer_width: <?php echo ($b['header-bg']['background-color'] == 'transparent' && $b['header-bg']['background-image'] == 'none') && ($b['footer-bg']['background-color'] != 'transparent' || $b['footer-bg']['background-image'] != 'none') ? '1' : '0' ?>;

// Content Bottom Padding
@calc_content_bottom: <?php echo (($b['content-bg-gradient'] && $b['content-bg-gcolor']['from'] && $b['content-bg-gcolor']['to']) || (!($b['content-bg-gradient'] && $b['content-bg-gcolor']['from'] && $b['content-bg-gcolor']['to']) && $b['content-bg']['background-color'] != $b['body-bg']['background-color'])) ? '1' : '0' ?>;

