<?php

if ( ! function_exists('adorn_edge_sidearea_options_map') ) {

	function adorn_edge_sidearea_options_map() {

		adorn_edge_add_admin_page(
			array(
				'slug' => '_side_area_page',
				'title' => esc_html__('Side Area', 'adorn'),
				'icon' => 'fa fa-indent'
			)
		);

		$side_area_panel = adorn_edge_add_admin_panel(
			array(
				'title' => esc_html__('Side Area', 'adorn'),
				'name' => 'side_area',
				'page' => '_side_area_page'
			)
		);

		$side_area_icon_style_group = adorn_edge_add_admin_group(
			array(
				'parent' => $side_area_panel,
				'name' => 'side_area_icon_style_group',
				'title' => esc_html__('Side Area Icon Style', 'adorn'),
				'description' => esc_html__('Define styles for Side Area icon', 'adorn')
			)
		);

		$side_area_icon_style_row1 = adorn_edge_add_admin_row(
			array(
				'parent'	=> $side_area_icon_style_group,
				'name'		=> 'side_area_icon_style_row1'
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row1,
				'type' => 'colorsimple',
				'name' => 'side_area_icon_color',
				'label' => esc_html__('Color', 'adorn')
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row1,
				'type' => 'colorsimple',
				'name' => 'side_area_icon_hover_color',
				'label' => esc_html__('Hover Color', 'adorn')
			)
		);

		$side_area_icon_style_row2 = adorn_edge_add_admin_row(
			array(
				'parent'	=> $side_area_icon_style_group,
				'name'		=> 'side_area_icon_style_row2',
				'next'		=> true
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row2,
				'type' => 'colorsimple',
				'name' => 'side_area_close_icon_color',
				'label' => esc_html__('Close Icon Color', 'adorn')
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row2,
				'type' => 'colorsimple',
				'name' => 'side_area_close_icon_hover_color',
				'label' => esc_html__('Close Icon Hover Color', 'adorn')
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $side_area_panel,
				'type' => 'text',
				'name' => 'side_area_width',
				'default_value' => '',
				'label' => esc_html__('Side Area Width', 'adorn'),
				'description' => esc_html__('Enter a width for Side Area', 'adorn'),
				'args' => array(
					'col_width' => 3,
					'suffix' => 'px'
				)
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $side_area_panel,
				'type' => 'color',
				'name' => 'side_area_background_color',
				'label' => esc_html__('Background Color', 'adorn'),
				'description' => esc_html__('Choose a background color for Side Area', 'adorn')
			)
		);
		
		adorn_edge_add_admin_field(
			array(
				'parent' => $side_area_panel,
				'type' => 'text',
				'name' => 'side_area_padding',
				'label' => esc_html__('Padding', 'adorn'),
				'description' => esc_html__('Define padding for Side Area in format top right bottom left', 'adorn'),
				'args' => array(
					'col_width' => 3
				)
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $side_area_panel,
				'type' => 'selectblank',
				'name' => 'side_area_aligment',
				'default_value' => '',
				'label' => esc_html__('Text Alignment', 'adorn'),
				'description' => esc_html__('Choose text alignment for side area', 'adorn'),
				'options' => array(
					'' => esc_html__('Default', 'adorn'),
					'left' => esc_html__('Left', 'adorn'),
					'center' => esc_html__('Center', 'adorn'),
					'right' => esc_html__('Right', 'adorn')
				)
			)
		);
	}

	add_action('adorn_edge_options_map', 'adorn_edge_sidearea_options_map', 14);
}