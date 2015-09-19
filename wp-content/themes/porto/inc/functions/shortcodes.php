<?php

add_action('vc_build_admin_page', 'porto_load_shortcodes');
add_action('vc_after_init', 'porto_load_shortcodes');

function porto_load_shortcodes() {

    if ( function_exists('vc_map') ) {
        /* ---------------------------- */
        /* Customize Tabs, Tab
        /* ---------------------------- */
        vc_remove_param('vc_tabs', 'interval');
        vc_add_param('vc_tabs', array(
            'type' => 'dropdown',
            'heading' => __('Position', 'porto'),
            'param_name' => 'position',
            'value' => porto_vc_commons('tabs'),
            'description' => __('Select the position of the tab header.', 'porto'),
            'admin_label' => true
        ));
        vc_add_param('vc_tab', array(
            'type' => 'textfield',
            'heading' => __('Font Awesome Icon or Icon Class', 'porto'),
            'param_name' => 'icon',
            'description' => __('Input font awesome icon or icon class. You can see <a target="_blank" href="http://fortawesome.github.io/Font-Awesome/icons/">Font Awesome Icons in here</a>.', 'porto')
        ));

        /* ---------------------------- */
        /* Customize Tour
        /* ---------------------------- */
        vc_remove_param('vc_tour', 'interval');
        vc_add_param('vc_tour', array(
            'type' => 'dropdown',
            'heading' => __('Position', 'porto'),
            'param_name' => 'position',
            'value' => porto_vc_commons('tour'),
            'description' => __('Select the position of the tab header.', 'porto'),
            'admin_label' => true
        ));

        /* ---------------------------- */
        /* Customize Separator
        /* ---------------------------- */
        vc_add_param('vc_separator', array(
            'type' => 'checkbox',
            'heading' => __('Show Gradient', 'porto'),
            'param_name' => 'gradient',
            'std' => 'yes',
            'value' => array( __( 'Yes, please', 'js_composer' ) => 'yes' )
        ));
        vc_add_param('vc_separator', array(
            'type' => 'dropdown',
            'heading' => __('Gap Size', 'porto'),
            'param_name' => 'gap',
            'value' => porto_vc_commons('separator')
        ));

        /* ---------------------------- */
        /* Customize Text Separator
        /* ---------------------------- */
        vc_add_param('vc_text_separator', array(
            'type' => 'checkbox',
            'heading' => __('Show Gradient', 'porto'),
            'param_name' => 'gradient',
            'std' => 'yes',
            'value' => array( __( 'Yes, please', 'js_composer' ) => 'yes' )
        ));

        /* ---------------------------- */
        /* Customize Accordion
        /* ---------------------------- */
        vc_remove_param('vc_accordion', 'disable_keyboard');
        vc_add_param('vc_accordion', array(
            'type' => 'dropdown',
            'heading' => __('Type', 'porto'),
            'param_name' => 'type',
            'value' => porto_vc_commons('accordion'),
        ));
        vc_add_param('vc_accordion_tab', array(
            'type' => 'textfield',
            'heading' => __('Font Awesome Icon or Icon Class', 'porto'),
            'param_name' => 'icon',
            'description' => __('Input font awesome icon or icon class. You can see <a target="_blank" href="http://fortawesome.github.io/Font-Awesome/icons/">Font Awesome Icons in here</a>.', 'porto')
        ));

        /* ---------------------------- */
        /* Customize Toggle
        /* ---------------------------- */
        vc_remove_param('vc_toggle', 'style');
        vc_remove_param('vc_toggle', 'color');
        vc_remove_param('vc_toggle', 'size');
        vc_add_param('vc_toggle', array(
            'type' => 'checkbox',
            'heading' => __('Hide Toggle Icon', 'porto'),
            'param_name' => 'hide_toggle',
            'value' => array(__('Hide toggle icon.', 'porto') => 'true'),
            'description' => ''
        ));
        vc_add_param('vc_toggle', array(
            'type' => 'checkbox',
            'heading' => __('View Option', 'porto'),
            'param_name' => 'one_toggle',
            'value' => array(__('Hide this toggle when open another toggle.', 'porto') => 'true'),
            'description' => ''
        ));
        vc_add_param('vc_toggle', array(
            'type' => 'textfield',
            'heading' => __('Font Awesome Icon or Icon Class', 'porto'),
            'param_name' => 'icon',
            'description' => __('Input font awesome icon or icon class. You can see <a target="_blank" href="http://fortawesome.github.io/Font-Awesome/icons/">Font Awesome Icons in here</a>.', 'porto')
        ));

        /* ---------------------------- */
        /* Customize Buttons
        /* ---------------------------- */
        vc_add_param('vc_button', array(
            'type' => 'checkbox',
            'heading' => __('Disable', 'porto'),
            'param_name' => 'disabled',
            'value' => array(__('Disable button.', 'porto') => true)
        ));
        vc_add_param('vc_button', array(
            'type' => 'checkbox',
            'heading' => __('Show as Label', 'porto'),
            'param_name' => 'label',
            'value' => array( __( 'Yes, please', 'js_composer' ) => 'yes' )
        ));

        /* ---------------------------- */
        /* Add Single Image Parameters
        /* ---------------------------- */
        vc_add_param('vc_single_image', array(
            'type' => 'checkbox',
            'heading' => __('LightBox', 'porto'),
            'param_name' => 'lightbox',
            'value' => array( __( 'Yes, please', 'js_composer' ) => true ),
            'dependency' => Array('element' => 'img_link_large', 'not_empty' => true),
            'description' => __('Check it if you want to link to the lightbox with the large image.', 'porto')
        ));
        vc_add_param('vc_single_image', array(
            'type' => 'checkbox',
            'heading' => __('Show Zoom Icon', 'porto'),
            'param_name' => 'zoom_icon',
            'value' => array( __( 'Yes, please', 'js_composer' ) => true ),
            'dependency' => Array('element' => 'img_link_large', 'not_empty' => true)
        ));

        /* ---------------------------- */
        /* Customize Pie Chart
        /* ---------------------------- */
        vc_remove_param('vc_pie', 'color');

        // Used in 'Button', 'Call __( 'Blue', 'js_composer' )to Action', 'Pie chart' blocks
        $colors_arr = array(
            __( 'Grey', 'js_composer' ) => 'wpb_button',
            __( 'Blue', 'js_composer' ) => 'btn-primary',
            __( 'Turquoise', 'js_composer' ) => 'btn-info',
            __( 'Green', 'js_composer' ) => 'btn-success',
            __( 'Orange', 'js_composer' ) => 'btn-warning',
            __( 'Red', 'js_composer' ) => 'btn-danger',
            __( 'Black', 'js_composer' ) => 'btn-inverse'
        );

        vc_add_param('vc_pie', array(
            'type' => 'dropdown',
            'heading' => __('Type', 'porto'),
            'param_name' => 'type',
            'value' => array(
                __('Custom', 'porto') => 'custom',
                __('Default', 'porto') => 'default',
            ),
            'description' => __( 'Select pie chart type.', 'porto' ),
            'admin_label' => true
        ));
        vc_add_param('vc_pie', array(
            'type' => 'dropdown',
            'heading' => __( 'Bar color (default)', 'porto' ),
            'param_name' => 'color',
            'value' => $colors_arr, //$pie_colors,
            'description' => __( 'Select pie chart color.', 'js_composer' ),
            'admin_label' => true,
            'dependency' => array(
                'element' => 'type',
                'value' => array( 'default' )
            ),
            'param_holder_class' => 'vc_colored-dropdown'
        ));
        vc_add_param('vc_pie', array(
            'type' => 'textfield',
            'heading' => __('Size', 'porto'),
            'param_name' => 'size',
            'std' => 175,
            'dependency' => array(
                'element' => 'type',
                'value' => array( 'custom' )
            ),
            'description' => __('Enter the size of the chart in px.', 'porto')
        ));
        vc_add_param('vc_pie', array(
            'type' => 'colorpicker',
            'heading' => __('Track Color', 'porto'),
            'param_name' => 'trackcolor',
            'dependency' => array(
                'element' => 'type',
                'value' => array( 'custom' )
            ),
            'description' => __('Choose the color of the track. Please clear this if you want to use the default color.', 'porto')
        ));
        vc_add_param('vc_pie', array(
            'type' => 'colorpicker',
            'heading' => __('Bar color (custom)', 'porto'),
            'param_name' => 'barcolor',
            'dependency' => array(
                'element' => 'type',
                'value' => array( 'custom' )
            ),
            'description' => __('Select pie chart color. Please clear this if you want to use the default color.', 'porto'),
            'admin_label' => true
        ));
        vc_add_param('vc_pie', array(
            'type' => 'textfield',
            'heading' => __('Animation Speed', 'porto'),
            'param_name' => 'speed',
            'std' => 2500,
            'dependency' => array(
                'element' => 'type',
                'value' => array( 'custom' )
            ),
            'description' => __('Enter the animation speed in milliseconds.', 'porto')
        ));
        vc_add_param('vc_pie', array(
            'type' => 'textfield',
            'heading' => __('Line Width', 'porto'),
            'param_name' => 'line',
            'std' => 14,
            'dependency' => array(
                'element' => 'type',
                'value' => array( 'custom' )
            ),
            'description' => __('Enter the width of the line bar in px.', 'porto')
        ));
        vc_add_param('vc_pie', array(
            'type' => 'dropdown',
            'heading' => __('Line Cap', 'porto'),
            'param_name' => 'linecap',
            'value' => array(__('Round', 'porto') => 'round', __('Square', 'porto') => 'square'),
            'dependency' => array(
                'element' => 'type',
                'value' => array( 'custom' )
            ),
            'description' => __('Choose how the ending of the bar line looks like.', 'porto')
        ));
    }
}

if (!function_exists('porto_vc_commons')) {
    function porto_vc_commons($asset = '') {
        switch ($asset) {

            case 'accordion':
                return Porto_VcSharedLibrary::getAccordionType();
                break;

            case 'align':
                return Porto_VcSharedLibrary::getTextAlign();
                break;

            case 'tabs':
                return Porto_VcSharedLibrary::getTabPositions();
                break;

            case 'tour':
                return Porto_VcSharedLibrary::getTourPositions();
                break;

            case 'separator':
                return Porto_VcSharedLibrary::getSeparator();
                break;

            case 'blog_layout':
                return Porto_VcSharedLibrary::getBlogLayout();
                break;

            case 'blog_grid_columns':
                return Porto_VcSharedLibrary::getBlogGridColumns();
                break;

            case 'portfolio_layout':
                return Porto_VcSharedLibrary::getPortfolioLayout();
                break;

            case 'portfolio_grid_columns':
                return Porto_VcSharedLibrary::getPortfolioGridColumns();
                break;

            case 'portfolio_grid_view':
                return Porto_VcSharedLibrary::getPortfolioGridView();
                break;

            case 'products_view_mode':
                return Porto_VcSharedLibrary::getProductsViewMode();
                break;

            case 'products_columns':
                return Porto_VcSharedLibrary::getProductsColumns();
                break;

            case 'products_column_width':
                return Porto_VcSharedLibrary::getProductsColumnWidth();
                break;

            case 'products_addlinks_pos':
                return Porto_VcSharedLibrary::getProductsAddlinksPos();
                break;

            case 'product_view_mode':
                return Porto_VcSharedLibrary::getProductViewMode();
                break;

            default:
                return array();
                break;
        }
    }
    }

if (!class_exists('Porto_VcSharedLibrary')) {

    class Porto_VcSharedLibrary {

        public static function getTextAlign() {
            return array(
                __('None', 'porto') => '',
                __('Left', 'porto' ) => 'left',
                __('Right', 'porto' ) => 'right',
                __('Center', 'porto' ) => 'center',
                __('Justify', 'porto' ) => 'justify'
            );
        }

        public static function getTabPositions() {
            return array(
                __('Top left', 'porto' ) => '',
                __('Top right', 'porto' ) => 'top-right',
                __('Bottom left', 'porto' ) => 'bottom-left',
                __('Bottom right', 'porto' ) => 'bottom-right',
                __('Top justify', 'porto' ) => 'top-justify',
                __('Bottom justify', 'porto' ) => 'bottom-justify',
            );
        }

        public static function getTourPositions() {
            return array(
                __('Left', 'porto' ) => 'vertical-left',
                __('Right', 'porto' ) => 'vertical-right',
            );
        }

        public static function getSeparator() {
            return array(
                __('Normal', 'porto' ) => '',
                __('Short', 'porto' ) => 'short',
                __('Tall', 'porto' ) => 'tall',
                __('Taller', 'porto' ) => 'taller',
            );
        }

        public static function getAccordionType() {
            return array(
                __('Default', 'porto' ) => 'panel-default',
                __('Secondary', 'porto' ) => 'secondary',
            );
        }

        public static function getBlogLayout() {
            return array(
                __('Full', 'porto' ) => 'full',
                __('Large', 'porto' ) => 'large',
                __('Large Alt', 'porto' ) => 'large-alt',
                __('Medium', 'porto' ) => 'medium',
                __('Grid', 'porto' ) => 'grid',
                __('Timeline', 'porto' ) => 'timeline'
            );
        }

        public static function getBlogGridColumns() {
            return array(
                __('2', 'porto' ) => '2',
                __('3', 'porto' ) => '3',
                __('4', 'porto' ) => '4'
            );
        }

        public static function getPortfolioLayout() {
            return array(
                __('Grid', 'porto' ) => 'grid',
                __('Timeline', 'porto' ) => 'timeline',
                __('Medium', 'porto' ) => 'medium',
                __('Large', 'porto' ) => 'large',
                __('Full', 'porto' ) => 'full'
            );
        }

        public static function getPortfolioGridColumns() {
            return array(
                __('2', 'porto' ) => '2',
                __('3', 'porto' ) => '3',
                __('4', 'porto' ) => '4',
                __('5', 'porto' ) => '5',
                __('6', 'porto' ) => '6'
            );
        }

        public static function getPortfolioGridView() {
            return array(
                __('Classic', 'porto' ) => '',
                __('Full', 'porto' ) => 'full'
            );
        }

        public static function getProductsViewMode() {
            return array(
                __( 'Grid', 'porto' )=> 'grid',
                __( 'List', 'porto' ) => 'list',
                __( 'Slider', 'porto' )  => 'products-slider',
            );
        }

        public static function getProductsColumns() {
            return array(
                '1' => 1,
                '2' => 2,
                '3' => 3,
                '4' => 4,
                '5' => 5,
                '6' => 6,
                '7 ' . __( '(without sidebar)', 'porto' ) => 7,
                '8 ' . __( '(without sidebar)', 'porto' ) => 8
            );
        }

        public static function getProductsColumnWidth() {
            return array(
                __( 'Default', 'porto' ) => '',
                '1/1' . __( ' of content width', 'porto' ) => 1,
                '1/2' . __( ' of content width', 'porto' ) => 2,
                '1/3' . __( ' of content width', 'porto' ) => 3,
                '1/4' . __( ' of content width', 'porto' ) => 4,
                '1/5' . __( ' of content width', 'porto' ) => 5,
                '1/6' . __( ' of content width', 'porto' ) => 6,
                '1/7' . __( ' of content width (without sidebar)', 'porto' ) => 7,
                '1/8' . __( ' of content width (without sidebar)', 'porto' ) => 8
            );
        }

        public static function getProductsAddlinksPos() {
            return array(
                __( 'Default', 'porto' ) => '',
                __( 'Out of Image', 'porto' ) => 'outimage',
                __( 'On Image', 'porto' ) => 'onimage'
            );
        }

        public static function getProductViewMode() {
            return array(
                __( 'Grid', 'porto' )=> 'grid',
                __( 'List', 'porto' ) => 'list',
            );
        }
    }
}