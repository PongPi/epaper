<?php get_header() ?>

<?php
global $porto_settings;
?>
    <div id="content" role="main">
        <?php /* The loop */ ?>
        <?php while ( have_posts() ) : the_post(); ?>

            <article <?php post_class(); ?>>
                <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                    <?php get_template_part('slideshow', 'page') ?>
                <?php endif; ?>

                <div class="page-content">
                    <?php
                    the_content();
                    wp_link_pages( array(
                        'before'      => '<div class="pagination" role="navigation">',
                        'after'       => '</div>'
                    ) );
                    ?>
                </div>
            </article>

            <?php if ($porto_settings['page-share'] && $porto_settings['share-enable']) : ?>
                <div class="page-share">
                    <h3><i class="fa fa-share"></i><?php _e('Share on', 'porto') ?></h3>
                    <?php get_template_part('share') ?>
                </div>
            <?php endif; ?>

            <?php if ($porto_settings['page-comment']) : ?>
                <?php
                wp_reset_postdata();
                comments_template();
                ?>
            <?php endif; ?>

        <?php endwhile; ?>

    </div>

<?php get_footer() ?>