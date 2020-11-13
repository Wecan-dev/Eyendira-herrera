<?php
if(!function_exists('adorn_edge_header_sticky_options_map')) {

	function adorn_edge_header_sticky_options_map(){

		$panel_sticky_header = adorn_edge_add_admin_panel(
			array(
				'title' => esc_html__('Sticky Header', 'adorn'),
				'name' => 'panel_sticky_header',
				'page' => '_header_page',
				'hidden_property' => 'header_type',
				'hidden_values'   => array('header-vertical','header-top-menu')
			)
		);

		adorn_edge_add_admin_field(
			array(
				'name' => 'scroll_amount_for_sticky',
				'type' => 'text',
				'label' => esc_html__('Scroll Amount for Sticky', 'adorn'),
				'description' => esc_html__('Enter scroll amount for Sticky Menu to appear (deafult is header height). This value can be overriden on a page level basis', 'adorn'),
				'parent' => $panel_sticky_header,
				'args' => array(
					'col_width' => 2,
					'suffix' => 'px'
				)
			)
		);

		adorn_edge_add_admin_field(
			array(
				'name' => 'sticky_header_in_grid',
				'type' => 'yesno',
				'default_value' => 'no',
				'label' => esc_html__('Sticky Header in Grid', 'adorn'),
				'description' => esc_html__('Enabling this option will put sticky header in grid', 'adorn'),
				'parent' => $panel_sticky_header,
			)
		);

		adorn_edge_add_admin_field(array(
			'name' => 'sticky_header_background_color',
			'type' => 'color',
			'label' => esc_html__('Background Color', 'adorn'),
			'description' => esc_html__('Choose a background color for header area', 'adorn'),
			'parent' => $panel_sticky_header
		));

		adorn_edge_add_admin_field(array(
			'name' => 'sticky_header_transparency',
			'type' => 'text',
			'label' => esc_html__('Background Transparency', 'adorn'),
			'description' => esc_html__('Choose a transparency for the header background color (0 = fully transparent, 1 = opaque)', 'adorn'),
			'parent' => $panel_sticky_header,
			'args' => array(
				'col_width' => 1
			)
		));

		adorn_edge_add_admin_field(array(
			'name' => 'sticky_header_border_color',
			'type' => 'color',
			'label' => esc_html__('Border Color', 'adorn'),
			'description' => esc_html__('Set border bottom color for header area', 'adorn'),
			'parent' => $panel_sticky_header
		));

		adorn_edge_add_admin_field(array(
			'name' => 'sticky_header_height',
			'type' => 'text',
			'label' => esc_html__('Sticky Header Height', 'adorn'),
			'description' => esc_html__('Enter height for sticky header (default is 60px)', 'adorn'),
			'parent' => $panel_sticky_header,
			'args' => array(
				'col_width' => 2,
				'suffix' => 'px'
			)
		));

		$group_sticky_header_menu = adorn_edge_add_admin_group(array(
			'title' => esc_html__('Sticky Header Menu', 'adorn'),
			'name' => 'group_sticky_header_menu',
			'parent' => $panel_sticky_header,
			'description' => esc_html__('Define styles for sticky menu items', 'adorn')
		));

		$row1_sticky_header_menu = adorn_edge_add_admin_row(array(
			'name' => 'row1',
			'parent' => $group_sticky_header_menu
		));

		adorn_edge_add_admin_field(array(
			'name' => 'sticky_color',
			'type' => 'colorsimple',
			'label' => esc_html__('Text Color', 'adorn'),
			'description' => '',
			'parent' => $row1_sticky_header_menu
		));

		adorn_edge_add_admin_field(array(
			'name' => 'sticky_hovercolor',
			'type' => 'colorsimple',
			'label' => esc_html__(esc_html__('Hover/Active Color', 'adorn'), 'adorn'),
			'description' => '',
			'parent' => $row1_sticky_header_menu
		));

		$row2_sticky_header_menu = adorn_edge_add_admin_row(array(
			'name' => 'row2',
			'parent' => $group_sticky_header_menu
		));

		adorn_edge_add_admin_field(
			array(
				'name' => 'sticky_google_fonts',
				'type' => 'fontsimple',
				'label' => esc_html__('Font Family', 'adorn'),
				'default_value' => '-1',
				'parent' => $row2_sticky_header_menu,
			)
		);

		adorn_edge_add_admin_field(
			array(
				'type' => 'textsimple',
				'name' => 'sticky_font_size',
				'label' => esc_html__('Font Size', 'adorn'),
				'default_value' => '',
				'parent' => $row2_sticky_header_menu,
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		adorn_edge_add_admin_field(
			array(
				'type' => 'textsimple',
				'name' => 'sticky_line_height',
				'label' => esc_html__('Line Height', 'adorn'),
				'default_value' => '',
				'parent' => $row2_sticky_header_menu,
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		adorn_edge_add_admin_field(
			array(
				'type' => 'selectblanksimple',
				'name' => 'sticky_text_transform',
				'label' => esc_html__('Text Transform', 'adorn'),
				'default_value' => '',
				'options' => adorn_edge_get_text_transform_array(),
				'parent' => $row2_sticky_header_menu
			)
		);

		$row3_sticky_header_menu = adorn_edge_add_admin_row(array(
			'name' => 'row3',
			'parent' => $group_sticky_header_menu
		));

		adorn_edge_add_admin_field(
			array(
				'type' => 'selectblanksimple',
				'name' => 'sticky_font_style',
				'default_value' => '',
				'label' => esc_html__('Font Style', 'adorn'),
				'options' => adorn_edge_get_font_style_array(),
				'parent' => $row3_sticky_header_menu
			)
		);

		adorn_edge_add_admin_field(
			array(
				'type' => 'selectblanksimple',
				'name' => 'sticky_font_weight',
				'default_value' => '',
				'label' => esc_html__('Font Weight', 'adorn'),
				'options' => adorn_edge_get_font_weight_array(),
				'parent' => $row3_sticky_header_menu
			)
		);

		adorn_edge_add_admin_field(
			array(
				'type' => 'textsimple',
				'name' => 'sticky_letter_spacing',
				'label' => esc_html__('Letter Spacing', 'adorn'),
				'default_value' => '',
				'parent' => $row3_sticky_header_menu,
				'args' => array(
					'suffix' => 'px'
				)
			)
		);
	}

	add_action('adorn_edge_header_sticky_options_map', 'adorn_edge_header_sticky_options_map', 10, 1);
}