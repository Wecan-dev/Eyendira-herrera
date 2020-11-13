<?php

if(!function_exists('adorn_edge_header_class')) {
    /**
     * Function that adds class to header based on theme options
     * @param array array of classes from main filter
     * @return array array of classes with added header class
     */
    function adorn_edge_header_class($classes) {
		$id = adorn_edge_get_page_id();

		$header_type = adorn_edge_get_meta_field_intersect('header_type', $id);

        $classes[] = 'edge-'.$header_type;

        if($header_type == 'header-standard' && adorn_edge_get_meta_field_intersect('menu_area_position_header_standard', $id) == 'right'){
			$classes[] = 'edge-'.$header_type.'-right-position';
		}

		$disable_menu_area_shadow = adorn_edge_get_meta_field_intersect('menu_area_shadow',$id) == 'no';
		if($disable_menu_area_shadow) {
			$classes[] = 'edge-menu-area-shadow-disable';
		}

		$disable_menu_area_grid_shadow = adorn_edge_get_meta_field_intersect('menu_area_in_grid_shadow',$id) == 'no';
		if($disable_menu_area_grid_shadow) {
			$classes[] = 'edge-menu-area-in-grid-shadow-disable';
		}

		$disable_menu_area_border = adorn_edge_get_meta_field_intersect('menu_area_border',$id) == 'no';
		if($disable_menu_area_border) {
			$classes[] = 'edge-menu-area-border-disable';
		}

		$disable_menu_area_grid_border = adorn_edge_get_meta_field_intersect('menu_area_in_grid_border',$id) == 'no';
		if($disable_menu_area_grid_border) {
			$classes[] = 'edge-menu-area-in-grid-border-disable';
		}

		if(adorn_edge_get_meta_field_intersect('menu_area_in_grid',$id) == 'yes' &&
			adorn_edge_get_meta_field_intersect('menu_area_grid_background_color',$id) !== '' &&
			adorn_edge_get_meta_field_intersect('menu_area_grid_background_transparency',$id) !== '0'){
			$classes[] = 'edge-header-menu-area-in-grid-padding';
		}

		$disable_logo_area_border = adorn_edge_get_meta_field_intersect('logo_area_border',$id) == 'no';
		if($disable_logo_area_border) {
			$classes[] = 'edge-logo-area-border-disable';
		}

		$disable_logo_area_grid_border = adorn_edge_get_meta_field_intersect('logo_area_in_grid_border',$id) == 'no';
		if($disable_logo_area_grid_border) {
			$classes[] = 'edge-logo-area-in-grid-border-disable';
		}

		if(adorn_edge_get_meta_field_intersect('logo_area_in_grid',$id) == 'yes' &&
			adorn_edge_get_meta_field_intersect('logo_area_grid_background_color',$id) !== '' &&
			adorn_edge_get_meta_field_intersect('logo_area_grid_background_transparency',$id) !== '0'){
			$classes[] = 'edge-header-logo-area-in-grid-padding';
		}

		$disable_shadow_vertical = adorn_edge_get_meta_field_intersect('vertical_header_shadow',$id) == 'no';
		if($disable_shadow_vertical) {
			$classes[] = 'edge-header-vertical-shadow-disable';
		}

		$disable_border_vertical = adorn_edge_get_meta_field_intersect('vertical_header_border',$id) == 'no';
		if($disable_border_vertical) {
			$classes[] = 'edge-header-vertical-border-disable';
		}

        return $classes;
    }

    add_filter('body_class', 'adorn_edge_header_class');
}

if(!function_exists('adorn_edge_header_behaviour_class')) {
    /**
     * Function that adds behaviour class to header based on theme options
     * @param array array of classes from main filter
     * @return array array of classes with added behaviour class
     */
    function adorn_edge_header_behaviour_class($classes) {

        $classes[] = 'edge-'.adorn_edge_get_meta_field_intersect('header_behaviour', adorn_edge_get_page_id());

        return $classes;
    }

    add_filter('body_class', 'adorn_edge_header_behaviour_class');
}

if(!function_exists('adorn_edge_mobile_header_class')) {
    function adorn_edge_mobile_header_class($classes) {
        $classes[] = 'edge-default-mobile-header';

        $classes[] = 'edge-sticky-up-mobile-header';

        return $classes;
    }

    add_filter('body_class', 'adorn_edge_mobile_header_class');
}

if(!function_exists('adorn_edge_menu_dropdown_appearance')) {
    /**
     * Function that adds menu dropdown appearance class to body tag
     * @param array array of classes from main filter
     * @return array array of classes with added menu dropdown appearance class
     */
    function adorn_edge_menu_dropdown_appearance($classes) {
		$dropdown_menu_appearance = adorn_edge_options()->getOptionValue('menu_dropdown_appearance');
		
        if($dropdown_menu_appearance !== 'default'){
            $classes[] = 'edge-'.$dropdown_menu_appearance;
        }

        return $classes;
    }

    add_filter('body_class', 'adorn_edge_menu_dropdown_appearance');
}

if (!function_exists('adorn_edge_full_width_wide_menu_class')) {
	/**
	 * @param $classes
	 *
	 * @return array
	 */
	function adorn_edge_full_width_wide_menu_class($classes) {
		if (adorn_edge_get_meta_field_intersect('enable_wide_menu_background',adorn_edge_get_page_id()) === 'yes') {
			$classes[] = 'edge-full-width-wide-menu';
		}

		return $classes;
	}

	add_filter('body_class', 'adorn_edge_full_width_wide_menu_class');
}

if (!function_exists('adorn_edge_header_skin_class')) {

    function adorn_edge_header_skin_class( $classes ) {
        $header_style     = adorn_edge_get_meta_field_intersect('header_style');
	    $header_style_404 = adorn_edge_options()->getOptionValue('404_header_style');
	    
        if(is_404() && !empty($header_style_404)) {
	        $classes[] = 'edge-' . $header_style_404;
        } else if (!empty($header_style)) {
	        $classes[] = 'edge-' . $header_style;
        }

        return $classes;
    }

    add_filter('body_class', 'adorn_edge_header_skin_class');
}

if(!function_exists('adorn_edge_header_global_js_var')) {
    function adorn_edge_header_global_js_var($global_variables) {

        $global_variables['edgeTopBarHeight'] = adorn_edge_get_top_bar_height();
        $global_variables['edgeStickyHeaderHeight'] = adorn_edge_get_sticky_header_height();
        $global_variables['edgeStickyHeaderTransparencyHeight'] = adorn_edge_get_sticky_header_height_of_complete_transparency();

        return $global_variables;
    }

    add_filter('adorn_edge_js_global_variables', 'adorn_edge_header_global_js_var');
}

if(!function_exists('adorn_edge_header_per_page_js_var')) {
    function adorn_edge_header_per_page_js_var($perPageVars) {

        $perPageVars['edgeStickyScrollAmount'] = adorn_edge_get_sticky_scroll_amount();

        return $perPageVars;
    }

    add_filter('adorn_edge_per_page_js_vars', 'adorn_edge_header_per_page_js_var');
}

if(!function_exists('adorn_edge_get_top_bar_styles')) {
	/**
	 * Sets per page styles for header top bar
	 *
	 * @param $styles
	 *
	 * @return array
	 */
	function adorn_edge_get_top_bar_styles($styles) {
		$id            = adorn_edge_get_page_id();

		$class_id = adorn_edge_get_page_id();
		if(adorn_edge_is_woocommerce_installed() && is_product()) {
			$class_id = get_the_ID();
		}
		$class_prefix  = adorn_edge_get_unique_page_class($class_id);

		$top_bar_style = array();

		$top_bar_bg_color = get_post_meta($id, 'edge_top_bar_background_color_meta', true);
		$top_bar_border = get_post_meta($id, 'edge_top_bar_border_meta', true);
		$top_bar_border_color = get_post_meta($id, 'edge_top_bar_border_color_meta', true);

		$current_style = '';

		$top_bar_selector = array(
			$class_prefix.' .edge-top-bar'
		);

		if($top_bar_bg_color !== '') {
			$top_bar_transparency = get_post_meta($id, 'edge_top_bar_background_transparency_meta', true);
			if($top_bar_transparency === '') {
				$top_bar_transparency = 1;
			}
			$top_bar_style['background-color'] = adorn_edge_rgba_color($top_bar_bg_color, $top_bar_transparency);
		}

		if($top_bar_border == 'yes') {
			$top_bar_style['border-bottom'] = '1px solid '.$top_bar_border_color;
		}elseif($top_bar_border == 'no'){
			$top_bar_style['border-bottom'] = '0';
		}

		$current_style  .= adorn_edge_dynamic_css($top_bar_selector, $top_bar_style);

		$current_style = $current_style . $styles;

		return $current_style;
	}

	add_filter('adorn_edge_add_page_custom_style', 'adorn_edge_get_top_bar_styles');
}

if(!function_exists('adorn_edge_top_bar_skin_class')) {
	/**
	 * @param $classes
	 *
	 * @return array
	 */
	function adorn_edge_top_bar_skin_class($classes) {
		$id           = adorn_edge_get_page_id();
		$top_bar_skin = get_post_meta($id, 'edge_top_bar_skin_meta', true);

		if(!empty($top_bar_skin)) {
			$classes[] = 'edge-top-bar-'.$top_bar_skin;
		}

		return $classes;
	}

	add_filter('body_class', 'adorn_edge_top_bar_skin_class');
}

if(!function_exists('adorn_edge_top_bar_grid_class')) {
	/**
	 * @param $classes
	 *
	 * @return array
	 */
	function adorn_edge_top_bar_grid_class($classes) {
		$id = adorn_edge_get_page_id();

		if(adorn_edge_get_meta_field_intersect('top_bar_in_grid', $id) == 'yes' &&
			adorn_edge_options()->getOptionValue('top_bar_grid_background_color') !== '' &&
			adorn_edge_options()->getOptionValue('top_bar_grid_background_transparency') !== '0') {
			$classes[] = 'edge-top-bar-in-grid-padding';
		}
		
		return $classes;
	}

	add_filter('body_class', 'adorn_edge_top_bar_grid_class');
}