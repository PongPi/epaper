<?php
$output = $name = $role = $company = $author_url = $photo_url = $photo_id = $quote = $view = $color = $animation_type = $animation_duration = $animation_delay = $el_class = '';
extract(shortcode_atts(array(
    'name' => '',
    'role' => '',
    'company' => '',
    'author_url' => '',
    'photo_url' => '',
    'photo_id' => '',
    'quote' => '',
    'view' => '',
    'color' => '',
    'animation_type' => '',
    'animation_duration' => '',
    'animation_delay' => '',
    'el_class' => '',
), $atts));

$el_class = porto_shortcode_extract_class( $el_class );

if ($animation_type)
    $el_class .= ' appear-animation';

if (!$photo_url && $photo_id)
    $photo_url = wp_get_attachment_url($photo_id);

$porto_url = str_replace(array('http:', 'https:'), '', $photo_url);

$output = '<div class="porto-testimonial wpb_content_element '. $el_class . '"';
if ($animation_type)
    $output .= ' data-appear-animation="'.$animation_type.'"';
if ($animation_delay)
    $output .= ' data-appear-animation-delay="'.$animation_delay.'"';
if ($animation_duration && $animation_duration != 1000)
    $output .= ' data-appear-animation-duration="'.$animation_duration.'"';
$output .= '>';

if ($view == 'transparent') {
    $output .= '<div class="center">';
    if ($photo_url) {
        $output .= '<img class="testimonial-author-image img-responsive img-circle" src="'.esc_url($porto_url).'" alt="' . $name . '">';
    }
    $output .= '<blockquote class="testimonial-carousel '.$color.'">';
    $output .= '<p>'.do_shortcode($content != '' ? $content : $quote).'</p>';
    $output .= '</blockquote>';
    if ($author_url) {
        $output .= '<a href="'.esc_url($author_url).'">';
    }
    $output .= '<div class="testimonial-author '.$color.'"><strong>'.$name.'</strong>';
    if ($author_url) {
        $output .= '</a>';
    }
    $output .= '<span>'.$role.(($role && $company)?' - ':'').$company.'</span>';
    $output .= '</div></div>';
} else if ($view == 'simple') {
    $output .= '<blockquote class="testimonial-simple center"><p><i class="fa fa-quote-'.(is_rtl() ? 'right' : 'left').'"></i> '.do_shortcode($content != '' ? $content : $quote).'</p>';
    if ($author_url) {
        $output .= '<a href="'.esc_url($author_url).'">';
    }
    $output .= '<span>- '.$name.'</span>';
    if ($author_url) {
        $output .= '</a>';
    }
    $output .= '</blockquote>';
} else {
    $output .= '<blockquote class="testimonial">';
    $output .= '<p>'.do_shortcode($content != '' ? $content : $quote).'</p>';
    $output .= '</blockquote><div class="testimonial-arrow-down"></div>';
    $output .= '<div class="testimonial-author clearfix">';
    if ($photo_url) {
        $output .= '<div class="img-thumbnail img-thumbnail-small"><img src="'.esc_url($photo_url).'" alt="' . $name . '"></div>';
    }
    $output .= '<p>';
    if ($author_url) {
        $output .= '<a href="'.esc_url($author_url).'">';
    }
    $output .= '<strong>'.$name.'</strong>';
    if ($author_url) {
        $output .= '</a>';
    }
    $output .= '<span>'.$role.(($role && $company)?' - ':'').$company.'</span></p>';
    $output .= '</div>';
}

$output .= '</div>' . porto_shortcode_end_block_comment( 'porto_testimonial' ) . "\n";;

echo $output;