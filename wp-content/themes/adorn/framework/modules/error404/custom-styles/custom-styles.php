<?php

if(!function_exists('adorn_edge_404_header_general_styles')) {
    /**
     * Generates general custom styles for 404 header area
     */
    function adorn_edge_404_header_general_styles() {
	    $background_color        = adorn_edge_options()->getOptionValue('404_menu_area_background_color_header');
	    $background_transparency = adorn_edge_options()->getOptionValue('404_menu_area_background_transparency_header');
	    
        $header_styles = array();

        if(!empty($background_color)) {
            $header_styles['background-color'] = $background_color;
            $header_styles['background-transparency'] = 1;

            if($background_transparency !== '') {
                $header_styles['background-transparency'] = $background_transparency;
            }

            echo adorn_edge_dynamic_css('.edge-404-page .edge-page-header', array('background-color' => adorn_edge_rgba_color($header_styles['background-color'], $header_styles['background-transparency']) . ' !important'));
        }

        if(empty($background_color) && $background_transparency !== '') {
            $header_styles['background-color'] = '#fff';
            $header_styles['background-transparency'] = $background_transparency;

            echo adorn_edge_dynamic_css('.edge-404-page .edge-page-header', array('background-color' => adorn_edge_rgba_color($header_styles['background-color'], $header_styles['background-transparency']) . ' !important'));
        }
	
	    $border_color = adorn_edge_options()->getOptionValue('404_menu_area_border_color_header');

        $menu_styles = array();

        if(!empty($border_color)) {
            $menu_styles['border-color'] = $border_color;
        }

        echo adorn_edge_dynamic_css('.edge-404-page .edge-page-header .edge-menu-area', $menu_styles);
    }

    add_action('adorn_edge_style_dynamic', 'adorn_edge_404_header_general_styles');
}

if(!function_exists('adorn_edge_404_footer_top_general_styles')) {
    /**
     * Generates general custom styles for footer top area
     */
    function adorn_edge_404_footer_top_general_styles() {
        $background_color         = adorn_edge_options()->getOptionValue('404_page_background_color');
	    $background_image         = adorn_edge_options()->getOptionValue('404_page_background_image');
	    $pattern_background_image = adorn_edge_options()->getOptionValue('404_page_background_pattern_image');
    	
    	$item_styles = array();
        if(!empty($background_color)) {
            $item_styles['background-color'] = $background_color;
        }

        if (!empty($background_image)) {
            $item_styles['background-image'] = 'url('.$background_image.')';
            $item_styles['background-position'] = 'center 0';
            $item_styles['background-size'] = 'cover';
            $item_styles['background-repeat'] = 'no-repeat';
        }

        if (!empty($pattern_background_image)) {
            $item_styles['background-image'] = 'url('.$pattern_background_image.')';
            $item_styles['background-position'] = '0 0';
            $item_styles['background-repeat'] = 'repeat';
        }
	
	    $item_selector = array(
		    '.edge-404-page .edge-content'
	    );

        echo adorn_edge_dynamic_css($item_selector, $item_styles);
    }

    add_action('adorn_edge_style_dynamic', 'adorn_edge_404_footer_top_general_styles');
}

if(!function_exists('adorn_edge_404_title_styles')) {
    /**
     * Generates styles for 404 page title
     */
    function adorn_edge_404_title_styles() {
	    $item_styles = adorn_edge_get_typography_styles('404_title');
	
	    $item_selector = array(
		    '.edge-404-page .edge-page-not-found h1'
	    );
	
	    echo adorn_edge_dynamic_css($item_selector, $item_styles);
    }

    add_action('adorn_edge_style_dynamic', 'adorn_edge_404_title_styles');
}

if(!function_exists('adorn_edge_404_subtitle_styles')) {
    /**
     * Generates styles for 404 page subtitle
     */
    function adorn_edge_404_subtitle_styles() {
	    $item_styles = adorn_edge_get_typography_styles('404_subtitle');
	
	    $item_selector = array(
		    '.edge-404-page .edge-page-not-found h3'
	    );
	
	    echo adorn_edge_dynamic_css($item_selector, $item_styles);
    }

    add_action('adorn_edge_style_dynamic', 'adorn_edge_404_subtitle_styles');
}

if(!function_exists('adorn_edge_404_text_styles')) {
    /**
     * Generates styles for 404 page text
     */
    function adorn_edge_404_text_styles() {
	    $item_styles = adorn_edge_get_typography_styles('404_text');
	
	    $item_selector = array(
		    '.edge-404-page .edge-page-not-found .edge-page-not-found-text'
	    );
	
	    echo adorn_edge_dynamic_css($item_selector, $item_styles);
    }

    add_action('adorn_edge_style_dynamic', 'adorn_edge_404_text_styles');
}