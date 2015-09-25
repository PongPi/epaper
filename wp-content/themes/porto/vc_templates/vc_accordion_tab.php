<?php
$output = $title = '';

extract(shortcode_atts(array(
	'title' => __("Section", "js_composer"),
    'icon' => 'none'
), $atts));

$col_id = 'collapse' . rand();

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'panel panel-default', $this->settings['base']);
$output .= "\n\t\t\t" . '<div class="'.$css_class.'">';
    $output .= "\n\t\t\t\t" . '<div class="panel-heading"><h4 class="panel-title">';
        $output .= "\n\t\t\t\t\t" . '<a class="accordion-toggle" data-toggle="collapse" href="#' . $col_id . '">';
            $output .= "\n\t\t\t\t\t\t" . ($icon ? '<i class="fa fa-' . str_replace('fa-', '', $icon) . '"></i>' : '');
            $output .= "\n\t\t\t\t\t\t" . $title;
        $output .= "\n\t\t\t\t\t" . '</a>';
    $output .= "\n\t\t\t\t" . '</h4></div>';

    $output .= "\n\t\t\t\t" . '<div id="' . $col_id . '" class="accordion-body collapse">';
        $output .= "\n\t\t\t\t\t" . '<div class="panel-body">';
            $output .= "\n\t\t\t\t\t" . !empty($content) ? wpb_js_remove_wpautop($content, false) : __("Empty section. Edit page to add content here.", "js_composer");
        $output .= "\n\t\t\t\t\t" . '</div>';
    $output .= "\n\t\t\t\t" . '</div>';

$output .= "\n\t\t\t" . '</div> ' . $this->endBlockComment('.wpb_accordion_section') . "\n";

    /*$output .= "\n\t\t\t\t" . '<h3 class="wpb_accordion_header ui-accordion-header"><a href="#'.sanitize_title($title).'">'.$title.'</a></h3>';
    $output .= "\n\t\t\t\t" . '<div class="wpb_accordion_content ui-accordion-content vc_clearfix">';
        $output .= ($content=='' || $content==' ') ? __("Empty section. Edit page to add content here.", "js_composer") : "\n\t\t\t\t" . wpb_js_remove_wpautop($content);
        $output .= "\n\t\t\t\t" . '</div>';
    $output .= "\n\t\t\t" . '</div> ' . $this->endBlockComment('.wpb_accordion_section') . "\n";*/

echo $output;