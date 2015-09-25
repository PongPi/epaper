<?php
$output = $container = $animation_type = $animation_duration = $animation_delay = $el_class = '';
extract(shortcode_atts(array(
    'container' => false,
    'animation_type' => '',
    'animation_duration' => '',
    'animation_delay' => '',
    'el_class' => ''
), $atts));

$el_class = porto_shortcode_extract_class( $el_class );

if ($animation_type)
    $el_class .= ' appear-animation';

$output = '<div class="porto-map-section ' . $el_class . '"';
if ($animation_type)
    $output .= ' data-appear-animation="'.$animation_type.'"';
if ($animation_delay)
    $output .= ' data-appear-animation-delay="'.$animation_delay.'"';
if ($animation_duration && $animation_duration != 1000)
    $output .= ' data-appear-animation-duration="'.$animation_duration.'"';
$output .= '>';

$output .= '<section class="map-content">';
if ($container)
    $output .= '<div class="container">';
$output .= do_shortcode($content);
if ($container)
    $output .= '</div>';
$output .= '</section>';
$output .= '</div>' . porto_shortcode_end_block_comment( 'porto_map_section' ) . "\n";

echo $output;