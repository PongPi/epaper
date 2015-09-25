<?php
/**
 * Single Product tabs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

global $porto_settings;

$review_index = 0;

$rand = porto_generate_rand();

$custom_tab_title1 = get_post_meta(get_the_id(), 'custom_tab_title1', true);
$custom_tab_content1 = get_post_meta(get_the_id(), 'custom_tab_content1', true);
$custom_tab_title2 = get_post_meta(get_the_id(), 'custom_tab_title2', true);
$custom_tab_content2 = get_post_meta(get_the_id(), 'custom_tab_content2', true);
$global_tab_title = $porto_settings['product-tab-title'];
$global_tab_block = $porto_settings['product-tab-block'];

if ( ! empty( $tabs ) || $custom_tab_title1 || $custom_tab_title2 || $global_custom_tab_title ) : ?>

    <div class="woocommerce-tabs woocommerce-tabs-<?php echo $rand ?>" id="product-tab">
        <ul class="resp-tabs-list">
            <?php
            $i = 0;
            foreach ( $tabs as $key => $tab ) :
                ?><li aria-controls="tab-<?php echo $key ?>">
                    <?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?>
                </li><?php
                if ($key == 'reviews') $review_index = $i;
                $i++;
            endforeach;

            if ($custom_tab_title1 && $custom_tab_content1) :
                ?><li aria-controls="tab-custom1">
                    <?php echo force_balance_tags($custom_tab_title1) ?>
                </li><?php
                $i++;
            endif;

            if ($custom_tab_title2 && $custom_tab_content2) :
                ?><li aria-controls="tab-custom2">
                    <?php echo force_balance_tags($custom_tab_title2) ?>
                </li><?php
                $i++;
            endif;

            if ($global_tab_title && $global_tab_block) :
                ?><li aria-controls="tab-custom3">
                    <?php echo force_balance_tags($global_tab_title) ?>
                </li><?php
                $i++;
            endif; ?>

        </ul>
        <div class="resp-tabs-container">
            <?php foreach ( $tabs as $key => $tab ) : ?>

                <div class="tab-content" id="tab-<?php echo $key ?>">
                    <?php call_user_func( $tab['callback'], $key, $tab ) ?>
                </div>

            <?php endforeach; ?>

            <?php if ($custom_tab_title1 && $custom_tab_content1) : ?>
                <div class="tab-content" id="tab-custom1">
                    <?php echo wpautop(do_shortcode($custom_tab_content1)) ?>
                </div>
            <?php endif; ?>

            <?php if ($custom_tab_title2 && $custom_tab_content2) : ?>
                <div class="tab-content" id="tab-custom2">
                    <?php echo wpautop(do_shortcode($custom_tab_content2)) ?>
                </div>
            <?php endif; ?>

            <?php if ($global_tab_title && $global_tab_block) : ?>
                <div class="tab-content" id="tab-custom3">
                    <?php echo wpautop(do_shortcode('[porto_block name="'.$global_tab_block.'"]')) ?>
                </div>
            <?php endif; ?>

        </div>
    </div>

    <script type="text/javascript">
        /* <![CDATA[ */
        jQuery(function($) {
            $('.woocommerce-tabs-<?php echo $rand ?>').easyResponsiveTabs({
                type: '<?php echo esc_js($porto_settings['product-tabs']) ?>', //Types: default, vertical, accordion
                width: 'auto', //auto or any width like 600px
                fit: true,   // 100% fit in a container
                closed: 'accordion', // Start closed if in accordion view
                activate: function(event) { // Callback function if tab is switched

                }
            });

            <?php if (!porto_is_ajax()) : ?>
            // go to reviews, write a review
            $('.woocommerce-review-link, .woocommerce-write-review-link').click(function(e) {
                var recalc_pos = false;
                if ($('#content #tab-reviews').css('display') != 'block') {
                    recalc_pos = true;
                }
                if ($("h2[aria-controls=tab_item-<?php echo esc_js($review_index) ?>]").length && $("h2[aria-controls=tab_item-<?php echo esc_js($review_index) ?>]").next().css('display') == 'none')
                    $("h2[aria-controls=tab_item-<?php echo esc_js($review_index) ?>]").click();
                else if ($("li[aria-controls=tab_item-<?php echo esc_js($review_index) ?>]").length && $("li[aria-controls=tab_item-<?php echo esc_js($review_index) ?>]").next().css('display') == 'none')
                    $("li[aria-controls=tab_item-<?php echo esc_js($review_index) ?>]").click();

                var target = $(this.hash);
                if (target.length) {
                    e.preventDefault();

                    var scroll_to;

                    if ($(window).scrollTop() > theme.StickyHeader.sticky_pos) {
                        scroll_to = target.offset().top - theme.StickyHeader.sticky_height - 40;
                    } else {
                        scroll_to = target.offset().top - theme.StickyHeader.sticky_height - theme.StickyHeader.sticky_offset - 40;
                    }

                    $('html,body').animate({
                        scrollTop: scroll_to
                    }, (recalc_pos ? 800 : 400));

                    if (recalc_pos) {
                        setTimeout(function() {
                            var scroll_to;

                            if ($(window).scrollTop() > theme.StickyHeader.sticky_pos) {
                                scroll_to = target.offset().top - theme.StickyHeader.sticky_height - 40;
                            } else {
                                scroll_to = target.offset().top - theme.StickyHeader.sticky_height - theme.StickyHeader.sticky_offset - 40;
                            }

                            $('html,body').stop().animate({
                                scrollTop: scroll_to
                            }, 400);
                        }, 400);
                    }
                    return false;
                }
            });
            // Open review form lightbox if accessed via anchor
            if ( window.location.hash == '#review_form' || window.location.hash == '#reviews' || window.location.hash.indexOf('#comment-') != -1 ) {
                setTimeout(function() {
                    if ($("h2[aria-controls=tab_item-<?php echo esc_js($review_index) ?>]").next().css('display') == 'none') {
                        $("h2[aria-controls=tab_item-<?php echo esc_js($review_index) ?>]").click();
                        var target = $(window.location.hash);
                        if (target.length) {
                            var scroll_to;
                            setTimeout(function() {
                                var scroll_to;

                                if ($(window).scrollTop() > theme.StickyHeader.sticky_pos) {
                                    scroll_to = target.offset().top - theme.StickyHeader.sticky_height - 40;
                                } else {
                                    scroll_to = target.offset().top - theme.StickyHeader.sticky_height - theme.StickyHeader.sticky_offset - 40;
                                }

                                $('html,body').stop().animate({
                                    scrollTop: scroll_to
                                }, 400);
                            }, 400);
                        }
                    }
                }, 200);
            }
            <?php endif; ?>
        });
        /* ]]> */
    </script>

<?php endif; ?>