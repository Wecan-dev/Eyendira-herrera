<?php
if(!function_exists('adorn_edge_header_top_options_map')) {

	function adorn_edge_header_top_options_map($panel_header){

		$top_header_container = adorn_edge_add_admin_container_no_style(
			array(
				'type'            => 'container',
				'name'            => 'top_header_container',
				'parent'          => $panel_header,
				'hidden_property' => 'header_type',
				'hidden_value'    => '',
				'hidden_values'   => array('','header-top-menu','header-vertical','header-vertical-closed')
			));

		adorn_edge_add_admin_field(
			array(
				'name'          => 'top_bar',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__('Top Bar', 'adorn'),
				'description'   => esc_html__('Enabling this option will show top bar area', 'adorn'),
				'parent'        => $top_header_container,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#edge_top_bar_container"
				)
			)
		);

		$top_bar_container = adorn_edge_add_admin_container(array(
			'name'            => 'top_bar_container',
			'parent'          => $top_header_container,
			'hidden_property' => 'top_bar',
			'hidden_value'    => 'no'
		));

		adorn_edge_add_admin_field(
			array(
				'parent'        => $top_bar_container,
				'type'          => 'select',
				'name'          => 'top_bar_layout',
				'default_value' => 'two-columns',
				'label'         => esc_html__('Choose top bar layout', 'adorn'),
				'description'   => esc_html__('Select the layout for top bar', 'adorn'),
				'options'       => array(
					'two-columns'   => esc_html__('Two columns', 'adorn'),
					'three-columns' => esc_html__('Three columns', 'adorn')
				),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						'two-columns'   => '#edge_top_bar_layout_container',
						'three-columns' => '#edge_top_bar_two_columns_layout_container'
					),
					'show'       => array(
						'two-columns'   => '#edge_top_bar_two_columns_layout_container',
						'three-columns' => '#edge_top_bar_layout_container'
					)
				)
			)
		);

		$top_bar_layout_container = adorn_edge_add_admin_container(array(
			'name'            => 'top_bar_layout_container',
			'parent'          => $top_bar_container,
			'hidden_property' => 'top_bar_layout',
			'hidden_value'    => '',
			'hidden_values'   => array('two-columns'),
		));

		adorn_edge_add_admin_field(
			array(
				'parent'        => $top_bar_layout_container,
				'type'          => 'select',
				'name'          => 'top_bar_column_widths',
				'default_value' => '30-30-30',
				'label'         => esc_html__('Choose column widths', 'adorn'),
				'description'   => '',
				'options'       => array(
					'30-30-30' => '33% - 33% - 33%',
					'25-50-25' => '25% - 50% - 25%'
				)
			)
		);

		$top_bar_two_columns_layout = adorn_edge_add_admin_container(array(
			'name'            => 'top_bar_two_columns_layout_container',
			'parent'          => $top_bar_container,
			'hidden_property' => 'top_bar_layout',
			'hidden_value'    => '',
			'hidden_values'   => array('three-columns'),
		));

		adorn_edge_add_admin_field(
			array(
				'parent'        => $top_bar_two_columns_layout,
				'type'          => 'select',
				'name'          => 'top_bar_two_column_widths',
				'default_value' => '50-50',
				'label'         => esc_html__('Choose column widths', 'adorn'),
				'description'   => '',
				'options'       => array(
					'50-50' => '50% - 50%',
					'33-66' => '33% - 66%',
					'66-33' => '66% - 33%'
				)
			)
		);

		adorn_edge_add_admin_field(
			array(
				'name'          => 'top_bar_in_grid',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__('Top Bar in grid', 'adorn'),
				'description'   => esc_html__('Set top bar content to be in grid', 'adorn'),
				'parent'        => $top_bar_container,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#edge_top_bar_in_grid_container"
				)
			)
		);

		$top_bar_in_grid_container = adorn_edge_add_admin_container(array(
			'name'            => 'top_bar_in_grid_container',
			'parent'          => $top_bar_container,
			'hidden_property' => 'top_bar_in_grid',
			'hidden_value'    => 'no'
		));

		adorn_edge_add_admin_field(array(
			'name'        => 'top_bar_grid_background_color',
			'type'        => 'color',
			'label'       => esc_html__('Grid Background Color', 'adorn'),
			'description' => esc_html__('Set grid background color for top bar', 'adorn'),
			'parent'      => $top_bar_in_grid_container
		));


		adorn_edge_add_admin_field(array(
			'name'        => 'top_bar_grid_background_transparency',
			'type'        => 'text',
			'label'       => esc_html__('Grid Background Transparency', 'adorn'),
			'description' => esc_html__('Set grid background transparency for top bar', 'adorn'),
			'parent'      => $top_bar_in_grid_container,
			'args'        => array('col_width' => 3)
		));

		adorn_edge_add_admin_field(array(
			'name'        => 'top_bar_background_color',
			'type'        => 'color',
			'label'       => esc_html__('Background Color', 'adorn'),
			'description' => esc_html__('Set background color for top bar', 'adorn'),
			'parent'      => $top_bar_container
		));

		adorn_edge_add_admin_field(array(
			'name'        => 'top_bar_background_transparency',
			'type'        => 'text',
			'label'       => esc_html__('Background Transparency', 'adorn'),
			'description' => esc_html__('Set background transparency for top bar', 'adorn'),
			'parent'      => $top_bar_container,
			'args'        => array('col_width' => 3)
		));

		adorn_edge_add_admin_field(
			array(
				'name'          => 'top_bar_border',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__('Top Bar Border', 'adorn'),
				'description'   => esc_html__('Set top bar border', 'adorn'),
				'parent'        => $top_bar_container,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#edge_top_bar_border_container"
				)
			)
		);

		$top_bar_border_container = adorn_edge_add_admin_container(array(
			'name'            => 'top_bar_border_container',
			'parent'          => $top_bar_container,
			'hidden_property' => 'top_bar_border',
			'hidden_value'    => 'no'
		));

		adorn_edge_add_admin_field(array(
			'name'        => 'top_bar_border_color',
			'type'        => 'color',
			'label'       => esc_html__('Top Bar Border', 'adorn'),
			'description' => esc_html__('Set border color for top bar', 'adorn'),
			'parent'      => $top_bar_border_container
		));

		adorn_edge_add_admin_field(array(
			'name'        => 'top_bar_height',
			'type'        => 'text',
			'label'       => esc_html__('Top bar height', 'adorn'),
			'description' => esc_html__('Enter top bar height (Default is 36px)', 'adorn'),
			'parent'      => $top_bar_container,
			'args'        => array(
				'col_width' => 2,
				'suffix'    => 'px'
			)
		));

	}

	add_action('adorn_edge_header_top_options_map', 'adorn_edge_header_top_options_map', 10, 1);
}