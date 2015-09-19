<?php
global $porto_settings;

$attachment = '';
if (has_post_thumbnail()) {
    $attachment_id = get_post_thumbnail_id();
    $attachment_related = porto_get_attachment($attachment_id, 'related-post');
    $attachment = porto_get_attachment($attachment_id);
}
?>
<div class="post-item">
    <?php if ($attachment && $attachment_related) : ?>
        <div class="post-image thumbnail">
            <div class="thumb-info">
                <a href="<?php the_permalink(); ?>">
                    <img class="img-responsive" width="<?php echo $attachment_related['width'] ?>" height="<?php echo $attachment_related['height'] ?>" src="<?php echo $attachment_related['src'] ?>" alt="<?php echo $attachment_related['alt'] ?>"<?php if ($porto_settings['post-zoom']) : ?> data-image="<?php echo $attachment['src'] ?>" data-caption="<?php echo $attachment['caption'] ?>"<?php endif; ?> />
                </a>
                <?php if ($porto_settings['post-zoom']) : ?>
                    <span class="zoom"><i class="fa fa-search"></i></span>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="post-date">
        <?php
        porto_post_date();
        //porto_post_format();
        ?>
    </div>
    <h4>
        <a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
    </h4>
    <?php echo porto_get_excerpt(15); ?>
</div>