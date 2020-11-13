<?php

if(!function_exists('adorn_edge_map_post_audio_meta')) {
    function adorn_edge_map_post_audio_meta() {
        $audio_post_format_meta_box = adorn_edge_create_meta_box(
            array(
                'scope' =>	array('post'),
                'title' => esc_html__('Audio Post Format', 'adorn'),
                'name' 	=> 'post_format_audio_meta'
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name'        => 'edge_audio_type_meta',
                'type'        => 'select',
                'label'       => esc_html__('Audio Type', 'adorn'),
                'description' => esc_html__('Choose audio type', 'adorn'),
                'parent'      => $audio_post_format_meta_box,
                'default_value' => 'social_networks',
                'options'     => array(
                    'social_networks' => esc_html__('Audio Service', 'adorn'),
                    'self' => esc_html__('Self Hosted', 'adorn')
                ),
                'args' => array(
                    'dependence' => true,
                    'hide' => array(
                        'social_networks' => '#edge_edge_audio_self_hosted_container',
                        'self' => '#edge_edge_audio_embedded_container'
                    ),
                    'show' => array(
                        'social_networks' => '#edge_edge_audio_embedded_container',
                        'self' => '#edge_edge_audio_self_hosted_container')
                )
            )
        );

        $edge_audio_embedded_container = adorn_edge_add_admin_container(
            array(
                'parent' => $audio_post_format_meta_box,
                'name' => 'edge_audio_embedded_container',
                'hidden_property' => 'edge_audio_type_meta',
                'hidden_value' => 'self'
            )
        );

        $edge_audio_self_hosted_container = adorn_edge_add_admin_container(
            array(
                'parent' => $audio_post_format_meta_box,
                'name' => 'edge_audio_self_hosted_container',
                'hidden_property' => 'edge_audio_type_meta',
                'hidden_value' => 'social_networks'
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name'        => 'edge_post_audio_link_meta',
                'type'        => 'text',
                'label'       => esc_html__('Audio URL', 'adorn'),
                'description' => esc_html__('Enter audio URL', 'adorn'),
                'parent'      => $edge_audio_embedded_container,
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name'        => 'edge_post_audio_custom_meta',
                'type'        => 'text',
                'label'       => esc_html__('Audio Link', 'adorn'),
                'description' => esc_html__('Enter audio link', 'adorn'),
                'parent'      => $edge_audio_self_hosted_container,
            )
        );
    }

    add_action('adorn_edge_meta_boxes_map', 'adorn_edge_map_post_audio_meta', 23);
}