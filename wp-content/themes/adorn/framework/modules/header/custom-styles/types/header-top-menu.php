<?php

if(!function_exists('adorn_edge_header_top_menu_logo_area_styles')) {
	/**
	 * Generates styles for menu area
	 */
	function adorn_edge_header_top_menu_logo_area_styles() {


		$menu_area_height = adorn_edge_options()->getOptionValue('menu_area_height');

		if($menu_area_height !== '') {
			echo adorn_edge_dynamic_css('.edge-header-top-menu .edge-page-header .edge-logo-area', array('margin-top' => $menu_area_height.'px'));
		}
	}

	add_action('adorn_edge_style_dynamic', 'adorn_edge_header_top_menu_logo_area_styles');
}