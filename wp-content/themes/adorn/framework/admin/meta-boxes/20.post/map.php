<?php

/*** Post Settings ***/

if(!function_exists('adorn_edge_map_post_meta')) {
    function adorn_edge_map_post_meta() {

        $post_meta_box = adorn_edge_create_meta_box(
            array(
                'scope' => array('post'),
                'title' => esc_html__('Post', 'adorn'),
                'name' => 'post-meta'
            )
        );

        adorn_edge_create_meta_box_field(array(
            'name'        => 'edge_blog_single_type_meta',
            'type'        => 'select',
            'label'       => esc_html__('Blog Layout for Single Post Pages', 'adorn'),
            'description' => esc_html__('Choose a default blog layout for single post pages', 'adorn'),
            'default_value' => 'standard',
            'parent'      => $post_meta_box,
            'options'     => array(
                ''		                => esc_html__('Default', 'adorn'),
                'standard'              => esc_html__('Standard', 'adorn'),
                'title-area-empty'		=> esc_html__('Title Area Empty', 'adorn'),
                'title-area-info' 		=> esc_html__('Title Area Info', 'adorn')
            )
        ));
	
	    adorn_edge_create_meta_box_field(array(
		    'name'        => 'edge_blog_single_sidebar_layout_meta',
		    'type'        => 'select',
		    'label'       => esc_html__('Sidebar Layout', 'adorn'),
		    'description' => esc_html__('Choose a sidebar layout for Blog single page', 'adorn'),
		    'default_value'	=> '',
		    'parent'      => $post_meta_box,
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
		    adorn_edge_create_meta_box_field(array(
			    'name' => 'edge_blog_single_custom_sidebar_area_meta',
			    'type' => 'selectblank',
			    'label' => esc_html__('Sidebar to Display', 'adorn'),
			    'description' => esc_html__('Choose a sidebar to display on Blog single page. Default sidebar is "Sidebar"', 'adorn'),
			    'parent' => $post_meta_box,
			    'options' => adorn_edge_get_custom_sidebars()
		    ));
	    }

        adorn_edge_create_meta_box_field(
            array(
                'name' => 'edge_blog_list_featured_image_meta',
                'type' => 'image',
                'label' => esc_html__('Blog List Image', 'adorn'),
                'description' => esc_html__('Choose an Image for displaying in blog list. If not uploaded, featured image will be shown.', 'adorn'),
                'parent' => $post_meta_box
            )
        );

        adorn_edge_create_meta_box_field(array(
            'name' => 'edge_blog_masonry_gallery_fixed_dimensions_meta',
            'type' => 'select',
            'label' => esc_html__('Dimensions for Fixed Proportion', 'adorn'),
            'description' => esc_html__('Choose image layout when it appears in Masonry lists in fixed proportion', 'adorn'),
            'default_value' => 'default',
            'parent' => $post_meta_box,
            'options' => array(
                'default' => esc_html__('Default', 'adorn'),
                'large-width' => esc_html__('Large Width', 'adorn'),
                'large-height' => esc_html__('Large Height', 'adorn'),
                'large-width-height' => esc_html__('Large Width/Height', 'adorn')
            )
        ));

        adorn_edge_create_meta_box_field(array(
            'name' => 'edge_blog_masonry_gallery_original_dimensions_meta',
            'type' => 'select',
            'label' => esc_html__('Dimensions for Original Proportion', 'adorn'),
            'description' => esc_html__('Choose image layout when it appears in Masonry lists in original proportion', 'adorn'),
            'default_value' => 'default',
            'parent' => $post_meta_box,
            'options' => array(
                'default' => esc_html__('Default', 'adorn'),
                'large-width' => esc_html__('Large Width', 'adorn')
            )
        ));

        adorn_edge_create_meta_box_field(
            array(
                'name' => 'edge_show_title_area_blog_meta',
                'type' => 'select',
                'default_value' => '',
                'label'       => esc_html__('Show Title Area', 'adorn'),
                'description' => esc_html__('Enabling this option will show title area on your single post page', 'adorn'),
                'parent'      => $post_meta_box,
                'options' => array(
                    '' => esc_html__('Default', 'adorn'),
                    'yes' => esc_html__('Yes', 'adorn'),
                    'no' => esc_html__('No', 'adorn')
                )
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name' => 'edge_full_height_title_area_blog_meta',
                'type' => 'select',
                'default_value' => '',
                'label'       => esc_html__('Full Height Title', 'adorn'),
                'description' => esc_html__('Enabling this option will show title area in full height on your single post page standard title', 'adorn'),
                'parent'      => $post_meta_box,
                'options' => array(
                    '' => esc_html__('Default', 'adorn'),
                    'yes' => esc_html__('Yes', 'adorn'),
                    'no' => esc_html__('No', 'adorn')
                )
            )
        );
    }
    
    add_action('adorn_edge_meta_boxes_map', 'adorn_edge_map_post_meta', 20);
}
