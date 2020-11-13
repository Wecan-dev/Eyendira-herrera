<?php

if(!function_exists('adorn_edge_map_sidebar_meta')) {
    function adorn_edge_map_sidebar_meta() {
        $edge_sidebar_meta_box = adorn_edge_create_meta_box(
            array(
                'scope' => array('page', 'portfolio-item', 'team-member'),
                'title' => esc_html__('Sidebar', 'adorn'),
                'name' => 'sidebar_meta'
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name'        => 'edge_sidebar_layout_meta',
                'type'        => 'select',
                'label'       => esc_html__('Layout', 'adorn'),
                'description' => esc_html__('Choose the sidebar layout', 'adorn'),
                'parent'      => $edge_sidebar_meta_box,
                'options'     => array(
                    ''			        => esc_html__('Default', 'adorn'),
                    'no-sidebar'		=> esc_html__('No Sidebar', 'adorn'),
                    'sidebar-33-right'	=> esc_html__('Sidebar 1/3 Right', 'adorn'),
                    'sidebar-25-right' 	=> esc_html__('Sidebar 1/4 Right', 'adorn'),
                    'sidebar-33-left' 	=> esc_html__('Sidebar 1/3 Left', 'adorn'),
                    'sidebar-25-left' 	=> esc_html__('Sidebar 1/4 Left', 'adorn')
                )
            )
        );

        $edge_custom_sidebars = adorn_edge_get_custom_sidebars();
        if(count($edge_custom_sidebars) > 0) {
            adorn_edge_create_meta_box_field(array(
                'name' => 'edge_custom_sidebar_area_meta',
                'type' => 'selectblank',
                'label' => esc_html__('Choose Widget Area in Sidebar', 'adorn'),
                'description' => esc_html__('Choose Custom Widget area to display in Sidebar"', 'adorn'),
                'parent' => $edge_sidebar_meta_box,
                'options' => $edge_custom_sidebars
            ));
        }
    }

    add_action('adorn_edge_meta_boxes_map', 'adorn_edge_map_sidebar_meta', 31);
}