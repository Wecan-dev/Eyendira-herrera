<?php

if ( ! function_exists('adorn_edge_mobile_header_options_map') ) {

	function adorn_edge_mobile_header_options_map() {

		adorn_edge_add_admin_page(
			array(
				'slug'  => '_mobile_header_page',
				'title' => esc_html__('Mobile Header', 'adorn'),
				'icon'  => 'fa fa-institution'
			)
		);

		$panel_mobile_header = adorn_edge_add_admin_panel(array(
			'title' => esc_html__('Mobile Header', 'adorn'),
			'name'  => 'panel_mobile_header',
			'page'  => '_mobile_header_page'
		));

		$mobile_header_group = adorn_edge_add_admin_group(
			array(
				'parent' => $panel_mobile_header,
				'name' => 'mobile_header_group',
				'title' => esc_html__('Mobile Header Styles', 'adorn')
			)
		);

		$mobile_header_row1 = adorn_edge_add_admin_row(
			array(
				'parent' => $mobile_header_group,
				'name' => 'mobile_header_row1'
			)
		);

			adorn_edge_add_admin_field(array(
				'name'        => 'mobile_header_height',
				'type'        => 'textsimple',
				'label'       => esc_html__('Height', 'adorn'),
				'parent'      => $mobile_header_row1,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			));

			adorn_edge_add_admin_field(array(
				'name'        => 'mobile_header_background_color',
				'type'        => 'colorsimple',
				'label'       => esc_html__('Background Color', 'adorn'),
				'parent'      => $mobile_header_row1
			));

			adorn_edge_add_admin_field(array(
				'name'        => 'mobile_header_border_bottom_color',
				'type'        => 'colorsimple',
				'label'       => esc_html__('Border Bottom Color', 'adorn'),
				'parent'      => $mobile_header_row1
			));

		$mobile_menu_group = adorn_edge_add_admin_group(
			array(
				'parent' => $panel_mobile_header,
				'name' => 'mobile_menu_group',
				'title' => esc_html__('Mobile Menu Styles', 'adorn')
			)
		);

		$mobile_menu_row1 = adorn_edge_add_admin_row(
			array(
				'parent' => $mobile_menu_group,
				'name' => 'mobile_menu_row1'
			)
		);

			adorn_edge_add_admin_field(array(
				'name'        => 'mobile_menu_background_color',
				'type'        => 'colorsimple',
				'label'       => esc_html__('Background Color', 'adorn'),
				'parent'      => $mobile_menu_row1
			));

			adorn_edge_add_admin_field(array(
				'name'        => 'mobile_menu_border_bottom_color',
				'type'        => 'colorsimple',
				'label'       => esc_html__('Border Bottom Color', 'adorn'),
				'parent'      => $mobile_menu_row1
			));

			adorn_edge_add_admin_field(array(
				'name'        => 'mobile_menu_separator_color',
				'type'        => 'colorsimple',
				'label'       => esc_html__('Menu Item Separator Color', 'adorn'),
				'parent'      => $mobile_menu_row1
			));

		adorn_edge_add_admin_field(array(
			'name'        => 'mobile_logo_height',
			'type'        => 'text',
			'label'       => esc_html__('Logo Height For Mobile Header', 'adorn'),
			'description' => esc_html__('Define logo height for screen size smaller than 1024px', 'adorn'),
			'parent'      => $panel_mobile_header,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		adorn_edge_add_admin_field(array(
			'name'        => 'mobile_logo_height_phones',
			'type'        => 'text',
			'label'       => esc_html__('Logo Height For Mobile Devices', 'adorn'),
			'description' => esc_html__('Define logo height for screen size smaller than 480px', 'adorn'),
			'parent'      => $panel_mobile_header,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		adorn_edge_add_admin_section_title(array(
			'parent' => $panel_mobile_header,
			'name'   => 'mobile_header_fonts_title',
			'title'  => esc_html__('Typography', 'adorn')
		));

		$first_level_group = adorn_edge_add_admin_group(
			array(
				'parent' => $panel_mobile_header,
				'name' => 'first_level_group',
				'title' => esc_html__('1st Level Menu', 'adorn'),
				'description' => esc_html__('Define styles for 1st level in Mobile Menu Navigation', 'adorn')
			)
		);

		$first_level_row1 = adorn_edge_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name' => 'first_level_row1'
			)
		);

		adorn_edge_add_admin_field(array(
			'name'        => 'mobile_text_color',
			'type'        => 'colorsimple',
			'label'       => esc_html__('Text Color', 'adorn'),
			'parent'      => $first_level_row1
		));

		adorn_edge_add_admin_field(array(
			'name'        => 'mobile_text_hover_color',
			'type'        => 'colorsimple',
			'label'       => esc_html__('Hover/Active Text Color', 'adorn'),
			'parent'      => $first_level_row1
		));

		adorn_edge_add_admin_field(array(
			'name'        => 'mobile_google_fonts',
			'type'        => 'fontsimple',
			'label'       => esc_html__('Font Family', 'adorn'),
			'parent'      => $first_level_row1
		));

		adorn_edge_add_admin_field(array(
			'name'        => 'mobile_font_size',
			'type'        => 'textsimple',
			'label'       => esc_html__('Font Size', 'adorn'),
			'parent'      => $first_level_row1,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		$first_level_row2 = adorn_edge_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name' => 'first_level_row2'
			)
		);

		adorn_edge_add_admin_field(array(
			'name'        => 'mobile_line_height',
			'type'        => 'textsimple',
			'label'       => esc_html__('Line Height', 'adorn'),
			'parent'      => $first_level_row2,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		adorn_edge_add_admin_field(array(
			'name'        => 'mobile_text_transform',
			'type'        => 'selectsimple',
			'label'       => esc_html__('Text Transform', 'adorn'),
			'parent'      => $first_level_row2,
			'options'     => adorn_edge_get_text_transform_array()
		));

		adorn_edge_add_admin_field(array(
			'name'        => 'mobile_font_style',
			'type'        => 'selectsimple',
			'label'       => esc_html__('Font Style', 'adorn'),
			'parent'      => $first_level_row2,
			'options'     => adorn_edge_get_font_style_array()
		));

		adorn_edge_add_admin_field(array(
			'name'        => 'mobile_font_weight',
			'type'        => 'selectsimple',
			'label'       => esc_html__('Font Weight', 'adorn'),
			'parent'      => $first_level_row2,
			'options'     => adorn_edge_get_font_weight_array()
		));

		$first_level_row3 = adorn_edge_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name' => 'first_level_row3'
			)
		);

		adorn_edge_add_admin_field(
			array(
				'type' => 'textsimple',
				'name' => 'mobile_letter_spacing',
				'label' => esc_html__('Letter Spacing', 'adorn'),
				'default_value' => '',
				'parent' => $first_level_row3,
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		$second_level_group = adorn_edge_add_admin_group(
			array(
				'parent' => $panel_mobile_header,
				'name' => 'second_level_group',
				'title' => esc_html__('Dropdown Menu', 'adorn'),
				'description' => esc_html__('Define styles for drop down menu items in Mobile Menu Navigation', 'adorn')
			)
		);

		$second_level_row1 = adorn_edge_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name' => 'second_level_row1'
			)
		);

		adorn_edge_add_admin_field(array(
			'name'        => 'mobile_dropdown_text_color',
			'type'        => 'colorsimple',
			'label'       => esc_html__('Text Color', 'adorn'),
			'parent'      => $second_level_row1
		));

		adorn_edge_add_admin_field(array(
			'name'        => 'mobile_dropdown_text_hover_color',
			'type'        => 'colorsimple',
			'label'       => esc_html__('Hover/Active Text Color', 'adorn'),
			'parent'      => $second_level_row1
		));

		adorn_edge_add_admin_field(array(
			'name'        => 'mobile_dropdown_google_fonts',
			'type'        => 'fontsimple',
			'label'       => esc_html__('Font Family', 'adorn'),
			'parent'      => $second_level_row1
		));

		adorn_edge_add_admin_field(array(
			'name'        => 'mobile_dropdown_font_size',
			'type'        => 'textsimple',
			'label'       => esc_html__('Font Size', 'adorn'),
			'parent'      => $second_level_row1,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		$second_level_row2 = adorn_edge_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name' => 'second_level_row2'
			)
		);

		adorn_edge_add_admin_field(array(
			'name'        => 'mobile_dropdown_line_height',
			'type'        => 'textsimple',
			'label'       => esc_html__('Line Height', 'adorn'),
			'parent'      => $second_level_row2,
			'args'        => array(
				'col_width' => 3,
				'suffix'    => 'px'
			)
		));

		adorn_edge_add_admin_field(array(
			'name'        => 'mobile_dropdown_text_transform',
			'type'        => 'selectsimple',
			'label'       => esc_html__('Text Transform', 'adorn'),
			'parent'      => $second_level_row2,
			'options'     => adorn_edge_get_text_transform_array()
		));

		adorn_edge_add_admin_field(array(
			'name'        => 'mobile_dropdown_font_style',
			'type'        => 'selectsimple',
			'label'       => esc_html__('Font Style', 'adorn'),
			'parent'      => $second_level_row2,
			'options'     => adorn_edge_get_font_style_array()
		));

		adorn_edge_add_admin_field(array(
			'name'        => 'mobile_dropdown_font_weight',
			'type'        => 'selectsimple',
			'label'       => esc_html__('Font Weight', 'adorn'),
			'parent'      => $second_level_row2,
			'options'     => adorn_edge_get_font_weight_array()
		));

		$second_level_row3 = adorn_edge_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name' => 'second_level_row3'
			)
		);

		adorn_edge_add_admin_field(
			array(
				'type' => 'textsimple',
				'name' => 'mobile_dropdown_letter_spacing',
				'label' => esc_html__('Letter Spacing', 'adorn'),
				'default_value' => '',
				'parent' => $second_level_row3,
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		adorn_edge_add_admin_section_title(array(
			'name' => 'mobile_opener_panel',
			'parent' => $panel_mobile_header,
			'title' => esc_html__('Mobile Menu Opener', 'adorn')
		));

		adorn_edge_add_admin_field(array(
			'name'        => 'mobile_menu_title',
			'type'        => 'text',
			'label'       => esc_html__('Mobile Navigation Title', 'adorn'),
			'description' => esc_html__('Enter title for mobile menu navigation', 'adorn'),
			'parent'      => $panel_mobile_header,
			'default_value' => esc_html__('Menu', 'adorn'),
			'args' => array(
				'col_width' => 3
			)
		));

		adorn_edge_add_admin_field(array(
			'name'        => 'mobile_icon_color',
			'type'        => 'color',
			'label'       => esc_html__('Mobile Navigation Icon Color', 'adorn'),
			'parent'      => $panel_mobile_header
		));

		adorn_edge_add_admin_field(array(
			'name'        => 'mobile_icon_hover_color',
			'type'        => 'color',
			'label'       => esc_html__('Mobile Navigation Icon Hover Color', 'adorn'),
			'parent'      => $panel_mobile_header
		));
	}

	add_action( 'adorn_edge_options_map', 'adorn_edge_mobile_header_options_map', 4);
}