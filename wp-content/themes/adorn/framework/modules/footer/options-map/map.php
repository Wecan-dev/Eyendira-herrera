<?php

if ( ! function_exists('adorn_edge_footer_options_map') ) {
	/**
	 * Add footer options
	 */
	function adorn_edge_footer_options_map() {

		adorn_edge_add_admin_page(
			array(
				'slug' => '_footer_page',
				'title' => esc_html__('Footer', 'adorn'),
				'icon' => 'fa fa-sort-amount-asc'
			)
		);

		$footer_panel = adorn_edge_add_admin_panel(
			array(
				'title' => esc_html__('Footer', 'adorn'),
				'name' => 'footer',
				'page' => '_footer_page'
			)
		);

		adorn_edge_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'footer_in_grid',
				'default_value' => 'yes',
				'label' => esc_html__('Footer in Grid', 'adorn'),
				'description' => esc_html__('Enabling this option will place Footer content in grid', 'adorn'),
				'parent' => $footer_panel,
			)
		);

		adorn_edge_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'show_footer_top',
				'default_value' => 'yes',
				'label' => esc_html__('Show Footer Top', 'adorn'),
				'description' => esc_html__('Enabling this option will show Footer Top area', 'adorn'),
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#edge_show_footer_top_container'
				),
				'parent' => $footer_panel,
			)
		);

		$show_footer_top_container = adorn_edge_add_admin_container(
			array(
				'name' => 'show_footer_top_container',
				'hidden_property' => 'show_footer_top',
				'hidden_value' => 'no',
				'parent' => $footer_panel
			)
		);

		adorn_edge_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'footer_top_columns',
				'parent' => $show_footer_top_container,
				'default_value' => '4',
				'label' => esc_html__('Footer Top Columns', 'adorn'),
				'description' => esc_html__('Choose number of columns for Footer Top area', 'adorn'),
				'options' => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4'
				)
			)
		);

        adorn_edge_add_admin_field(
            array(
                'type'          => 'select',
                'name'          => 'footer_top_skin',
                'default_value' => 'light',
                'label'         => esc_html__('Footer Top Skin', 'adorn'),
                'description'   => esc_html__('Choose a footer top style to make footer top widgets in that predefined style', 'adorn'),
                'options'       => array(
                    'standard' => esc_html__('Standard', 'adorn'),
                    'light'    => esc_html__('Light', 'adorn'),
                    'dark'     => esc_html__('Dark', 'adorn')
                ),
                'parent'        => $show_footer_top_container,
            )
        );

		adorn_edge_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'footer_top_columns_alignment',
				'default_value' => 'left',
				'label' => esc_html__('Footer Top Columns Alignment', 'adorn'),
				'description' => esc_html__('Text Alignment in Footer Columns', 'adorn'),
				'options' => array(
					''       => esc_html__('Default', 'adorn'),
					'left'   => esc_html__('Left', 'adorn'),
					'center' => esc_html__('Center', 'adorn'),
					'right'  => esc_html__('Right', 'adorn')
				),
				'parent' => $show_footer_top_container,
			)
		);

		adorn_edge_add_admin_field(array(
			'name' => 'footer_top_background_color',
			'type' => 'color',
			'label' => esc_html__('Background Color', 'adorn'),
			'description' => esc_html__('Set background color for top footer area', 'adorn'),
			'parent' => $show_footer_top_container
		));

		adorn_edge_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'show_footer_bottom',
				'default_value' => 'yes',
				'label' => esc_html__('Show Footer Bottom', 'adorn'),
				'description' => esc_html__('Enabling this option will show Footer Bottom area', 'adorn'),
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#edge_show_footer_bottom_container'
				),
				'parent' => $footer_panel,
			)
		);

		$show_footer_bottom_container = adorn_edge_add_admin_container(
			array(
				'name' => 'show_footer_bottom_container',
				'hidden_property' => 'show_footer_bottom',
				'hidden_value' => 'no',
				'parent' => $footer_panel
			)
		);

		adorn_edge_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'footer_bottom_columns',
				'default_value' => '3',
				'label' => esc_html__('Footer Bottom Columns', 'adorn'),
				'description' => esc_html__('Choose number of columns for Footer Bottom area', 'adorn'),
				'options' => array(
					'1' => '1',
					'2' => '2',
					'3' => '3'
				),
				'parent' => $show_footer_bottom_container,
			)
		);

        adorn_edge_add_admin_field(
            array(
                'type'          => 'select',
                'name'          => 'footer_bottom_skin',
                'default_value' => 'light',
                'label'         => esc_html__('Footer Bottom Skin', 'adorn'),
                'description'   => esc_html__('Choose a footer bottom style to make footer bottom widgets in that predefined style', 'adorn'),
                'options'       => array(
                    'standard' => esc_html__('Standard', 'adorn'),
                    'light'    => esc_html__('Light', 'adorn'),
                    'dark'     => esc_html__('Dark', 'adorn')
                ),
                'parent'        => $show_footer_bottom_container,
            )
        );

		adorn_edge_add_admin_field(array(
			'name' => 'footer_bottom_background_color',
			'type' => 'color',
			'label' => esc_html__('Background Color', 'adorn'),
			'description' => esc_html__('Set background color for bottom footer area', 'adorn'),
			'parent' => $show_footer_bottom_container
		));
	}

	add_action( 'adorn_edge_options_map', 'adorn_edge_footer_options_map', 10);
}