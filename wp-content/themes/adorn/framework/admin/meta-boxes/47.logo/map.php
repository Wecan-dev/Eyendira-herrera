<?php

if (!function_exists('adorn_edge_logo_meta_box_map')) {
    function adorn_edge_logo_meta_box_map() {

        $logo_meta_box = adorn_edge_create_meta_box(
            array(
                'scope' => array('page', 'portfolio-item', 'post', 'edge-team-member'),
                'title' => esc_html__('Logo', 'adorn'),
                'name'  => 'logo_meta'
            )
        );


        adorn_edge_create_meta_box_field(
            array(
                'name'          => 'edge_logo_image_meta',
                'type'          => 'image',
                'label'         => esc_html__('Logo Image - Default', 'adorn'),
                'description'   => esc_html__('Choose a default logo image to display ', 'adorn'),
                'parent'        => $logo_meta_box
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name'          => 'edge_logo_image_dark_meta',
                'type'          => 'image',
                'label'         => esc_html__('Logo Image - Dark', 'adorn'),
                'description'   => esc_html__('Choose a default logo image to display ', 'adorn'),
                'parent'        => $logo_meta_box
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name'          => 'edge_logo_image_light_meta',
                'type'          => 'image',
                'label'         => esc_html__('Logo Image - Light', 'adorn'),
                'description'   => esc_html__('Choose a default logo image to display ', 'adorn'),
                'parent'        => $logo_meta_box
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name'          => 'edge_logo_image_sticky_meta',
                'type'          => 'image',
                'label'         => esc_html__('Logo Image - Sticky', 'adorn'),
                'description'   => esc_html__('Choose a default logo image to display ', 'adorn'),
                'parent'        => $logo_meta_box
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name'          => 'edge_logo_image_mobile_meta',
                'type'          => 'image',
                'label'         => esc_html__('Logo Image - Mobile', 'adorn'),
                'description'   => esc_html__('Choose a default logo image to display ', 'adorn'),
                'parent'        => $logo_meta_box
            )
        );
    }

    add_action('adorn_edge_meta_boxes_map', 'adorn_edge_logo_meta_box_map');
}