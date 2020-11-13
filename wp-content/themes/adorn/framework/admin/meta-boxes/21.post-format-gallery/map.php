<?php

if(!function_exists('adorn_edge_map_post_gallery_meta')) {

    function adorn_edge_map_post_gallery_meta() {
        $gallery_post_format_meta_box = adorn_edge_create_meta_box(
            array(
                'scope' =>	array('post'),
                'title' => esc_html__('Gallery Post Format', 'adorn'),
                'name' 	=> 'post_format_gallery_meta'
            )
        );

        adorn_edge_add_multiple_images_field(
            array(
                'name'        => 'edge_post_gallery_images_meta',
                'label'       => esc_html__('Gallery Images', 'adorn'),
                'description' => esc_html__('Choose your gallery images', 'adorn'),
                'parent'      => $gallery_post_format_meta_box,
            )
        );
    }

    add_action('adorn_edge_meta_boxes_map', 'adorn_edge_map_post_gallery_meta', 21);
}
