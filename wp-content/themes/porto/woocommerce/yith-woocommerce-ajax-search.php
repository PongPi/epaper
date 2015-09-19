<?php
/**
 * YITH WooCommerce Ajax Search template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Ajax Search
 * @version 1.1.1
 */

if ( !defined( 'YITH_WCAS' ) ) { exit; } // Exit if accessed directly

wp_enqueue_script('yith_wcas_jquery-autocomplete' );

global $porto_settings;

?>

<form role="search" method="get" id="yith-ajaxsearchform" action="<?php echo esc_url( home_url( '/'  ) ) ?>" class="yith-ajaxsearchform-container searchform <?php if (isset($porto_settings['search-cats']) && $porto_settings['search-cats']) echo 'searchform-cats'; ?>">
    <fieldset>
        <span class="text"><input name="s" id="yith-s" type="text" value="<?php echo get_search_query() ?>" placeholder="<?php echo __('Search&hellip;', 'porto'); ?>" /></span>
        <?php
        if (isset($porto_settings['search-cats']) && $porto_settings['search-cats']) {
            $args = array(
                'show_option_all' => __( 'All Categories', 'porto' ),
                'hierarchical' => 1,
                'class' => 'cat',
                'echo' => 1
            );
            $args['taxonomy'] = 'product_cat';
            $args['name'] = 'cat';
            wp_dropdown_categories($args);
        }
        ?>
        <span class="button-wrap"><button class="btn" id="yith-searchsubmit" title="<?php echo __('Search', 'porto'); ?>" type="submit"><i class="fa fa-search"></i></button></span>
        <input type="hidden" name="post_type" value="product" />
    </fieldset>
</form>

<script type="text/javascript">
jQuery(function($){
    var search_loader_url = '<?php echo esc_url(porto_uri . '/images/ajax-loader@2x.gif') ?>';

    $('#yith-s').autocomplete({
        minChars: <?php echo get_option('yith_wcas_min_chars') * 1; ?>,
        appendTo: '.yith-ajaxsearchform-container',
        serviceUrl: woocommerce_params.ajax_url + '?action=yith_ajax_search_products'<?php echo (isset($porto_settings['search-cats']) && $porto_settings['search-cats']) ? " + '&cat=' + $('.yith-ajaxsearchform-container #cat').val()" : "" ?>,
        onSearchStart: function(){
            $(this).css('background', 'url('+search_loader_url+') no-repeat 97% center');
            $(this).css('background-size', '16px 16px');
        },
        onSearchComplete: function(){
            $(this).css('background', 'transparent');
        },
        onSelect: function (suggestion) {
            if( suggestion.id != -1 ) {
                window.location.href = suggestion.url;
            }
        }
    });
});
</script>