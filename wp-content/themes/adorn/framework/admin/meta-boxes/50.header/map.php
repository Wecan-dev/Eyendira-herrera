<?php

foreach(glob(EDGE_FRAMEWORK_ROOT_DIR.'/admin/meta-boxes/50.header/*/*.php') as $meta_box_load) {
	include_once $meta_box_load;
}

if(!function_exists('adorn_edge_map_header_meta')) {
    function adorn_edge_map_header_meta() {
        $header_meta_box = adorn_edge_create_meta_box(
            array(
                'scope' => array('page', 'portfolio-item', 'post', 'team-member'),
                'title' => esc_html__('Header', 'adorn'),
                'name' => 'header_meta'
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name' => 'edge_header_type_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Choose Header Type', 'adorn'),
                'description' => esc_html__('Select header type layout', 'adorn'),
                'parent' => $header_meta_box,
                'options' => array(
					''                         => esc_html__('', 'adorn'),
					'header-standard'          => esc_html__('Standard Header', 'adorn'),
					'header-standard-extended' => esc_html__('Standard Extended Header', 'adorn'),
					'header-minimal'           => esc_html__('Minimal Header', 'adorn'),
					'header-divided'           => esc_html__('Divided Header', 'adorn'),
					'header-centered'          => esc_html__('Centered Header', 'adorn'),
					'header-top-menu'          => esc_html__('Top Menu Header', 'adorn'),
					'header-vertical'          => esc_html__('Vertical Header', 'adorn'),
					'header-vertical-closed'   => esc_html__('Vertical Closed Header', 'adorn')
                ),
				'args'          => array(
					"dependence" => true,
					'show' => array(
						'header-standard'          => '#edge_top_header_container,#edge_menu_area_container,#edge_menu_area_position_header_standard_container',
						'header-standard-extended' => '#edge_top_header_container,#edge_logo_area_container, #edge_menu_area_container',
						'header-minimal'           => '#edge_top_header_container,#edge_menu_area_container',
						'header-divided'           => '#edge_top_header_container,#edge_menu_area_container',
						'header-centered'          => '#edge_top_header_container,#edge_logo_area_container, #edge_menu_area_container,#edge_edge_logo_wrapper_padding_header_centered_meta, #edge_menu_area_position_header_centered_container',
						'header-top-menu'          => '#edge_logo_area_container,#edge_menu_area_container',
						'header-vertical'          => '#edge_header_vertical_area_meta_container',
						'header-vertical-closed'   => '#edge_header_vertical_area_meta_container'
					),
					'hide' => array(
						''						   => '#edge_logo_area_container, #edge_menu_area_container,#edge_header_vertical_area_meta_container, #edge_menu_area_position_header_centered_container',
						'header-standard'          => '#edge_logo_area_container,#edge_edge_logo_wrapper_padding_header_centered_meta,#edge_header_vertical_area_meta_container, #edge_menu_area_position_header_centered_container',
						'header-standard-extended' => '#edge_edge_logo_wrapper_padding_header_centered_meta,#edge_header_vertical_area_meta_container,#edge_menu_area_position_header_standard_container, #edge_menu_area_position_header_centered_container',
						'header-minimal'           => '#edge_logo_area_container,#edge_edge_logo_wrapper_padding_header_centered_meta,#edge_header_vertical_area_meta_container,#edge_menu_area_position_header_standard_container, #edge_menu_area_position_header_centered_container',
						'header-divided'           => '#edge_logo_area_container,#edge_edge_logo_wrapper_padding_header_centered_meta,#edge_header_vertical_area_meta_container,#edge_menu_area_position_header_standard_container, #edge_menu_area_position_header_centered_container',
						'header-centered'          => '#edge_header_vertical_area_meta_container,#edge_menu_area_position_header_standard_container',
						'header-top-menu'          => '#edge_top_header_container,#edge_edge_logo_wrapper_padding_header_centered_meta,#edge_header_vertical_area_meta_container,#edge_menu_area_position_header_standard_container, #edge_menu_area_position_header_centered_container',
						'header-vertical'          => '#edge_top_header_container,#edge_logo_area_container, #edge_menu_area_container,#edge_edge_logo_wrapper_padding_header_centered_meta',
						'header-vertical-closed'   => '#edge_top_header_container,#edge_logo_area_container, #edge_menu_area_container,#edge_edge_logo_wrapper_padding_header_centered_meta',
					)
				)
            )
        );

		adorn_edge_create_meta_box_field(
			array(
				'parent'          => $header_meta_box,
				'type'            => 'select',
				'name'            => 'edge_header_behaviour_meta',
				'default_value'   => '',
				'label'           => esc_html__('Choose Header behaviour', 'adorn'),
				'description'     => esc_html__('Select the behaviour of header when you scroll down to page', 'adorn'),
				'options'         => array(
					''                                => '',
					'no-behavior'                     => esc_html__('No Behavior', 'adorn'),
					'sticky-header-on-scroll-up'      => esc_html__('Sticky on scrol up', 'adorn'),
					'sticky-header-on-scroll-down-up' => esc_html__('Sticky on scrol up/down', 'adorn'),
					'fixed-on-scroll'                 => esc_html__('Fixed on scroll', 'adorn')
				),
				'hidden_property' => 'edge_header_type_meta',
				'hidden_value'    => '',
				'args'            => array(
					'dependence' => true,
					'show'       => array(
						''                                => '',
						'sticky-header-on-scroll-up'      => '',
						'sticky-header-on-scroll-down-up' => '#edge_edge_sticky_amount_container_meta_container',
						'no-behavior'                     => ''
					),
					'hide'       => array(
						''                                => '#edge_edge_sticky_amount_container_meta_container',
						'sticky-header-on-scroll-up'      => '#edge_edge_sticky_amount_container_meta_container',
						'sticky-header-on-scroll-down-up' => '',
						'no-behavior'                     => '#edge_edge_sticky_amount_container_meta_container'
					)
				)
			)
		);

		$sticky_amount_container = adorn_edge_add_admin_container(
			array(
				'parent'          => $header_meta_box,
				'name'            => 'edge_sticky_amount_container_meta_container',
				'hidden_property' => 'edge_header_behaviour_meta',
				'hidden_value'    => '',
				'hidden_values'   => array('', 'no-behavior', 'sticky-header-on-scroll-up, fixed-on-scroll'),
			)
		);

			adorn_edge_create_meta_box_field(
				array(
					'name'            => 'edge_scroll_amount_for_sticky_meta',
					'type'            => 'text',
					'label'           => esc_html__('Scroll amount for sticky header appearance', 'adorn'),
					'description'     => esc_html__('Define scroll amount for sticky header appearance', 'adorn'),
					'parent'          => $sticky_amount_container,
					'args'            => array(
						'col_width' => 2,
						'suffix'    => 'px'
					)
				)
			);

		adorn_edge_create_meta_box_field(
			array(
				'name' => 'edge_header_style_meta',
				'type' => 'select',
				'default_value' => '',
				'label' => esc_html__('Header Skin', 'adorn'),
				'description' => esc_html__('Choose a header style to make header elements (logo, main menu, side menu button) in that predefined style', 'adorn'),
				'parent' => $header_meta_box,
				'options' => array(
					'' => esc_html__('Default', 'adorn'),
					'light-header' => esc_html__('Light', 'adorn'),
					'dark-header' => esc_html__('Dark', 'adorn')
				)
			)
		);

        adorn_edge_create_meta_box_field(
            array(
                'name'          => 'edge_sticky_header_in_grid_meta',
                'type'          => 'select',
                'label'         => esc_html__('Sticky Header In Grid', 'adorn'),
                'description'   => esc_html__('Set sticky header content to be in grid', 'adorn'),
                'parent'        => $header_meta_box,
                'default_value' => '',
                'options'       => array(
                    ''    => esc_html__('Default', 'adorn'),
                    'no'  => esc_html__('No', 'adorn'),
                    'yes' => esc_html__('Yes', 'adorn')
                ),
            )
        );

		adorn_edge_create_meta_box_field(
			array(
				'name'          => 'edge_enable_wide_menu_background_meta',
				'type'          => 'select',
				'label'         => esc_html__('Enable Full Width Background for Wide Dropdown Type', 'adorn'),
				'description'   => esc_html__('Enabling this option will show full width background for wide dropdown type', 'adorn'),
				'parent'        => $header_meta_box,
				'default_value' => '',
				'options'       => array(
					''    => esc_html__('', 'adorn'),
					'no'  => esc_html__('No', 'adorn'),
					'yes' => esc_html__('Yes', 'adorn')
				),
			)
		);

		//top area
		do_action('adorn_edge_header_top_area_meta_options_map',$header_meta_box);

		//logo area
		do_action('adorn_edge_header_logo_area_meta_options_map',$header_meta_box);

		//menu area
		do_action('adorn_edge_header_menu_area_meta_options_map',$header_meta_box);

		//vertical area
		do_action('adorn_edge_header_vertical_area_meta_options_map',$header_meta_box);
    }

    add_action('adorn_edge_meta_boxes_map', 'adorn_edge_map_header_meta', 50);
}