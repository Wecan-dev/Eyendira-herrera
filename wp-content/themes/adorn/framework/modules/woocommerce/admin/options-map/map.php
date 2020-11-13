<?php

if ( ! function_exists('adorn_edge_woocommerce_options_map') ) {

	/**
	 * Add Woocommerce options page
	 */
	function adorn_edge_woocommerce_options_map() {

		adorn_edge_add_admin_page(
			array(
				'slug' => '_woocommerce_page',
				'title' => esc_html__('Woocommerce', 'adorn'),
				'icon' => 'fa fa-shopping-cart'
			)
		);

		/**
		 * Product List Settings
		 */
		$panel_product_list = adorn_edge_add_admin_panel(
			array(
				'page' => '_woocommerce_page',
				'name' => 'panel_product_list',
				'title' => esc_html__('Product List', 'adorn')
			)
		);

		adorn_edge_add_admin_field(array(
			'name'        	=> 'edge_woo_product_list_columns',
			'type'        	=> 'select',
			'label'       	=> esc_html__('Product List Columns', 'adorn'),
			'default_value'	=> 'edge-woocommerce-columns-4',
			'description' 	=> esc_html__('Choose number of columns for product listing', 'adorn'),
			'options'		=> array(
				'edge-woocommerce-columns-3' => esc_html__('3 Columns', 'adorn'),
				'edge-woocommerce-columns-4' => esc_html__('4 Columns', 'adorn')
			),
			'parent'      	=> $panel_product_list,
		));
		
		adorn_edge_add_admin_field(array(
			'name'        	=> 'edge_woo_product_list_columns_space',
			'type'        	=> 'select',
			'label'       	=> esc_html__('Space Between Products', 'adorn'),
			'default_value'	=> 'edge-woo-normal-space',
			'description' 	=> esc_html__('Select space between products for product listing and related products on single product', 'adorn'),
			'options'		=> array(
				'edge-woo-normal-space' => esc_html__('Normal', 'adorn'),
				'edge-woo-small-space'  => esc_html__('Small', 'adorn'),
				'edge-woo-no-space'     => esc_html__('No Space', 'adorn')
			),
			'parent'      	=> $panel_product_list,
		));
		
		adorn_edge_add_admin_field(array(
			'name'        	=> 'edge_woo_product_list_info_position',
			'type'        	=> 'select',
			'label'       	=> esc_html__('Product Info Position', 'adorn'),
			'default_value'	=> 'info_below_image',
			'description' 	=> esc_html__('Select product info position for product listing and related products on single product', 'adorn'),
			'options'		=> array(
				'info_below_image'    => esc_html__('Info Below Image', 'adorn'),
				'info_on_image_hover' => esc_html__('Info On Image Hover', 'adorn')
			),
			'parent'      	=> $panel_product_list,
		));

		adorn_edge_add_admin_field(array(
			'name'        	=> 'edge_woo_products_per_page',
			'type'        	=> 'text',
			'label'       	=> esc_html__('Number of products per page', 'adorn'),
			'default_value'	=> '',
			'description' 	=> esc_html__('Set number of products on shop page', 'adorn'),
			'parent'      	=> $panel_product_list,
			'args' 			=> array(
				'col_width' => 3
			)
		));

		adorn_edge_add_admin_field(array(
			'name'        	=> 'edge_products_list_title_tag',
			'type'        	=> 'select',
			'label'       	=> esc_html__('Products Title Tag', 'adorn'),
			'default_value'	=> 'h5',
			'description' 	=> '',
			'options'       => adorn_edge_get_title_tag(),
			'parent'      	=> $panel_product_list,
		));

		/**
		 * Single Product Settings
		 */
		$panel_single_product = adorn_edge_add_admin_panel(
			array(
				'page' => '_woocommerce_page',
				'name' => 'panel_single_product',
				'title' => esc_html__('Single Product', 'adorn')
			)
		);
			
			adorn_edge_add_admin_field(array(
				'name'          => 'woo_set_thumb_images_position',
				'type'          => 'select',
				'label'         => esc_html__('Set Thumbnail Images Position', 'adorn'),
				'default_value' => 'on-left-side',
				'options'		=> array(
					'below-image'  => esc_html__('Below Featured Image', 'adorn'),
					'on-left-side' => esc_html__('On The Left Side Of Featured Image', 'adorn')
				),
				'parent'        => $panel_single_product
			));

			adorn_edge_add_admin_field(array(
				'name'        	=> 'edge_single_product_title_tag',
				'type'        	=> 'select',
				'label'       	=> esc_html__('Single Product Title Tag', 'adorn'),
				'default_value'	=> 'h3',
				'description' 	=> '',
				'options'       => adorn_edge_get_title_tag(),
				'parent'      	=> $panel_single_product,
			));

            adorn_edge_add_admin_field(
                array(
                    'type' => 'select',
                    'name' => 'show_title_area_woo',
                    'default_value' => '',
                    'label'       => esc_html__('Show Title Area', 'adorn'),
                    'description' => esc_html__('Enabling this option will show title area on single post pages', 'adorn'),
                    'parent'      => $panel_single_product,
                    'options' => array(
                        '' => esc_html__('Default', 'adorn'),
                        'yes' => esc_html__('Yes', 'adorn'),
                        'no' => esc_html__('No', 'adorn')
                    ),
                    'args' => array(
                        'col_width' => 3
                    )
                )
            );

        adorn_edge_add_admin_field(
            array(
                'name'          => 'woo_set_single_images_behavior',
                'type'          => 'select',
                'default_value' => '',
                'label'         => esc_html__( 'Set Images Behavior', 'adorn' ),
                'options'       => array(
                    ''             => esc_html__( 'No Behavior', 'adorn' ),
                    'pretty-photo' => esc_html__( 'Pretty Photo Lightbox', 'adorn' )
                ),
                'parent'        => $panel_single_product
            )
        );
	}

	add_action( 'adorn_edge_options_map', 'adorn_edge_woocommerce_options_map', 19);
}