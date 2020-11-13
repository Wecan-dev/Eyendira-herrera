<?php
if(!function_exists('adorn_edge_header_menu_area_options_map')) {

	function adorn_edge_header_menu_area_options_map($panel_header){

		$menu_area_container = adorn_edge_add_admin_container_no_style(
			array(
				'parent'          => $panel_header,
				'name'            => 'menu_area_container',
				'hidden_property' => 'header_type',
				'hidden_values'   => array('header-vertical','header-vertical-closed')
			)
		);

		adorn_edge_add_admin_section_title(
			array(
				'parent' => $menu_area_container,
				'name' => 'menu_area_style',
				'title' => esc_html__('Menu Area Style', 'adorn')
			)
		);

        $menu_area_position_header_standard_container = adorn_edge_add_admin_container(
            array(
                'parent' => $menu_area_container,
                'name' => 'menu_area_position_header_standard_container',
                'hidden_property' => 'header_type',
                'hidden_values' => array('header-minimal','header-divided','header-centered')
            )
        );

            adorn_edge_add_admin_field(
                array(
                    'parent'		=> $menu_area_position_header_standard_container,
                    'type'			=> 'select',
                    'name'			=> 'menu_area_position_header_standard',
                    'default_value'	=> 'center',
                    'options' => array(
                        'center'	=> esc_html__('Center', 'adorn'),
                        'right'		=> esc_html__('Right', 'adorn'),
                    ),
                    'label'			=> esc_html__('Menu Area Position', 'adorn'),
                    'description'	=> esc_html__('Set posistion of menu area for Standard Header Type', 'adorn'),
                )
            );

		adorn_edge_add_admin_field(
			array(
				'parent' => $menu_area_container,
				'type' => 'yesno',
				'name' => 'menu_area_in_grid',
				'default_value' => 'no',
				'label' => esc_html__('Menu Area In Grid', 'adorn'),
				'description' => esc_html__('Set menu area content to be in grid', 'adorn'),
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#edge_menu_area_in_grid_container'
				)
			)
		);

		$menu_area_in_grid_container = adorn_edge_add_admin_container(
			array(
				'parent' => $menu_area_container,
				'name' => 'menu_area_in_grid_container',
				'hidden_property' => 'menu_area_in_grid',
				'hidden_value' => 'no'
			)
		);

			adorn_edge_add_admin_field(
				array(
					'parent' => $menu_area_in_grid_container,
					'type' => 'color',
					'name' => 'menu_area_grid_background_color',
					'default_value' => '',
					'label' => esc_html__('Grid Background Color', 'adorn'),
					'description' => esc_html__('Set grid background color for menu area', 'adorn'),
				)
			);

			adorn_edge_add_admin_field(
				array(
					'parent' => $menu_area_in_grid_container,
					'type' => 'text',
					'name' => 'menu_area_grid_background_transparency',
					'default_value' => '',
					'label' => esc_html__('Grid Background Transparency', 'adorn'),
					'description' => esc_html__('Set grid background transparency for menu area', 'adorn'),
					'args' => array(
						'col_width' => 3
					)
				)
			);

			adorn_edge_add_admin_field(
				array(
					'parent' => $menu_area_in_grid_container,
					'type' => 'yesno',
					'name' => 'menu_area_in_grid_shadow',
					'default_value' => 'no',
					'label' => esc_html__('Grid Area Shadow', 'adorn'),
					'description' => esc_html__('Set shadow on grid area', 'adorn')
				)
			);

			adorn_edge_add_admin_field(
				array(
					'parent' => $menu_area_in_grid_container,
					'type' => 'yesno',
					'name' => 'menu_area_in_grid_border',
					'default_value' => 'no',
					'label' => esc_html__('Grid Area Border', 'adorn'),
					'description' => esc_html__('Set border on grid area', 'adorn'),
					'args' => array(
						'dependence' => true,
						'dependence_hide_on_yes' => '',
						'dependence_show_on_yes' => '#edge_menu_area_in_grid_border_container'
					)
				)
			);

			$menu_area_in_grid_border_container = adorn_edge_add_admin_container(
				array(
					'parent' => $menu_area_in_grid_container,
					'name' => 'menu_area_in_grid_border_container',
					'hidden_property' => 'menu_area_in_grid_border',
					'hidden_value' => 'no'
				)
			);

				adorn_edge_add_admin_field(
					array(
						'parent' => $menu_area_in_grid_border_container,
						'type' => 'color',
						'name' => 'menu_area_in_grid_border_color',
						'default_value' => '',
						'label' => esc_html__('Border Color', 'adorn'),
						'description' => esc_html__('Set border color for menu area', 'adorn'),
					)
				);

		adorn_edge_add_admin_field(
			array(
				'parent' => $menu_area_container,
				'type' => 'color',
				'name' => 'menu_area_background_color',
				'default_value' => '',
				'label' => esc_html__('Background color', 'adorn'),
				'description' => esc_html__('Set background color for menu area', 'adorn')
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $menu_area_container,
				'type' => 'text',
				'name' => 'menu_area_background_transparency',
				'default_value' => '',
				'label' => esc_html__('Background transparency', 'adorn'),
				'description' => esc_html__('Set background transparency for menu area', 'adorn'),
				'args' => array(
					'col_width' => 3
				)
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $menu_area_container,
				'type' => 'yesno',
				'name' => 'menu_area_shadow',
				'default_value' => 'no',
				'label' => esc_html__('Menu Area Area Shadow', 'adorn'),
				'description' => esc_html__('Set shadow on menu area', 'adorn'),
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $menu_area_container,
				'type' => 'yesno',
				'name' => 'menu_area_border',
				'default_value' => 'no',
				'label' => esc_html__('Menu Area Border', 'adorn'),
				'description' => esc_html__('Set border on menu area', 'adorn'),
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#edge_menu_area_border_container'
				)
			)
		);

		$menu_area_border_container = adorn_edge_add_admin_container(
			array(
				'parent' => $menu_area_container,
				'name' => 'menu_area_border_container',
				'hidden_property' => 'menu_area_border',
				'hidden_value' => 'no'
			)
		);

			adorn_edge_add_admin_field(
				array(
					'parent' => $menu_area_border_container,
					'type' => 'color',
					'name' => 'menu_area_border_color',
					'default_value' => '',
					'label' => esc_html__('Border Color', 'adorn'),
					'description' => esc_html__('Set border color for menu area', 'adorn'),
				)
			);

		adorn_edge_add_admin_field(
			array(
				'parent' => $menu_area_container,
				'type' => 'text',
				'name' => 'menu_area_height',
				'default_value' => '',
				'label' => esc_html__('Height', 'adorn'),
				'description' => esc_html__('Enter header height', 'adorn'),
				'args' => array(
					'col_width' => 3,
					'suffix' => 'px'
				)
			)
		);

		do_action('adorn_edge_header_menu_area_additional_options', $panel_header);
	}

	add_action('adorn_edge_header_menu_area_options_map', 'adorn_edge_header_menu_area_options_map', 10, 1);
}