<?php

global $post;

$item_classes = ' ';
$item_cats = get_the_terms($post->ID, 'faq_cat');
if ($item_cats):
    foreach ($item_cats as $item_cat) {
        $item_classes .= urldecode($item_cat->slug) . ' ';
    }
endif;
?>

<article <?php post_class('faq' . $item_classes); ?>>
    <section class="toggle<?php echo $item_classes ?>">
        <label><i class="fa fa-plus"></i><i class="fa fa-minus"></i><?php the_title() ?></label>
        <div class="toggle-content">
            <?php
            the_content();
            wp_link_pages( array(
                'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'porto' ) . '</span>',
                'after'       => '</div>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
                'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'porto' ) . ' </span>%',
                'separator'   => '<span class="screen-reader-text">, </span>',
            ) );
            ?>
        </div>
    </section>
</article>