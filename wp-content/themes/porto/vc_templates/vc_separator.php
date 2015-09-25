<?php
$gap = $gradient = '';
extract( shortcode_atts( array(
	'el_width' => '',
	'style' => '',
	'color' => '',
    'border_width' => '',
	'accent_color' => 'rgba(0,0,0,0.15)',
    'gap' => '',
    'gradient' => false,
    'el_class' => '',
    'align' => '',
), $atts ) );
echo '<div class="porto-separator '.$gap.'">';
if (!$gradient) {
    echo do_shortcode( '[vc_text_separator layout="separator_no_text" align="' . $align . '" style="' . $style . '" color="' . $color . '" accent_color="' . $accent_color . '" border_width="' . $border_width . '" el_width="' . $el_width . '" el_class="' . $el_class . '"]' );
} else {
    $el_class .= ' ' . $align;
    if ($color == 'custom')
        $color = $accent_color;
    if (!$align)
        $align = 'align_center';
    $el_class = $this->getExtraClass( $el_class );
    echo '<hr class="separator-line ' . $el_class . ($el_width?' separator-line-'.$el_width:'').'" style="'.
        (($color != 'rgba(0,0,0,0.15)' || ($align != 'align_center'))?'background-image: -webkit-linear-gradient(left'.(($align == 'align_center' || $align == 'align_right')?', transparent':'').', '.$color.(($align == 'align_center' || $align == 'align_left')?', transparent':'').'); background-image: linear-gradient(to right'.(($align == 'align_center' || $align == 'align_right')?', transparent':'').', '.$color.(($align == 'align_center' || $align == 'align_left')?', transparent':'').');':'').
        ($border_width?'height:'.$border_width.'px;':'').
        '">';
}
echo '</div>';