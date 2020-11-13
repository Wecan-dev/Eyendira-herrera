<?php

if(!function_exists('adorn_edge_map_post_video_meta')) {
    function adorn_edge_map_post_video_meta() {
        $video_post_format_meta_box = adorn_edge_create_meta_box(
            array(
                'scope' =>	array('post'),
                'title' => esc_html__('Video Post Format', 'adorn'),
                'name' 	=> 'post_format_video_meta'
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name'        => 'edge_video_type_meta',
                'type'        => 'select',
                'label'       => esc_html__('Video Type', 'adorn'),
                'description' => esc_html__('Choose video type', 'adorn'),
                'parent'      => $video_post_format_meta_box,
                'default_value' => 'social_networks',
                'options'     => array(
                    'social_networks' => esc_html__('Video Service', 'adorn'),
                    'self' => esc_html__('Self Hosted', 'adorn')
                ),
                'args' => array(
                    'dependence' => true,
                    'hide' => array(
                        'social_networks' => '#edge_edge_video_self_hosted_container',
                        'self' => '#edge_edge_video_embedded_container'
                    ),
                    'show' => array(
                        'social_networks' => '#edge_edge_video_embedded_container',
                        'self' => '#edge_edge_video_self_hosted_container')
                )
            )
        );

        $edge_video_embedded_container = adorn_edge_add_admin_container(
            array(
                'parent' => $video_post_format_meta_box,
                'name' => 'edge_video_embedded_container',
                'hidden_property' => 'edge_video_type_meta',
                'hidden_value' => 'self'
            )
        );

        $edge_video_self_hosted_container = adorn_edge_add_admin_container(
            array(
                'parent' => $video_post_format_meta_box,
                'name' => 'edge_video_self_hosted_container',
                'hidden_property' => 'edge_video_type_meta',
                'hidden_value' => 'social_networks'
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name'        => 'edge_post_video_link_meta',
                'type'        => 'text',
                'label'       => esc_html__('Video URL', 'adorn'),
                'description' => esc_html__('Enter Video URL', 'adorn'),
                'parent'      => $edge_video_embedded_container,
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name'        => 'edge_post_video_custom_meta',
                'type'        => 'text',
                'label'       => esc_html__('Video MP4', 'adorn'),
                'description' => esc_html__('Enter video URL for MP4 format', 'adorn'),
                'parent'      => $edge_video_self_hosted_container,
            )
        );
    }

    add_action('adorn_edge_meta_boxes_map', 'adorn_edge_map_post_video_meta', 22);
}