<?php
/**
 * The template for displaying product category thumbnails within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product_cat.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $woocommerce_loop, $porto_products_cols_lg, $porto_products_cols_md, $porto_products_cols_xs, $porto_products_cols_ls;

$woocommerce_loop['cat_loop']++;

$class = '';
if ($woocommerce_loop['cat_loop'] % $porto_products_cols_lg == 1)
    $class .= ' pcols-lg-first';
if ($woocommerce_loop['cat_loop'] % $porto_products_cols_md == 1)
    $class .= ' pcols-md-first';
if ($woocommerce_loop['cat_loop'] % $porto_products_cols_xs == 1)
    $class .= ' pcols-xs-first';
if ($woocommerce_loop['cat_loop'] % $porto_products_cols_ls == 1)
    $class .= ' pcols-ls-first';

?>
<li class="product-category <?php echo $class ?>">

	<?php do_action( 'woocommerce_before_subcategory', $category ); ?>

    <a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">
        <div class="thumbnail">
            <div class="thumb-info">
                <?php
                /**
                 * woocommerce_before_subcategory_title hook
                 *
                 * @hooked woocommerce_subcategory_thumbnail - 10
                 */
                do_action( 'woocommerce_before_subcategory_title', $category );
                ?>

                <div class="thumb-info-wrap">
                    <div class="thumb-info-title">
                        <h3 class="sub-title thumb-info-inner"><?php echo esc_html($category->name); ?></h3>
                        <?php if ( $category->count > 0 ) : ?>
                        <span class="thumb-info-type">
                            <?php echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">' . $category->count . '</mark>', $category ) . ' ' . __( 'Products', 'woocommerce' ); ?>
                        </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </a>

    <?php
    /**
     * woocommerce_after_subcategory_title hook
     */
    do_action( 'woocommerce_after_subcategory_title', $category );
    ?>

	<?php do_action( 'woocommerce_after_subcategory', $category ); ?>

</li>