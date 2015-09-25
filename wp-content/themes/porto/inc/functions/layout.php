<?php

add_action('wp_head', 'porto_output_skin_options');

function porto_output_skin_options() {
    // Skin
    $body_bg_color = porto_get_meta_value('body_bg_color');
    $body_bg_image = porto_get_meta_value('body_bg_image');
    $body_bg_repeat = porto_get_meta_value('body_bg_repeat');
    $body_bg_size = porto_get_meta_value('body_bg_size');
    $body_bg_attachment = porto_get_meta_value('body_bg_attachment');
    $body_bg_position = porto_get_meta_value('body_bg_position');

    $page_bg_color = porto_get_meta_value('page_bg_color');
    $page_bg_image = porto_get_meta_value('page_bg_image');
    $page_bg_repeat = porto_get_meta_value('page_bg_repeat');
    $page_bg_size = porto_get_meta_value('page_bg_size');
    $page_bg_attachment = porto_get_meta_value('page_bg_attachment');
    $page_bg_position = porto_get_meta_value('page_bg_position');

    $header_bg_color = porto_get_meta_value('header_bg_color');
    $header_bg_image = porto_get_meta_value('header_bg_image');
    $header_bg_repeat = porto_get_meta_value('header_bg_repeat');
    $header_bg_size = porto_get_meta_value('header_bg_size');
    $header_bg_attachment = porto_get_meta_value('header_bg_attachment');
    $header_bg_position = porto_get_meta_value('header_bg_position');

    $sticky_header_bg_color = porto_get_meta_value('sticky_header_bg_color');
    $sticky_header_bg_image = porto_get_meta_value('sticky_header_bg_image');
    $sticky_header_bg_repeat = porto_get_meta_value('sticky_header_bg_repeat');
    $sticky_header_bg_size = porto_get_meta_value('sticky_header_bg_size');
    $sticky_header_bg_attachment = porto_get_meta_value('sticky_header_bg_attachment');
    $sticky_header_bg_position = porto_get_meta_value('sticky_header_bg_position');

    $footer_bg_color = porto_get_meta_value('footer_bg_color');
    $footer_bg_image = porto_get_meta_value('footer_bg_image');
    $footer_bg_repeat = porto_get_meta_value('footer_bg_repeat');
    $footer_bg_size = porto_get_meta_value('footer_bg_size');
    $footer_bg_attachment = porto_get_meta_value('footer_bg_attachment');
    $footer_bg_position = porto_get_meta_value('footer_bg_position');

    $footer_bottom_bg_color = porto_get_meta_value('footer_bottom_bg_color');
    $footer_bottom_bg_image = porto_get_meta_value('footer_bottom_bg_image');
    $footer_bottom_bg_repeat = porto_get_meta_value('footer_bottom_bg_repeat');
    $footer_bottom_bg_size = porto_get_meta_value('footer_bottom_bg_size');
    $footer_bottom_bg_attachment = porto_get_meta_value('footer_bottom_bg_attachment');
    $footer_bottom_bg_position = porto_get_meta_value('footer_bottom_bg_position');

    $breadcrumbs_bg_color = porto_get_meta_value('breadcrumbs_bg_color');
    $breadcrumbs_bg_image = porto_get_meta_value('breadcrumbs_bg_image');
    $breadcrumbs_bg_repeat = porto_get_meta_value('breadcrumbs_bg_repeat');
    $breadcrumbs_bg_size = porto_get_meta_value('breadcrumbs_bg_size');
    $breadcrumbs_bg_attachment = porto_get_meta_value('breadcrumbs_bg_attachment');
    $breadcrumbs_bg_position = porto_get_meta_value('breadcrumbs_bg_position');

    if ($body_bg_color || $body_bg_image || $body_bg_repeat || $body_bg_size || $body_bg_attachment || $body_bg_position
        || $page_bg_color || $page_bg_image || $page_bg_repeat || $page_bg_size || $page_bg_attachment || $page_bg_position
        || $header_bg_color || $header_bg_image || $header_bg_repeat || $header_bg_size || $header_bg_attachment || $header_bg_position
        || $sticky_header_bg_color || $sticky_header_bg_image || $sticky_header_bg_repeat || $sticky_header_bg_size || $sticky_header_bg_attachment || $sticky_header_bg_position
        || $footer_bg_color || $footer_bg_image || $footer_bg_repeat || $footer_bg_size || $footer_bg_attachment || $footer_bg_position
        || $footer_bottom_bg_color || $footer_bottom_bg_image || $footer_bottom_bg_repeat || $footer_bottom_bg_size || $footer_bottom_bg_attachment || $footer_bottom_bg_position
        || $breadcrumbs_bg_color || $breadcrumbs_bg_image || $breadcrumbs_bg_repeat || $breadcrumbs_bg_size || $breadcrumbs_bg_attachment || $breadcrumbs_bg_position) : ?>

        <style type="text/css">
            <?php if ($body_bg_color || $body_bg_image || $body_bg_repeat || $body_bg_size || $body_bg_attachment || $body_bg_position) : ?>
            body {
                <?php if ($body_bg_color) : ?>background-color: <?php echo $body_bg_color ?>;<?php endif; ?>
                <?php if ($body_bg_image == 'none') : echo 'background-image: none'; else : if ($body_bg_image) : ?>background-image: url('<?php echo esc_url(str_replace(array('http://', 'https://'), array('//', '//'), $body_bg_image)) ?>');<?php endif; endif; ?>
                <?php if ($body_bg_repeat) : ?>background-repeat: <?php echo $body_bg_repeat ?>;<?php endif; ?>
                <?php if ($body_bg_size) : ?>background-size: <?php echo $body_bg_size ?>;<?php endif; ?>
                <?php if ($body_bg_attachment) : ?>background-attachment: <?php echo $body_bg_attachment ?>;<?php endif; ?>
                <?php if ($body_bg_position) : ?>background-position: <?php echo $body_bg_position ?>;<?php endif; ?>
            }
            <?php endif; ?>
            <?php if ($page_bg_color || $page_bg_image || $page_bg_repeat || $page_bg_size || $page_bg_attachment || $page_bg_position) : ?>
            #main.wide,
            #main.column2-wide-left-sidebar,
            #main.column2-wide-right-sidebar,
            #main > .container {
                <?php if ($page_bg_color) : ?>background-color: <?php echo $page_bg_color ?>;<?php endif; ?>
                <?php if ($page_bg_image == 'none') : echo 'background-image: none'; else : if ($page_bg_image) : ?>background-image: url('<?php echo esc_url(str_replace(array('http://', 'https://'), array('//', '//'), $page_bg_image)) ?>');<?php endif; endif; ?>
                <?php if ($page_bg_repeat) : ?>background-repeat: <?php echo $page_bg_repeat ?>;<?php endif; ?>
                <?php if ($page_bg_size) : ?>background-size: <?php echo $page_bg_size ?>;<?php endif; ?>
                <?php if ($page_bg_attachment) : ?>background-attachment: <?php echo $page_bg_attachment ?>;<?php endif; ?>
                <?php if ($page_bg_position) : ?>background-position: <?php echo $page_bg_position ?>;<?php endif; ?>
            }
            <?php if ($page_bg_color == 'transparent') : ?>
            .main-content {
                padding-bottom: 0;
            }
            .left-sidebar,
            .right-sidebar,
            .wide-left-sidebar,
            .wide-right-sidebar {
                padding-top: 0;
                padding-bottom: 0;
                margin: 0;
            }
            <?php endif; ?>
            <?php endif; ?>
            <?php if ($header_bg_color || $header_bg_image || $header_bg_repeat || $header_bg_size || $header_bg_attachment || $header_bg_position) : ?>
            #header,
            .fixed-header #header {
                <?php if ($header_bg_color) : ?>background-color: <?php echo $header_bg_color ?>;<?php endif; ?>
                <?php if ($header_bg_image == 'none') : echo 'background-image: none'; else : if ($header_bg_image) : ?>background-image: url('<?php echo esc_url(str_replace(array('http://', 'https://'), array('//', '//'), $header_bg_image)) ?>');<?php endif; endif; ?>
                <?php if ($header_bg_repeat) : ?>background-repeat: <?php echo $header_bg_repeat ?>;<?php endif; ?>
                <?php if ($header_bg_size) : ?>background-size: <?php echo $header_bg_size ?>;<?php endif; ?>
                <?php if ($header_bg_attachment) : ?>background-attachment: <?php echo $header_bg_attachment ?>;<?php endif; ?>
                <?php if ($header_bg_position) : ?>background-position: <?php echo $header_bg_position ?>;<?php endif; ?>
            }
            <?php endif; ?>
            <?php if ($sticky_header_bg_color || $sticky_header_bg_image || $sticky_header_bg_repeat || $sticky_header_bg_size || $sticky_header_bg_attachment || $sticky_header_bg_position) : ?>
            #header.sticky-header,
            .fixed-header #header.sticky-header {
                <?php if ($sticky_header_bg_color) : ?>background-color: <?php echo $sticky_header_bg_color ?>;<?php endif; ?>
                <?php if ($sticky_header_bg_image == 'none') : echo 'background-image: none'; else : if ($sticky_header_bg_image) : ?>background-image: url('<?php echo esc_url(str_replace(array('http://', 'https://'), array('//', '//'), $sticky_header_bg_image)) ?>');<?php endif; endif; ?>
                <?php if ($sticky_header_bg_repeat) : ?>background-repeat: <?php echo $sticky_header_bg_repeat ?>;<?php endif; ?>
                <?php if ($sticky_header_bg_size) : ?>background-size: <?php echo $sticky_header_bg_size ?>;<?php endif; ?>
                <?php if ($sticky_header_bg_attachment) : ?>background-attachment: <?php echo $sticky_header_bg_attachment ?>;<?php endif; ?>
                <?php if ($sticky_header_bg_position) : ?>background-position: <?php echo $sticky_header_bg_position ?>;<?php endif; ?>
            }
            <?php endif; ?>
            <?php if ($footer_bg_color || $footer_bg_image || $footer_bg_repeat || $footer_bg_size || $footer_bg_attachment || $footer_bg_position) : ?>
            #footer,
            .footer-wrapper.fixed #footer {
                <?php if ($footer_bg_color) : ?>background-color: <?php echo $footer_bg_color ?>;<?php endif; ?>
                <?php if ($footer_bg_image == 'none') : echo 'background-image: none'; else : if ($footer_bg_image) : ?>background-image: url('<?php echo esc_url(str_replace(array('http://', 'https://'), array('//', '//'), $footer_bg_image)) ?>');<?php endif; endif; ?>
                <?php if ($footer_bg_repeat) : ?>background-repeat: <?php echo $footer_bg_repeat ?>;<?php endif; ?>
                <?php if ($footer_bg_size) : ?>background-size: <?php echo $footer_bg_size ?>;<?php endif; ?>
                <?php if ($footer_bg_attachment) : ?>background-attachment: <?php echo $footer_bg_attachment ?>;<?php endif; ?>
                <?php if ($footer_bg_position) : ?>background-position: <?php echo $footer_bg_position ?>;<?php endif; ?>
            }
            <?php endif; ?>
            <?php if ($footer_bottom_bg_color || $footer_bottom_bg_image || $footer_bottom_bg_repeat || $footer_bottom_bg_size || $footer_bottom_bg_attachment || $footer_bottom_bg_position) : ?>
            #footer .footer-bottom,
            .footer-wrapper.fixed #footer .footer-bottom {
                <?php if ($footer_bottom_bg_color) : ?>background-color: <?php echo $footer_bottom_bg_color ?>;<?php endif; ?>
                <?php if ($footer_bottom_bg_image == 'none') : echo 'background-image: none'; else : if ($footer_bottom_bg_image) : ?>background-image: url('<?php echo esc_url(str_replace(array('http://', 'https://'), array('//', '//'), $footer_bottom_bg_image)) ?>');<?php endif; endif; ?>
                <?php if ($footer_bottom_bg_repeat) : ?>background-repeat: <?php echo $footer_bottom_bg_repeat ?>;<?php endif; ?>
                <?php if ($footer_bottom_bg_size) : ?>background-size: <?php echo $footer_bottom_bg_size ?>;<?php endif; ?>
                <?php if ($footer_bottom_bg_attachment) : ?>background-attachment: <?php echo $footer_bottom_bg_attachment ?>;<?php endif; ?>
                <?php if ($footer_bottom_bg_position) : ?>background-position: <?php echo $footer_bottom_bg_position ?>;<?php endif; ?>
            }
            <?php endif; ?>
            <?php if ($breadcrumbs_bg_color || $breadcrumbs_bg_image || $breadcrumbs_bg_repeat || $breadcrumbs_bg_size || $breadcrumbs_bg_attachment || $breadcrumbs_bg_position) : ?>
            .page-top {
                <?php if ($breadcrumbs_bg_color) : ?>background-color: <?php echo $breadcrumbs_bg_color ?>;<?php endif; ?>
                <?php if ($breadcrumbs_bg_image == 'none') : echo 'background-image: none'; else : if ($breadcrumbs_bg_image) : ?>background-image: url('<?php echo esc_url(str_replace(array('http://', 'https://'), array('//', '//'), $breadcrumbs_bg_image)) ?>');<?php endif; endif; ?>
                <?php if ($breadcrumbs_bg_repeat) : ?>background-repeat: <?php echo $breadcrumbs_bg_repeat ?>;<?php endif; ?>
                <?php if ($breadcrumbs_bg_size) : ?>background-size: <?php echo $breadcrumbs_bg_size ?>;<?php endif; ?>
                <?php if ($breadcrumbs_bg_attachment) : ?>background-attachment: <?php echo $breadcrumbs_bg_attachment ?>;<?php endif; ?>
                <?php if ($breadcrumbs_bg_position) : ?>background-position: <?php echo $breadcrumbs_bg_position ?>;<?php endif; ?>
            }
            <?php endif; ?>
        </style>

    <?php endif;
}

function porto_banner($banner_class = '') {
    global $porto_settings;

    $banner_type = porto_get_meta_value('banner_type');
    $master_slider = porto_get_meta_value('master_slider');
    $rev_slider = porto_get_meta_value('rev_slider');
    $banner_block = porto_get_meta_value('banner_block');

    $banner_class .= $porto_settings['banner-wrapper'] == 'boxed' ? ' container' : '';

    if ($banner_type === 'master_slider' && isset($master_slider)) { ?>

        <div class="banner-container">
            <div id="banner-wrapper" class="<?php echo $banner_class ?>">
                <?php echo do_shortcode('[masterslider id="'.$master_slider.'"]'); ?>
            </div>
        </div>

    <?php } else if ($banner_type === 'rev_slider' && isset($rev_slider)) { ?>

        <div class="banner-container">
            <div id="banner-wrapper" class="<?php echo $banner_class ?>">
                <?php echo do_shortcode('[rev_slider '.$rev_slider.']'); ?>
            </div>
        </div>

    <?php } else if ($banner_type === 'banner_block' && isset($banner_block)) { ?>

        <div class="banner-container">
            <div id="banner-wrapper" class="<?php echo $banner_class ?>">
                <?php echo do_shortcode('[porto_block name="'.$banner_block.'"]'); ?>
            </div>
        </div>

    <?php
    }
}

function porto_breadcrumbs() {
    global $post, $wp_query, $author, $porto_settings;

    $delimiter = '<i class="delimiter"></i>';
    $prepend = '';
    $before = '<li>';
    $after = '</li>';
    $home = __('Home', 'porto');

    $shop_page_id = false;
    $shop_page = false;
    $front_page_shop = false;
    if ( defined( 'WOOCOMMERCE_VERSION' ) ) {
        $permalinks   = get_option( 'woocommerce_permalinks' );
        $shop_page_id = wc_get_page_id( 'shop' );
        $shop_page    = get_post( $shop_page_id );
        $front_page_shop = get_option( 'page_on_front' ) == wc_get_page_id( 'shop' );
    }

    // If permalinks contain the shop page in the URI prepend the breadcrumb with shop
    if ( $shop_page_id && $shop_page && strstr( $permalinks['product_base'], '/' . $shop_page->post_name ) && get_option( 'page_on_front' ) != $shop_page_id ) {
        $prepend = $before . '<a href="' . get_permalink( $shop_page ) . '">' . $shop_page->post_title . '</a> ' . $delimiter . $after;
    }

    if ( ( ! is_home() && ! is_front_page() && ! ( is_post_type_archive() && $front_page_shop ) ) || is_paged() ) {
        echo '<ul class="breadcrumb">';

        if ( ! empty( $home ) ) {
            echo $before . '<a class="home" href="' . apply_filters( 'woocommerce_breadcrumb_home_url', home_url() ) . '">' . $home . '</a>' . $delimiter . $after;
        }

        if ( is_home() ) {

            echo $before . single_post_title('', false) . $after;

        } elseif ( is_post_type_archive('product') && get_option('page_on_front') !== $shop_page_id ) {

            $_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';

            if ( ! $_name ) {
                $product_post_type = get_post_type_object( 'product' );
                $_name = $product_post_type->labels->singular_name;
            }

            if ( is_search() ) {

                echo $before . '<a href="' . get_post_type_archive_link('product') . '">' . $_name . '</a>' . $delimiter . __( 'Search results for &ldquo;', 'porto' ) . get_search_query() . '&rdquo;' . $after;

            } elseif ( is_paged() ) {

                echo $before . '<a href="' . get_post_type_archive_link('product') . '">' . $_name . '</a>' . '&nbsp;(' . __( 'Page', 'porto' ) . ' ' . get_query_var( 'paged' ) . ')' . $after;

            } else {

                echo $before . $_name . $after;

            }

        } else if ( is_category() ) {

            if ( get_option( 'show_on_front' ) == 'page' ) {
                echo $before . '<a href="' . get_permalink( get_option('page_for_posts' ) ) . '">' . get_the_title( get_option('page_for_posts', true) ) . '</a>' . $delimiter . $after;
            }

            $cat_obj = $wp_query->get_queried_object();
            if ($cat_obj) {
                $this_category = get_category( $cat_obj->term_id );
                if ( 0 != $this_category->parent ) {
                    $parent_category = get_category( $this_category->parent );
                    if ( ( $parents = get_category_parents( $parent_category, TRUE, $delimiter . $after . $before ) ) && ! is_wp_error( $parents ) ) {
                        echo $before . substr( $parents, 0, strlen($parents) - strlen($delimiter . $after . $before) ) . $delimiter . $after;
                    }
                }
                echo $before . single_cat_title( '', false ) . $after;
            }

        } elseif ( is_tax('product_cat') || is_tax('portfolio_cat') || is_tax('portfolio_skills') || is_tax('member_cat') || is_tax('faq_cat') ) {

            echo $prepend;

            if ( is_tax('portfolio_cat') || is_tax('portfolio_skills') ) {
                $post_type = get_post_type_object( 'portfolio' );
                echo $before . '<a href="' . get_post_type_archive_link( 'portfolio' ) . '">' . $post_type->labels->singular_name . '</a>' . $delimiter . $after;
            }

            if ( is_tax('member_cat') ) {
                $post_type = get_post_type_object( 'member' );
                echo $before . '<a href="' . get_post_type_archive_link( 'member' ) . '">' . $post_type->labels->singular_name . '</a>' . $delimiter . $after;
            }

            if ( is_tax('faq_cat') ) {
                $post_type = get_post_type_object( 'faq' );
                echo $before . '<a href="' . get_post_type_archive_link( 'faq' ) . '">' . $post_type->labels->singular_name . '</a>' . $delimiter . $after;
            }

            $current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

            $ancestors = array_reverse( get_ancestors( $current_term->term_id, get_query_var( 'taxonomy' ) ) );

            foreach ( $ancestors as $ancestor ) {
                $ancestor = get_term( $ancestor, get_query_var( 'taxonomy' ) );

                echo $before . '<a href="' . get_term_link( $ancestor->slug, get_query_var( 'taxonomy' ) ) . '">' . esc_html( $ancestor->name ) . '</a>' . $delimiter . $after;
            }

            echo $before . esc_html( $current_term->name ) . $after;

        } elseif ( is_tax('product_tag') ) {

            $queried_object = $wp_query->get_queried_object();
            if ($queried_object) echo $prepend . $before . ' ' . __( 'Products tagged &ldquo;', 'porto' ) . $queried_object->name . '&rdquo;' . $after;

        } elseif ( is_day() ) {

            echo $before . '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $delimiter . $after;
            echo $before . '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a>' . $delimiter . $after;
            echo $before . get_the_time('d') . $after;

        } elseif ( is_month() ) {

            echo $before . '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $delimiter . $after;
            echo $before . get_the_time('F') . $after;

        } elseif ( is_year() ) {

            echo $before . get_the_time('Y') . $after;

        } elseif ( is_single() && ! is_attachment() ) {

            if ( 'product' == get_post_type() ) {

                echo $prepend;

                if ( $terms = wc_get_product_terms( $post->ID, 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
                    $main_term = $terms[0];
                    $ancestors = get_ancestors( $main_term->term_id, 'product_cat' );
                    $ancestors = array_reverse( $ancestors );

                    foreach ( $ancestors as $ancestor ) {
                        $ancestor = get_term( $ancestor, 'product_cat' );

                        if ( ! is_wp_error( $ancestor ) && $ancestor ) {
                            echo $before . '<a href="' . get_term_link( $ancestor ) . '">' . $ancestor->name . '</a>' . $delimiter . $after;
                        }
                    }

                    echo $before . '<a href="' . get_term_link( $main_term ) . '">' . $main_term->name . '</a>' . $delimiter . $after;

                }

                echo $before . get_the_title() . $after;

            } elseif ( 'post' != get_post_type() ) {
                $post_type = get_post_type_object( get_post_type() );
                $slug = $post_type->rewrite;
                echo $before . '<a href="' . get_post_type_archive_link( get_post_type() ) . '">' . $post_type->labels->singular_name . '</a>' . $delimiter . $after;
                echo $before . get_the_title() . $after;

            } else {

                if ( 'post' == get_post_type() && get_option( 'show_on_front' ) == 'page' ) {
                    echo $before . '<a href="' . get_permalink( get_option('page_for_posts' ) ) . '">' . get_the_title( get_option('page_for_posts', true) ) . '</a>' . $delimiter . $after;
                }

                $cat = current( get_the_category() );
                if ( ( $parents = get_category_parents( $cat, TRUE, $delimiter . $after . $before ) ) && ! is_wp_error( $parents ) ) {
                    echo $before . substr( $parents, 0, strlen($parents) - strlen($delimiter . $after . $before) ) . $delimiter . $after;
                }
                echo $before . get_the_title() . $after;

            }

        } elseif ( is_404() ) {

            echo $before . __( 'Error 404', 'porto' ) . $after;

        } elseif ( is_attachment() ) {

            $parent = get_post( $post->post_parent );
            $cat = get_the_category( $parent->ID );
            $cat = $cat[0];
            if ( ( $parents = get_category_parents( $cat, TRUE, $delimiter . $after . $before ) ) && ! is_wp_error( $parents ) ) {
                echo $before . substr( $parents, 0, strlen($parents) - strlen($delimiter . $after . $before) ) . $delimiter . $after;
            }
            echo $before . '<a href="' . get_permalink( $parent ) . '">' . $parent->post_title . '</a>' . $delimiter . $after;
            echo $before . get_the_title() . $after;

        } elseif ( is_page() && !$post->post_parent ) {

            echo $before . get_the_title() . $after;

        } elseif ( is_page() && $post->post_parent ) {

            $parent_id  = $post->post_parent;
            $breadcrumbs = array();

            while ( $parent_id ) {
                $page = get_post( $parent_id );
                $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title( $page->ID ) . '</a>';
                $parent_id  = $page->post_parent;
            }

            $breadcrumbs = array_reverse( $breadcrumbs );

            foreach ( $breadcrumbs as $crumb ) {
                echo $before . $crumb . $delimiter . $after;
            }

            echo $before . get_the_title() . $after;

        } elseif ( is_search() ) {

            echo $before . __( 'Search results for &ldquo;', 'porto' ) . get_search_query() . '&rdquo;' . $after;

        } elseif ( is_tag() ) {

            if ( 'post' == get_post_type() && get_option( 'show_on_front' ) == 'page' ) {
                echo $before . '<a href="' . get_permalink( get_option('page_for_posts' ) ) . '">' . get_the_title( get_option('page_for_posts', true) ) . '</a>' . $delimiter . $after;
            }

            echo $before . __( 'Posts tagged &ldquo;', 'porto' ) . single_tag_title('', false) . '&rdquo;' . $after;

        } elseif ( is_author() ) {

            $userdata = get_userdata($author);
            echo $before . __( 'Author:', 'porto' ) . ' ' . $userdata->display_name . $after;

        } elseif ( ! is_single() && ! is_page() && get_post_type() != 'post' ) {

            $post_type = get_post_type_object( get_post_type() );

            if ( $post_type ) {
                echo $before . $post_type->labels->singular_name . $after;
            }

        }

        if ( get_query_var( 'paged' ) ) {
            echo $before . '&nbsp;(' . __( 'Page', 'porto' ) . ' ' . get_query_var( 'paged' ) . ')' . $after;
        }

        echo '</ul>';
    } else {
        if ( is_home() && !is_front_page() ) {
            echo '<ul class="breadcrumb">';

            if ( ! empty( $home ) ) {
                echo $before . '<a class="home" href="' . apply_filters( 'woocommerce_breadcrumb_home_url', home_url() ) . '">' . $home . '</a>' . $delimiter . $after;

                echo $before . force_balance_tags($porto_settings['blog-title']) . $after;
            }

            echo '</ul>';
        }
    }
}

function porto_page_title() {

    global $porto_settings, $post, $wp_query, $author;

    $home = __('Home', 'porto');

    $shop_page_id = false;
    $front_page_shop = false;
    if ( defined( 'WOOCOMMERCE_VERSION' ) ) {
        $shop_page_id = wc_get_page_id( 'shop' );
        $front_page_shop = get_option( 'page_on_front' ) == wc_get_page_id( 'shop' );
    }

    if ( ( ! is_home() && ! is_front_page() && ! ( is_post_type_archive() && $front_page_shop ) ) || is_paged() ) {

        if ( is_home() ) {

        } elseif ( is_post_type_archive('product') && get_option('page_on_front') !== $shop_page_id ) {

            $_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';

            if ( ! $_name ) {
                $product_post_type = get_post_type_object( 'product' );
                $_name = $product_post_type->labels->singular_name;
            }

            if ( is_search() ) {
                echo __( 'Search results for &ldquo;', 'porto' ) . get_search_query() . '&rdquo;';
            } elseif ( is_paged() ) {
                echo ' (' . __( 'Page', 'porto' ) . ' ' . get_query_var( 'paged' ) . ')';
            } else {
                echo $_name;
            }

        } else if ( is_category() ) {

            echo single_cat_title( '', false );

        } elseif ( is_tax('product_cat') || is_tax('portfolio_cat') || is_tax('portfolio_skills') || is_tax('member_cat') || is_tax('faq_cat') ) {

            $current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

            echo esc_html( $current_term->name );

        } elseif ( is_tax('product_tag') ) {

            $queried_object = $wp_query->get_queried_object();
            if ($queried_object) echo __( 'Products tagged &ldquo;', 'porto' ) . $queried_object->name . '&rdquo;';

        } elseif ( is_day() ) {

            printf( __( 'Daily Archives: %s', 'porto' ), get_the_date() );

        } elseif ( is_month() ) {

            printf( __( 'Monthly Archives: %s', 'porto' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'porto' ) ) );

        } elseif ( is_year() ) {

            printf( __( 'Yearly Archives: %s', 'porto' ), get_the_date( _x( 'Y', 'yearly archives date format', 'porto' ) ) );

        } elseif ( is_post_type_archive('faq') ) {

            $post_type = get_post_type_object( 'faq' );
            echo $post_type->labels->name;

        } elseif ( is_post_type_archive('member') ) {

            $post_type = get_post_type_object( 'member' );
            echo $post_type->labels->name;

        } elseif ( is_post_type_archive('portfolio') ) {

            $post_type = get_post_type_object( 'portfolio' );
            echo $post_type->labels->name;

        } else if ( is_post_type_archive() ) {
            sprintf( __( 'Archives: %s', 'porto' ), post_type_archive_title( '', false ) );
        } elseif ( is_single() && ! is_attachment() ) {

            if ( 'portfolio' == get_post_type() ) {

                echo __('Single Project', 'porto');

            } else {

                echo get_the_title();

            }

        } elseif ( is_404() ) {

            echo __( 'Error 404', 'porto' );

        } elseif ( is_attachment() ) {

            echo get_the_title();

        } elseif ( is_page() && !$post->post_parent ) {

            echo get_the_title();

        } elseif ( is_page() && $post->post_parent ) {

            echo get_the_title();

        } elseif ( is_search() ) {

            echo __( 'Search results for &ldquo;', 'porto' ) . get_search_query() . '&rdquo;';

        } elseif ( is_tag() ) {

            echo __( 'Posts tagged &ldquo;', 'porto' ) . single_tag_title('', false) . '&rdquo;';

        } elseif ( is_author() ) {

            $userdata = get_userdata($author);
            echo __( 'Author:', 'porto' ) . ' ' . $userdata->display_name;

        } elseif ( ! is_single() && ! is_page() && get_post_type() != 'post' ) {

            $post_type = get_post_type_object( get_post_type() );

            if ( $post_type ) {
                echo $post_type->labels->singular_name;
            }

        }

        if ( get_query_var( 'paged' ) ) {
            echo ' (' . __( 'Page', 'porto' ) . ' ' . get_query_var( 'paged' ) . ')';
        }
    } else {
        if ( is_home() && !is_front_page() ) {
            if ( ! empty( $home ) ) {
                echo force_balance_tags($porto_settings['blog-title']);
            }
        }
    }
}

function porto_currency_switcher() {
    global $porto_settings;

    ob_start();
    if ( !$porto_settings['wcml-switcher'] && has_nav_menu( 'currency_switcher' ) ) :
        wp_nav_menu(array(
            'theme_location' => 'currency_switcher',
            'container' => '',
            'menu_class' => 'currency-switcher mega-menu show-arrow',
            'before' => '',
            'after' => '',
            'depth' => 2,
            'link_before' => '',
            'link_after' => '',
            'fallback_cb' => false,
            'walker' => new porto_top_navwalker
        ));
    endif;

    if ( $porto_settings['wcml-switcher'] && class_exists('WCML_Multi_Currency_Support') ) {
        global $sitepress, $woocommerce_wpml;

        if ( !is_page( get_option( 'woocommerce_myaccount_page_id' ) ) ) {
            $settings = $woocommerce_wpml->get_settings();
            $format = '%symbol% %code%';
            $wc_currencies = get_woocommerce_currencies();
            if (!isset($settings['currencies_order'])) {
                $currencies = $woocommerce_wpml->multi_currency_support->get_currency_codes();
            } else {
                $currencies = $settings['currencies_order'];
            }
            $active_c = '';
            $other_c = '';

            foreach ($currencies as $currency) {
                if ($woocommerce_wpml->settings['currency_options'][$currency]['languages'][$sitepress->get_current_language()] == 1 ) {
                    $selected = $currency == $woocommerce_wpml->multi_currency_support->get_client_currency() ? ' selected="selected"' : '';
                    $currency_format = preg_replace(array('#%name%#', '#%symbol%#', '#%code%#'),

                    array($wc_currencies[$currency], get_woocommerce_currency_symbol($currency), $currency), $format);

                    if ($selected) {
                        $active_c .= $currency_format;
                    } else {
                        $other_c .= '<li rel="' . $currency . '" class="menu-item"><h5>' . $currency_format . '</h5></li>';
                    }
                }
            }
            ?>
            <ul id="menu-currency-switcher" class="currency-switcher mega-menu show-arrow">
                <li class="menu-item<?php if ($other_c) echo ' has-sub' ?> narrow">
                    <h5><?php echo $active_c ?></h5>
                    <?php if ($other_c) : ?>
                        <div class="popup">
                            <div class="inner">
                                <ul class="sub-menu wcml-switcher">
                                    <?php echo $other_c ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>
                </li>
            </ul>
            <?php
        }
    }

    return str_replace('&nbsp;', '', ob_get_clean());
}

function porto_mobile_currency_switcher() {
    global $porto_settings;

    ob_start();
    if ( !$porto_settings['wcml-switcher'] && has_nav_menu( 'currency_switcher' ) ) :
        wp_nav_menu(array(
            'theme_location' => 'currency_switcher',
            'container' => '',
            'menu_class' => 'currency-switcher accordion-menu show-arrow',
            'before' => '',
            'after' => '',
            'depth' => 2,
            'link_before' => '',
            'link_after' => '',
            'fallback_cb' => false,
            'walker' => new porto_accordion_navwalker
        ));
    endif;

    if ( $porto_settings['wcml-switcher'] && class_exists('WCML_Multi_Currency_Support') ) {
        global $sitepress, $woocommerce_wpml;

        if ( !is_page( get_option( 'woocommerce_myaccount_page_id' ) ) ) {
            $settings = $woocommerce_wpml->get_settings();
            $format = '%symbol% %code%';
            $wc_currencies = get_woocommerce_currencies();
            if (!isset($settings['currencies_order'])) {
                $currencies = $woocommerce_wpml->multi_currency_support->get_currency_codes();
            } else {
                $currencies = $settings['currencies_order'];
            }
            $active_c = '';
            $other_c = '';

            foreach ($currencies as $currency) {
                if ($woocommerce_wpml->settings['currency_options'][$currency]['languages'][$sitepress->get_current_language()] == 1 ) {
                    $selected = $currency == $woocommerce_wpml->multi_currency_support->get_client_currency() ? ' selected="selected"' : '';
                    $currency_format = preg_replace(array('#%name%#', '#%symbol%#', '#%code%#'),

                        array($wc_currencies[$currency], get_woocommerce_currency_symbol($currency), $currency), $format);

                    if ($selected) {
                        $active_c .= $currency_format;
                    } else {
                        $other_c .= '<li rel="' . $currency . '" class="menu-item"><h5>' . $currency_format . '</h5></li>';
                    }
                }
            }
            ?>
            <ul id="menu-currency-switcher" class="currency-switcher accordion-menu show-arrow">
                <li class="menu-item<?php if ($other_c) echo ' has-sub' ?> narrow">
                    <h5><?php echo $active_c ?></h5>
                    <?php if ($other_c) : ?>
                        <span class="arrow"></span>
                        <ul class="sub-menu wcml-switcher">
                            <?php echo $other_c ?>
                        </ul>
                    <?php endif; ?>
                </li>
            </ul>
        <?php
        }
    }

    return str_replace('&nbsp;', '', ob_get_clean());
}

function porto_view_switcher() {
    global $porto_settings;

    ob_start();
    if ( !$porto_settings['wpml-switcher'] && has_nav_menu( 'view_switcher' ) ) :
        wp_nav_menu(array(
            'theme_location' => 'view_switcher',
            'container' => '',
            'menu_class' => 'view-switcher mega-menu show-arrow',
            'before' => '',
            'after' => '',
            'depth' => 2,
            'link_before' => '',
            'link_after' => '',
            'fallback_cb' => false,
            'walker' => new porto_top_navwalker
        ));
    endif;

    if ( $porto_settings['wpml-switcher'] && function_exists('icl_get_languages') ) {
        $languages = icl_get_languages('skip_missing=0&orderby=code');
        if (!empty($languages)) {
            $active_lang = '';
            $other_langs = '';
            foreach ($languages as $l) {
                if (!$l['active']) {
                    $other_langs .= '<li class="menu-item"><a href="'.esc_url($l['url']).'">';
                }
                if ($l['country_flag_url']){
                    if ($l['active']) {
                        $active_lang .= '<span class="flag"><img src="'.esc_url($l['country_flag_url']).'" height="12" alt="'.esc_attr($l['language_code']).'" width="18" /></span>';
                    } else {
                        $other_langs .= '<span class="flag"><img src="'.esc_url($l['country_flag_url']).'" height="12" alt="'.esc_attr($l['language_code']).'" width="18" /></span>';
                    }
                }
                if ($l['active']) {
                    $active_lang .= icl_disp_language($l['native_name'], $l['translated_name']);
                } else {
                    $other_langs .= icl_disp_language($l['native_name'], $l['translated_name']);
                }
                if (!$l['active']) {
                    $other_langs .= '</a></li>';
                }
            }
            ?>
            <ul id="menu-view-switcher" class="view-switcher mega-menu show-arrow">
                <li class="menu-item<?php if ($other_langs) echo ' has-sub' ?> narrow">
                    <h5><?php echo $active_lang ?></h5>
                    <?php if ($other_langs) : ?>
                    <div class="popup">
                        <div class="inner">
                            <ul class="sub-menu">
                                <?php echo $other_langs ?>
                            </ul>
                        </div>
                    </div>
                    <?php endif; ?>
                </li>
            </ul>
            <?php
        }
    }

    return str_replace('&nbsp;', '', ob_get_clean());
}

function porto_mobile_view_switcher() {
    global $porto_settings;

    ob_start();
    if ( !$porto_settings['wpml-switcher'] && has_nav_menu( 'view_switcher' ) ) :
        wp_nav_menu(array(
            'theme_location' => 'view_switcher',
            'container' => '',
            'menu_class' => 'view-switcher accordion-menu show-arrow',
            'before' => '',
            'after' => '',
            'depth' => 2,
            'link_before' => '',
            'link_after' => '',
            'fallback_cb' => false,
            'walker' => new porto_accordion_navwalker
        ));
    endif;

    if ( $porto_settings['wpml-switcher'] && function_exists('icl_get_languages') ) {
        $languages = icl_get_languages('skip_missing=0&orderby=code');
        if (!empty($languages)) {
            $active_lang = '';
            $other_langs = '';
            foreach ($languages as $l) {
                if (!$l['active']) {
                    $other_langs .= '<li class="menu-item"><a href="'.esc_url($l['url']).'">';
                }
                if ($l['country_flag_url']){
                    if ($l['active']) {
                        $active_lang .= '<span class="flag"><img src="'.esc_url($l['country_flag_url']).'" height="12" alt="'.esc_attr($l['language_code']).'" width="18" /></span>';
                    } else {
                        $other_langs .= '<span class="flag"><img src="'.esc_url($l['country_flag_url']).'" height="12" alt="'.esc_attr($l['language_code']).'" width="18" /></span>';
                    }
                }
                if ($l['active']) {
                    $active_lang .= icl_disp_language($l['native_name'], $l['translated_name']);
                } else {
                    $other_langs .= icl_disp_language($l['native_name'], $l['translated_name']);
                }
                if (!$l['active']) {
                    $other_langs .= '</a></li>';
                }
            }
            ?>
            <ul id="menu-view-switcher" class="view-switcher accordion-menu show-arrow">
                <li class="menu-item<?php if ($other_langs) echo ' has-sub' ?> narrow">
                    <h5><?php echo $active_lang ?></h5>
                    <?php if ($other_langs) : ?>
                        <span class="arrow"></span>
                        <ul class="sub-menu">
                            <?php echo $other_langs ?>
                        </ul>
                    <?php endif; ?>
                </li>
            </ul>
        <?php
        }
    }

    return str_replace('&nbsp;', '', ob_get_clean());
}

function porto_top_navigation() {
    global $porto_settings;

    $html = '';
    if (isset($porto_settings['menu-login-pos']) && $porto_settings['menu-login-pos'] == 'top_nav') {
        if (is_user_logged_in()) {
            if ( class_exists( 'WooCommerce' ) ) {
                $link = version_compare(porto_get_woo_version_number(), '2.3', '<') ? wp_logout_url( wc_get_page_permalink( 'myaccount' ) ) : wc_get_endpoint_url( 'customer-logout', '', wc_get_page_permalink( 'myaccount' ) );
            } else {
                $link = wp_logout_url( get_home_url() );
            }
            $html .= '<li class="menu-item"><a href="' . $link . '"><i class="avatar">' . get_avatar( get_current_user_id(), $size = '24' ) . '</i>' . __('Logout', 'porto') . '</a></li>';
        } else {
            if ( class_exists( 'WooCommerce' ) ) {
                $link = wc_get_page_permalink( 'myaccount' );
            } else {
                $link = wp_login_url( get_home_url() );
            }
            $html .= '<li class="menu-item"><a href="' . $link . '"><i class="fa fa-user"></i>' . __('Login', 'porto') . '</a></li>';
        }
    }

    ob_start();
    if ( has_nav_menu( 'top_nav' ) ) :
        wp_nav_menu(array(
            'theme_location' => 'top_nav',
            'container' => '',
            'menu_class' => 'top-links mega-menu' . ($porto_settings['menu-arrow']?' show-arrow':''),
            'before' => '',
            'after' => '',
            'depth' => 2,
            'link_before' => '',
            'link_after' => '',
            'fallback_cb' => false,
            'walker' => new porto_top_navwalker
        ));
    endif;

    $output = str_replace('&nbsp;', '', ob_get_clean());

    if ($output && $html) {
        $output = preg_replace('/<\/ul>$/', $html . '</ul>', $output, 1);
    }

    return $output;
}

function porto_mobile_top_navigation() {
    global $porto_settings;

    $html = '';
    if (isset($porto_settings['menu-login-pos']) && $porto_settings['menu-login-pos'] == 'top_nav') {
        if (is_user_logged_in()) {
            if ( class_exists( 'WooCommerce' ) ) {
                $link = version_compare(porto_get_woo_version_number(), '2.3', '<') ? wp_logout_url( wc_get_page_permalink( 'myaccount' ) ) : wc_get_endpoint_url( 'customer-logout', '', wc_get_page_permalink( 'myaccount' ) );
            } else {
                $link = wp_logout_url( get_home_url() );
            }
            $html .= '<li class="menu-item"><a href="' . $link . '"><i class="avatar">' . get_avatar( get_current_user_id(), $size = '24' ) . '</i>' . __('Logout', 'porto') . '</a></li>';
        } else {
            if ( class_exists( 'WooCommerce' ) ) {
                $link = wc_get_page_permalink( 'myaccount' );
            } else {
                $link = wp_login_url( get_home_url() );
            }
            $html .= '<li class="menu-item"><a href="' . $link . '"><i class="fa fa-user"></i>' . __('Login', 'porto') . '</a></li>';
        }
    }

    ob_start();
    if ( has_nav_menu( 'top_nav' ) ) :
        wp_nav_menu(array(
            'theme_location' => 'top_nav',
            'container' => '',
            'menu_class' => 'top-links accordion-menu' . ($porto_settings['menu-arrow']?' show-arrow':''),
            'before' => '',
            'after' => '',
            'depth' => 2,
            'link_before' => '',
            'link_after' => '',
            'fallback_cb' => false,
            'walker' => new porto_accordion_navwalker
        ));
    endif;

    $output = str_replace('&nbsp;', '', ob_get_clean());

    if ($output && $html) {
        $output = preg_replace('/<\/ul>$/', $html . '</ul>', $output, 1);
    }

    return $output;
}

function porto_main_menu() {
    global $porto_settings, $porto_layout;

    $header_type = $porto_settings['header-type'];

    $is_home = false;

    if ( is_front_page() && is_home() ) {
        $is_home = true;
    } elseif ( is_front_page() ) {
        $is_home = true;
    }

    if (($header_type == 1 || $header_type == 4 || $header_type == 13) && ($porto_layout == 'wide-left-sidebar' || $porto_layout == 'wide-right-sidebar' || $porto_layout == 'left-sidebar' || $porto_layout == 'right-sidebar') && $porto_settings['menu-sidebar']) {
        if ($is_home || (!$is_home && !$porto_settings['menu-sidebar-home']))
            return '';
    }

    $html = '';

    if (isset($porto_settings['menu-login-pos']) && $porto_settings['menu-login-pos'] == 'main_menu') {
        if (is_user_logged_in()) {
            if ( class_exists( 'WooCommerce' ) ) {
                $link = version_compare(porto_get_woo_version_number(), '2.3', '<') ? wp_logout_url( wc_get_page_permalink( 'myaccount' ) ) : wc_get_endpoint_url( 'customer-logout', '', wc_get_page_permalink( 'myaccount' ) );
            } else {
                $link = wp_logout_url( get_home_url() );
            }

            if (($header_type == 1 || $header_type == 4 || $header_type == 13)) {
                $html .= '<li class="'. ($porto_settings['menu-align'] == 'centered' ? 'inline-menu-item' : (is_rtl() ? 'pull-left' : 'pull-right')).'"><div class="menu-custom-block"><a href="' . $link . '"><i class="avatar">' . get_avatar( get_current_user_id(), $size = '24' ) . '</i>' . __('Logout', 'porto') . '</a></div></li>';
            } else {
                $html .= '<li class="menu-item"><a href="' . $link . '"><i class="avatar">' . get_avatar( get_current_user_id(), $size = '24' ) . '</i>' . __('Logout', 'porto') . '</a></li>';
            }
        } else {
            if ( class_exists( 'WooCommerce' ) ) {
                $link = wc_get_page_permalink( 'myaccount' );
            } else {
                $link = wp_login_url( get_home_url() );
            }
            if (($header_type == 1 || $header_type == 4 || $header_type == 13)) {
                $html .= '<li class="'. ($porto_settings['menu-align'] == 'centered' ? 'inline-menu-item' : (is_rtl() ? 'pull-left' : 'pull-right')).'"><div class="menu-custom-block"><a href="' . $link . '"><i class="fa fa-user"></i>' . __('Login', 'porto') . '</a></div></li>';
            } else {
                $html .= '<li class="menu-item"><a href="' . $link . '"><i class="fa fa-user"></i>' . __('Login', 'porto') . '</a></li>';
            }
        }
    }

    if ($header_type == 1 || $header_type == 4 || $header_type == 13) {
        if ($porto_settings['menu-block']) {
            $html .= '<li class="'. ($porto_settings['menu-align'] == 'centered' ? 'inline-menu-item' : (is_rtl() ? 'pull-left' : 'pull-right')).'"><div class="menu-custom-block">'.force_balance_tags($porto_settings['menu-block']).'</div></li>';
        }
    }

    ob_start();
    if ( has_nav_menu( 'main_menu' ) ) :
        wp_nav_menu(array(
            'theme_location' => 'main_menu',
            'container' => '',
            'menu_class' => 'main-menu mega-menu' . ($porto_settings['menu-arrow']?' show-arrow':''),
            'before' => '',
            'after' => '',
            'link_before' => '',
            'link_after' => '',
            'fallback_cb' => false,
            'walker' => new porto_top_navwalker
        ));
    endif;

    $output = str_replace('&nbsp;', '', ob_get_clean());

    if ($output && $html) {
        $output = preg_replace('/<\/ul>$/', $html . '</ul>', $output, 1);
    }

    return $output;
}

function porto_main_toggle_menu() {
    global $porto_settings, $porto_layout;

    $header_type = $porto_settings['header-type'];

    if ($header_type != 9)
        return porto_main_menu();

    ob_start();
    if ( has_nav_menu( 'main_menu' ) ) :
        wp_nav_menu(array(
            'theme_location' => 'main_menu',
            'container' => '',
            'menu_class' => 'main-menu sidebar-menu',
            'before' => '',
            'after' => '',
            'link_before' => '',
            'link_after' => '',
            'fallback_cb' => false,
            'walker' => new porto_sidebar_navwalker
        ));
    endif;

    return str_replace('&nbsp;', '', ob_get_clean());
}

function porto_sidebar_menu() {
    global $porto_settings, $porto_layout;

    $header_type = $porto_settings['header-type'];

    $is_home = false;
    if ( is_front_page() && is_home() ) {
        $is_home = true;
    } elseif ( is_front_page() ) {
        $is_home = true;
    }

    $output = '';

    $html = '';
    if (!((($header_type == 1 || $header_type == 4 || $header_type == 13) && ($porto_layout == 'wide-left-sidebar' || $porto_layout == 'wide-right-sidebar' || $porto_layout == 'left-sidebar' || $porto_layout == 'right-sidebar') && $porto_settings['menu-sidebar']) || $header_type == 'side')) {

    } else if (($header_type == 1 || $header_type == 4 || $header_type == 13) && !$is_home && $porto_settings['menu-sidebar-home']) {

    } else {
        if (isset($porto_settings['menu-login-pos']) && $porto_settings['menu-login-pos'] == 'main_menu') {
            if (is_user_logged_in()) {
                if ( class_exists( 'WooCommerce' ) ) {
                    $link = version_compare(porto_get_woo_version_number(), '2.3', '<') ? wp_logout_url( wc_get_page_permalink( 'myaccount' ) ) : wc_get_endpoint_url( 'customer-logout', '', wc_get_page_permalink( 'myaccount' ) );
                } else {
                    $link = wp_logout_url( get_home_url() );
                }
                $html .= '<li class="menu-item"><a href="' . $link . '"><i class="avatar">' . get_avatar( get_current_user_id(), $size = '24' ) . '</i>' . __('Logout', 'porto') . '</a></li>';
            } else {
                if ( class_exists( 'WooCommerce' ) ) {
                    $link = wc_get_page_permalink( 'myaccount' );
                } else {
                    $link = wp_login_url( get_home_url() );
                }
                $html .= '<li class="menu-item"><a href="' . $link . '"><i class="fa fa-user"></i>' . __('Login', 'porto') . '</a></li>';
            }
        }
        if ($porto_settings['menu-block']) {
            $html .= '<li class="menu-custom-item"><div class="menu-custom-block">'.force_balance_tags($porto_settings['menu-block']).'</div></li>';
        }

        ob_start();
        if ( has_nav_menu( 'main_menu' ) ) {
            wp_nav_menu(array(
                'theme_location' => 'main_menu',
                'container' => '',
                'menu_class' => 'main-menu sidebar-menu' . (has_nav_menu( 'sidebar_menu' ) ? ' has-side-menu' : ''),
                'before' => '',
                'after' => '',
                'link_before' => '',
                'link_after' => '',
                'fallback_cb' => false,
                'walker' => new porto_sidebar_navwalker
            ));
        }

        $output .= str_replace('&nbsp;', '', ob_get_clean());

        if ($output && $html) {
            $output = preg_replace('/<\/ul>$/', $html . '</ul>', $output, 1);
        }
    }

    // sidebar menu
    ob_start();
    if ( has_nav_menu( 'sidebar_menu' ) ) {
        wp_nav_menu(array(
            'theme_location' => 'sidebar_menu',
            'container' => '',
            'menu_class' => 'sidebar-menu' . ($output ? ' has-main-menu' : ''),
            'before' => '',
            'after' => '',
            'link_before' => '',
            'link_after' => '',
            'fallback_cb' => false,
            'walker' => new porto_sidebar_navwalker
        ));
    }

    $output .= str_replace('&nbsp;', '', ob_get_clean());

    return $output;
}

function porto_mobile_menu() {
    global $porto_settings;

    $html = '';
    if (isset($porto_settings['menu-login-pos']) && $porto_settings['menu-login-pos'] == 'main_menu') {
        if (is_user_logged_in()) {
            if ( class_exists( 'WooCommerce' ) ) {
                $link = version_compare(porto_get_woo_version_number(), '2.3', '<') ? wp_logout_url( wc_get_page_permalink( 'myaccount' ) ) : wc_get_endpoint_url( 'customer-logout', '', wc_get_page_permalink( 'myaccount' ) );
            } else {
                $link = wp_logout_url( get_home_url() );
            }
            $html .= '<li class="menu-item"><a href="' . $link . '"><i class="avatar">' . get_avatar( get_current_user_id(), $size = '24' ) . '</i>' . __('Logout', 'porto') . '</a></li>';
        } else {
            if ( class_exists( 'WooCommerce' ) ) {
                $link = wc_get_page_permalink( 'myaccount' );
            } else {
                $link = wp_login_url( get_home_url() );
            }
            $html .= '<li class="menu-item"><a href="' . $link . '"><i class="fa fa-user"></i>' . __('Login', 'porto') . '</a></li>';
        }
    }

    ob_start();
    if ( has_nav_menu( 'main_menu' ) ) :
        wp_nav_menu(array(
            'theme_location' => 'main_menu',
            'container' => '',
            'menu_class' => 'mobile-menu accordion-menu',
            'before' => '',
            'after' => '',
            'link_before' => '',
            'link_after' => '',
            'fallback_cb' => false,
            'walker' => new porto_accordion_navwalker
        ));
    endif;

    $output = str_replace('&nbsp;', '', ob_get_clean());

    // sidebar menu
    ob_start();
    if ( has_nav_menu( 'sidebar_menu' ) ) {
        wp_nav_menu(array(
            'theme_location' => 'sidebar_menu',
            'container' => '',
            'menu_class' => 'mobile-menu accordion-menu',
            'before' => '',
            'after' => '',
            'link_before' => '',
            'link_after' => '',
            'fallback_cb' => false,
            'walker' => new porto_accordion_navwalker
        ));
    }

    $output .= str_replace('&nbsp;', '', ob_get_clean());

    if ($output && $html) {
        $output = preg_replace('/<\/ul>$/', $html . '</ul>', $output, 1);
    }

    return $output;
}

function porto_search_form() {
    global $porto_settings;

    if (!$porto_settings['show-searchform']) return '';

    ob_start();
    ?>
    <div class="searchform-popup">
        <a class="search-toggle"><i class="fa fa-search"></i></a>
        <?php echo porto_search_form_content(); ?>
    </div>
    <?php
    return ob_get_clean();
}

function porto_search_form_content() {
    global $porto_settings;

    if (!$porto_settings['show-searchform']) return '';

    ob_start();
    if (isset($porto_settings['search-type']) && $porto_settings['search-type'] === 'product' && defined('YITH_WCAS' )) {
        $wc_get_template = function_exists('wc_get_template') ? 'wc_get_template' : 'woocommerce_get_template';
        $wc_get_template( 'yith-woocommerce-ajax-search.php', array(), '', YITH_WCAS_DIR . 'templates/' );
        return;
    }
    ?>
    <form action="<?php echo home_url(); ?>/" method="get"
        class="searchform <?php if (isset($porto_settings['search-type']) && ($porto_settings['search-type'] === 'post' || $porto_settings['search-type'] === 'product' || $porto_settings['search-type'] === 'portfolio') && (isset($porto_settings['search-cats']) && $porto_settings['search-cats'])) echo 'searchform-cats'; ?>">
        <fieldset>
            <span class="text"><input name="s" id="s" type="text" value="<?php echo get_search_query() ?>" placeholder="<?php echo __('Search&hellip;', 'porto'); ?>" autocomplete="off" /></span>
            <?php if (isset($porto_settings['search-type']) && ($porto_settings['search-type'] === 'post' || $porto_settings['search-type'] === 'product' || $porto_settings['search-type'] === 'portfolio')) : ?>
                <input type="hidden" name="post_type" value="<?php echo $porto_settings['search-type'] ?>"/>
                <?php
                if (isset($porto_settings['search-cats']) && $porto_settings['search-cats']) {
                    $args = array(
                        'show_option_all' => __( 'All Categories', 'porto' ),
                        'hierarchical' => 1,
                        'class' => 'cat',
                        'echo' => 1
                    );
                    if ($porto_settings['search-type'] === 'product' && class_exists('WooCommerce')) {
                        $args['taxonomy'] = 'product_cat';
                        $args['name'] = 'cat';
                    }
                    if ($porto_settings['search-type'] === 'portfolio') {
                        $args['taxonomy'] = 'portfolio_cat';
                        $args['name'] = 'cat';
                    }
                    wp_dropdown_categories($args);
                }
            endif; ?>
            <span class="button-wrap"><button class="btn btn-special" title="<?php echo __('Search', 'porto'); ?>" type="submit"><i class="fa fa-search"></i></button></span>
        </fieldset>
    </form>
    <?php
    return ob_get_clean();
}

function porto_header_socials() {
    global $porto_settings;

    if (!$porto_settings['show-header-socials']) return '';

    ob_start();
    echo '<div class="share-links">';
    if ($porto_settings['header-social-facebook']) :
        ?><a target="_blank" class="share-facebook" href="<?php echo esc_url($porto_settings['header-social-facebook']) ?>" title="<?php _e('Facebook', 'porto') ?>"></a><?php
    endif;

    if ($porto_settings['header-social-twitter']) :
        ?><a target="_blank" class="share-twitter" href="<?php echo esc_url($porto_settings['header-social-twitter']) ?>" title="<?php _e('Twitter', 'porto') ?>"></a><?php
    endif;

    if ($porto_settings['header-social-rss']) :
        ?><a target="_blank" class="share-rss" href="<?php echo esc_url($porto_settings['header-social-rss']) ?>" title="<?php _e('RSS', 'porto') ?>"></a><?php
    endif;

    if ($porto_settings['header-social-pinterest']) :
        ?><a target="_blank" class="share-pinterest" href="<?php echo esc_url($porto_settings['header-social-pinterest']) ?>" title="<?php _e('Pinterest', 'porto') ?>"></a><?php
    endif;

    if ($porto_settings['header-social-youtube']) :
        ?><a target="_blank" class="share-youtube" href="<?php echo esc_url($porto_settings['header-social-youtube']) ?>" title="<?php _e('Youtube', 'porto') ?>"></a><?php
    endif;

    if ($porto_settings['header-social-instagram']) :
        ?><a target="_blank" class="share-instagram" href="<?php echo esc_url($porto_settings['header-social-instagram']) ?>" title="<?php _e('Instagram', 'porto') ?>"></a><?php
    endif;

    if ($porto_settings['header-social-skype']) :
        ?><a target="_blank" class="share-skype" href="<?php echo esc_url($porto_settings['header-social-skype']) ?>" title="<?php _e('Skype', 'porto') ?>"></a><?php
    endif;

    if ($porto_settings['header-social-linkedin']) :
        ?><a target="_blank" class="share-linkedin" href="<?php echo esc_url($porto_settings['header-social-linkedin']) ?>" title="<?php _e('LinkedIn', 'porto') ?>"></a><?php
    endif;

    if ($porto_settings['header-social-googleplus']) :
        ?><a target="_blank" class="share-googleplus" href="<?php echo esc_url($porto_settings['header-social-googleplus']) ?>" title="<?php _e('Google Plus', 'porto') ?>"></a><?php
    endif;
    echo '</div>';

    return ob_get_clean();
}

function porto_minicart() {
    global $woocommerce, $porto_settings;

    if (!$porto_settings['show-minicart']) return '';

    if ($porto_settings['catalog-enable']) {
        if ($porto_settings['catalog-admin'] || (!$porto_settings['catalog-admin'] && !(current_user_can( 'administrator' ) && is_user_logged_in())) ) {
            if (!$porto_settings['catalog-cart']) {
                return '';
            }
        }
    }

    $minicart_type = ($porto_settings['header-type'] == 'side' || $porto_settings['header-type'] >= 10) ? 'minicart-inline' : $porto_settings['minicart-type'];

    ob_start();
    if ( class_exists( 'WooCommerce' ) ) :
        $_cartQty = $woocommerce->cart->cart_contents_count;
        ?>
        <div id="mini-cart" class="dropdown mini-cart <?php echo $minicart_type ?>">
            <div class="dropdown-toggle cart-head" data-toggle="dropdown" data-delay="50" data-close-others="false">
                <i class="minicart-icon"></i>
                <span class="cart-items"><?php echo ($minicart_type == 'minicart-inline')
                        ? '<span class="mobile-hide">' . sprintf( _n( '%d item', '%d items', $_cartQty, 'porto' ), $_cartQty ) . '</span><span class="mobile-show">' . $_cartQty . '</span>'
                        : (($_cartQty > 0) ? $_cartQty : '0'); ?></span>
            </div>
            <div class="dropdown-menu cart-popup widget_shopping_cart">
                <div class="widget_shopping_cart_content">
                    <div class="cart-loading"></div>
                </div>
            </div>
        </div>
    <?php
    endif;

    return ob_get_clean();
}

function porto_blueimp_gallery_html() {
?>
    <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-start-slideshow="true" data-filter=":even">
        <div class="slides"></div>
        <h3 class="title">&nbsp;</h3>
        <a class="prev"></a>
        <a class="next"></a>
        <a class="close"></a>
        <a class="play-pause"></a>
        <ol class="indicator"></ol>
    </div>
<?php
}

add_filter('masterslider_layer_shortcode', 'porto_master_slider_iframe', 10, 4);

function porto_master_slider_iframe($layer, $merged, $atts, $content) {
    return str_replace('<iframe', '<iframe frameborder="0"', $layer);
}
