<?php
global $porto_settings;

$breadcrumbs = $porto_settings['show-breadcrumbs'] ? porto_get_meta_value('breadcrumbs', true) : false;
$page_title = $porto_settings['show-pagetitle'] ? porto_get_meta_value('page_title', true) : false;

if (( is_front_page() && is_home()) || is_front_page() ) {
    $breadcrumbs = false;
    $page_title = false;
}

?>
<?php if ($breadcrumbs || $page_title) : ?>
    <?php if ($porto_settings['breadcrumbs-wrapper'] == 'boxed') : ?>
        <div id="breadcrumbs-boxed" class="container">
    <?php endif; ?>
    <section class="page-top<?php if ($porto_settings['breadcrumbs-wrapper'] == 'wide') echo ' wide' ?>">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                <?php if ($breadcrumbs) : ?>
                    <div class="breadrumbs-wrap">
                        <?php porto_breadcrumbs(); ?>
                    </div>
                <?php endif; ?>
                <div class="<?php if (!$page_title) : ?> hide<?php endif; ?>">
                    <h2 class="entry-title"><?php porto_page_title(); ?></h2>
                </div>
                <?php
                if (function_exists('porto_woocommerce_product_nav')) {
                    porto_woocommerce_product_nav();
                }
                ?>
            </div>
        </div>
    </section>
    <?php if ($porto_settings['breadcrumbs-wrapper'] == 'boxed') : ?>
        </div>
    <?php endif; ?>
<?php endif; ?>