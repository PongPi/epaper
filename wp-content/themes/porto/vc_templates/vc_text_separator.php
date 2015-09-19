<?php
$gradient = '';
extract(shortcode_atts(array(
    'title' => '',
    'title_align' => '',
    'align' => 'align_center',
    'el_width' => '',
    'border_width' => '',
    'style' => '',
    'color' => '',
    'accent_color' => '',
    'el_class' => '',
    'layout' => 'separator_with_text',
    'gradient' => false
), $atts));

$class = "vc_separator vc_text_separator";

//$el_width = "90";
//$style = 'double';
//$title = '';
//$color = 'blue';

$class .= ($title_align!='') ? ' vc_'.$title_align : '';
$class .= ($el_width!='') ? ' vc_sep_width_'.$el_width : ' vc_sep_width_100';
$class .= ($style!='') ? ' vc_sep_'.$style : '';
$class .= ($align!='') ? ' vc_sep_pos_'.$align : '';

$class .= ($layout=='separator_no_text') ? ' vc_separator_no_text' : '';

if ( $color == 'custom' ) {
	$color = $accent_color;
}

$inline_css_1 = ' style="';
$inline_css_2 = ' style="';
if ($gradient) {
    $inline_css_1 .= ($color) ? 'background-image: -webkit-linear-gradient(left, transparent, '.$color.');
     background-image: linear-gradient(to right, transparent, '.$color.');' : '';
    $inline_css_2 .= ($color) ? 'background-image: -webkit-linear-gradient(left, '.$color.', transparent);
     background-image: linear-gradient(to right, '.$color.', transparent);' : '';
} else {
    $inline_css_1 .= ($color) ? 'background-color: '.$color.';' : '';
    $inline_css_1 .= ($color) ? 'background-color: '.$color.';' : '';
}

if ($border_width!='') {
    $inline_css_1 .= 'height:'.$border_width.'px;';
    $inline_css_2 .= 'height:'.$border_width.'px;';
}

$inline_css_1 .= '"';
$inline_css_2 .= '"';

$class .= $this->getExtraClass($el_class);
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );

?>
<div class="<?php echo esc_attr(trim($css_class)); ?>">
	<span class="vc_sep_holder vc_sep_holder_l"><span<?php echo $inline_css_1; ?> class="vc_sep_line"></span></span>
	<?php if($title!=''): ?><h4><?php echo $title; ?></h4><?php endif; ?>
	<span class="vc_sep_holder vc_sep_holder_r"><span<?php echo $inline_css_2; ?> class="vc_sep_line"></span></span>
</div>
<?php echo $this->endBlockComment('separator')."\n";