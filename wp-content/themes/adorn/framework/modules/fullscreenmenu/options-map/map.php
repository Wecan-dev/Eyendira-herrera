<?php

if ( ! function_exists('adorn_edge_fullscreen_menu_options_map')) {

	function adorn_edge_fullscreen_menu_options_map() {

		$fullscreen_panel = adorn_edge_add_admin_panel(
			array(
				'title'           => esc_html__('Fullscreen Menu', 'adorn'),
				'name'            => 'panel_fullscreen_menu',
				'page'            => '_header_page',
				'hidden_property' => 'header_type',
				'hidden_value'    => '',
				'hidden_values'   => array(
					'header-standard',
					'header-standard-extended',
					'header-vertical',
					'header-divided',
					'header-centered',
				)
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $fullscreen_panel,
				'type' => 'select',
				'name' => 'fullscreen_menu_animation_style',
				'default_value' => 'fade-push-text-right',
				'label' => esc_html__('Fullscreen Menu Overlay Animation', 'adorn'),
				'description' => esc_html__('Choose animation type for fullscreen menu overlay', 'adorn'),
				'options' => array(
					'fade-push-text-right' => esc_html__('Fade Push Text Right', 'adorn'),
					'fade-push-text-top' => esc_html__('Fade Push Text Top', 'adorn'),
					'fade-text-scaledown' => esc_html__('Fade Text Scaledown', 'adorn')
				)
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $fullscreen_panel,
				'type' => 'yesno',
				'name' => 'fullscreen_in_grid',
				'default_value' => 'no',
				'label' => esc_html__('Fullscreen Menu in Grid', 'adorn'),
				'description' => esc_html__('Enabling this option will put fullscreen menu content in grid', 'adorn'),
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $fullscreen_panel,
				'type' => 'selectblank',
				'name' => 'fullscreen_alignment',
				'default_value' => '',
				'label' => esc_html__('Fullscreen Menu Alignment', 'adorn'),
				'description' => esc_html__('Choose alignment for fullscreen menu content', 'adorn'),
				'options' => array(
					'' => esc_html__('Default', 'adorn'),
					'left' => esc_html__('Left', 'adorn'),
					'center' => esc_html__('Center', 'adorn'),
					'right' => esc_html__('Right', 'adorn')
				)
			)
		);

		$background_group = adorn_edge_add_admin_group(
			array(
				'parent' => $fullscreen_panel,
				'name' => 'background_group',
				'title' => esc_html__('Background', 'adorn'),
				'description' => esc_html__('Select a background color and transparency for fullscreen menu (0 = fully transparent, 1 = opaque)', 'adorn')
			)
		);

		$background_group_row = adorn_edge_add_admin_row(
			array(
				'parent' => $background_group,
				'name' => 'background_group_row'
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $background_group_row,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_background_color',
				'label' => esc_html__('Background Color', 'adorn')
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $background_group_row,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_background_transparency',
				'label' => esc_html__('Background Transparency', 'adorn')
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $fullscreen_panel,
				'type' => 'image',
				'name' => 'fullscreen_menu_background_image',
				'label' => esc_html__('Background Image', 'adorn'),
				'description' => esc_html__('Choose a background image for fullscreen menu background', 'adorn')
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $fullscreen_panel,
				'type' => 'image',
				'name' => 'fullscreen_menu_pattern_image',
				'label' => esc_html__('Pattern Background Image', 'adorn'),
				'description' => esc_html__('Choose a pattern image for fullscreen menu background', 'adorn')
			)
		);

		//1st level style group
		$first_level_style_group = adorn_edge_add_admin_group(
			array(
				'parent' => $fullscreen_panel,
				'name' => 'first_level_style_group',
				'title' => esc_html__('1st Level Style', 'adorn'),
				'description' => esc_html__('Define styles for 1st level in Fullscreen Menu', 'adorn')
			)
		);

		$first_level_style_row1 = adorn_edge_add_admin_row(
			array(
				'parent' => $first_level_style_group,
				'name' => 'first_level_style_row1'
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $first_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_color',
				'default_value' => '',
				'label' => esc_html__('Text Color', 'adorn'),
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $first_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_hover_color',
				'default_value' => '',
				'label' => esc_html__('Hover Text Color', 'adorn'),
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $first_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_active_color',
				'default_value' => '',
				'label' => esc_html__('Active Text Color', 'adorn'),
			)
		);

		$first_level_style_row3 = adorn_edge_add_admin_row(
			array(
				'parent' => $first_level_style_group,
				'name' => 'first_level_style_row3'
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $first_level_style_row3,
				'type' => 'fontsimple',
				'name' => 'fullscreen_menu_google_fonts',
				'default_value' => '-1',
				'label' => esc_html__('Font Family', 'adorn'),
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $first_level_style_row3,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_font_size',
				'default_value' => '',
				'label' => esc_html__('Font Size', 'adorn'),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $first_level_style_row3,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_line_height',
				'default_value' => '',
				'label' => esc_html__('Line Height', 'adorn'),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		$first_level_style_row4 = adorn_edge_add_admin_row(
			array(
				'parent' => $first_level_style_group,
				'name' => 'first_level_style_row4'
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $first_level_style_row4,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_font_style',
				'default_value' => '',
				'label' => esc_html__('Font Style', 'adorn'),
				'options' => adorn_edge_get_font_style_array()
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $first_level_style_row4,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_font_weight',
				'default_value' => '',
				'label' => esc_html__('Font Weight', 'adorn'),
				'options' => adorn_edge_get_font_weight_array()
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $first_level_style_row4,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_letter_spacing',
				'default_value' => '',
				'label' => esc_html__('Lettert Spacing', 'adorn'),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $first_level_style_row4,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_text_transform',
				'default_value' => '',
				'label' => esc_html__('Text Transform', 'adorn'),
				'options' => adorn_edge_get_text_transform_array()
			)
		);

		//2nd level style group
		$second_level_style_group = adorn_edge_add_admin_group(
			array(
				'parent' => $fullscreen_panel,
				'name' => 'second_level_style_group',
				'title' => esc_html__('2nd Level Style', 'adorn'),
				'description' => esc_html__('Define styles for 2nd level in Fullscreen Menu', 'adorn')
			)
		);

		$second_level_style_row1 = adorn_edge_add_admin_row(
			array(
				'parent' => $second_level_style_group,
				'name' => 'second_level_style_row1'
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $second_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_color_2nd',
				'default_value' => '',
				'label' => esc_html__('Text Color', 'adorn'),
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $second_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_hover_color_2nd',
				'default_value' => '',
				'label' => esc_html__('Hover/Active Text Color', 'adorn'),
			)
		);

		$second_level_style_row2 = adorn_edge_add_admin_row(
			array(
				'parent' => $second_level_style_group,
				'name' => 'second_level_style_row2'
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $second_level_style_row2,
				'type' => 'fontsimple',
				'name' => 'fullscreen_menu_google_fonts_2nd',
				'default_value' => '-1',
				'label' => esc_html__('Font Family', 'adorn'),
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $second_level_style_row2,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_font_size_2nd',
				'default_value' => '',
				'label' => esc_html__('Font Size', 'adorn'),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $second_level_style_row2,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_line_height_2nd',
				'default_value' => '',
				'label' => esc_html__('Line Height', 'adorn'),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		$second_level_style_row3 = adorn_edge_add_admin_row(
			array(
				'parent' => $second_level_style_group,
				'name' => 'second_level_style_row3'
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $second_level_style_row3,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_font_style_2nd',
				'default_value' => '',
				'label' => esc_html__('Font Style', 'adorn'),
				'options' => adorn_edge_get_font_style_array()
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $second_level_style_row3,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_font_weight_2nd',
				'default_value' => '',
				'label' => esc_html__('Font Weight', 'adorn'),
				'options' => adorn_edge_get_font_weight_array()
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $second_level_style_row3,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_letter_spacing_2nd',
				'default_value' => '',
				'label' => esc_html__('Lettert Spacing', 'adorn'),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $second_level_style_row3,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_text_transform_2nd',
				'default_value' => '',
				'label' => esc_html__('Text Transform', 'adorn'),
				'options' => adorn_edge_get_text_transform_array()
			)
		);

		$third_level_style_group = adorn_edge_add_admin_group(
			array(
				'parent' => $fullscreen_panel,
				'name' => 'third_level_style_group',
				'title' => esc_html__('3rd Level Style', 'adorn'),
				'description' => esc_html__('Define styles for 3rd level in Fullscreen Menu', 'adorn')
			)
		);

		$third_level_style_row1 = adorn_edge_add_admin_row(
			array(
				'parent' => $third_level_style_group,
				'name' => 'third_level_style_row1'
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $third_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_color_3rd',
				'default_value' => '',
				'label' => esc_html__('Text Color', 'adorn'),
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $third_level_style_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_hover_color_3rd',
				'default_value' => '',
				'label' => esc_html__('Hover/Active Text Color', 'adorn'),
			)
		);

		$third_level_style_row2 = adorn_edge_add_admin_row(
			array(
				'parent' => $third_level_style_group,
				'name' => 'second_level_style_row2'
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $third_level_style_row2,
				'type' => 'fontsimple',
				'name' => 'fullscreen_menu_google_fonts_3rd',
				'default_value' => '-1',
				'label' => esc_html__('Font Family', 'adorn'),
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $third_level_style_row2,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_font_size_3rd',
				'default_value' => '',
				'label' => esc_html__('Font Size', 'adorn'),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $third_level_style_row2,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_line_height_3rd',
				'default_value' => '',
				'label' => esc_html__('Line Height', 'adorn'),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		$third_level_style_row3 = adorn_edge_add_admin_row(
			array(
				'parent' => $third_level_style_group,
				'name' => 'second_level_style_row3'
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $third_level_style_row3,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_font_style_3rd',
				'default_value' => '',
				'label' => esc_html__('Font Style', 'adorn'),
				'options' => adorn_edge_get_font_style_array()
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $third_level_style_row3,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_font_weight_3rd',
				'default_value' => '',
				'label' => esc_html__('Font Weight', 'adorn'),
				'options' => adorn_edge_get_font_weight_array()
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $third_level_style_row3,
				'type' => 'textsimple',
				'name' => 'fullscreen_menu_letter_spacing_3rd',
				'default_value' => '',
				'label' => esc_html__('Lettert Spacing', 'adorn'),
				'args' => array(
					'suffix' => 'px'
				)
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $third_level_style_row3,
				'type' => 'selectblanksimple',
				'name' => 'fullscreen_menu_text_transform_3rd',
				'default_value' => '',
				'label' => esc_html__('Text Transform', 'adorn'),
				'options' => adorn_edge_get_text_transform_array()
			)
		);

		$icon_colors_group = adorn_edge_add_admin_group(
			array(
				'parent' => $fullscreen_panel,
				'name' => 'fullscreen_menu_icon_colors_group',
				'title' => esc_html__('Full Screen Menu Icon Style', 'adorn'),
				'description' => esc_html__('Define styles for Fullscreen Menu Icon', 'adorn')
			)
		);

		$icon_colors_row1 = adorn_edge_add_admin_row(
			array(
				'parent' => $icon_colors_group,
				'name' => 'icon_colors_row1'
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $icon_colors_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_icon_color',
				'label' => esc_html__('Color', 'adorn'),
			)
		);
		
		adorn_edge_add_admin_field(
			array(
				'parent' => $icon_colors_row1,
				'type' => 'colorsimple',
				'name' => 'fullscreen_menu_icon_hover_color',
				'label' => esc_html__('Hover Color', 'adorn'),
			)
		);
	}

	add_action('adorn_edge_header_options_map', 'adorn_edge_fullscreen_menu_options_map', 17);
}