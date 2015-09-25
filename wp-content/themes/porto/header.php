<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <?php get_template_part('head'); ?>
</head>
<?php
global $porto_settings, $porto_design;
$body_class = ($porto_settings['wrapper']) ? ($porto_settings['wrapper']) : '';
?>
<body <?php body_class(array($body_class)); ?>>

    <?php
    // Get Meta Values
    wp_reset_postdata();
    global $porto_layout, $porto_sidebar;

    $porto_layout = porto_meta_layout();
    $porto_sidebar = porto_meta_sidebar();
    $porto_banner_pos = porto_get_meta_value('banner_pos');
    if (($porto_layout == 'left-sidebar' || $porto_layout == 'right-sidebar') && (!$porto_sidebar || !is_active_sidebar( $porto_sidebar ))) {
        $porto_layout = 'fullwidth';
    }
    if (($porto_layout == 'wide-left-sidebar' || $porto_layout == 'wide-right-sidebar') && (!$porto_sidebar || !is_active_sidebar( $porto_sidebar ))) {
        $porto_layout = 'widewidth';
    }

    $breadcrumbs = $porto_settings['show-breadcrumbs'] ? porto_get_meta_value('breadcrumbs', true) : false;
    $page_title = $porto_settings['show-pagetitle'] ? porto_get_meta_value('page_title', true) : false;
    $content_top = porto_get_meta_value('content_top');
    $content_inner_top = porto_get_meta_value('content_inner_top');

    if (( is_front_page() && is_home()) || is_front_page() ) {
        $breadcrumbs = false;
        $page_title = false;
    }

    $header_type = $porto_settings['header-type'];

    ?>

    <div class="page-wrapper<?php if ($header_type == 'side') echo ' side-nav' ?>"><!-- page wrapper -->

        <?php
        if ($porto_banner_pos == 'before_header') {
            porto_banner('banner-before-header');
        }
        ?>

        <?php if (porto_get_meta_value('header', true)) : ?>
            <div class="header-wrapper<?php if ($porto_settings['header-wrapper'] == 'wide') echo ' wide' ?><?php if ($porto_banner_pos == 'below_header' || $porto_banner_pos == 'fixed') echo ' fixed-header' ?><?php if ($header_type == 'side') echo ' header-side-nav' ?> clearfix"><!-- header wrapper -->
                <?php

                global $porto_settings;

                ?>
                <?php if ($porto_settings['header-wrapper'] == 'boxed') : ?>
                <div id="header-boxed" class="container">
                <?php endif; ?>

                    <?php
                    get_template_part('header/header_'.$header_type);
                    ?>

                <?php if ($porto_settings['header-wrapper'] == 'boxed') : ?>
                </div>
                <?php endif; ?>
            </div><!-- end header wrapper -->
        <?php endif; ?>

        <?php
        if ($porto_banner_pos != 'before_header') {
            porto_banner($porto_banner_pos == 'fixed' ? 'banner-fixed' : '');
        }
        ?>

        <?php get_template_part('breadcrumbs'); ?>

        <div id="main" class="<?php if ($porto_layout == 'wide-left-sidebar' || $porto_layout == 'wide-right-sidebar' || $porto_layout == 'left-sidebar' || $porto_layout == 'right-sidebar') echo 'column2' . ' column2-' . str_replace('wide-', '', $porto_layout); else echo 'column1'; ?><?php if ($porto_layout == 'widewidth') echo ' wide' ?><?php if (!$breadcrumbs && !$page_title) echo ' no-breadcrumbs' ?>"><!-- main -->

            <?php if ($content_top) : ?>
            <div id="content-top"><!-- begin content top -->
                <?php echo do_shortcode('[porto_block name="'.$content_top.'"]') ?>
            </div><!-- end content top -->
            <?php endif; ?>

            <?php if ($porto_layout == 'fullwidth' || $porto_layout == 'left-sidebar' || $porto_layout == 'right-sidebar') : ?>
            <div class="container">
                <div class="row">
            <?php endif; ?>

            <!-- main content -->
            <div class="main-content <?php if (($porto_layout == 'wide-left-sidebar' || $porto_layout == 'wide-right-sidebar' || $porto_layout == 'left-sidebar' || $porto_layout == 'right-sidebar') && $porto_sidebar && is_active_sidebar( $porto_sidebar )) echo 'col-md-9'; else echo 'col-md-12'; ?>">

            <?php if (function_exists('wc_print_notices')) : ?>
                <?php wc_print_notices(); ?>
            <?php endif; ?>

            <?php wp_reset_postdata(); ?>
                <?php if ($content_inner_top) : ?>
                    <div id="content-inner-top"><!-- begin content inner top -->
                        <?php echo do_shortcode('[porto_block name="'.$content_inner_top.'"]') ?>
                    </div><!-- end content inner top -->
                <?php endif; ?>