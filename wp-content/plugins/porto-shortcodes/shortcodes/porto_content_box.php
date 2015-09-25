<?php

// Porto Content Box
add_shortcode('porto_content_box', 'porto_shortcode_content_box');
add_action('vc_build_admin_page', 'porto_load_content_box_shortcode');
add_action('vc_after_init', 'porto_load_content_box_shortcode');

function porto_shortcode_content_box($atts, $content = null) {
    ob_start();
    if ($template = porto_shortcode_template('porto_content_box'))
        include $template;
    return ob_get_clean();
}

function porto_load_content_box_shortcode() {
    $animation_type = porto_vc_animation_type();
    $animation_duration = porto_vc_animation_duration();
    $animation_delay = porto_vc_animation_delay();
    $custom_class = porto_vc_custom_class();

    vc_map( array(
        "name" => "Porto " . __("Content Box", 'porto-shortcodes'),
        "base" => "porto_content_box",
        "category" => __("Porto", 'porto-shortcodes'),
        "icon" => "porto_vc_content_box",
        'is_container' => true,
        'weight' => - 50,
        "show_settings_on_create" => false,
        'js_view' => 'VcColumnView',
        "params" => array(
            array(
                'type' => 'colorpicker',
                'heading' => __('Border Top Color', 'porto-shortcodes'),
                'param_name' => 'border_top_color',
                'admin_label' => true
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Border Radius', 'porto-shortcodes'),
                'param_name' => 'border_radius',
                'description' => __('Enter the border radius in px.', 'porto-shortcodes')
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Border Top Width', 'porto-shortcodes'),
                'param_name' => 'border_top_width',
                'description' => __('Enter the border top width in px.', 'porto-shortcodes')
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __('Background Gradient Top Color', 'porto-shortcodes'),
                'param_name' => 'bg_top_color'
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __('Background Gradient Bottom Color', 'porto-shortcodes'),
                'param_name' => 'bg_bottom_color'
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Text Align", 'porto-shortcodes'),
                "param_name" => "align",
                "value" => porto_vc_commons('align'),
            ),
            $animation_type,
            $animation_duration,
            $animation_delay,
            $custom_class
        )
    ) );

    if (!class_exists('WPBakeryShortCode_Porto_Content_Box')) {
        class WPBakeryShortCode_Porto_Content_Box extends WPBakeryShortCodesContainer {
        }
    }
}