<?php

if ( ! function_exists('adorn_edge_portfolio_options_map') ) {
	function adorn_edge_portfolio_options_map() {

		adorn_edge_add_admin_page(array(
			'slug'  => '_portfolio',
			'title' => esc_html__('Portfolio', 'edge-core'),
			'icon'  => 'fa fa-camera-retro'
		));

		$panel_archive = adorn_edge_add_admin_panel(array(
			'title' => esc_html__('Portfolio Archive', 'edge-core'),
			'name'  => 'panel_portfolio_archive',
			'page'  => '_portfolio'
		));

		adorn_edge_add_admin_field(array(
			'name'        => 'portfolio_archive_number_of_items',
			'type'        => 'text',
			'label'       => esc_html__('Number of Items', 'edge-core'),
			'description' => esc_html__('Set number of items for your portfolio list on archive pages. Default value is 12', 'edge-core'),
			'parent'      => $panel_archive,
			'args'        => array(
				'col_width' => 3
			)
		));

		adorn_edge_add_admin_field(array(
			'name'        => 'portfolio_archive_number_of_columns',
			'type'        => 'select',
			'label'       => esc_html__('Number of Columns', 'edge-core'),
			'default_value' => '4',
			'description' => esc_html__('Set number of columns for your portfolio list on archive pages. Default value is 4 columns', 'edge-core'),
			'parent'      => $panel_archive,
			'options'     => array(
				'2' => esc_html__('2 Columns', 'edge-core'),
				'3' => esc_html__('3 Columns', 'edge-core'),
				'4' => esc_html__('4 Columns', 'edge-core'),
				'5' => esc_html__('5 Columns', 'edge-core')
			)
		));

		adorn_edge_add_admin_field(array(
			'name'        => 'portfolio_archive_space_between_items',
			'type'        => 'select',
			'label'       => esc_html__('Space Between Items', 'edge-core'),
			'default_value' => 'normal',
			'description' => esc_html__('Set space size between portfolio items for your portfolio list on archive pages. Default value is normal', 'edge-core'),
			'parent'      => $panel_archive,
			'options'     => array(
				'normal'    => esc_html__('Normal', 'edge-core'),
				'small'     => esc_html__('Small', 'edge-core'),
				'tiny'      => esc_html__('Tiny', 'edge-core'),
				'no'        => esc_html__('No Space', 'edge-core')
			)
		));

		adorn_edge_add_admin_field(array(
			'name'        => 'portfolio_archive_image_size',
			'type'        => 'select',
			'label'       => esc_html__('Image Proportions', 'edge-core'),
			'default_value' => 'landscape',
			'description' => esc_html__('Set image proportions for your portfolio list on archive pages. Default value is landscape', 'edge-core'),
			'parent'      => $panel_archive,
			'options'     => array(
				'full'      => esc_html__('Original', 'edge-core'),
				'landscape' => esc_html__('Landscape', 'edge-core'),
				'portrait'  => esc_html__('Portrait', 'edge-core'),
				'square'    => esc_html__('Square', 'edge-core')
			)
		));
		
		adorn_edge_add_admin_field(array(
			'name'        => 'portfolio_archive_item_layout',
			'type'        => 'select',
			'label'       => esc_html__('Item Style', 'edge-core'),
			'default_value' => 'standard-shader',
			'description' => esc_html__('Set item style for your portfolio list on archive pages. Default value is Standard - Shader', 'edge-core'),
			'parent'      => $panel_archive,
			'options'     => array(
				'standard-shader' => esc_html__('Standard - Shader', 'edge-core'),
				'gallery-overlay' => esc_html__('Gallery - Overlay', 'edge-core')
			)
		));

		$panel = adorn_edge_add_admin_panel(array(
			'title' => esc_html__('Portfolio Single', 'edge-core'),
			'name'  => 'panel_portfolio_single',
			'page'  => '_portfolio'
		));

		adorn_edge_add_admin_field(array(
			'name'          => 'portfolio_single_template',
			'type'          => 'select',
			'label'         => esc_html__('Portfolio Type', 'edge-core'),
			'default_value'	=> 'small-images',
			'description'   => esc_html__('Choose a default type for Single Project pages', 'edge-core'),
			'parent'        => $panel,
			'options'       => array(
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
					'huge-images'       => '',
					'images'            => '',
					'small-images'      => '',
					'slider'            => '',
					'small-slider'      => '',
					'gallery'           => '#edge_portfolio_gallery_container',
					'small-gallery'     => '#edge_portfolio_gallery_container',
					'masonry'           => '#edge_portfolio_masonry_container',
					'small-masonry'     => '#edge_portfolio_masonry_container',
					'custom'            => '',
					'full-width-custom' => ''
				),
				'hide' => array(
					'huge-images'       => '#edge_portfolio_gallery_container, #edge_portfolio_masonry_container',
					'images'            => '#edge_portfolio_gallery_container, #edge_portfolio_masonry_container',
					'small-images'      => '#edge_portfolio_gallery_container, #edge_portfolio_masonry_container',
					'slider'            => '#edge_portfolio_gallery_container, #edge_portfolio_masonry_container',
					'small-slider'      => '#edge_portfolio_gallery_container, #edge_portfolio_masonry_container',
					'gallery'           => '#edge_portfolio_masonry_container',
					'small-gallery'     => '#edge_portfolio_masonry_container',
					'masonry'           => '#edge_portfolio_gallery_container',
					'small-masonry'     => '#edge_portfolio_gallery_container',
					'custom'            => '#edge_portfolio_gallery_container, #edge_portfolio_masonry_container',
					'full-width-custom' => '#edge_portfolio_gallery_container, #edge_portfolio_masonry_container'
				)
			)
		));
		
		/***************** Gallery Layout *****************/
		
		$portfolio_gallery_container = adorn_edge_add_admin_container(array(
			'parent'          => $panel,
			'name'            => 'portfolio_gallery_container',
			'hidden_property' => 'portfolio_single_template',
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
		));
		
			adorn_edge_add_admin_field(array(
				'name'        => 'portfolio_single_gallery_columns_number',
				'type'        => 'select',
				'label'       => esc_html__('Number of Columns', 'edge-core'),
				'default_value' => 'three',
				'description' => esc_html__('Set number of columns for portfolio gallery type', 'edge-core'),
				'parent'      => $portfolio_gallery_container,
				'options'     => array(
					'two'   => esc_html__('2 Columns', 'edge-core'),
					'three' => esc_html__('3 Columns', 'edge-core'),
					'four'  => esc_html__('4 Columns', 'edge-core')
				)
			));
		
			adorn_edge_add_admin_field(array(
				'name'        => 'portfolio_single_gallery_space_between_items',
				'type'        => 'select',
				'label'       => esc_html__('Space Between Items', 'edge-core'),
				'default_value' => 'normal',
				'description' => esc_html__('Set space size between columns for portfolio gallery type', 'edge-core'),
				'parent'      => $portfolio_gallery_container,
				'options'     => array(
					'normal'    => esc_html__('Normal', 'edge-core'),
					'small'     => esc_html__('Small', 'edge-core'),
					'tiny'      => esc_html__('Tiny', 'edge-core'),
					'no'        => esc_html__('No Space', 'edge-core')
				)
			));
		
		/***************** Gallery Layout *****************/
		
		/***************** Masonry Layout *****************/
		
		$portfolio_masonry_container = adorn_edge_add_admin_container(array(
			'parent'          => $panel,
			'name'            => 'portfolio_masonry_container',
			'hidden_property' => 'portfolio_single_template',
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
		));
		
			adorn_edge_add_admin_field(array(
				'name'        => 'portfolio_single_masonry_columns_number',
				'type'        => 'select',
				'label'       => esc_html__('Number of Columns', 'edge-core'),
				'default_value' => 'three',
				'description' => esc_html__('Set number of columns for portfolio masonry type', 'edge-core'),
				'parent'      => $portfolio_masonry_container,
				'options'     => array(
					'two'   => esc_html__('2 Columns', 'edge-core'),
					'three' => esc_html__('3 Columns', 'edge-core'),
					'four'  => esc_html__('4 Columns', 'edge-core')
				)
			));
			
			adorn_edge_add_admin_field(array(
				'name'        => 'portfolio_single_masonry_space_between_items',
				'type'        => 'select',
				'label'       => esc_html__('Space Between Items', 'edge-core'),
				'default_value' => 'normal',
				'description' => esc_html__('Set space size between columns for portfolio masonry type', 'edge-core'),
				'parent'      => $portfolio_masonry_container,
				'options'     => array(
					'normal'    => esc_html__('Normal', 'edge-core'),
					'small'     => esc_html__('Small', 'edge-core'),
					'tiny'      => esc_html__('Tiny', 'edge-core'),
					'no'        => esc_html__('No Space', 'edge-core')
				)
			));
		
		/***************** Masonry Layout *****************/
		
		adorn_edge_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'show_title_area_portfolio_single',
				'default_value' => '',
				'label'       => esc_html__('Show Title Area', 'edge-core'),
				'description' => esc_html__('Enabling this option will show title area on single projects', 'edge-core'),
				'parent'      => $panel,
                'options' => array(
                    '' => esc_html__('Default', 'edge-core'),
                    'yes' => esc_html__('Yes', 'edge-core'),
                    'no' => esc_html__('No', 'edge-core')
                ),
				'args' => array(
					'col_width' => 3
				)
			)
		);

		adorn_edge_add_admin_field(array(
			'name'          => 'portfolio_single_lightbox_images',
			'type'          => 'yesno',
			'label'         => esc_html__('Enable Lightbox for Images', 'edge-core'),
			'description'   => esc_html__('Enabling this option will turn on lightbox functionality for projects with images', 'edge-core'),
			'parent'        => $panel,
			'default_value' => 'yes'
		));

		adorn_edge_add_admin_field(array(
			'name'          => 'portfolio_single_lightbox_videos',
			'type'          => 'yesno',
			'label'         => esc_html__('Enable Lightbox for Videos', 'edge-core'),
			'description'   => esc_html__('Enabling this option will turn on lightbox functionality for YouTube/Vimeo projects', 'edge-core'),
			'parent'        => $panel,
			'default_value' => 'no'
		));

		adorn_edge_add_admin_field(array(
			'name'          => 'portfolio_single_hide_date',
			'type'          => 'yesno',
			'label'         => esc_html__('Enable Date', 'edge-core'),
			'description'   => esc_html__('Enabling this option will enable date meta on single projects', 'edge-core'),
			'parent'        => $panel,
			'default_value' => 'yes'
		));
		
		adorn_edge_add_admin_field(array(
			'name'          => 'portfolio_single_sticky_sidebar',
			'type'          => 'yesno',
			'label'         => esc_html__('Enable Sticky Side Text', 'edge-core'),
			'description'   => esc_html__('Enabling this option will make side text sticky on Single Project pages. This option works only for Full Width Images, Small Images, Small Gallery and Small Masonry portfolio types', 'edge-core'),
			'parent'        => $panel,
			'default_value' => 'yes'
		));

		adorn_edge_add_admin_field(array(
			'name'          => 'portfolio_single_comments',
			'type'          => 'yesno',
			'label'         => esc_html__('Show Comments', 'edge-core'),
			'description'   => esc_html__('Enabling this option will show comments on your page', 'edge-core'),
			'parent'        => $panel,
			'default_value' => 'no'
		));

		adorn_edge_add_admin_field(array(
			'name'          => 'portfolio_single_hide_pagination',
			'type'          => 'yesno',
			'label'         => esc_html__('Hide Pagination', 'edge-core'),
			'description'   => esc_html__('Enabling this option will turn off portfolio pagination functionality', 'edge-core'),
			'parent'        => $panel,
			'default_value' => 'no',
			'args' => array(
				'dependence' => true,
				'dependence_hide_on_yes' => '#edge_navigate_same_category_container'
			)
		));

			$container_navigate_category = adorn_edge_add_admin_container(array(
				'name'            => 'navigate_same_category_container',
				'parent'          => $panel,
				'hidden_property' => 'portfolio_single_hide_pagination',
				'hidden_value'    => 'yes'
			));
	
				adorn_edge_add_admin_field(array(
					'name'            => 'portfolio_single_nav_same_category',
					'type'            => 'yesno',
					'label'           => esc_html__('Enable Pagination Through Same Category', 'edge-core'),
					'description'     => esc_html__('Enabling this option will make portfolio pagination sort through current category', 'edge-core'),
					'parent'          => $container_navigate_category,
					'default_value'   => 'no'
				));

		adorn_edge_add_admin_field(array(
			'name'        => 'portfolio_single_slug',
			'type'        => 'text',
			'label'       => esc_html__('Portfolio Single Slug', 'edge-core'),
			'description' => esc_html__('Enter if you wish to use a different Single Project slug (Note: After entering slug, navigate to Settings -> Permalinks and click "Save" in order for changes to take effect)', 'edge-core'),
			'parent'      => $panel,
			'args'        => array(
				'col_width' => 3
			)
		));
	}

	add_action( 'adorn_edge_options_map', 'adorn_edge_portfolio_options_map', 10);
}