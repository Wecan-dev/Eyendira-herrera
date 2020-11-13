<?php

if(!function_exists('edge_core_map_portfolio_settings_meta')) {
    function edge_core_map_portfolio_settings_meta() {
        $meta_box = adorn_edge_create_meta_box(array(
            'scope' => 'portfolio-item',
            'title' => esc_html__('Portfolio Settings', 'edge-core'),
            'name'  => 'portfolio_settings_meta_box'
        ));

        adorn_edge_create_meta_box_field(array(
            'name'        => 'edge_portfolio_single_template_meta',
            'type'        => 'select',
            'label'       => esc_html__('Portfolio Type', 'edge-core'),
            'description' => esc_html__('Choose a default type for Single Project pages', 'edge-core'),
            'parent'      => $meta_box,
            'options'     => array(
                ''                  => esc_html__('Default', 'edge-core'),
                'huge-images'       => esc_html__('Portfolio Full Width Images', 'edge-core'),
                'images'            => esc_html__('Portfolio Images', 'edge-core'),
                'small-images'      => esc_html__('Portfolio Small Images', 'edge-core'),
                'slider'            => esc_html__('Portfolio Slider', 'edge-core'),
                'small-slider'      => esc_html__('Portfolio Small Slider', 'edge-core'),
                'gallery'           => esc_html__('Portfolio Gallery', 'edge-core'),
                'small-gallery'     => esc_html__('Portfolio Small Gallery', 'edge-core'),
                'masonry'           => esc_html__('Portfolio Masonry', 'edge-core'),
                'small-masonry'     => esc_html__('Portfolio Small Masonry', 'edge-core'),
                'custom'            => esc_html__('Portfolio Custom', 'edge-core'),
                'full-width-custom' => esc_html__('Portfolio Full Width Custom', 'edge-core')
            ),
            'args' => array(
	            'dependence' => true,
	            'show' => array(
		            ''                  => '',
	            	'huge-images'       => '',
		            'images'            => '',
		            'small-images'      => '',
		            'slider'            => '',
		            'small-slider'      => '',
		            'gallery'           => '#edge_edge_gallery_type_meta_container',
		            'small-gallery'     => '#edge_edge_gallery_type_meta_container',
		            'masonry'           => '#edge_edge_masonry_type_meta_container',
		            'small-masonry'     => '#edge_edge_masonry_type_meta_container',
		            'custom'            => '',
		            'full-width-custom' => ''
	            ),
	            'hide' => array(
		            ''                  => '#edge_edge_gallery_type_meta_container, #edge_edge_masonry_type_meta_container',
	            	'huge-images'       => '#edge_edge_gallery_type_meta_container, #edge_edge_masonry_type_meta_container',
		            'images'            => '#edge_edge_gallery_type_meta_container, #edge_edge_masonry_type_meta_container',
		            'small-images'      => '#edge_edge_gallery_type_meta_container, #edge_edge_masonry_type_meta_container',
		            'slider'            => '#edge_edge_gallery_type_meta_container, #edge_edge_masonry_type_meta_container',
		            'small-slider'      => '#edge_edge_gallery_type_meta_container, #edge_edge_masonry_type_meta_container',
		            'gallery'           => '#edge_edge_masonry_type_meta_container',
		            'small-gallery'     => '#edge_edge_masonry_type_meta_container',
		            'masonry'           => '#edge_edge_gallery_type_meta_container',
		            'small-masonry'     => '#edge_edge_gallery_type_meta_container',
		            'custom'            => '#edge_edge_gallery_type_meta_container, #edge_edge_masonry_type_meta_container',
		            'full-width-custom' => '#edge_edge_gallery_type_meta_container, #edge_edge_masonry_type_meta_container'
	            )
            )
        ));
	
	    /***************** Gallery Layout *****************/
	
	    $gallery_type_meta_container = adorn_edge_add_admin_container(
		    array(
			    'parent' => $meta_box,
			    'name' => 'edge_gallery_type_meta_container',
			    'hidden_property' => 'edge_portfolio_single_template_meta',
			    'hidden_values' => array(
				    'huge-images',
				    'images',
				    'small-images',
				    'slider',
				    'small-slider',
				    'masonry',
				    'small-masonry',
				    'custom',
				    'full-width-custom'
			    )
		    )
	    );
	
	        adorn_edge_create_meta_box_field(array(
			    'name'        => 'edge_portfolio_single_gallery_columns_number_meta',
			    'type'        => 'select',
			    'label'       => esc_html__('Number of Columns', 'edge-core'),
			    'default_value' => '',
			    'description' => esc_html__('Set number of columns for portfolio gallery type', 'edge-core'),
			    'parent'      => $gallery_type_meta_container,
			    'options'     => array(
				    ''      => esc_html__('Default', 'edge-core'),
				    'two'   => esc_html__('2 Columns', 'edge-core'),
				    'three' => esc_html__('3 Columns', 'edge-core'),
				    'four'  => esc_html__('4 Columns', 'edge-core')
			    )
		    ));
	
	        adorn_edge_create_meta_box_field(array(
			    'name'        => 'edge_portfolio_single_gallery_space_between_items_meta',
			    'type'        => 'select',
			    'label'       => esc_html__('Space Between Items', 'edge-core'),
			    'default_value' => '',
			    'description' => esc_html__('Set space size between columns for portfolio gallery type', 'edge-core'),
			    'parent'      => $gallery_type_meta_container,
			    'options'     => array(
				    ''          => esc_html__('Default', 'edge-core'),
				    'normal'    => esc_html__('Normal', 'edge-core'),
				    'small'     => esc_html__('Small', 'edge-core'),
				    'tiny'      => esc_html__('Tiny', 'edge-core'),
				    'no'        => esc_html__('No Space', 'edge-core')
			    )
		    ));
	
	    /***************** Gallery Layout *****************/
	
	    /***************** Masonry Layout *****************/
	
	    $masonry_type_meta_container = adorn_edge_add_admin_container(
		    array(
			    'parent' => $meta_box,
			    'name' => 'edge_masonry_type_meta_container',
			    'hidden_property' => 'edge_portfolio_single_template_meta',
			    'hidden_values' => array(
				    'huge-images',
				    'images',
				    'small-images',
				    'slider',
				    'small-slider',
				    'gallery',
				    'small-gallery',
				    'custom',
				    'full-width-custom'
			    )
		    )
	    );
	
		    adorn_edge_create_meta_box_field(array(
			    'name'        => 'edge_portfolio_single_masonry_columns_number_meta',
			    'type'        => 'select',
			    'label'       => esc_html__('Number of Columns', 'edge-core'),
			    'default_value' => '',
			    'description' => esc_html__('Set number of columns for portfolio masonry type', 'edge-core'),
			    'parent'      => $masonry_type_meta_container,
			    'options'     => array(
				    ''      => esc_html__('Default', 'edge-core'),
				    'two'   => esc_html__('2 Columns', 'edge-core'),
				    'three' => esc_html__('3 Columns', 'edge-core'),
				    'four'  => esc_html__('4 Columns', 'edge-core')
			    )
		    ));
		
		    adorn_edge_create_meta_box_field(array(
			    'name'        => 'edge_portfolio_single_masonry_space_between_items_meta',
			    'type'        => 'select',
			    'label'       => esc_html__('Space Between Items', 'edge-core'),
			    'default_value' => '',
			    'description' => esc_html__('Set space size between columns for portfolio masonry type', 'edge-core'),
			    'parent'      => $masonry_type_meta_container,
			    'options'     => array(
				    ''          => esc_html__('Default', 'edge-core'),
				    'normal'    => esc_html__('Normal', 'edge-core'),
				    'small'     => esc_html__('Small', 'edge-core'),
				    'tiny'      => esc_html__('Tiny', 'edge-core'),
				    'no'        => esc_html__('No Space', 'edge-core')
			    )
		    ));
	
	    /***************** Masonry Layout *****************/

        adorn_edge_create_meta_box_field(
            array(
                'name' => 'edge_show_title_area_portfolio_single_meta',
                'type' => 'select',
                'default_value' => '',
                'label'       => esc_html__('Show Title Area', 'edge-core'),
                'description' => esc_html__('Enabling this option will show title area on your single portfolio page', 'edge-core'),
                'parent'      => $meta_box,
                'options' => array(
                    '' => esc_html__('Default', 'edge-core'),
                    'yes' => esc_html__('Yes', 'edge-core'),
                    'no' => esc_html__('No', 'edge-core')
                )
            )
        );

	    adorn_edge_create_meta_box_field(array(
		    'name'        => 'portfolio_info_top_padding',
		    'type'        => 'text',
		    'label'       => esc_html__('Portfolio Info Top Padding', 'edge-core'),
		    'description' => esc_html__('Set top padding for portfolio info elements holder. This option works only for Portfolio Images, Slider, Gallery and Masonry portfolio types', 'edge-core'),
		    'parent'      => $meta_box,
		    'args'        => array(
			    'col_width' => 3,
			    'suffix' => 'px'
		    )
	    ));

        $all_pages = array();
        $pages     = get_pages();
        foreach($pages as $page) {
            $all_pages[$page->ID] = $page->post_title;
        }

        adorn_edge_create_meta_box_field(array(
            'name'        => 'portfolio_single_back_to_link',
            'type'        => 'select',
            'label'       => esc_html__('"Back To" Link', 'edge-core'),
            'description' => esc_html__('Choose "Back To" page to link from portfolio Single Project page', 'edge-core'),
            'parent'      => $meta_box,
            'options'     => $all_pages
        ));

        adorn_edge_create_meta_box_field(array(
            'name'        => 'portfolio_external_link',
            'type'        => 'text',
            'label'       => esc_html__('Portfolio External Link', 'edge-core'),
            'description' => esc_html__('Enter URL to link from Portfolio List page', 'edge-core'),
            'parent'      => $meta_box,
            'args'        => array(
                'col_width' => 3
            )
        ));
	
	    adorn_edge_create_meta_box_field(
		    array(
			    'name' => 'edge_portfolio_featured_image_meta',
			    'type' => 'image',
			    'label' => esc_html__('Featured Image', 'edge-core'),
			    'description' => esc_html__('Choose an image for Portfolio Lists shortcode where Hover Type option is Switch Featured Images', 'edge-core'),
			    'parent' => $meta_box
		    )
	    );
	
	    adorn_edge_create_meta_box_field(array(
		    'name' => 'edge_portfolio_masonry_fixed_dimensions_meta',
		    'type' => 'select',
		    'label' => esc_html__('Dimensions for Masonry - Image Fixed Proportion', 'edge-core'),
		    'description' => esc_html__('Choose image layout when it appears in Masonry type portfolio lists where image proportion is fixed', 'edge-core'),
		    'default_value' => 'default',
		    'parent' => $meta_box,
		    'options' => array(
			    'default' => esc_html__('Default', 'edge-core'),
			    'large-width' => esc_html__('Large Width', 'edge-core'),
			    'large-height' => esc_html__('Large Height', 'edge-core'),
			    'large-width-height' => esc_html__('Large Width/Height', 'edge-core')
		    )
	    ));
	
	    adorn_edge_create_meta_box_field(array(
		    'name' => 'edge_portfolio_masonry_original_dimensions_meta',
		    'type' => 'select',
		    'label' => esc_html__('Dimensions for Masonry - Image Original Proportion', 'edge-core'),
		    'description' => esc_html__('Choose image layout when it appears in Masonry type portfolio lists where image proportion is original', 'edge-core'),
		    'default_value' => 'default',
		    'parent' => $meta_box,
		    'options' => array(
			    'default' => esc_html__('Default', 'edge-core'),
			    'large-width' => esc_html__('Large Width', 'edge-core')
		    )
	    ));

        adorn_edge_create_meta_box_field(array(
            'name' => 'portfolio_slider_header_color',
            'type' => 'color',
            'label' => esc_html__('Title Color For Portfolio Slider', 'edge-core'),
            'description' => esc_html__('Choose title color for portfolio slider', 'edge-core'),
            'parent' => $meta_box,
            'args'        => array(
                'col_width' => 3
            )
        ));

        adorn_edge_create_meta_box_field(array(
            'name' => 'portfolio_slider_category_color',
            'type' => 'color',
            'label' => esc_html__('Category Color For Portfolio Slider', 'edge-core'),
            'description' => esc_html__('Choose category color for portfolio slider', 'edge-core'),
            'parent' => $meta_box,
            'args'        => array(
                'col_width' => 3
            )
        ));
    }

    add_action('adorn_edge_meta_boxes_map', 'edge_core_map_portfolio_settings_meta', 41);
}