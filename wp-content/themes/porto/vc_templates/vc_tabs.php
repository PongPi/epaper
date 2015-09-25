<?php
$output = $title = $interval = $el_class = '';
extract(shortcode_atts(array(
    'title' => '',
    'interval' => 0,
    'position' => '',
    'el_class' => ''
), $atts));

$el_class = $this->getExtraClass($el_class);

$element = 'tabs ';
if ( 'vc_tour' == $this->shortcode) $element .= ' tabs-vertical';

// Extract tab titles
preg_match_all( '/vc_tab title="([^\"]+)"(\stab_id\=\"([^\"]+)\"){0,1}(\sicon\=\"([^\"]+)\"){0,1}/i', $content, $matches, PREG_OFFSET_CAPTURE );
$tab_titles = array();

$ul_class = '';
switch ( $position ) {
    case 'top-right' :
        $ul_class .= ' text-right';
        break;
    case 'bottom-left' :
        $el_class .= ' tabs-bottom';
        break;
    case 'bottom-right' :
        $ul_class .= ' nav-right';
        $el_class .= ' tabs-bottom';
        break;
    case 'top-justify' :
        $ul_class .= ' nav-justified';
        break;
    case 'bottom-justify' :
        $ul_class .= ' nav-justified';
        $el_class .= ' tabs-bottom';
        break;
    case 'vertical-left' :
        $ul_class .= ' col-sm-3';
        $el_class .= ' tabs-left';
        break;
    case 'vertical-right' :
        $ul_class .= ' col-sm-3';
        $el_class .= ' tabs-right';
        break;
    default:
}

/**
 * vc_tabs
 *
 */
if ( isset($matches[0]) ) { $tab_titles = $matches[0]; }
$tabs_nav = '';
$tabs_nav .= '<ul class="nav nav-tabs' . $ul_class . '">';
foreach ( $tab_titles as $tab ) {
    preg_match('/title="([^\"]+)"(\stab_id\=\"([^\"]+)\"){0,1}(\sicon\=\"([^\"]+)\"){0,1}/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE );
    if(isset($tab_matches[1][0])) {
        $tabs_nav .= '<li><a href="#tab-'. (isset($tab_matches[3][0]) ? $tab_matches[3][0] : sanitize_title( $tab_matches[1][0] ) ) .'" data-toggle="tab">'. (isset($tab_matches[5][0]) ? ('<i class="fa fa-' . str_replace('fa-', '', $tab_matches[5][0]) . '"></i> ') : '' ) . $tab_matches[1][0] . '</a></li>';

    }
}
$tabs_nav .= '</ul>'."\n";
$tabs_nav = preg_replace('/<li>/', '<li class="active">', $tabs_nav, 1);

$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, trim($element.$el_class), $this->settings['base']);

$output .= "\n\t".'<div class="'.$css_class.'" data-interval="'.$interval.'">';
$output .= wpb_widget_title(array('title' => $title, 'extraclass' => $element.'_heading'));
if ( !in_array($position, array('bottom-left', 'bottom-right', 'bottom-justify', 'vertical-right')) ) {
    $output .= "\n\t\t\t".$tabs_nav;
}
$output .= "\n\t\t".'<div class="tab-content">';
$output .= "\n\t\t\t".preg_replace('/tab-pane/', 'tab-pane active', wpb_js_remove_wpautop($content), 1);
//if ( 'vc_tour' == $this->shortcode) {
//    $output .= "\n\t\t\t" . '<div class="wpb_tour_next_prev_nav vc_clearfix"> <span class="wpb_prev_slide"><a href="#prev" title="'.__('Previous slide', 'js_composer').'">'.__('Previous slide', 'js_composer').'</a></span> <span class="wpb_next_slide"><a href="#next" title="'.__('Next slide', 'js_composer').'">'.__('Next slide', 'js_composer').'</a></span></div>';
//}
$output .= "\n\t\t".'</div> '.$this->endBlockComment('.tab-content');
if ( in_array($position, array('bottom-left', 'bottom-right', 'bottom-justify', 'vertical-right')) ) {
    $output .= "\n\t\t\t".$tabs_nav;
}
$output .= "\n\t".'</div> '.$this->endBlockComment($element);

echo $output;