<?php

if(!function_exists('adorn_edge_map_blog_meta')) {
    function adorn_edge_map_blog_meta() {
        $edge_blog_categories = array();
        $categories = get_categories();
        foreach($categories as $category) {
            $edge_blog_categories[$category->slug] = $category->name;
        }

        $blog_meta_box = adorn_edge_create_meta_box(
            array(
                'scope' => array('page'),
                'title' => esc_html__('Blog', 'adorn'),
                'name' => 'blog_meta'
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name'        => 'edge_blog_category_meta',
                'type'        => 'selectblank',
                'label'       => esc_html__('Blog Category', 'adorn'),
                'description' => esc_html__('Choose category of posts to display (leave empty to display all categories)', 'adorn'),
                'parent'      => $blog_meta_box,
                'options'     => $edge_blog_categories
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name'        => 'edge_show_posts_per_page_meta',
                'type'        => 'text',
                'label'       => esc_html__('Number of Posts', 'adorn'),
                'description' => esc_html__('Enter the number of posts to display', 'adorn'),
                'parent'      => $blog_meta_box,
                'options'     => $edge_blog_categories,
                'args'        => array("col_width" => 3)
            )
        );

        adorn_edge_create_meta_box_field(array(
            'name'        => 'edge_blog_masonry_layout_meta',
            'type'        => 'select',
            'label'       => esc_html__('Masonry - Layout', 'adorn'),
            'description' => esc_html__('Set masonry layout. Default is in grid.', 'adorn'),
            'parent'      => $blog_meta_box,
            'options'     => array(
                ''      => esc_html__('Default', 'adorn'),
                'in-grid'   => esc_html__('In Grid', 'adorn'),
                'full-width' => esc_html__('Full Width', 'adorn')
            )
        ));

        adorn_edge_create_meta_box_field(array(
            'name'        => 'edge_blog_masonry_number_of_columns_meta',
            'type'        => 'select',
            'label'       => esc_html__('Masonry - Number of Columns', 'adorn'),
            'description' => esc_html__('Set number of columns for your masonry blog lists', 'adorn'),
            'parent'      => $blog_meta_box,
            'options'     => array(
                ''      => esc_html__('Default', 'adorn'),
                'two'   => esc_html__('2 Columns', 'adorn'),
                'three' => esc_html__('3 Columns', 'adorn'),
                'four'  => esc_html__('4 Columns', 'adorn'),
                'five'  => esc_html__('5 Columns', 'adorn')
            )
        ));

        adorn_edge_create_meta_box_field(array(
            'name'        => 'edge_blog_masonry_space_between_items_meta',
            'type'        => 'select',
            'label'       => esc_html__('Masonry - Space Between Items', 'adorn'),
            'description' => esc_html__('Set space size between posts for your masonry blog lists', 'adorn'),
            'parent'      => $blog_meta_box,
            'options'     => array(
                ''        => esc_html__('Default', 'adorn'),
                'normal'  => esc_html__('Normal', 'adorn'),
                'small'   => esc_html__('Small', 'adorn'),
                'tiny'    => esc_html__('Tiny', 'adorn'),
                'no'      => esc_html__('No Space', 'adorn')
            )
        ));

        adorn_edge_create_meta_box_field(array(
            'name'        => 'edge_blog_list_featured_image_proportion_meta',
            'type'        => 'select',
            'label'       => esc_html__('Featured Image Proportion', 'adorn'),
            'description' => esc_html__('Choose type of proportions you want to use for featured images on blog lists.', 'adorn'),
            'parent'      => $blog_meta_box,
            'default_value' => '',
            'options'     => array(
                ''		   => esc_html__('Default', 'adorn'),
                'fixed'    => esc_html__('Fixed', 'adorn'),
                'original' => esc_html__('Original', 'adorn')
            )
        ));

        adorn_edge_create_meta_box_field(array(
            'name'        => 'edge_blog_pagination_type_meta',
            'type'        => 'select',
            'label'       => esc_html__('Pagination Type', 'adorn'),
            'description' => esc_html__('Choose a pagination layout for Blog Lists', 'adorn'),
            'parent'      => $blog_meta_box,
            'default_value' => '',
            'options'     => array(
                ''                => esc_html__('Default', 'adorn'),
                'standard'		  => esc_html__('Standard', 'adorn'),
                'load-more'		  => esc_html__('Load More', 'adorn'),
                'infinite-scroll' => esc_html__('Infinite Scroll', 'adorn'),
                'no-pagination'   => esc_html__('No Pagination', 'adorn')
            )
        ));

        adorn_edge_create_meta_box_field(
            array(
                'type' => 'text',
                'name' => 'edge_number_of_chars_meta',
                'default_value' => '',
                'label' => esc_html__('Number of Words in Excerpt', 'adorn'),
                'description' => esc_html__('Enter a number of words in excerpt (article summary). Default value is 40', 'adorn'),
                'parent' => $blog_meta_box,
                'args' => array(
                    'col_width' => 3
                )
            )
        );



    }

    add_action('adorn_edge_meta_boxes_map', 'adorn_edge_map_blog_meta', 30);
}