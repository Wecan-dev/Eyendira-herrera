<?php

if ( ! function_exists('adorn_edge_content_bottom_options_map') ) {

	function adorn_edge_content_bottom_options_map() {
		/***************** Content Bottom Layout - begin **********************/

		adorn_edge_add_admin_page(
			array(
				'slug'  => '_content_bottom_page',
				'title' => esc_html__('Content Bottom', 'adorn'),
				'icon'  => 'fa fa-file-text-o'
			)
		);

		$panel_content_bottom = adorn_edge_add_admin_panel(
			array(
				'page'  => '_content_bottom_page',
				'name'  => 'panel_content_bottom',
				'title' => esc_html__('Content Bottom Area Style', 'adorn')
			)
		);

		adorn_edge_add_admin_field(array(
			'name'          => 'enable_content_bottom_area',
			'type'          => 'yesno',
			'default_value' => 'no',
			'label'         => esc_html__('Enable Content Bottom Area', 'adorn'),
			'description'   => esc_html__('This option will enable Content Bottom area on pages', 'adorn'),
			'args'          => array(
				'dependence' => true,
				'dependence_hide_on_yes' => '',
				'dependence_show_on_yes' => '#edge_enable_content_bottom_area_container'
			),
			'parent'        => $panel_content_bottom
		));

		$enable_content_bottom_area_container = adorn_edge_add_admin_container(
			array(
				'parent'            => $panel_content_bottom,
				'name'              => 'enable_content_bottom_area_container',
				'hidden_property'   => 'enable_content_bottom_area',
				'hidden_value'      => 'no'
			)
		);

		$adorn_custom_sidebars = adorn_edge_get_custom_sidebars();

		adorn_edge_add_admin_field(array(
			'type'          => 'selectblank',
			'name'          => 'content_bottom_sidebar_custom_display',
			'default_value' => '',
			'label'         => esc_html__('Widget Area to Display', 'adorn'),
			'description'   => esc_html__('Choose a Content Bottom widget area to display', 'adorn'),
			'options'       => $adorn_custom_sidebars,
			'parent'        => $enable_content_bottom_area_container
		));

		adorn_edge_add_admin_field(array(
			'type'          => 'yesno',
			'name'          => 'content_bottom_in_grid',
			'default_value' => 'yes',
			'label'         => esc_html__('Display in Grid', 'adorn'),
			'description'   => esc_html__('Enabling this option will place Content Bottom in grid', 'adorn'),
			'parent'        => $enable_content_bottom_area_container
		));

		adorn_edge_add_admin_field(array(
			'type'          => 'color',
			'name'          => 'content_bottom_background_color',
			'label'         => esc_html__('Background Color', 'adorn'),
			'description'   => esc_html__('Choose a background color for Content Bottom area', 'adorn'),
			'parent'        => $enable_content_bottom_area_container
		));

		/***************** Content Bottom Layout - end **********************/
	}
	add_action( 'adorn_edge_options_map', 'adorn_edge_content_bottom_options_map', 7);
}