<?php

function porto_shortcode_template( $name = false ) {
    if (!$name)
        return false;

    if ( $overridden_template = locate_template( 'vc_templates' . $name . '.php' ) ) {
        return $overridden_template;
    } else {
        // If neither the child nor parent theme have overridden the template,
        // we load the template from the 'templates' sub-directory of the directory this file is in
        return PORTO_SHORTCODES_TEMPLATES . $name . '.php';
    }
}

function porto_shortcode_woo_template( $name = false ) {
    if (!$name)
        return false;

    if ( $overridden_template = locate_template( 'vc_templates' . $name . '.php' ) ) {
        return $overridden_template;
    } else {
        // If neither the child nor parent theme have overridden the template,
        // we load the template from the 'templates' sub-directory of the directory this file is in
        return PORTO_SHORTCODES_WOO_TEMPLATES . $name . '.php';
    }
}

function porto_shortcode_extract_class( $el_class ) {
    $output = '';
    if ( $el_class != '' ) {
        $output = " " . str_replace( ".", "", $el_class );
    }

    return $output;
}

function porto_shortcode_end_block_comment( $string ) {
    return WP_DEBUG ? '<!-- END ' . $string . ' -->' : '';
}

function porto_shortcode_js_remove_wpautop( $content, $autop = false ) {

    if ( $autop ) {
        $content = wpautop( preg_replace( '/<\/?p\>/', "\n", $content ) . "\n" );
    }

    return do_shortcode( shortcode_unautop( $content ) );
}

function porto_shortcode_image_resize( $attach_id = null, $img_url = null, $width, $height, $crop = false ) {
    // this is an attachment, so we have the ID
    $image_src = array();
    if ( $attach_id ) {
        $image_src = wp_get_attachment_image_src( $attach_id, 'full' );
        $actual_file_path = get_attached_file( $attach_id );
        // this is not an attachment, let's use the image url
    } else if ( $img_url ) {
        $file_path = parse_url( $img_url );
        $actual_file_path = $_SERVER['DOCUMENT_ROOT'] . $file_path['path'];
        $actual_file_path = ltrim( $file_path['path'], '/' );
        $actual_file_path = rtrim( ABSPATH, '/' ) . $file_path['path'];
        $orig_size = getimagesize( $actual_file_path );
        $image_src[0] = $img_url;
        $image_src[1] = $orig_size[0];
        $image_src[2] = $orig_size[1];
    }
    if(!empty($actual_file_path)) {
        $file_info = pathinfo( $actual_file_path );
        $extension = '.' . $file_info['extension'];

        // the image path without the extension
        $no_ext_path = $file_info['dirname'] . '/' . $file_info['filename'];

        $cropped_img_path = $no_ext_path . '-' . $width . 'x' . $height . $extension;

        // checking if the file size is larger than the target size
        // if it is smaller or the same size, stop right here and return
        if ( $image_src[1] > $width || $image_src[2] > $height ) {

            // the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match)
            if ( file_exists( $cropped_img_path ) ) {
                $cropped_img_url = str_replace( basename( $image_src[0] ), basename( $cropped_img_path ), $image_src[0] );
                $vt_image = array(
                    'url' => $cropped_img_url,
                    'width' => $width,
                    'height' => $height
                );

                return $vt_image;
            }

            // $crop = false
            if ( $crop == false ) {
                // calculate the size proportionaly
                $proportional_size = wp_constrain_dimensions( $image_src[1], $image_src[2], $width, $height );
                $resized_img_path = $no_ext_path . '-' . $proportional_size[0] . 'x' . $proportional_size[1] . $extension;

                // checking if the file already exists
                if ( file_exists( $resized_img_path ) ) {
                    $resized_img_url = str_replace( basename( $image_src[0] ), basename( $resized_img_path ), $image_src[0] );

                    $vt_image = array(
                        'url' => $resized_img_url,
                        'width' => $proportional_size[0],
                        'height' => $proportional_size[1]
                    );

                    return $vt_image;
                }
            }

            // no cache files - let's finally resize it
            $img_editor = wp_get_image_editor( $actual_file_path );

            if ( is_wp_error( $img_editor ) || is_wp_error( $img_editor->resize( $width, $height, $crop ) ) ) {
                return array(
                    'url' => '',
                    'width' => '',
                    'height' => ''
                );
            }

            $new_img_path = $img_editor->generate_filename();

            if ( is_wp_error( $img_editor->save( $new_img_path ) ) ) {
                return array(
                    'url' => '',
                    'width' => '',
                    'height' => ''
                );
            }
            if ( ! is_string( $new_img_path ) ) {
                return array(
                    'url' => '',
                    'width' => '',
                    'height' => ''
                );
            }

            $new_img_size = getimagesize( $new_img_path );
            $new_img = str_replace( basename( $image_src[0] ), basename( $new_img_path ), $image_src[0] );

            // resized output
            $vt_image = array(
                'url' => $new_img,
                'width' => $new_img_size[0],
                'height' => $new_img_size[1]
            );

            return $vt_image;
        }

        // default output - without resizing
        $vt_image = array(
            'url' => $image_src[0],
            'width' => $image_src[1],
            'height' => $image_src[2]
        );

        return $vt_image;
    }
    return false;
}

function porto_shortcode_get_image_by_size(
    $params = array(
        'post_id' => null,
        'attach_id' => null,
        'thumb_size' => 'thumbnail',
        'class' => ''
    )
) {
    //array( 'post_id' => $post_id, 'thumb_size' => $grid_thumb_size )
    if ( ( ! isset( $params['attach_id'] ) || $params['attach_id'] == null ) && ( ! isset( $params['post_id'] ) || $params['post_id'] == null ) ) {
        return false;
    }
    $post_id = isset( $params['post_id'] ) ? $params['post_id'] : 0;

    if ( $post_id ) {
        $attach_id = get_post_thumbnail_id( $post_id );
    } else {
        $attach_id = $params['attach_id'];
    }

    $thumb_size = $params['thumb_size'];
    $thumb_class = ( isset( $params['class'] ) && $params['class'] != '' ) ? $params['class'] . ' ' : '';

    global $_wp_additional_image_sizes;
    $thumbnail = '';

    if ( is_string( $thumb_size ) && ( ( ! empty( $_wp_additional_image_sizes[ $thumb_size ] ) && is_array( $_wp_additional_image_sizes[ $thumb_size ] ) ) || in_array( $thumb_size, array(
                'thumbnail',
                'thumb',
                'medium',
                'large',
                'full'
            ) ) )
    ) {
        $thumbnail = wp_get_attachment_image( $attach_id, $thumb_size, false, array( 'class' => $thumb_class . 'attachment-' . $thumb_size ) );
    } elseif ( $attach_id ) {
        if ( is_string( $thumb_size ) ) {
            preg_match_all( '/\d+/', $thumb_size, $thumb_matches );
            if ( isset( $thumb_matches[0] ) ) {
                $thumb_size = array();
                if ( count( $thumb_matches[0] ) > 1 ) {
                    $thumb_size[] = $thumb_matches[0][0]; // width
                    $thumb_size[] = $thumb_matches[0][1]; // height
                } elseif ( count( $thumb_matches[0] ) > 0 && count( $thumb_matches[0] ) < 2 ) {
                    $thumb_size[] = $thumb_matches[0][0]; // width
                    $thumb_size[] = $thumb_matches[0][0]; // height
                } else {
                    $thumb_size = false;
                }
            }
        }
        if ( is_array( $thumb_size ) ) {
            // Resize image to custom size
            $p_img = porto_shortcode_image_resize( $attach_id, null, $thumb_size[0], $thumb_size[1], true );
            $alt = trim( strip_tags( get_post_meta( $attach_id, '_wp_attachment_image_alt', true ) ) );
            $attachment = get_post( $attach_id );
            if(!empty($attachment)) {
                $title = trim( strip_tags( $attachment->post_title ) );

                if ( empty( $alt ) ) {
                    $alt = trim( strip_tags( $attachment->post_excerpt ) ); // If not, Use the Caption
                }
                if ( empty( $alt ) ) {
                    $alt = $title;
                } // Finally, use the title
                if ( $p_img ) {
                    $img_class = '';
                    //if ( $grid_layout == 'thumbnail' ) $img_class = ' no_bottom_margin'; class="'.$img_class.'"
                    $thumbnail = '<img class="' . esc_attr( $thumb_class ) . '" src="' . esc_attr( $p_img['url'] ) . '" width="' . esc_attr( $p_img['width'] ) . '" height="' . esc_attr( $p_img['height'] ) . '" alt="' . esc_attr( $alt ) . '" title="' . esc_attr( $title ) . '" />';
                }
            }
        }
    }

    $p_img_large = wp_get_attachment_image_src( $attach_id, 'large' );

    return apply_filters( 'vc_wpb_getimagesize', array(
        'thumbnail' => $thumbnail,
        'p_img_large' => $p_img_large
    ), $attach_id, $params );
}

function porto_vc_animation_type() {
    return array(
        "type" => "porto_animation_type",
        "heading" => __("Animation Type", 'porto-shortcodes'),
        "param_name" => "animation_type",
        "admin_label" => true
    );
}

function porto_vc_animation_duration() {
    return array(
        "type" => "textfield",
        "heading" => __("Animation Duration", 'porto-shortcodes'),
        "param_name" => "animation_duration",
        "description" => __("numerical value (unit: milliseconds)", 'porto-shortcodes'),
        "value" => '1000'
    );
}

function porto_vc_animation_delay() {
    return array(
        "type" => "textfield",
        "heading" => __("Animation Delay", 'porto-shortcodes'),
        "param_name" => "animation_delay",
        "description" => __("numerical value (unit: milliseconds)", 'porto-shortcodes'),
        "value" => '0'
    );
}

function porto_vc_custom_class() {
    return array(
        'type' => 'textfield',
        'heading' => __( 'Extra class name', 'porto-shortcodes' ),
        'param_name' => 'el_class',
        'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'porto-shortcodes' )
    );
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

function porto_vc_woo_order_by() {
    return array(
        '',
        __( 'Date', 'js_composer' ) => 'date',
        __( 'ID', 'js_composer' ) => 'ID',
        __( 'Author', 'js_composer' ) => 'author',
        __( 'Title', 'js_composer' ) => 'title',
        __( 'Modified', 'js_composer' ) => 'modified',
        __( 'Random', 'js_composer' ) => 'rand',
        __( 'Comment count', 'js_composer' ) => 'comment_count',
        __( 'Menu order', 'js_composer' ) => 'menu_order',
    );
}

function porto_vc_woo_order_way() {
    return array(
        '',
        __( 'Descending', 'js_composer' ) => 'DESC',
        __( 'Ascending', 'js_composer' ) => 'ASC',
    );
}

if (!class_exists('Porto_VcSharedLibrary')) {
    class Porto_VcSharedLibrary {

        public static function getTextAlign() {
            return array(
                __('None', 'porto-shortcodes') => '',
                __('Left', 'porto-shortcodes' ) => 'left',
                __('Right', 'porto-shortcodes' ) => 'right',
                __('Center', 'porto-shortcodes' ) => 'center',
                __('Justify', 'porto-shortcodes' ) => 'justify'
            );
        }

        public static function getTabPositions() {
            return array(
                __('Top left', 'porto-shortcodes' ) => '',
                __('Top right', 'porto-shortcodes' ) => 'top-right',
                __('Bottom left', 'porto-shortcodes' ) => 'bottom-left',
                __('Bottom right', 'porto-shortcodes' ) => 'bottom-right',
                __('Top justify', 'porto-shortcodes' ) => 'top-justify',
                __('Bottom justify', 'porto-shortcodes' ) => 'bottom-justify',
            );
        }

        public static function getTourPositions() {
            return array(
                __('Left', 'porto-shortcodes' ) => 'vertical-left',
                __('Right', 'porto-shortcodes' ) => 'vertical-right',
            );
        }

        public static function getSeparator() {
            return array(
                __('Normal', 'porto-shortcodes' ) => '',
                __('Short', 'porto-shortcodes' ) => 'short',
                __('Tall', 'porto-shortcodes' ) => 'tall',
                __('Taller', 'porto-shortcodes' ) => 'taller',
            );
        }

        public static function getAccordionType() {
            return array(
                __('Default', 'porto-shortcodes' ) => 'panel-default',
                __('Secondary', 'porto-shortcodes' ) => 'secondary',
            );
        }

        public static function getBlogLayout() {
            return array(
                __('Full', 'porto-shortcodes' ) => 'full',
                __('Large', 'porto-shortcodes' ) => 'large',
                __('Large Alt', 'porto-shortcodes' ) => 'large-alt',
                __('Medium', 'porto-shortcodes' ) => 'medium',
                __('Grid', 'porto-shortcodes' ) => 'grid',
                __('Timeline', 'porto-shortcodes' ) => 'timeline'
            );
        }

        public static function getBlogGridColumns() {
            return array(
                __('2', 'porto-shortcodes' ) => '2',
                __('3', 'porto-shortcodes' ) => '3',
                __('4', 'porto-shortcodes' ) => '4'
            );
        }

        public static function getPortfolioLayout() {
            return array(
                __('Grid', 'porto-shortcodes' ) => 'grid',
                __('Timeline', 'porto-shortcodes' ) => 'timeline',
                __('Medium', 'porto-shortcodes' ) => 'medium',
                __('Large', 'porto-shortcodes' ) => 'large',
                __('Full', 'porto-shortcodes' ) => 'full'
            );
        }

        public static function getPortfolioGridColumns() {
            return array(
                __('2', 'porto-shortcodes' ) => '2',
                __('3', 'porto-shortcodes' ) => '3',
                __('4', 'porto-shortcodes' ) => '4',
                __('5', 'porto-shortcodes' ) => '5',
                __('6', 'porto-shortcodes' ) => '6'
            );
        }

        public static function getPortfolioGridView() {
            return array(
                __('Classic', 'porto-shortcodes' ) => '',
                __('Full', 'porto-shortcodes' ) => 'full'
            );
        }

        public static function getProductsViewMode() {
            return array(
                __( 'Grid', 'porto-shortcodes' )=> 'grid',
                __( 'List', 'porto-shortcodes' ) => 'list',
                __( 'Slider', 'porto-shortcodes' )  => 'products-slider',
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
                '7 ' . __( '(without sidebar)', 'porto-shortcodes' ) => 7,
                '8 ' . __( '(without sidebar)', 'porto-shortcodes' ) => 8
            );
        }

        public static function getProductsColumnWidth() {
            return array(
                __( 'Default', 'porto-shortcodes' ) => '',
                '1/1' . __( ' of content width', 'porto-shortcodes' ) => 1,
                '1/2' . __( ' of content width', 'porto-shortcodes' ) => 2,
                '1/3' . __( ' of content width', 'porto-shortcodes' ) => 3,
                '1/4' . __( ' of content width', 'porto-shortcodes' ) => 4,
                '1/5' . __( ' of content width', 'porto-shortcodes' ) => 5,
                '1/6' . __( ' of content width', 'porto-shortcodes' ) => 6,
                '1/7' . __( ' of content width (without sidebar)', 'porto-shortcodes' ) => 7,
                '1/8' . __( ' of content width (without sidebar)', 'porto-shortcodes' ) => 8
            );
        }

        public static function getProductsAddlinksPos() {
            return array(
                __( 'Default', 'porto-shortcodes' ) => '',
                __( 'Out of Image', 'porto-shortcodes' ) => 'outimage',
                __( 'On Image', 'porto-shortcodes' ) => 'onimage'
            );
        }

        public static function getProductViewMode() {
            return array(
                __( 'Grid', 'porto-shortcodes' )=> 'grid',
                __( 'List', 'porto-shortcodes' ) => 'list',
            );
        }
    }
}

function porto_shortcode_widget_title( $params = array( 'title' => '' ) ) {
    if ( $params['title'] == '' ) {
        return '';
    }

    $extraclass = ( isset( $params['extraclass'] ) ) ? " " . $params['extraclass'] : "";
    $output = '<h2 class="wpb_heading' . $extraclass . '">' . $params['title'] . '</h2>';

    return apply_filters( 'wpb_widget_title', $output, $params );
}

if (function_exists('vc_add_shortcode_param'))
    vc_add_shortcode_param('porto_animation_type', 'porto_vc_animation_type_field');

function porto_vc_animation_type_field($settings, $value) {
    $param_line = '<select name="' . $settings['param_name'] . '" class="wpb_vc_param_value dropdown wpb-input wpb-select ' . $settings['param_name'] . ' ' . $settings['type'] . '">';

    $param_line .= '<option value="">none</option>';

    $param_line .= '<optgroup label="' . __('Attention Seekers', 'porto-shortcodes') . '">';
    $options = array("bounce", "flash", "pulse", "rubberBand", "shake", "swing", "tada", "wobble");
    foreach ( $options as $option ) {
        $selected = '';
        if ( $option == $value ) $selected = ' selected="selected"';
        $param_line .= '<option value="' . $option . '"' . $selected . '>' . $option . '</option>';
    }
    $param_line .= '</optgroup>';

    $param_line .= '<optgroup label="' . __('Bouncing Entrances', 'porto-shortcodes') . '">';
    $options = array("bounceIn", "bounceInDown", "bounceInLeft", "bounceInRight", "bounceInUp");
    foreach ( $options as $option ) {
        $selected = '';
        if ( $option == $value ) $selected = ' selected="selected"';
        $param_line .= '<option value="' . $option . '"' . $selected . '>' . $option . '</option>';
    }
    $param_line .= '</optgroup>';

    $param_line .= '<optgroup label="' . __('Fading Entrances', 'porto-shortcodes') . '">';
    $options = array("fadeIn", "fadeInDown", "fadeInDownBig", "fadeInLeft", "fadeInLeftBig", "fadeInRight", "fadeInRightBig", "fadeInUp", "fadeInUpBig");
    foreach ( $options as $option ) {
        $selected = '';
        if ( $option == $value ) $selected = ' selected="selected"';
        $param_line .= '<option value="' . $option . '"' . $selected . '>' . $option . '</option>';
    }
    $param_line .= '</optgroup>';

    $param_line .= '<optgroup label="' . __('Flippers', 'porto-shortcodes') . '">';
    $options = array("flip", "flipInX", "flipInY");//, "flipOutX", "flipOutY");
    foreach ( $options as $option ) {
        $selected = '';
        if ( $option == $value ) $selected = ' selected="selected"';
        $param_line .= '<option value="' . $option . '"' . $selected . '>' . $option . '</option>';
    }
    $param_line .= '</optgroup>';

    $param_line .= '<optgroup label="' . __('Lightspeed', 'porto-shortcodes') . '">';
    $options = array("lightSpeedIn");//, "lightSpeedOut");
    foreach ( $options as $option ) {
        $selected = '';
        if ( $option == $value ) $selected = ' selected="selected"';
        $param_line .= '<option value="' . $option . '"' . $selected . '>' . $option . '</option>';
    }
    $param_line .= '</optgroup>';

    $param_line .= '<optgroup label="' . __('Rotating Entrances', 'porto-shortcodes') . '">';
    $options = array("rotateIn", "rotateInDownLeft", "rotateInDownRight", "rotateInUpLeft", "rotateInUpRight");
    foreach ( $options as $option ) {
        $selected = '';
        if ( $option == $value ) $selected = ' selected="selected"';
        $param_line .= '<option value="' . $option . '"' . $selected . '>' . $option . '</option>';
    }
    $param_line .= '</optgroup>';

    $param_line .= '<optgroup label="' . __('Sliders', 'porto-shortcodes') . '">';
    $options = array("slideInDown", "slideInLeft", "slideInRight");//, "slideOutLeft", "slideOutRight", "slideOutUp");
    foreach ( $options as $option ) {
        $selected = '';
        if ( $option == $value ) $selected = ' selected="selected"';
        $param_line .= '<option value="' . $option . '"' . $selected . '>' . $option . '</option>';
    }
    $param_line .= '</optgroup>';

    $param_line .= '<optgroup label="' . __('Specials', 'porto-shortcodes') . '">';
    $options = array("hinge", "rollIn");//, "rollOut");
    foreach ( $options as $option ) {
        $selected = '';
        if ( $option == $value ) $selected = ' selected="selected"';
        $param_line .= '<option value="' . $option . '"' . $selected . '>' . $option . '</option>';
    }
    $param_line .= '</optgroup>';

    $param_line .= '</select>';

    return $param_line;
}
