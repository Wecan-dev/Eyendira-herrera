<?php

if(!function_exists('adorn_edge_map_post_quote_meta')) {
    function adorn_edge_map_post_quote_meta() {
        $quote_post_format_meta_box = adorn_edge_create_meta_box(
            array(
                'scope' =>	array('post'),
                'title' => esc_html__('Quote Post Format', 'adorn'),
                'name' 	=> 'post_format_quote_meta'
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name'        => 'edge_post_quote_text_meta',
                'type'        => 'text',
                'label'       => esc_html__('Quote Text', 'adorn'),
                'description' => esc_html__('Enter Quote text', 'adorn'),
                'parent'      => $quote_post_format_meta_box,

            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name'        => 'edge_post_quote_author_meta',
                'type'        => 'text',
                'label'       => esc_html__('Quote Author', 'adorn'),
                'description' => esc_html__('Enter Quote author', 'adorn'),
                'parent'      => $quote_post_format_meta_box,
            )
        );
    }

    add_action('adorn_edge_meta_boxes_map', 'adorn_edge_map_post_quote_meta', 25);
}