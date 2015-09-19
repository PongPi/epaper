<?php
$output = $color = $size = $icon = $target = $href = $el_class = $title = $disabled = $label = $position = '';
extract( shortcode_atts( array(
	'color' => 'wpb_button',
	'size' => '',
	'icon' => 'none',
	'target' => '_self',
	'href' => '',
	'el_class' => '',
	'title' => __( 'Text on the button', "js_composer" ),
	'position' => '',
    'disabled' => false,
    'label' => false,
), $atts ) );
$a_class = '';

if ( $el_class != '' ) {
	$tmp_class = explode( " ", strtolower( $el_class ) );
	$tmp_class = str_replace( ".", "", $tmp_class );
	if ( in_array( "prettyphoto", $tmp_class ) ) {
		wp_enqueue_script( 'prettyphoto' );
		wp_enqueue_style( 'prettyphoto' );
		$a_class .= ' prettyphoto';
		$el_class = str_ireplace( "prettyphoto", "", $el_class );
	}
	if ( in_array( "pull-right", $tmp_class ) && $href != '' ) {
		$a_class .= ' pull-right';
		$el_class = str_ireplace( "pull-right", "", $el_class );
	}
	if ( in_array( "pull-left", $tmp_class ) && $href != '' ) {
		$a_class .= ' pull-left';
		$el_class = str_ireplace( "pull-left", "", $el_class );
	}
}

if ( $target == 'same' || $target == '_self' ) {
	$target = '';
}
$target = ( $target != '' ) ? ' target="' . $target . '"' : '';

if ($label != '') {
    switch ($color) {
        case 'wpb_button': $color = ' label-default'; break;
        case 'btn-inverse': $color = ' label-dark'; break;
        default: $color = str_replace('btn-', 'label-', $color);
    }
} else {
    switch ($color) {
        case 'wpb_button': $color = ' btn-default'; break;
        default: $color = ' '.$color;
    }
}

//$color = ( $color != '' ) ? ' wpb_' . $color : '';

switch ($size) {
    case 'btn-large': $size = ' btn-lg'; break;
    case 'btn-small': $size = ' btn-sm'; break;
    case 'btn-mini': $size = ' btn-xs'; break;
    default: $size = '';
}

//$size = ( $size != '' && $size != 'wpb_regularsize' ) ? ' wpb_' . $size : ' ' . $size;

$icon = ($icon != 'none' && $icon != '') ? ' ' . $icon : '';
$i_icon = $icon ? ' <i class="icon"> </i>' : '';
$position = ( $position != '' ) ? ' ' . $position . '-button-position' : '';
$el_class = $this->getExtraClass( $el_class );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'btn ' . $color . $size . $icon . $el_class . $position, $this->settings['base'], $atts );

if ( $href != '' ) {
	$output .= '<span class="' . $css_class . '">' . $title . $i_icon . '</span>';
	$output = '<a class="wpb_button_a' . $a_class . (($disabled != '') ? ' disabled' : '') . '" title="' . $title . '" href="' . $href . '"' . $target . '>' . $output . '</a>';
} else {
    if ($label != '') {
        $output .= '<span class="label ' . $color . (($disabled != '') ? '  disabled' : '') . '">' . $title . '</span>';
    } else {
	    $output .= '<button class="' . $css_class . '"'. (($disabled != '') ? ' disabled="disabled"' : '') . '>' . $title . $i_icon . '</button>';
    }

}

echo $output . $this->endBlockComment( 'button' ) . "\n";