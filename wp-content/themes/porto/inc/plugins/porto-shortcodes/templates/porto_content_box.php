<?php
$output = $border_top_color = $border_radius = $border_top_width = $bg_top_color = $bg_bottom_color = $align = $animation_type = $animation_duration = $animation_delay = $el_class = '';
extract(shortcode_atts(array(
    'border_top_color' => '',
    'border_radius' => '',
    'border_top_width' => '',
    'bg_top_color' => '',
    'bg_bottom_color' => '',
    'align' => '',
    'animation_type' => '',
    'animation_duration' => '',
    'animation_delay' => '',
    'el_class' => ''
), $atts));

$el_class = porto_shortcode_extract_class( $el_class );

if ($animation_type)
    $el_class .= ' appear-animation';

$output = '<div class="porto-content-box wpb_content_element '. $el_class . '"';
if ($animation_type)
    $output .= ' data-appear-animation="'.$animation_type.'"';
if ($animation_delay)
    $output .= ' data-appear-animation-delay="'.$animation_delay.'"';
if ($animation_duration && $animation_duration != 1000)
    $output .= ' data-appear-animation-duration="'.$animation_duration.'"';
$output .= '>';

$output .= '<div class="featured-box'.($align?' align-'.$align:''). '" style="'.(($border_radius) ? 'border-radius:'.$border_radius.'px;' : '').
    (($bg_top_color && $bg_bottom_color)?'background:-webkit-linear-gradient(top, '.$bg_top_color.' 1%, '.$bg_bottom_color.' 98%) repeat scroll 0 0 transparent; background: linear-gradient(to bottom, '.$bg_top_color.' 1%, '.$bg_bottom_color.' 98%) repeat scroll 0 0 transparent; ':'').'">';
$output .= '<div class="box-content" style="'.(($border_radius) ? 'border-radius:'.$border_radius.'px;' : '').
    ($border_top_color?'border-top-color:'.$border_top_color.';':'').($border_top_width?'border-top-width:'.$border_top_width.'px;':'').'">';
$output .= do_shortcode($content);
$output .= '</div></div>';

$output .= '</div>' . porto_shortcode_end_block_comment( 'porto_content_box' ) . "\n";

echo $output;