<?php

if (!function_exists('adorn_edge_title_area_typography_style')) {

    function adorn_edge_title_area_typography_style(){

        // title default/small style
	    
	    $item_styles = adorn_edge_get_typography_styles('page_title');
	
	    $item_selector = array(
		    '.edge-title .edge-title-holder .edge-page-title'
	    );
	
	    echo adorn_edge_dynamic_css($item_selector, $item_styles);
	
	    // subtitle style
	
	    $item_styles = adorn_edge_get_typography_styles('page_subtitle');
	
	    $item_selector = array(
		    '.edge-title .edge-title-holder .edge-subtitle'
	    );
	
	    echo adorn_edge_dynamic_css($item_selector, $item_styles);
	
	    // breadcrumb style
	
	    $item_styles = adorn_edge_get_typography_styles('page_breadcrumb');
	
	    $item_selector = array(
		    '.edge-title .edge-title-holder .edge-breadcrumbs a',
		    '.edge-title .edge-title-holder .edge-breadcrumbs span'
	    );
	
	    echo adorn_edge_dynamic_css($item_selector, $item_styles);
	    

	    $breadcrumb_hover_color = adorn_edge_options()->getOptionValue('page_breadcrumb_hovercolor');
	    
        $breadcrumb_hover_styles = array();
        if(!empty($breadcrumb_hover_color)) {
            $breadcrumb_hover_styles['color'] = $breadcrumb_hover_color;
        }

        $breadcrumb_hover_selector = array(
            '.edge-title .edge-title-holder .edge-breadcrumbs a:hover'
        );

        echo adorn_edge_dynamic_css($breadcrumb_hover_selector, $breadcrumb_hover_styles);
    }

    add_action('adorn_edge_style_dynamic', 'adorn_edge_title_area_typography_style');
}