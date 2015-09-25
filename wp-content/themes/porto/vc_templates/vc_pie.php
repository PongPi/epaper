<?php
global $porto_settings;
$dark = (isset($porto_settings['css-type']) && $porto_settings['css-type'] == 'dark') ? true : false;
$title = $el_class = $value = $color = $label_value= $units = $type = $size = $trackcolor = $barcolor = $speed = $line = $linecap = '';
extract(shortcode_atts(array(
    'title' => '',
    'el_class' => '',
    'value' => '50',
    'units' => '',
    'color' => 'turquoise',
    'label_value' => '',
    'type' => 'custom',
    'size' => '175',
    'trackcolor' => $dark ? '#2e353e' : '#eeeeee',
    'barcolor' => '',
    'speed' => '2500',
    'line' => '20',
    'linecap' => 'round'
), $atts));

if ($type == 'default') {

    wp_enqueue_script('vc_pie');

    $el_class = $this->getExtraClass( $el_class );
    $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_pie_chart wpb_content_element' . $el_class, $this->settings['base'], $atts );
    $output = "\n\t".'<div class= "'.$css_class.'" data-pie-value="'.$value.'" data-pie-label-value="'.$label_value.'" data-pie-units="'.$units.'" data-pie-color="'.htmlspecialchars($color).'">';
        $output .= "\n\t\t".'<div class="wpb_wrapper">';
            $output .= "\n\t\t\t".'<div class="vc_pie_wrapper">';
                $output .= "\n\t\t\t".'<span class="vc_pie_chart_back"></span>';
                $output .= "\n\t\t\t".'<span class="vc_pie_chart_value"></span>';
                $output .= "\n\t\t\t".'<canvas width="101" height="101"></canvas>';
            $output .= "\n\t\t\t".'</div>';
            if ($title!='') {
                $output .= '<h4 class="wpb_heading wpb_pie_chart_heading">'.$title.'</h4>';
            }
            //wpb_widget_title(array('title' => $title, 'extraclass' => 'wpb_pie_chart_heading'));
            $output .= "\n\t\t".'</div>'.$this->endBlockComment('.wpb_wrapper');
        $output .= "\n\t".'</div>'.$this->endBlockComment('.wpb_pie_chart')."\n";
    echo $output;
} else {
    global $porto_settings;
    if (empty($barcolor))
        $barcolor = $porto_settings['skin-color'];

    $el_class = $this->getExtraClass( $el_class );
    $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'circular-bar center ' . $el_class, $this->settings['base'], $atts );
    $output = "\n\t".'<div class= "'.$css_class.'">';
        $output .= "\n\t\t".'<div class="chart" data-trackcolor="'.$trackcolor.'" data-barcolor="'.$barcolor.'" data-percent="'.$value.'" data-size="'.$size.'" data-speed="'.$speed.'" data-linewidth="'.$line.'" data-label-value="'.$label_value.'" data-linecap="'.$linecap.'" style="height:'.$size.'px">';
            if ($title!='') {
                $output .= "\n\t\t\t".'<strong>'.$title.'</strong>';
            }
            $output .= "\n\t\t\t".'<label><span class="percent">0</span>'.$units.'</label>';
	    $output .= "\n\t".'</div>'.$this->endBlockComment('.chart')."\n";

	$output .= "\n\t".'</div>'.$this->endBlockComment('.circular-bar')."\n";
	echo $output;
}