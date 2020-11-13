<?php

if ( ! function_exists('adorn_edge_header_centered_meta_map') ) {

	function adorn_edge_header_centered_meta_map($parent) {
		adorn_edge_create_meta_box_field(
			array(
				'parent'        => $parent,
				'type'          => 'text',
				'name'          => 'edge_logo_wrapper_padding_header_centered_meta',
				'default_value' => '',
				'label'         => esc_html__('Logo Padding', 'adorn'),
				'description'   => esc_html__('Insert padding in format: 0px 0px 1px 0px', 'adorn'),
				'args'          => array(
					'col_width' => 3
				),
				'hidden_property' => 'edge_header_type_meta',
				'hidden_values' => array('','header-standard','header-standard-extended','header-minimal','header-divided','header-vertical')
			)
		);

	}

	add_action( 'adorn_edge_header_logo_area_additional_meta_options', 'adorn_edge_header_centered_meta_map',10,1);
}