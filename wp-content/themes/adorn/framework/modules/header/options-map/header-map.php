<?php

foreach(glob(EDGE_FRAMEWORK_MODULES_ROOT_DIR.'/header/options-map/*/*.php') as $options_load) {
	include_once $options_load;
}

if ( ! function_exists('adorn_edge_header_options_map') ) {

	function adorn_edge_header_options_map() {

		adorn_edge_add_admin_page(
			array(
				'slug' => '_header_page',
				'title' => esc_html__('Header', 'adorn'),
				'icon' => 'fa fa-header'
			)
		);

		$panel_header = adorn_edge_add_admin_panel(
			array(
				'page' => '_header_page',
				'name' => 'panel_header',
				'title' => esc_html__('Header', 'adorn')
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $panel_header,
				'type' => 'radiogroup',
				'name' => 'header_type',
				'default_value' => 'header-standard',
				'label' => esc_html__('Choose Header Type', 'adorn'),
				'description' => esc_html__('Select the type of header you would like to use', 'adorn'),
				'options' => array(
					'header-standard'          => array(
						'image' => EDGE_FRAMEWORK_ROOT.'/admin/assets/img/header-standard.png',
						'label' => esc_html__('Standard', 'adorn')
					),
					'header-minimal'           => array(
						'image' => EDGE_FRAMEWORK_ROOT.'/admin/assets/img/header-minimal.png',
						'label' => esc_html__('Minimal', 'adorn')
					),
					'header-divided'           => array(
						'image' => EDGE_FRAMEWORK_ROOT.'/admin/assets/img/header-divided.png',
						'label' => esc_html__('Divided', 'adorn')
					),
					'header-centered'          => array(
						'image' => EDGE_FRAMEWORK_ROOT.'/admin/assets/img/header-centered.png',
						'label' => esc_html__('Centered', 'adorn')
					),
					'header-vertical'          => array(
						'image' => EDGE_FRAMEWORK_ROOT.'/admin/assets/img/header-vertical.png',
						'label' => esc_html__('Vertical', 'adorn')
					)
				),
				'args' => array(
					'use_images' => true,
					'hide_labels' => true,
					'dependence' => true,
					'show' => array(
						'header-standard'          => '#edge_top_header_container,#edge_header_behaviour,#edge_menu_area_container,#edge_panel_main_menu,#edge_panel_sticky_header,#edge_panel_fixed_header,#edge_menu_area_position_header_standard_container',
						'header-standard-extended' => '#edge_top_header_container,#edge_header_behaviour,#edge_menu_area_container,#edge_logo_area_container,#edge_panel_main_menu,#edge_panel_sticky_header,#edge_panel_fixed_header',
						'header-minimal'           => '#edge_top_header_container,#edge_header_behaviour,#edge_menu_area_container,#edge_panel_fullscreen_menu,#edge_panel_main_menu,#edge_panel_sticky_header,#edge_panel_fixed_header',
						'header-divided'           => '#edge_top_header_container,#edge_header_behaviour,#edge_menu_area_container,#edge_panel_main_menu,#edge_panel_sticky_header,#edge_panel_fixed_header',
						'header-centered'          => '#edge_top_header_container,#edge_header_behaviour,#edge_menu_area_container,#edge_logo_area_container,#edge_logo_wrapper_padding_header_centered,#edge_panel_main_menu,#edge_panel_sticky_header,#edge_panel_fixed_header',
						'header-top-menu'		   => '#edge_menu_area_container,#edge_logo_area_container,#edge_panel_main_menu',
						'header-vertical'          => '#edge_vertical_area_container,#edge_panel_vertical_main_menu',
						'header-vertical-closed'   => '#edge_vertical_area_container,#edge_panel_vertical_main_menu',
					),
					'hide' => array(
						'header-standard'          => '#edge_logo_area_container,#edge_panel_fullscreen_menu,#edge_logo_wrapper_padding_header_centered,#edge_vertical_area_container,#edge_panel_vertical_main_menu',
						'header-standard-extended' => '#edge_panel_fullscreen_menu,#edge_logo_wrapper_padding_header_centered,#edge_vertical_area_container,#edge_panel_vertical_main_menu,#edge_menu_area_position_header_standard_container',
						'header-minimal'           => '#edge_logo_area_container,#edge_logo_wrapper_padding_header_centered,#edge_vertical_area_container,#edge_panel_vertical_main_menu,#edge_menu_area_position_header_standard_container',
						'header-divided'           => '#edge_logo_area_container,#edge_panel_fullscreen_menu,#edge_logo_wrapper_padding_header_centered,#edge_vertical_area_container,#edge_panel_vertical_main_menu,#edge_menu_area_position_header_standard_container',
						'header-centered'          => '#edge_panel_fullscreen_menu,#edge_vertical_area_container,#edge_panel_vertical_main_menu,#edge_menu_area_position_header_standard_container',
						'header-top-menu'		   => '#edge_top_header_container,#edge_panel_fullscreen_menu,#edge_vertical_area_container,#edge_panel_vertical_main_menu,#edge_logo_wrapper_padding_header_centered,#edge_header_behaviour,#edge_panel_sticky_header,#edge_panel_fixed_header,#edge_menu_area_position_header_standard_container',
						'header-vertical'          => '#edge_top_header_container,#edge_header_behaviour,#edge_menu_area_container,#edge_logo_area_container,#edge_panel_fullscreen_menu,#edge_logo_wrapper_padding_header_centered,#edge_panel_main_menu,#edge_panel_sticky_header,#edge_panel_fixed_header',
						'header-vertical-closed'  => '#edge_top_header_container,#edge_header_behaviour,#edge_menu_area_container,#edge_logo_area_container,#edge_panel_fullscreen_menu,#edge_logo_wrapper_padding_header_centered,#edge_panel_main_menu,#edge_panel_sticky_header,#edge_panel_fixed_header',
					)
				)
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $panel_header,
				'type' => 'select',
				'name' => 'header_behaviour',
				'default_value' => 'fixed-on-scroll',
				'label' => esc_html__('Choose Header Behaviour', 'adorn'),
				'description' => esc_html__('Select the behaviour of header when you scroll down to page', 'adorn'),
				'options' => array(
					'sticky-header-on-scroll-up' => esc_html__('Sticky on scroll up', 'adorn'),
					'sticky-header-on-scroll-down-up' => esc_html__('Sticky on scroll up/down', 'adorn'),
					'fixed-on-scroll' => esc_html__('Fixed on scroll', 'adorn')
				),
                'hidden_property' => 'header_type',
                'hidden_values' => array('header-vertical','header-vertical-closed','header-top-menu')
			)
		);

		/***************** Top Header Layout - start **********************/

		do_action('adorn_edge_header_top_options_map', $panel_header);

		/***************** Top Header Layout - end **********************/
		
		/***************** Header Skin Options -start ********************/
		
			adorn_edge_add_admin_field(
				array(
					'parent' => $panel_header,
					'type' => 'select',
					'name' => 'header_style',
					'default_value' => '',
					'label' => esc_html__('Header Skin', 'adorn'),
					'description' => esc_html__('Choose a predefined header style for header elements (logo, main menu, side menu opener...)', 'adorn'),
					'options' => array(
						'' => esc_html__('Default', 'adorn'),
						'light-header' => esc_html__('Light', 'adorn'),
						'dark-header' => esc_html__('Dark', 'adorn')
					)
				)
			);
		/***************** Header Skin Options - end ********************/

		/***************** Logo Area Style - start **********************/
		do_action('adorn_edge_header_logo_area_options_map', $panel_header);
		/***************** Logo Area Style - end **********************/

		/***************** Menu Area Style - start **********************/
		do_action('adorn_edge_header_menu_area_options_map', $panel_header);
		/***************** Menu Area Style - end **********************/

		/***************** Vertical Header Layout *****************/
		do_action('adorn_edge_header_vertical_options_map', $panel_header);
		/***************** Vertical Header Layout *****************/

		/***************** Full Screen Menu Style - start **********************/
		do_action('adorn_edge_header_options_map');
		/***************** Full Screen Menu Style - end **********************/

        /***************** Sticky Header Layout *******************/
		do_action('adorn_edge_header_sticky_options_map');
		/***************** Sticky Header Layout *******************/	

		/***************** Fixed Header Layout ********************/
		do_action('adorn_edge_header_fixed_options_map');
		/***************** Fixed Header Layout ********************/	

		/******************* Main Menu Layout *********************/
		do_action('adorn_edge_header_main_navigation_options_map');
        /******************* Main Menu Layout *********************/

		/****************** Vertical Main Menu Layout ********************/
		do_action('adorn_edge_header_vertical_navigation_options_map');
		/****************** Vertical Main Menu Layout ********************/

	}

	add_action( 'adorn_edge_options_map', 'adorn_edge_header_options_map', 4);
}