<?php
if(!function_exists('adorn_edge_header_vertical_area_meta_options_map')) {

	function adorn_edge_header_vertical_area_meta_options_map($header_meta_box){
		$header_vertical_area_meta_container = adorn_edge_add_admin_container(
			array(
				'parent'          => $header_meta_box,
				'name'            => 'header_vertical_area_meta_container',
				'hidden_property' => 'edge_header_type_meta',
				'hidden_value'    => '',
				'hidden_values'   => array('','header-standard','header-extended','header-minimal','header-divided','header-centered')
			)
		);

		adorn_edge_add_admin_section_title(
			array(
				'parent' => $header_vertical_area_meta_container,
				'name' => 'vertical_area_style',
				'title' => esc_html__('Vertical Area Style', 'adorn')
			)
		);

		$adorn_custom_sidebars = adorn_edge_get_custom_sidebars();
		if(count($adorn_custom_sidebars) > 0) {
			adorn_edge_create_meta_box_field(array(
				'name' => 'edge_custom_vertical_area_sidebar_meta',
				'type' => 'selectblank',
				'label' => esc_html__('Choose Custom Widget Area in Vertical area', 'adorn'),
				'description' => esc_html__('Choose custom widget area to display in vertical menu"', 'adorn'),
				'parent' => $header_vertical_area_meta_container,
				'options' => $adorn_custom_sidebars
			));
		}

		adorn_edge_create_meta_box_field(array(
			'name'        => 'edge_vertical_header_background_color_meta',
			'type'        => 'color',
			'label'       => esc_html__('Background Color', 'adorn'),
			'description' => esc_html__('Set background color for vertical menu', 'adorn'),
			'parent'      => $header_vertical_area_meta_container
		));

		adorn_edge_create_meta_box_field(
			array(
				'name'          => 'edge_vertical_header_background_image_meta',
				'type'          => 'image',
				'default_value' => '',
				'label'         => esc_html__('Background Image', 'adorn'),
				'description'   => esc_html__('Set background image for vertical menu', 'adorn'),
				'parent'        => $header_vertical_area_meta_container
			)
		);

		adorn_edge_create_meta_box_field(
			array(
				'name'          => 'edge_disable_vertical_header_background_image_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__('Disable Background Image', 'adorn'),
				'description'   => esc_html__('Enabling this option will hide background image in Vertical Menu', 'adorn'),
				'parent'        => $header_vertical_area_meta_container
			)
		);

		adorn_edge_create_meta_box_field(array(
			'name'          => 'edge_vertical_header_shadow_meta',
			'type'          => 'select',
			'label'         => esc_html__('Shadow', 'adorn'),
			'description'   => esc_html__('Set shadow on vertical menu', 'adorn'),
			'parent'        => $header_vertical_area_meta_container,
			'default_value' => '',
			'options'       => array(
				''    => '',
				'no'  => esc_html__('No', 'adorn'),
				'yes' => esc_html__('Yes', 'adorn')
			)
		));

		adorn_edge_create_meta_box_field(array(
			'name'          => 'edge_vertical_header_border_meta',
			'type'          => 'select',
			'label'         => esc_html__('Vertical Area Border', 'adorn'),
			'description'   => esc_html__('Set border on vertical area', 'adorn'),
			'parent'        => $header_vertical_area_meta_container,
			'default_value' => '',
			'options'       => array(
				''    => '',
				'no'  => esc_html__('No', 'adorn'),
				'yes' => esc_html__('Yes', 'adorn')
			),
			'args'          => array(
				'dependence' => true,
				'hide'       => array(
					''    => '#edge_vertical_header_border_container',
					'no'  => '#edge_vertical_header_border_container',
					'yes' => ''
				),
				'show'       => array(
					''    => '',
					'no'  => '',
					'yes' => '#edge_vertical_header_border_container'
				)
			)
		));

		$vertical_header_border_container = adorn_edge_add_admin_container(array(
			'type'            => 'container',
			'name'            => 'vertical_header_border_container',
			'parent'          => $header_vertical_area_meta_container,
			'hidden_property' => 'edge_vertical_header_border_meta',
			'hidden_value'    => 'no',
			'hidden_values'   => array('', 'no')
		));

		adorn_edge_create_meta_box_field(array(
			'name'        => 'edge_vertical_header_border_color_meta',
			'type'        => 'color',
			'label'       => esc_html__('Border Color', 'adorn'),
			'description' => esc_html__('Choose color of border', 'adorn'),
			'parent'      => $vertical_header_border_container
		));

		adorn_edge_create_meta_box_field(array(
			'name'          => 'edge_vertical_header_center_content_meta',
			'type'          => 'select',
			'label'         => esc_html__('Center Content', 'adorn'),
			'description'   => esc_html__('Set content in vertical center', 'adorn'),
			'parent'        => $header_vertical_area_meta_container,
			'default_value' => '',
			'options'       => array(
				''    => '',
				'no'  => esc_html__('No', 'adorn'),
				'yes' => esc_html__('Yes', 'adorn')
			)
		));
	}
	add_action('adorn_edge_header_vertical_area_meta_options_map', 'adorn_edge_header_vertical_area_meta_options_map', 10, 1);
}