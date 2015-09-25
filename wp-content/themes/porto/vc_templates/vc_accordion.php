<?php
//wp_enqueue_script('jquery-ui-accordion');
$output = $title = $interval = $el_class = $collapsible = $disable_keyboard = $active_tab = '';

extract(shortcode_atts(array(
    'title' => '',
    'interval' => 0,
    'el_class' => '',
    'collapsible' => 'no',
    'type' => '',
    'disable_keyboard' => 'no',
    'active_tab' => '1'
), $atts));

$id = 'accordion' . rand();
$el_class = $this->getExtraClass($el_class);
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'panel-group '.$el_class.' '.$type, $this->settings['base']);

$output .= "\n\t".'<div class="'.$css_class.'" id="' . $id . '" data-collapsible="'.$collapsible.'" data-active-tab="'.$active_tab.'">'; //data-interval="'.$interval.'"
$output .= wpb_widget_title(array('title' => $title, 'extraclass' => 'wpb_accordion_heading'));

$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
$output .= "\n\t".'</div> '.$this->endBlockComment('vc_accordion');

echo $output;