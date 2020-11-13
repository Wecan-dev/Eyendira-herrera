<?php
if(!function_exists('adorn_edge_header_fixed_options_map')) {

	function adorn_edge_header_fixed_options_map(){

		$panel_fixed_header = adorn_edge_add_admin_panel(
			array(
				'title' => esc_html__('Fixed Header', 'adorn'),
				'name' => 'panel_fixed_header',
				'page' => '_header_page',
				'hidden_property' => 'header_type',
				'hidden_property' => 'header_type',
				'hidden_values'   => array('header-vertical','header-top-menu')
			)
		);

		adorn_edge_add_admin_field(array(
			'name' => 'fixed_header_background_color',
			'type' => 'color',
			'default_value' => '',
			'label' => esc_html__('Background Color', 'adorn'),
			'description' => esc_html__('Choose a background color for header area', 'adorn'),
			'parent' => $panel_fixed_header
		));

		adorn_edge_add_admin_field(array(
			'name' => 'fixed_header_transparency',
			'type' => 'text',
			'label' => esc_html__('Background Transparency', 'adorn'),
			'description' => esc_html__('Choose a transparency for the header background color (0 = fully transparent, 1 = opaque)', 'adorn'),
			'parent' => $panel_fixed_header,
			'args' => array(
				'col_width' => 1
			)
		));

		adorn_edge_add_admin_field(
			array(
				'parent' => $panel_fixed_header,
				'type' => 'color',
				'name' => 'fixed_header_border_bottom_color',
				'default_value' => '',
				'label' => esc_html__('Border Color', 'adorn'),
				'description' => esc_html__('Set border bottom color for header area', 'adorn'),
			)
		);

		$group_fixed_header_menu = adorn_edge_add_admin_group(array(
			'title' => esc_html__('Fixed Header Menu', 'adorn'),
			'name' => 'group_fixed_header_menu',
			'parent' => $panel_fixed_header,
			'description' => esc_html__('Define styles for fixed menu items', 'adorn')
		));

		$row1_fixed_header_menu = adorn_edge_add_admin_row(array(
			'name' => 'row1',
			'parent' => $group_fixed_header_menu
		));

		adorn_edge_add_admin_field(array(
			'name' => 'fixed_color',
			'type' => 'colorsimple',
			'label' => esc_html__('Text Color', 'adorn'),
			'description' => '',
			'parent' => $row1_fixed_header_menu
		));

		adorn_edge_add_admin_field(array(
			'name' => 'fixed_hovercolor',
			'type' => 'colorsimple',
			'label' => esc_html__(esc_html__('Hover/Active Color', 'adorn'), 'adorn'),
			'description' => '',
			'parent' => $row1_fixed_header_menu
		));

		$row2_fixed_header_menu = adorn_edge_add_admin_row(array(
			'name' => 'row2',
			'parent' => $group_fixed_header_menu
		));

		adorn_edge_add_admin_field(
			array(
				'name' => 'fixed_google_fonts',
				'type' => 'fontsimple',
				'label' => esc_html__('Font Family', 'adorn'),
				'default_value' => '-1',
				'parent' => $row2_fixed_header_menu,
			)
		);

		adorn_edge_add_admin_field(
			array(
				'type' => 'textsimple',
				'name' => 'fixed_font_size',
				'label' => esc_html__('Font Size', 'adorn'),
				'default_value' => '',
				'parent' => $row2_fixed_header_menu,
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		adorn_edge_add_admin_field(
			array(
				'type' => 'textsimple',
				'name' => 'fixed_line_height',
				'label' => esc_html__('Line Height', 'adorn'),
				'default_value' => '',
				'parent' => $row2_fixed_header_menu,
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		adorn_edge_add_admin_field(
			array(
				'type' => 'selectblanksimple',
				'name' => 'fixed_text_transform',
				'label' => esc_html__('Text Transform', 'adorn'),
				'default_value' => '',
				'options' => adorn_edge_get_text_transform_array(),
				'parent' => $row2_fixed_header_menu
			)
		);

		$row3_fixed_header_menu = adorn_edge_add_admin_row(array(
			'name' => 'row3',
			'parent' => $group_fixed_header_menu
		));

		adorn_edge_add_admin_field(
			array(
				'type' => 'selectblanksimple',
				'name' => 'fixed_font_style',
				'default_value' => '',
				'label' => esc_html__('Font Style', 'adorn'),
				'options' => adorn_edge_get_font_style_array(),
				'parent' => $row3_fixed_header_menu
			)
		);

		adorn_edge_add_admin_field(
			array(
				'type' => 'selectblanksimple',
				'name' => 'fixed_font_weight',
				'default_value' => '',
				'label' => esc_html__('Font Weight', 'adorn'),
				'options' => adorn_edge_get_font_weight_array(),
				'parent' => $row3_fixed_header_menu
			)
		);

		adorn_edge_add_admin_field(
			array(
				'type' => 'textsimple',
				'name' => 'fixed_letter_spacing',
				'label' => esc_html__('Letter Spacing', 'adorn'),
				'default_value' => '',
				'parent' => $row3_fixed_header_menu,
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

	}

	add_action('adorn_edge_header_fixed_options_map', 'adorn_edge_header_fixed_options_map', 10, 1);
}