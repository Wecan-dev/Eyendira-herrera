<?php
if(!function_exists('adorn_edge_header_menu_area_meta_options_map')) {

	function adorn_edge_header_menu_area_meta_options_map($header_meta_box){

		$menu_area_container = adorn_edge_add_admin_container_no_style(
			array(
				'type'            => 'container',
				'name'            => 'menu_area_container',
				'parent'          => $header_meta_box,
				'hidden_property' => 'edge_header_type_meta',
				'hidden_value'    => '',
				'hidden_values'   => array('','header-vertical','header-vertical-closed')
			));

		adorn_edge_add_admin_section_title(
			array(
				'parent' => $menu_area_container,
				'name' => 'menu_area_style',
				'title' => esc_html__('Menu Area Style', 'adorn')
			)
		);

		adorn_edge_create_meta_box_field(
			array(
				'name' => 'edge_disable_header_widget_menu_area_meta',
				'type' => 'yesno',
				'default_value' => 'no',
				'label' => esc_html__('Disable Header Menu Area Widget', 'adorn'),
				'description' => esc_html__('Enabling this option will hide widget area from the menu area', 'adorn'),
				'parent' => $menu_area_container
			)
		);

		$adorn_custom_sidebars = adorn_edge_get_custom_sidebars();
		if(count($adorn_custom_sidebars) > 0) {
			adorn_edge_create_meta_box_field(array(
				'name' => 'edge_custom_menu_area_sidebar_meta',
				'type' => 'selectblank',
				'label' => esc_html__('Choose Custom Widget Area in Menu area', 'adorn'),
				'description' => esc_html__('Choose custom widget area to display in header menu area', 'adorn'),
				'parent' => $menu_area_container,
				'options' => $adorn_custom_sidebars
			));
		}

        $adorn_custom_sticky_widget_sidebars = adorn_edge_get_custom_sidebars();
        if(count($adorn_custom_sidebars) > 0) {
            adorn_edge_create_meta_box_field(array(
                'name' => 'edge_custom_sticky_area_sidebar_meta',
                'type' => 'selectblank',
                'label' => esc_html__('Choose Custom Sticky Widget Area in Menu area', 'adorn'),
                'description' => esc_html__('Choose custom sticky widget area to display in header menu area', 'adorn'),
                'parent' => $menu_area_container,
                'options' => $adorn_custom_sticky_widget_sidebars
            ));
        }

        $menu_area_position_header_centered_container = adorn_edge_add_admin_container(
            array(
                'parent' => $menu_area_container,
                'name' => 'menu_area_position_header_centered_container',
                'hidden_property' => 'edge_header_type_meta',
                'hidden_values' => array('header-minimal','header-divided','header-standard','header-standard-extended','header-top')
            )
        );

        $adorn_custom_sidebars = adorn_edge_get_custom_sidebars();
        if(count($adorn_custom_sidebars) > 0) {
            adorn_edge_create_meta_box_field(array(
                'parent' => $menu_area_position_header_centered_container,
                'name' => 'edge_custom_menu_area_left_sidebar_meta',
                'type' => 'selectblank',
                'label' => esc_html__('Choose Custom Widget Area Placed Left of the Centered Menu', 'adorn'),
                'description' => esc_html__('Choose Custom Widget Area That is Placed Left of the Centered Menu', 'adorn'),
                'options' => $adorn_custom_sidebars
            ));
        }

        $menu_area_position_header_standard_container = adorn_edge_add_admin_container(
            array(
                'parent' => $menu_area_container,
                'name' => 'menu_area_position_header_standard_container',
                'hidden_property' => 'edge_header_type_meta',
                'hidden_values' => array('header-minimal','header-divided','header-centered')
            )
        );

        adorn_edge_create_meta_box_field(
                array(
                    'parent'		=> $menu_area_position_header_standard_container,
                    'type'			=> 'select',
                    'name'			=> 'edge_menu_area_position_header_standard_meta',
                    'default_value'	=> '',
                    'options' => array(
                        ''          => esc_html__('Default', 'adorn'),
                        'center'	=> esc_html__('Center', 'adorn'),
                        'right'		=> esc_html__('Right', 'adorn'),
                    ),
                    'label'			=> esc_html__('Menu Area Position', 'adorn'),
                    'description'	=> esc_html__('Set posistion of menu area for Standard Header Type', 'adorn'),
                )
            );

		adorn_edge_create_meta_box_field(array(
			'name'          => 'edge_menu_area_in_grid_meta',
			'type'          => 'select',
			'label'         => esc_html__('Menu Area In Grid', 'adorn'),
			'description'   => esc_html__('Set menu area content to be in grid', 'adorn'),
			'parent'        => $menu_area_container,
			'default_value' => '',
			'options'       => array(
				''    => esc_html__('Default', 'adorn'),
				'no'  => esc_html__('No', 'adorn'),
				'yes' => esc_html__('Yes', 'adorn')
			),
			'args'          => array(
				'dependence' => true,
				'hide'       => array(
					''    => '#edge_menu_area_in_grid_container',
					'no'  => '#edge_menu_area_in_grid_container',
					'yes' => ''
				),
				'show'       => array(
					''    => '',
					'no'  => '',
					'yes' => '#edge_menu_area_in_grid_container'
				)
			)
		));

		$menu_area_in_grid_container = adorn_edge_add_admin_container(array(
			'type'            => 'container',
			'name'            => 'menu_area_in_grid_container',
			'parent'          => $menu_area_container,
			'hidden_property' => 'edge_menu_area_in_grid_meta',
			'hidden_value'    => 'no',
			'hidden_values'   => array('', 'no')
		));


		adorn_edge_create_meta_box_field(
			array(
				'name'        => 'edge_menu_area_grid_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__('Grid Background Color', 'adorn'),
				'description' => esc_html__('Set grid background color for menu area', 'adorn'),
				'parent'      => $menu_area_in_grid_container
			)
		);

		adorn_edge_create_meta_box_field(
			array(
				'name'        => 'edge_menu_area_grid_background_transparency_meta',
				'type'        => 'text',
				'label'       => esc_html__('Grid Background Transparency', 'adorn'),
				'description' => esc_html__('Set grid background transparency for menu area (0 = fully transparent, 1 = opaque)', 'adorn'),
				'parent'      => $menu_area_in_grid_container,
				'args'        => array(
					'col_width' => 2
				)
			)
		);

		adorn_edge_create_meta_box_field(array(
			'name'          => 'edge_menu_area_in_grid_shadow_meta',
			'type'          => 'select',
			'label'         => esc_html__('Grid Area Shadow', 'adorn'),
			'description'   => esc_html__('Set shadow on grid menu area', 'adorn'),
			'parent'        => $menu_area_in_grid_container,
			'default_value' => '',
			'options'       => array(
				''    => '',
				'no'  => esc_html__('No', 'adorn'),
				'yes' => esc_html__('Yes', 'adorn')
			)
		));

		adorn_edge_create_meta_box_field(array(
			'name'          => 'edge_menu_area_in_grid_border_meta',
			'type'          => 'select',
			'label'         => esc_html__('Grid Area Border', 'adorn'),
			'description'   => esc_html__('Set border on grid menu area', 'adorn'),
			'parent'        => $menu_area_in_grid_container,
			'default_value' => '',
			'options'       => array(
				''    => '',
				'no'  => esc_html__('No', 'adorn'),
				'yes' => esc_html__('Yes', 'adorn')
			),
			'args'          => array(
				'dependence' => true,
				'hide'       => array(
					''    => '#edge_menu_area_in_grid_border_container',
					'no'  => '#edge_menu_area_in_grid_border_container',
					'yes' => ''
				),
				'show'       => array(
					''    => '',
					'no'  => '',
					'yes' => '#edge_menu_area_in_grid_border_container'
				)
			)
		));

		$menu_area_in_grid_border_container = adorn_edge_add_admin_container(array(
			'type'            => 'container',
			'name'            => 'menu_area_in_grid_border_container',
			'parent'          => $menu_area_in_grid_container,
			'hidden_property' => 'edge_menu_area_in_grid_border_meta',
			'hidden_value'    => 'no',
			'hidden_values'   => array('', 'no')
		));

		adorn_edge_create_meta_box_field(array(
			'name'        => 'edge_menu_area_in_grid_border_color_meta',
			'type'        => 'color',
			'label'       => esc_html__('Border Color', 'adorn'),
			'description' => esc_html__('Set border color for grid area', 'adorn'),
			'parent'      => $menu_area_container
		));


		adorn_edge_create_meta_box_field(
			array(
				'name'        => 'edge_menu_area_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__('Background Color', 'adorn'),
				'description' => esc_html__('Choose a background color for menu area', 'adorn'),
				'parent'      => $menu_area_container
			)
		);

		adorn_edge_create_meta_box_field(
			array(
				'name'        => 'edge_menu_area_background_transparency_meta',
				'type'        => 'text',
				'label'       => esc_html__('Transparency', 'adorn'),
				'description' => esc_html__('Choose a transparency for the menu area background color (0 = fully transparent, 1 = opaque)', 'adorn'),
				'parent'      => $menu_area_container,
				'args'        => array(
					'col_width' => 2
				)
			)
		);

		adorn_edge_create_meta_box_field(array(
			'name'          => 'edge_menu_area_shadow_meta',
			'type'          => 'select',
			'label'         => esc_html__('Menu Area Shadow', 'adorn'),
			'description'   => esc_html__('Set shadow on menu area', 'adorn'),
			'parent'        => $menu_area_container,
			'default_value' => '',
			'options'       => array(
				''    => '',
				'no'  => esc_html__('No', 'adorn'),
				'yes' => esc_html__('Yes', 'adorn')
			)
		));

		adorn_edge_create_meta_box_field(array(
			'name'          => 'edge_menu_area_border_meta',
			'type'          => 'select',
			'label'         => esc_html__('Menu Area Border', 'adorn'),
			'description'   => esc_html__('Set border on menu area', 'adorn'),
			'parent'        => $menu_area_container,
			'default_value' => '',
			'options'       => array(
				''    => '',
				'no'  => esc_html__('No', 'adorn'),
				'yes' => esc_html__('Yes', 'adorn')
			),
			'args'          => array(
				'dependence' => true,
				'hide'       => array(
					''    => '#edge_menu_area_border_bottom_color_container',
					'no'  => '#edge_menu_area_border_bottom_color_container',
					'yes' => ''
				),
				'show'       => array(
					''    => '',
					'no'  => '',
					'yes' => '#edge_menu_area_border_bottom_color_container'
				)
			)
		));

		$menu_area_border_bottom_color_container = adorn_edge_add_admin_container(array(
			'type'            => 'container',
			'name'            => 'menu_area_border_bottom_color_container',
			'parent'          => $menu_area_container,
			'hidden_property' => 'edge_menu_area_border_meta',
			'hidden_value'    => 'no',
			'hidden_values'   => array('', 'no')
		));

		adorn_edge_create_meta_box_field(array(
			'name'        => 'edge_menu_area_border_color_meta',
			'type'        => 'color',
			'label'       => esc_html__('Border Color', 'adorn'),
			'description' => esc_html__('Choose color of header bottom border', 'adorn'),
			'parent'      => $menu_area_border_bottom_color_container
		));

		do_action('adorn_edge_header_menu_area_additional_meta_options',$menu_area_container);
	}

	add_action('adorn_edge_header_menu_area_meta_options_map', 'adorn_edge_header_menu_area_meta_options_map', 10, 1);
}