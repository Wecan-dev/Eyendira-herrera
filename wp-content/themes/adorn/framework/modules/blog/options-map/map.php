<?php

if ( ! function_exists('adorn_edge_blog_options_map') ) {

	function adorn_edge_blog_options_map() {

		adorn_edge_add_admin_page(
			array(
				'slug' => '_blog_page',
				'title' => esc_html__('Blog', 'adorn'),
				'icon' => 'fa fa-files-o'
			)
		);

		/**
		 * Blog Lists
		 */
		$panel_blog_lists = adorn_edge_add_admin_panel(
			array(
				'page' => '_blog_page',
				'name' => 'panel_blog_lists',
				'title' => esc_html__('Blog Lists', 'adorn')
			)
		);

		adorn_edge_add_admin_field(array(
			'name'        => 'blog_list_type',
			'type'        => 'select',
			'label'       => esc_html__('Blog Layout for Archive Pages', 'adorn'),
			'description' => esc_html__('Choose a default blog layout for archived blog post lists', 'adorn'),
			'default_value' => 'standard',
			'parent'      => $panel_blog_lists,
			'options'     => array(
				'masonry'               => esc_html__('Blog: Masonry', 'adorn'),
				'masonry-gallery'       => esc_html__('Blog: Masonry Gallery', 'adorn'),
                'standard'              => esc_html__('Blog: Standard', 'adorn'),
			)
		));

		adorn_edge_add_admin_field(array(
			'name'        => 'archive_sidebar_layout',
			'type'        => 'select',
			'label'       => esc_html__('Sidebar Layout for Archive Pages', 'adorn'),
			'description' => esc_html__('Choose a sidebar layout for archived blog post lists', 'adorn'),
			'default_value' => '',
			'parent'      => $panel_blog_lists,
			'options'     => array(
				''		            => esc_html__('Default', 'adorn'),
				'no-sidebar'		=> esc_html__('No Sidebar', 'adorn'),
				'sidebar-33-right'	=> esc_html__('Sidebar 1/3 Right', 'adorn'),
				'sidebar-25-right' 	=> esc_html__('Sidebar 1/4 Right', 'adorn'),
				'sidebar-33-left' 	=> esc_html__('Sidebar 1/3 Left', 'adorn'),
				'sidebar-25-left' 	=> esc_html__('Sidebar 1/4 Left', 'adorn')
			)
		));
		
		$adorn_custom_sidebars = adorn_edge_get_custom_sidebars();
		if(count($adorn_custom_sidebars) > 0) {
			adorn_edge_add_admin_field(array(
				'name' => 'archive_custom_sidebar_area',
				'type' => 'selectblank',
				'label' => esc_html__('Sidebar to Display for Archive Pages', 'adorn'),
				'description' => esc_html__('Choose a sidebar to display on archived blog post lists. Default sidebar is "Sidebar Page"', 'adorn'),
				'parent' => $panel_blog_lists,
				'options' => adorn_edge_get_custom_sidebars()
			));
		}

        adorn_edge_add_admin_field(array(
            'name'        => 'blog_masonry_layout',
            'type'        => 'select',
            'label'       => esc_html__('Masonry - Layout', 'adorn'),
            'default_value' => 'in-grid',
            'description' => esc_html__('Set masonry layout. Default is in grid.', 'adorn'),
            'parent'      => $panel_blog_lists,
            'options'     => array(
                'in-grid'    => esc_html__('In Grid', 'adorn'),
                'full-width' => esc_html__('Full Width', 'adorn')
            )
        ));
		
		adorn_edge_add_admin_field(array(
			'name'        => 'blog_masonry_number_of_columns',
			'type'        => 'select',
			'label'       => esc_html__('Masonry - Number of Columns', 'adorn'),
			'default_value' => 'four',
			'description' => esc_html__('Set number of columns for your masonry blog lists. Default value is 4 columns', 'adorn'),
			'parent'      => $panel_blog_lists,
			'options'     => array(
				'two'   => esc_html__('2 Columns', 'adorn'),
				'three' => esc_html__('3 Columns', 'adorn'),
				'four'  => esc_html__('4 Columns', 'adorn'),
				'five'  => esc_html__('5 Columns', 'adorn')
			)
		));
		
		adorn_edge_add_admin_field(array(
			'name'        => 'blog_masonry_space_between_items',
			'type'        => 'select',
			'label'       => esc_html__('Masonry - Space Between Items', 'adorn'),
			'default_value' => 'normal',
			'description' => esc_html__('Set space size between posts for your masonry blog lists. Default value is normal', 'adorn'),
			'parent'      => $panel_blog_lists,
			'options'     => array(
				'normal'  => esc_html__('Normal', 'adorn'),
				'small'   => esc_html__('Small', 'adorn'),
				'tiny'    => esc_html__('Tiny', 'adorn'),
				'no'      => esc_html__('No Space', 'adorn')
			)
		));

        adorn_edge_add_admin_field(array(
            'name'        => 'blog_list_featured_image_proportion',
            'type'        => 'select',
            'label'       => esc_html__('Featured Image Proportion', 'adorn'),
            'default_value' => 'fixed',
            'description' => esc_html__('Choose type of proportions you want to use for featured images on blog lists.', 'adorn'),
            'parent'      => $panel_blog_lists,
            'options'     => array(
                'fixed'    => esc_html__('Fixed', 'adorn'),
                'original' => esc_html__('Original', 'adorn')
            )
        ));

		adorn_edge_add_admin_field(array(
			'name'        => 'blog_pagination_type',
			'type'        => 'select',
			'label'       => esc_html__('Pagination Type', 'adorn'),
			'description' => esc_html__('Choose a pagination layout for Blog Lists', 'adorn'),
			'parent'      => $panel_blog_lists,
			'default_value' => 'standard',
			'options'     => array(
				'standard'		  => esc_html__('Standard', 'adorn'),
				'load-more'		  => esc_html__('Load More', 'adorn'),
				'infinite-scroll' => esc_html__('Infinite Scroll', 'adorn'),
				'no-pagination'   => esc_html__('No Pagination', 'adorn')
			)
		));
	
		adorn_edge_add_admin_field(
			array(
				'type' => 'text',
				'name' => 'number_of_chars',
				'default_value' => '40',
				'label' => esc_html__('Number of Words in Excerpt', 'adorn'),
				'description' => esc_html__('Enter a number of words in excerpt (article summary). Default value is 40', 'adorn'),
				'parent' => $panel_blog_lists,
				'args' => array(
					'col_width' => 3
				)
			)
		);

		/**
		 * Blog Single
		 */
		$panel_blog_single = adorn_edge_add_admin_panel(
			array(
				'page' => '_blog_page',
				'name' => 'panel_blog_single',
				'title' => esc_html__('Blog Single', 'adorn')
			)
		);

        adorn_edge_add_admin_field(array(
            'name'        => 'blog_single_type',
            'type'        => 'select',
            'label'       => esc_html__('Blog Layout for Single Post Pages', 'adorn'),
            'description' => esc_html__('Choose a default blog layout for single post pages', 'adorn'),
            'default_value' => 'standard',
            'parent'      => $panel_blog_single,
            'options'     => array(
                'standard'              => esc_html__('Standard', 'adorn'),
                'title-area-empty'		=> esc_html__('Title Area Empty', 'adorn'),
                'title-area-info' 		=> esc_html__('Title Area Info', 'adorn')
            )
        ));

		adorn_edge_add_admin_field(array(
			'name'        => 'blog_single_sidebar_layout',
			'type'        => 'select',
			'label'       => esc_html__('Sidebar Layout', 'adorn'),
			'description' => esc_html__('Choose a sidebar layout for Blog Single pages', 'adorn'),
			'default_value'	=> '',
			'parent'      => $panel_blog_single,
			'options'     => array(
				''		            => esc_html__('Default', 'adorn'),
				'no-sidebar'		=> esc_html__('No Sidebar', 'adorn'),
				'sidebar-33-right'	=> esc_html__('Sidebar 1/3 Right', 'adorn'),
				'sidebar-25-right' 	=> esc_html__('Sidebar 1/4 Right', 'adorn'),
				'sidebar-33-left' 	=> esc_html__('Sidebar 1/3 Left', 'adorn'),
				'sidebar-25-left' 	=> esc_html__('Sidebar 1/4 Left', 'adorn')
			)
		));

		if(count($adorn_custom_sidebars) > 0) {
			adorn_edge_add_admin_field(array(
				'name' => 'blog_single_custom_sidebar_area',
				'type' => 'selectblank',
				'label' => esc_html__('Sidebar to Display', 'adorn'),
				'description' => esc_html__('Choose a sidebar to display on Blog Single pages. Default sidebar is "Sidebar"', 'adorn'),
				'parent' => $panel_blog_single,
				'options' => adorn_edge_get_custom_sidebars()
			));
		}
		
		adorn_edge_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'show_title_area_blog',
				'default_value' => '',
				'label'       => esc_html__('Show Title Area', 'adorn'),
				'description' => esc_html__('Enabling this option will show title area on single post pages', 'adorn'),
				'parent'      => $panel_blog_single,
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
				'type' => 'yesno',
				'name' => 'full_height_title_area_blog',
				'default_value' => 'no',
				'label'       => esc_html__('Full Height Title', 'adorn'),
				'description' => esc_html__('Enabling this option will show standard title area in full height on single post pages', 'adorn'),
				'parent'      => $panel_blog_single,
				'args' => array(
					'col_width' => 3
				)
			)
		);

		adorn_edge_add_admin_field(array(
			'name'          => 'blog_single_title_in_title_area',
			'type'          => 'yesno',
			'label'         => esc_html__('Show Post Title in Title Area', 'adorn'),
			'description'   => esc_html__('Enabling this option will show post title in title area on single post pages', 'adorn'),
			'parent'        => $panel_blog_single,
			'default_value' => 'no'
		));

		adorn_edge_add_admin_field(array(
			'name'			=> 'blog_single_related_posts',
			'type'			=> 'yesno',
			'label'			=> esc_html__('Show Related Posts', 'adorn'),
			'description'   => esc_html__('Enabling this option will show related posts on single post pages', 'adorn'),
			'parent'        => $panel_blog_single,
			'default_value' => 'yes'
		));

		adorn_edge_add_admin_field(array(
			'name'          => 'blog_single_comments',
			'type'          => 'yesno',
			'label'         => esc_html__('Show Comments Form', 'adorn'),
			'description'   => esc_html__('Enabling this option will show comments form on single post pages', 'adorn'),
			'parent'        => $panel_blog_single,
			'default_value' => 'yes'
		));

		adorn_edge_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'blog_single_navigation',
				'default_value' => 'no',
				'label' => esc_html__('Enable Prev/Next Single Post Navigation Links', 'adorn'),
				'description' => esc_html__('Enable navigation links through the blog posts (left and right arrows will appear)', 'adorn'),
				'parent' => $panel_blog_single,
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#edge_edge_blog_single_navigation_container'
				)
			)
		);

		$blog_single_navigation_container = adorn_edge_add_admin_container(
			array(
				'name' => 'edge_blog_single_navigation_container',
				'hidden_property' => 'blog_single_navigation',
				'hidden_value' => 'no',
				'parent' => $panel_blog_single,
			)
		);

		adorn_edge_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'blog_navigation_through_same_category',
				'default_value' => 'no',
				'label'       => esc_html__('Enable Navigation Only in Current Category', 'adorn'),
				'description' => esc_html__('Limit your navigation only through current category', 'adorn'),
				'parent'      => $blog_single_navigation_container,
				'args' => array(
					'col_width' => 3
				)
			)
		);

		adorn_edge_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'blog_author_info',
				'default_value' => 'yes',
				'label' => esc_html__('Show Author Info Box', 'adorn'),
				'description' => esc_html__('Enabling this option will display author name and descriptions on single post pages', 'adorn'),
				'parent' => $panel_blog_single,
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#edge_edge_blog_single_author_info_container'
				)
			)
		);

		$blog_single_author_info_container = adorn_edge_add_admin_container(
			array(
				'name' => 'edge_blog_single_author_info_container',
				'hidden_property' => 'blog_author_info',
				'hidden_value' => 'no',
				'parent' => $panel_blog_single,
			)
		);

		adorn_edge_add_admin_field(
			array(
				'type'        => 'yesno',
				'name' => 'blog_author_info_email',
				'default_value' => 'no',
				'label'       => esc_html__('Show Author Email', 'adorn'),
				'description' => esc_html__('Enabling this option will show author email', 'adorn'),
				'parent'      => $blog_single_author_info_container,
				'args' => array(
					'col_width' => 3
				)
			)
		);

		adorn_edge_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'blog_single_author_social',
				'default_value' => 'yes',
				'label'       => esc_html__('Show Author Social Icons', 'adorn'),
				'description' => esc_html__('Enabling this option will show author social icons on single post pages', 'adorn'),
				'parent'      => $blog_single_author_info_container,
				'args' => array(
					'col_width' => 3
				)
			)
		);
	}

	add_action( 'adorn_edge_options_map', 'adorn_edge_blog_options_map', 12);
}