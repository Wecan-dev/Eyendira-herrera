<?php

if(!function_exists('adorn_edge_map_woocommerce_meta')) {
    function adorn_edge_map_woocommerce_meta() {
        $woocommerce_meta_box = adorn_edge_create_meta_box(
            array(
                'scope' => array('product'),
                'title' => esc_html__('Product Meta', 'adorn'),
                'name' => 'woo_product_meta'
            )
        );

        adorn_edge_create_meta_box_field(array(
            'name'        => 'edge_product_featured_image_size',
            'type'        => 'select',
            'label'       => esc_html__('Dimensions for Product List Shortcode', 'adorn'),
            'description' => esc_html__('Choose image layout when it appears in Edge Product List - Masonry layout shortcode', 'adorn'),
            'parent'      => $woocommerce_meta_box,
            'options'     => array(
                'edge-woo-image-normal-width'		 => esc_html__('Default', 'adorn'),
				'edge-woo-image-large-width'        => esc_html__('Large width', 'adorn'),
				'edge-woo-image-large-height'       => esc_html__('Large height', 'adorn'),
				'edge-woo-image-large-width-height' => esc_html__('Large width/height', 'adorn'),
            )
        ));

	    adorn_edge_create_meta_box_field(array(
		    'name'        => 'product_masonry_layout',
		    'type'        => 'select',
		    'label'       => esc_html__('Dimensions for Custom Product List and Categories Shortcode', 'adorn'),
		    'parent'      => $woocommerce_meta_box,
		    'options'     => array(
			    'default-item' => esc_html__('Default Item', 'adorn'),
			    'large-width-height' => esc_html__('Large Width and Height', 'adorn'),
			    'large-width'   => esc_html__('Large Width', 'adorn'),
			    'large_height'   => esc_html__('Large Height', 'adorn')
		    )
	    ));

	    adorn_edge_create_meta_box_field(array(
		    'name'        => 'product_masonry_order',
		    'type'        => 'text',
		    'label'       => esc_html__('Item Order for Custom Product List and Categories Shortcode', 'adorn'),
		    'parent'      => $woocommerce_meta_box
	    ));

	    adorn_edge_create_meta_box_field(array(
		    'name'        => 'product_masonry_title_skin',
		    'type'        => 'select',
		    'label'       => esc_html__('Title Skin for Custom Product List and Categories Shortcode', 'adorn'),
		    'parent'      => $woocommerce_meta_box,
		    'options'     => array(
		    	'' => esc_html__('Default' , 'adorn'),
			    'light'  => esc_html__('Light', 'adorn'),
			    'dark' => esc_html__('Dark', 'adorn')
		    )
	    ));

        adorn_edge_create_meta_box_field(
            array(
                'name'          => 'edge_show_title_area_woo_meta',
                'type'          => 'select',
                'default_value' => '',
                'label'         => esc_html__('Show Title Area', 'adorn'),
                'description'   => esc_html__('Disabling this option will turn off page title area', 'adorn'),
                'parent'        => $woocommerce_meta_box,
                'options'       => adorn_edge_get_yes_no_select_array()
            )
        );

		adorn_edge_create_meta_box_field(array(
			'name'        => 'edge_single_product_new_meta',
			'type'        => 'select',
			'label'       => esc_html__('Enable New Product Mark', 'adorn'),
			'description' => esc_html__('Enabling this option will show new product mark on your product lists and product single', 'adorn'),
			'parent'      => $woocommerce_meta_box,
			'options'     => array(
				'no'  => esc_html__('No', 'adorn'),
				'yes' => esc_html__('Yes', 'adorn')
			)
		));

	    adorn_edge_create_meta_box_field(array(
		    'name'        => 'product_slider_skin',
		    'type'        => 'select',
		    'label'       => esc_html__('Choose Product Text Skin', 'adorn'),
		    'description' => esc_html__('Define Product Text Skin for Edge Product Single - Slider Shortcode', 'adorn'),
		    'parent'      => $woocommerce_meta_box,
		    'options'     => array(
			    'light'  => esc_html__('Light', 'adorn'),
			    'dark' => esc_html__('Dark', 'adorn')
		    )
	    ));
    }
	
    add_action('adorn_edge_meta_boxes_map', 'adorn_edge_map_woocommerce_meta', 99);
}