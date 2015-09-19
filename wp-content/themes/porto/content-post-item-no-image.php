<?php
global $porto_settings;

?>
<div class="post-item">
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