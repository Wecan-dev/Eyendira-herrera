<?php
if(!function_exists('adorn_edge_header_top_area_meta_options_map')) {

	function adorn_edge_header_top_area_meta_options_map($header_meta_box){

		$top_header_container = adorn_edge_add_admin_container_no_style(
			array(
				'type'            => 'container',
				'name'            => 'top_header_container',
				'parent'          => $header_meta_box,
				'hidden_property' => 'edge_header_type_meta',
				'hidden_value'    => '',
				'hidden_values'   => array('','header-top-menu','header-vertical','header-vertical-closed')
			));

		adorn_edge_add_admin_section_title(
			array(
				'parent' => $top_header_container,
				'name' => 'top_area_style',
				'title' => esc_html__('Top Area', 'adorn')
			)
		);

		adorn_edge_create_meta_box_field(
			array(
				'name' => 'edge_top_bar_meta',
				'type' => 'select',
				'default_value' => '',
				'label' => esc_html__('Header Top Bar', 'adorn'),
				'description' => esc_html__('Enabling this option will show header top bar area', 'adorn'),
				'parent' => $top_header_container,
				'options' => adorn_edge_get_yes_no_select_array(),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						''    => '#edge_top_bar_container_no_style',
						'no'  => '#edge_top_bar_container_no_style',
						'yes' => ''
					),
					'show'       => array(
						''    => '',
						'no'  => '',
						'yes' => '#edge_top_bar_container_no_style'
					)
				)
			)
		);

		$top_bar_container = adorn_edge_add_admin_container_no_style(array(
			'name'            => 'top_bar_container_no_style',
			'parent'          => $top_header_container,
			'hidden_property' => 'edge_top_bar_meta',
			'hidden_value'    => 'no',
			'hidden_values'   => array('','no')
		));

		adorn_edge_create_meta_box_field(array(
			'name'          => 'edge_top_bar_in_grid_meta',
			'type'          => 'select',
			'label'         => esc_html__('Top Bar In Grid', 'adorn'),
			'description'   => esc_html__('Set top bar content to be in grid', 'adorn'),
			'parent'        => $top_bar_container,
			'default_value' => '',
			'options'       => array(
				''    => '',
				'no'  => esc_html__('No', 'adorn'),
				'yes' => esc_html__('Yes', 'adorn')
			)
		));

		adorn_edge_create_meta_box_field(array(
			'name'    => 'edge_top_bar_skin_meta',
			'type'    => 'select',
			'label'   => esc_html__('Top Bar Skin', 'adorn'),
			'options' => array(
				''      => esc_html__('Default', 'adorn'),
				'light' => esc_html__('White', 'adorn'),
				'dark'  => esc_html__('Black', 'adorn'),
				'gray'  => esc_html__('Gray', 'adorn'),
			),
			'parent'  => $top_bar_container
		));

		adorn_edge_create_meta_box_field(array(
			'name'   => 'edge_top_bar_background_color_meta',
			'type'   => 'color',
			'label'  => esc_html__('Top Bar Background Color', 'adorn'),
			'parent' => $top_bar_container
		));

		adorn_edge_create_meta_box_field(array(
			'name'        => 'edge_top_bar_background_transparency_meta',
			'type'        => 'text',
			'label'       => esc_html__('Top Bar Background Color Transparency', 'adorn'),
			'description' => esc_html__('Set top bar background color transparenct. Value should be between 0 and 1', 'adorn'),
			'parent'      => $top_bar_container,
			'args'        => array(
				'col_width' => 3
			)
		));

		adorn_edge_create_meta_box_field(array(
			'name'          => 'edge_top_bar_border_meta',
			'type'          => 'select',
			'label'         => esc_html__('Top Bar Border', 'adorn'),
			'description'   => esc_html__('Set border on top bar', 'adorn'),
			'parent'        => $top_bar_container,
			'default_value' => '',
			'options'       => array(
				''    => '',
				'no'  => esc_html__('No', 'adorn'),
				'yes' => esc_html__('Yes', 'adorn')
			),
			'args'          => array(
				'dependence' => true,
				'hide'       => array(
					''    => '#edge_top_bar_border_container',
					'no'  => '#edge_top_bar_border_container',
					'yes' => ''
				),
				'show'       => array(
					''    => '',
					'no'  => '',
					'yes' => '#edge_top_bar_border_container'
				)
			)
		));

		$top_bar_border_container = adorn_edge_add_admin_container(array(
			'type'            => 'container',
			'name'            => 'top_bar_border_container',
			'parent'          => $top_bar_container,
			'hidden_property' => 'edge_top_bar_border_meta',
			'hidden_value'    => 'no',
			'hidden_values'   => array('', 'no')
		));

		adorn_edge_create_meta_box_field(array(
			'name'        => 'edge_top_bar_border_color_meta',
			'type'        => 'color',
			'label'       => esc_html__('Border Color', 'adorn'),
			'description' => esc_html__('Choose color for top bar border', 'adorn'),
			'parent'      => $top_bar_border_container
		));
	}
	add_action('adorn_edge_header_top_area_meta_options_map', 'adorn_edge_header_top_area_meta_options_map', 10, 1);
}