<?php
if(!function_exists('adorn_edge_header_logo_area_meta_options_map')) {

	function adorn_edge_header_logo_area_meta_options_map($header_meta_box){
		$logo_area_container = adorn_edge_add_admin_container_no_style(
			array(
				'type'            => 'container',
				'name'            => 'logo_area_container',
				'parent'          => $header_meta_box,
				'hidden_property' => 'edge_header_type_meta',
				'hidden_value'    => '',
				'hidden_values'   => array('','header-standard','header-minimal','header-divided','header-vertical','header-vertical-closed')
			));


		adorn_edge_add_admin_section_title(
			array(
				'parent' => $logo_area_container,
				'name' => 'logo_area_style',
				'title' => esc_html__('Logo Area Style', 'adorn')
			)
		);

		adorn_edge_create_meta_box_field(
			array(
				'name' => 'edge_disable_header_widget_logo_area_meta',
				'type' => 'yesno',
				'default_value' => 'no',
				'label' => esc_html__('Disable Header Logo Area Widget', 'adorn'),
				'description' => esc_html__('Enabling this option will hide widget area from the logo area', 'adorn'),
				'parent' => $logo_area_container
			)
		);

		$adorn_custom_sidebars = adorn_edge_get_custom_sidebars();
		if(count($adorn_custom_sidebars) > 0) {
			adorn_edge_create_meta_box_field(array(
				'name' => 'edge_custom_logo_area_sidebar_meta',
				'type' => 'selectblank',
				'label' => esc_html__('Choose Custom Widget Area for Logo Area', 'adorn'),
				'description' => esc_html__('Choose custom widget area to display in header logo area"', 'adorn'),
				'parent' => $logo_area_container,
				'options' => $adorn_custom_sidebars
			));
		}

		adorn_edge_create_meta_box_field(array(
			'name'          => 'edge_logo_area_in_grid_meta',
			'type'          => 'select',
			'label'         => esc_html__('Logo Area In Grid', 'adorn'),
			'description'   => esc_html__('Set menu area content to be in grid', 'adorn'),
			'parent'        => $logo_area_container,
			'default_value' => '',
			'options'       => array(
				''    => esc_html__('Default', 'adorn'),
				'no'  => esc_html__('No', 'adorn'),
				'yes' => esc_html__('Yes', 'adorn')
			),
			'args'          => array(
				'dependence' => true,
				'hide'       => array(
					''    => '#edge_logo_area_in_grid_container',
					'no'  => '#edge_logo_area_in_grid_container',
					'yes' => ''
				),
				'show'       => array(
					''    => '',
					'no'  => '',
					'yes' => '#edge_logo_area_in_grid_container'
				)
			)
		));

		$logo_area_in_grid_container = adorn_edge_add_admin_container(array(
			'type'            => 'container',
			'name'            => 'logo_area_in_grid_container',
			'parent'          => $logo_area_container,
			'hidden_property' => 'edge_logo_area_in_grid_meta',
			'hidden_value'    => 'no',
			'hidden_values'   => array('', 'no')
		));


		adorn_edge_create_meta_box_field(
			array(
				'name'        => 'edge_logo_area_grid_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__('Grid Background Color', 'adorn'),
				'description' => esc_html__('Set grid background color for logo area', 'adorn'),
				'parent'      => $logo_area_in_grid_container
			)
		);

		adorn_edge_create_meta_box_field(
			array(
				'name'        => 'edge_logo_area_grid_background_transparency_meta',
				'type'        => 'text',
				'label'       => esc_html__('Grid Background Transparency', 'adorn'),
				'description' => esc_html__('Set grid background transparency for logo area (0 = fully transparent, 1 = opaque)', 'adorn'),
				'parent'      => $logo_area_in_grid_container,
				'args'        => array(
					'col_width' => 2
				)
			)
		);

		adorn_edge_create_meta_box_field(array(
			'name'          => 'edge_logo_area_in_grid_border_meta',
			'type'          => 'select',
			'label'         => esc_html__('Grid Area Border', 'adorn'),
			'description'   => esc_html__('Set border on grid logo area', 'adorn'),
			'parent'        => $logo_area_in_grid_container,
			'default_value' => '',
			'options'       => array(
				''    => '',
				'no'  => esc_html__('No', 'adorn'),
				'yes' => esc_html__('Yes', 'adorn')
			),
			'args'          => array(
				'dependence' => true,
				'hide'       => array(
					''    => '#edge_logo_area_in_grid_border_container',
					'no'  => '#edge_logo_area_in_grid_border_container',
					'yes' => ''
				),
				'show'       => array(
					''    => '',
					'no'  => '',
					'yes' => '#edge_logo_area_in_grid_border_container'
				)
			)
		));

		$logo_area_in_grid_border_container = adorn_edge_add_admin_container(array(
			'type'            => 'container',
			'name'            => 'logo_area_in_grid_border_container',
			'parent'          => $logo_area_in_grid_container,
			'hidden_property' => 'edge_logo_area_in_grid_border_meta',
			'hidden_value'    => 'no',
			'hidden_values'   => array('', 'no')
		));

		adorn_edge_create_meta_box_field(array(
			'name'        => 'edge_logo_area_in_grid_border_color_meta',
			'type'        => 'color',
			'label'       => esc_html__('Border Color', 'adorn'),
			'description' => esc_html__('Set border color for grid area', 'adorn'),
			'parent'      => $logo_area_in_grid_border_container
		));


		adorn_edge_create_meta_box_field(
			array(
				'name'        => 'edge_logo_area_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__('Background Color', 'adorn'),
				'description' => esc_html__('Choose a background color for logo area', 'adorn'),
				'parent'      => $logo_area_container
			)
		);

		adorn_edge_create_meta_box_field(
			array(
				'name'        => 'edge_logo_area_background_transparency_meta',
				'type'        => 'text',
				'label'       => esc_html__('Transparency', 'adorn'),
				'description' => esc_html__('Choose a transparency for the logo area background color (0 = fully transparent, 1 = opaque)', 'adorn'),
				'parent'      => $logo_area_container,
				'args'        => array(
					'col_width' => 2
				)
			)
		);

		adorn_edge_create_meta_box_field(array(
			'name'          => 'edge_logo_area_border_meta',
			'type'          => 'select',
			'label'         => esc_html__('Logo Area Border', 'adorn'),
			'description'   => esc_html__('Set border on logo area', 'adorn'),
			'parent'        => $logo_area_container,
			'default_value' => '',
			'options'       => array(
				''    => '',
				'no'  => esc_html__('No', 'adorn'),
				'yes' => esc_html__('Yes', 'adorn')
			),
			'args'          => array(
				'dependence' => true,
				'hide'       => array(
					''    => '#edge_logo_area_border_bottom_color_container',
					'no'  => '#edge_logo_area_border_bottom_color_container',
					'yes' => ''
				),
				'show'       => array(
					''    => '',
					'no'  => '',
					'yes' => '#edge_logo_area_border_bottom_color_container'
				)
			)
		));

		$logo_area_border_bottom_color_container = adorn_edge_add_admin_container(array(
			'type'            => 'container',
			'name'            => 'logo_area_border_bottom_color_container',
			'parent'          => $logo_area_container,
			'hidden_property' => 'edge_logo_area_border_meta',
			'hidden_value'    => 'no',
			'hidden_values'   => array('', 'no')
		));

		adorn_edge_create_meta_box_field(array(
			'name'        => 'edge_logo_area_border_color_meta',
			'type'        => 'color',
			'label'       => esc_html__('Border Color', 'adorn'),
			'description' => esc_html__('Choose color of header bottom border', 'adorn'),
			'parent'      => $logo_area_border_bottom_color_container
		));

		do_action('adorn_edge_header_logo_area_additional_meta_options',$logo_area_container);
	}
	add_action('adorn_edge_header_logo_area_meta_options_map', 'adorn_edge_header_logo_area_meta_options_map', 10, 1);
}