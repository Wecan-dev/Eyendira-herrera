<?php

if(!function_exists('adorn_edge_register_top_header_areas')) {
    /**
     * Registers widget areas for top header bar when it is enabled
     */
    function adorn_edge_register_top_header_areas() {

        register_sidebar(array(
            'name'          => esc_html__('Top Bar Left Column', 'adorn'),
            'id'            => 'edge-top-bar-left',
            'before_widget' => '<div id="%1$s" class="widget %2$s edge-top-bar-widget">',
            'after_widget'  => '</div>',
            'description'   => esc_html__('Widgets added here will appear on the left side in top bar header', 'adorn')
        ));

        register_sidebar(array(
            'name'          => esc_html__('Top Bar Middle Column', 'adorn'),
            'id'            => 'edge-top-bar-center',
            'before_widget' => '<div id="%1$s" class="widget %2$s edge-top-bar-widget">',
            'after_widget'  => '</div>',
            'description'   => esc_html__('Widgets added here will appear on the middle side in top bar header', 'adorn')
        ));

        register_sidebar(array(
            'name'          => esc_html__('Top Bar Right Column', 'adorn'),
            'id'            => 'edge-top-bar-right',
            'before_widget' => '<div id="%1$s" class="widget %2$s edge-top-bar-widget">',
            'after_widget'  => '</div>',
            'description'   => esc_html__('Widgets added here will appear on the right side in top bar header', 'adorn')
        ));
    }

    add_action('widgets_init', 'adorn_edge_register_top_header_areas');
}

if(!function_exists('adorn_edge_header_widget_areas')) {
    /**
     * Registers widget areas for header types
     */
    function adorn_edge_header_standard_widget_areas() {
		register_sidebar(array(
			'name'          => esc_html__('Header Widget Logo Area', 'adorn'),
			'id'            => 'edge-header-widget-logo-area',
			'before_widget' => '<div id="%1$s" class="widget %2$s edge-header-widget-logo-area">',
			'after_widget'  => '</div>',
			'description'   => esc_html__('Widgets added here will appear in the logo area', 'adorn')
		));

		if( adorn_edge_core_plugin_installed() ) {
			register_sidebar(array(
				'name' => esc_html__('Header Widget Menu Area Right', 'adorn'),
				'id' => 'edge-header-widget-menu-area',
				'before_widget' => '<div id="%1$s" class="widget %2$s edge-header-widget-menu-area">',
				'after_widget' => '</div>',
				'description' => esc_html__('Widgets added here will appear in the menu area', 'adorn')
			));
			register_sidebar(array(
				'name' => esc_html__('Header Widget Menu Area Left', 'adorn'),
				'id' => 'edge-header-widget-menu-area-left',
				'before_widget' => '<div id="%1$s" class="widget %2$s edge-header-widget-menu-area">',
				'after_widget' => '</div>',
				'description' => esc_html__('Widgets added here will appear on the left side in the menu area of Centered Header', 'adorn')
			));
		}
    }

    add_action('widgets_init', 'adorn_edge_header_standard_widget_areas');
}

if(!function_exists('adorn_edge_header_vertical_widget_top_areas')) {
    /**
     * Registers widget areas for vertical header
     */
    function adorn_edge_header_vertical_widget_top_areas() {
        register_sidebar(array(
            'name'          => esc_html__('Vertical Area Top', 'adorn'),
            'id'            => 'edge-vertical-area-top',
            'before_widget' => '<div id="%1$s" class="widget %2$s edge-vertical-area-widget-top">',
            'after_widget'  => '</div>',
            'description'   => esc_html__('Widgets added here will appear bellow menu items', 'adorn')
        ));
    }

    add_action('widgets_init', 'adorn_edge_header_vertical_widget_top_areas');
}

if(!function_exists('adorn_edge_header_vertical_widget_areas')) {
	/**
	 * Registers widget areas for vertical header
	 */
	function adorn_edge_header_vertical_widget_areas() {
		register_sidebar(array(
			'name'          => esc_html__('Vertical Area', 'adorn'),
			'id'            => 'edge-vertical-area',
			'before_widget' => '<div id="%1$s" class="widget %2$s edge-vertical-area-widget">',
			'after_widget'  => '</div>',
			'description'   => esc_html__('Widgets added here will appear on the bottom of vertical menu', 'adorn')
		));
	}

	add_action('widgets_init', 'adorn_edge_header_vertical_widget_areas');
}

if(!function_exists('adorn_edge_register_mobile_header_areas')) {
    /**
     * Registers widget areas for mobile header
     */
    function adorn_edge_register_mobile_header_areas() {
        if(adorn_edge_is_responsive_on()) {
            register_sidebar(array(
                'name'          => esc_html__('Mobile Header Widget Area', 'adorn'),
                'id'            => 'edge-mobile-menu-bottom',
                'before_widget' => '<div id="%1$s" class="widget %2$s edge-mobile-menu-bottom">',
                'after_widget'  => '</div>',
                'description'   => esc_html__('Widgets added here will appear on the bottom of mobile menu area', 'adorn')
            ));
        }
    }

    add_action('widgets_init', 'adorn_edge_register_mobile_header_areas');
}

if(!function_exists('adorn_edge_register_sticky_header_areas')) {
    /**
     * Registers widget area for sticky header
     */
    function adorn_edge_register_sticky_header_areas() {
		$id = adorn_edge_get_page_id();

        if(in_array(adorn_edge_get_meta_field_intersect('header_behaviour',$id), array('sticky-header-on-scroll-up','sticky-header-on-scroll-down-up'))) {
            register_sidebar(array(
                'name'          => esc_html__('Sticky Header Widget Area', 'adorn'),
                'id'            => 'edge-sticky-right',
                'before_widget' => '<div id="%1$s" class="widget %2$s edge-sticky-right">',
                'after_widget'  => '</div>',
                'description'   => esc_html__('Widgets added here will appear on the right hand side from the sticky menu', 'adorn')
            ));
        }
    }

    add_action('widgets_init', 'adorn_edge_register_sticky_header_areas');
}