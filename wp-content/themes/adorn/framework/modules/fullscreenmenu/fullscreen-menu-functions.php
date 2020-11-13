<?php

if(!function_exists('adorn_edge_register_full_screen_menu_nav')) {
    function adorn_edge_register_full_screen_menu_nav() {
	    register_nav_menus(
		    array(
			    'popup-navigation' => esc_html__('Fullscreen Navigation', 'adorn')
		    )
	    );
    }

	add_action('after_setup_theme', 'adorn_edge_register_full_screen_menu_nav');
}

if ( !function_exists('adorn_edge_register_full_screen_menu_sidebars') ) {

	function adorn_edge_register_full_screen_menu_sidebars() {

		register_sidebar(array(
			'name' => esc_html__('Fullscreen Menu Top', 'adorn'),
			'id' => 'fullscreen_menu_above',
			'description' => esc_html__('This widget area is rendered above fullscreen menu', 'adorn'),
			'before_widget' => '<div class="%2$s edge-fullscreen-menu-above-widget">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="edge-fullscreen-widget-title">',
			'after_title' => '</h4>'
		));

		register_sidebar(array(
			'name' => esc_html__('Fullscreen Menu Bottom', 'adorn'),
			'id' => 'fullscreen_menu_below',
			'description' => esc_html__('This widget area is rendered below fullscreen menu', 'adorn'),
			'before_widget' => '<div class="%2$s edge-fullscreen-menu-below-widget">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="edge-fullscreen-widget-title">',
			'after_title' => '</h4>'
		));
	}

	add_action('widgets_init', 'adorn_edge_register_full_screen_menu_sidebars');
}

if(!function_exists('adorn_edge_fullscreen_menu_body_class')) {
	/**
	 * Function that adds body classes for different full screen menu types
	 *
	 * @param $classes array original array of body classes
	 *
	 * @return array modified array of classes
	 */
	function adorn_edge_fullscreen_menu_body_class($classes) {

		if ( adorn_edge_get_meta_field_intersect('header_type') == 'header-minimal') {

			$classes[] = 'edge-' . adorn_edge_options()->getOptionValue('fullscreen_menu_animation_style');
		}

		return $classes;
	}

	add_filter('body_class', 'adorn_edge_fullscreen_menu_body_class');
}

if ( !function_exists('adorn_edge_get_full_screen_menu') ) {
	/**
	 * Loads fullscreen menu HTML template
	 */
	function adorn_edge_get_full_screen_menu() {

		if ( adorn_edge_get_meta_field_intersect('header_type') == 'header-minimal') {

			$parameters = array(
				'fullscreen_menu_in_grid' => adorn_edge_options()->getOptionValue('fullscreen_in_grid') === 'yes' ? true : false
			);

			adorn_edge_get_module_template_part('templates/fullscreen-menu', 'fullscreenmenu', '', $parameters);
		}
	}
	
	add_action('adorn_edge_after_header_area', 'adorn_edge_get_full_screen_menu', 10);
}