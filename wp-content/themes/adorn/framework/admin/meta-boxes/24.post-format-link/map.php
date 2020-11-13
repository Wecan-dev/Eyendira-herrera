<?php

if(!function_exists('adorn_edge_map_post_link_meta')) {
    function adorn_edge_map_post_link_meta() {
        $link_post_format_meta_box = adorn_edge_create_meta_box(
            array(
                'scope' => array('post'),
                'title' => esc_html__('Link Post Format', 'adorn'),
                'name' => 'post_format_link_meta'
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name'        => 'edge_post_link_link_meta',
                'type'        => 'text',
                'label'       => esc_html__('Link', 'adorn'),
                'description' => esc_html__('Enter link', 'adorn'),
                'parent'      => $link_post_format_meta_box,

            )
        );


    }

    add_action('adorn_edge_meta_boxes_map', 'adorn_edge_map_post_link_meta', 24);
}