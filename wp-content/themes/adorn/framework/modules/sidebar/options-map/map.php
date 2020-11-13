<?php

if ( ! function_exists('adorn_edge_sidebar_options_map') ) {

	function adorn_edge_sidebar_options_map() {

		adorn_edge_add_admin_page(
			array(
				'slug' => '_sidebar_page',
				'title' => esc_html__('Sidebar', 'adorn'),
				'icon' => 'fa fa-search'
			)
		);

		$sidebar_panel = adorn_edge_add_admin_panel(
			array(
				'title' => esc_html__('Sidebar Area', 'adorn'),
				'name' => 'sidebar',
				'page' => '_sidebar_page'
			)
		);
		
		adorn_edge_add_admin_field(array(
			'name'          => 'sidebar_layout',
			'type'          => 'select',
			'label'         => esc_html__('Sidebar Layout', 'adorn'),
			'description'   => esc_html__('Choose a sidebar layout for pages', 'adorn'),
			'parent'        => $sidebar_panel,
			'default_value' => 'no-sidebar',
			'options'       => array(
				'no-sidebar'        => esc_html__('No Sidebar', 'adorn'),
				'sidebar-33-right'	=> esc_html__('Sidebar 1/3 Right', 'adorn'),
				'sidebar-25-right' 	=> esc_html__('Sidebar 1/4 Right', 'adorn'),
				'sidebar-33-left' 	=> esc_html__('Sidebar 1/3 Left', 'adorn'),
				'sidebar-25-left' 	=> esc_html__('Sidebar 1/4 Left', 'adorn')
			)
		));
		
		$adorn_custom_sidebars = adorn_edge_get_custom_sidebars();
		if(count($adorn_custom_sidebars) > 0) {
			adorn_edge_add_admin_field(array(
				'name' => 'custom_sidebar_area',
				'type' => 'selectblank',
				'label' => esc_html__('Sidebar to Display', 'adorn'),
				'description' => esc_html__('Choose a sidebar to display on pages. Default sidebar is "Sidebar"', 'adorn'),
				'parent' => $sidebar_panel,
				'options' => $adorn_custom_sidebars
			));
		}
	}

	add_action('adorn_edge_options_map', 'adorn_edge_sidebar_options_map', 9);
}