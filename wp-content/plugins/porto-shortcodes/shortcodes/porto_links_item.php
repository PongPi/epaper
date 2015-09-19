<?php

// Porto Links Item
add_shortcode('porto_links_item', 'porto_shortcode_links_item');
add_action('vc_build_admin_page', 'porto_load_links_item_shortcode');
add_action('vc_after_init', 'porto_load_links_item_shortcode');

function porto_shortcode_links_item($atts, $content = null) {
    ob_start();
    if ($template = porto_shortcode_template('porto_links_item'))
        include $template;
    return ob_get_clean();
}

function porto_load_links_item_shortcode() {
    $custom_class = porto_vc_custom_class();

    vc_map( array(
        "name" => __("Links Item", 'porto-shortcodes'),
        "base" => "porto_links_item",
        "category" => __("Porto", 'porto-shortcodes'),
        "icon" => "porto_vc_links_item",
        'weight' => - 50,
        "as_child" => array('only' => 'porto_links_block'),
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => __("Label", 'porto-shortcodes'),
                "param_name" => "label",
                "value" => "",
                "admin_label" => true
            ),
            array(
                "type" => "textfield",
                "heading" => __("Link", 'porto-shortcodes'),
                "param_name" => "link",
                "value" => ""
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Font Awesome Icon or Icon Class', 'porto-shortcodes'),
                'param_name' => 'icon',
                'description' => __('Input font awesome icon or icon class. You can see <a target="_blank" href="http://fortawesome.github.io/Font-Awesome/icons/">Font Awesome Icons in here</a>.', 'porto-shortcodes')
            ),
            $custom_class
        )
    ) );

    if (!class_exists('WPBakeryShortCode_Porto_Links_Item')) {
        class WPBakeryShortCode_Porto_Links_Item extends WPBakeryShortCode {
        }
    }
}