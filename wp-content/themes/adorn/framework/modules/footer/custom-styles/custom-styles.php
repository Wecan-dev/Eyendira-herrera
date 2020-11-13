<?php

if(!function_exists('adorn_edge_footer_top_general_styles')) {
    /**
     * Generates general custom styles for footer top area
     */
    function adorn_edge_footer_top_general_styles() {
        $item_styles = array();
        $background_color = adorn_edge_options()->getOptionValue('footer_top_background_color');

        if(!empty($background_color)) {
            $item_styles['background-color'] = $background_color;
        }

        echo adorn_edge_dynamic_css('footer.edge-page-footer .edge-footer-top-holder', $item_styles);
    }

    add_action('adorn_edge_style_dynamic', 'adorn_edge_footer_top_general_styles');
}

if(!function_exists('adorn_edge_footer_bottom_general_styles')) {
    /**
     * Generates general custom styles for footer bottom area
     */
    function adorn_edge_footer_bottom_general_styles() {
        $item_styles = array();
	    $background_color = adorn_edge_options()->getOptionValue('footer_bottom_background_color');
	
	    if(!empty($background_color)) {
		    $item_styles['background-color'] = $background_color;
	    }

        echo adorn_edge_dynamic_css('footer.edge-page-footer .edge-footer-bottom-holder', $item_styles);
    }

    add_action('adorn_edge_style_dynamic', 'adorn_edge_footer_bottom_general_styles');
}