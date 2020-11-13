<?php
if(!function_exists('adorn_edge_header_logo_area_options_map')) {

	function adorn_edge_header_logo_area_options_map($panel_header){

		$logo_area_container = adorn_edge_add_admin_container_no_style(
			array(
				'parent'          => $panel_header,
				'name'            => 'logo_area_container',
				'hidden_property' => 'header_type',
				'hidden_values'   => array('header-standard','header-minimal','header-divided','header-vertical','header-vertical-closed')
			)
		);

		adorn_edge_add_admin_section_title(
			array(
				'parent' => $logo_area_container,
				'name'   => 'logo_menu_area_title',
				'title'  => esc_html__('Logo Area', 'adorn')
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent'        => $logo_area_container,
				'type'          => 'yesno',
				'name'          => 'logo_area_in_grid',
				'default_value' => 'no',
				'label'         => esc_html__('Logo Area In Grid', 'adorn'),
				'description'   => esc_html__('Set menu area content to be in grid', 'adorn'),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#edge_logo_area_in_grid_container'
				)
			)
		);

		$logo_area_in_grid_container = adorn_edge_add_admin_container(
			array(
				'parent'          => $logo_area_container,
				'name'            => 'logo_area_in_grid_container',
				'hidden_property' => 'logo_area_in_grid',
				'hidden_value'    => 'no'
			)
		);

			adorn_edge_add_admin_field(
				array(
					'parent'        => $logo_area_in_grid_container,
					'type'          => 'color',
					'name'          => 'logo_area_grid_background_color',
					'default_value' => '',
					'label'         => esc_html__('Grid Background Color', 'adorn'),
					'description'   => esc_html__('Set grid background color for logo area', 'adorn'),
				)
			);

			adorn_edge_add_admin_field(
				array(
					'parent'        => $logo_area_in_grid_container,
					'type'          => 'text',
					'name'          => 'logo_area_grid_background_transparency',
					'default_value' => '',
					'label'         => esc_html__('Grid Background Transparency', 'adorn'),
					'description'   => esc_html__('Set grid background transparency', 'adorn'),
					'args'          => array(
						'col_width' => 3
					)
				)
			);

			adorn_edge_add_admin_field(
				array(
					'parent'        => $logo_area_in_grid_container,
					'type'          => 'yesno',
					'name'          => 'logo_area_in_grid_border',
					'default_value' => 'no',
					'label'         => esc_html__('Grid Area Border', 'adorn'),
					'description'   => esc_html__('Set border on grid area', 'adorn'),
					'args'          => array(
						'dependence'             => true,
						'dependence_hide_on_yes' => '',
						'dependence_show_on_yes' => '#edge_logo_area_in_grid_border_container'
					)
				)
			);

			$logo_area_in_grid_border_container = adorn_edge_add_admin_container(
				array(
					'parent'          => $logo_area_in_grid_container,
					'name'            => 'logo_area_in_grid_border_container',
					'hidden_property' => 'logo_area_in_grid_border',
					'hidden_value'    => 'no'
				)
			);

				adorn_edge_add_admin_field(
					array(
						'parent'        => $logo_area_in_grid_border_container,
						'type'          => 'color',
						'name'          => 'logo_area_in_grid_border_color',
						'default_value' => '',
						'label'         => esc_html__('Border Color', 'adorn'),
						'description'   => esc_html__('Set border color for grid area', 'adorn'),
					)
				);

		adorn_edge_add_admin_field(
			array(
				'parent'        => $logo_area_container,
				'type'          => 'color',
				'name'          => 'logo_area_background_color',
				'default_value' => '',
				'label'         => esc_html__('Background color', 'adorn'),
				'description'   => esc_html__('Set background color for logo area', 'adorn')
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent'        => $logo_area_container,
				'type'          => 'text',
				'name'          => 'logo_area_background_transparency',
				'default_value' => '',
				'label'         => esc_html__('Background transparency', 'adorn'),
				'description'   => esc_html__('Set background transparency for logo area', 'adorn'),
				'args'          => array(
					'col_width' => 3
				)
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent'        => $logo_area_container,
				'type'          => 'yesno',
				'name'          => 'logo_area_border',
				'default_value' => 'no',
				'label'         => esc_html__('Logo Area Border', 'adorn'),
				'description'   => esc_html__('Set border on logo area', 'adorn'),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#edge_logo_area_border_container'
				)
			)
		);

		$logo_area_border_container = adorn_edge_add_admin_container(
			array(
				'parent'          => $logo_area_container,
				'name'            => 'logo_area_border_container',
				'hidden_property' => 'logo_area_border',
				'hidden_value'    => 'no'
			)
		);

			adorn_edge_add_admin_field(
				array(
					'parent'        => $logo_area_border_container,
					'type'          => 'color',
					'name'          => 'logo_area_border_color',
					'default_value' => '',
					'label'         => esc_html__('Border Color', 'adorn'),
					'description'   => esc_html__('Set border color for logo area', 'adorn'),
				)
			);

		adorn_edge_add_admin_field(
			array(
				'parent'        => $logo_area_container,
				'type'          => 'text',
				'name'          => 'logo_area_height',
				'default_value' => '',
				'label'         => esc_html__('Height', 'adorn'),
				'description'   => esc_html__('Enter logo area height (default is 90px)', 'adorn'),
				'args'          => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);

		do_action('adorn_edge_header_logo_area_additional_options', $logo_area_container);
	}

	add_action('adorn_edge_header_logo_area_options_map', 'adorn_edge_header_logo_area_options_map', 10, 1);
}