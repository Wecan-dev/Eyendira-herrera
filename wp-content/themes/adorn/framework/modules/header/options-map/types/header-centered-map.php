<?php

if ( ! function_exists('adorn_edge_header_centered_map') ) {

	function adorn_edge_header_centered_map($parent) {
		adorn_edge_add_admin_field(
			array(
				'parent'        => $parent,
				'type'          => 'text',
				'name'          => 'logo_wrapper_padding_header_centered',
				'default_value' => '',
				'label'         => esc_html__('Logo Padding', 'adorn'),
				'description'   => esc_html__('Insert padding in format: 0px 0px 1px 0px', 'adorn'),
				'args'          => array(
					'col_width' => 3
				),
				'hidden_property' => 'header_type',
				'hidden_values' => array('header-standard','header-standard-extended','header-minimal','header-divided')
			)
		);

	}

	add_action( 'adorn_edge_header_logo_area_additional_options', 'adorn_edge_header_centered_map');
}