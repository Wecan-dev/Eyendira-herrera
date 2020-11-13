<?php

if(!function_exists('adorn_edge_map_content_bottom_meta')) {
    function adorn_edge_map_content_bottom_meta() {
        $content_bottom_meta_box = adorn_edge_create_meta_box(
            array(
                'scope' => array('page', 'portfolio-item', 'post', 'team-member'),
                'title' => esc_html__('Content Bottom', 'adorn'),
                'name' => 'content_bottom_meta'
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name' => 'edge_enable_content_bottom_area_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Enable Content Bottom Area', 'adorn'),
                'description' => esc_html__('This option will enable Content Bottom area on pages', 'adorn'),
                'parent' => $content_bottom_meta_box,
                'options' => adorn_edge_get_yes_no_select_array(),
                'args' => array(
                    'dependence' => true,
                    'hide' => array(
                        '' => '#edge_edge_show_content_bottom_meta_container',
                        'no' => '#edge_edge_show_content_bottom_meta_container'
                    ),
                    'show' => array(
                        'yes' => '#edge_edge_show_content_bottom_meta_container'
                    )
                )
            )
        );

        $show_content_bottom_meta_container = adorn_edge_add_admin_container(
            array(
                'parent' => $content_bottom_meta_box,
                'name' => 'edge_show_content_bottom_meta_container',
                'hidden_property' => 'edge_enable_content_bottom_area_meta',
                'hidden_values' => array('','no')
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name' => 'edge_content_bottom_sidebar_custom_display_meta',
                'type' => 'selectblank',
                'default_value' => '',
                'label' => esc_html__('Sidebar to Display', 'adorn'),
                'description' => esc_html__('Choose a content bottom sidebar to display', 'adorn'),
                'options' => adorn_edge_get_custom_sidebars(),
                'parent' => $show_content_bottom_meta_container
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'type' => 'select',
                'name' => 'edge_content_bottom_in_grid_meta',
                'default_value' => '',
                'label' => esc_html__('Display in Grid', 'adorn'),
                'description' => esc_html__('Enabling this option will place content bottom in grid', 'adorn'),
                'options' => adorn_edge_get_yes_no_select_array(),
                'parent' => $show_content_bottom_meta_container
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'type' => 'color',
                'name' => 'edge_content_bottom_background_color_meta',
                'label' => esc_html__('Background Color', 'adorn'),
                'description' => esc_html__('Choose a background color for content bottom area', 'adorn'),
                'parent' => $show_content_bottom_meta_container
            )
        );
    }

    add_action('adorn_edge_meta_boxes_map', 'adorn_edge_map_content_bottom_meta', 71);
}