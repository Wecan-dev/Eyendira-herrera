<?php

if(!function_exists('edge_core_map_testimonials_meta')) {
    function edge_core_map_testimonials_meta() {
        $testimonial_meta_box = adorn_edge_create_meta_box(
            array(
                'scope' => array('testimonials'),
                'title' => esc_html__('Testimonial', 'edge-core'),
                'name' => 'testimonial_meta'
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name'        	=> 'edge_testimonial_title',
                'type'        	=> 'text',
                'label'       	=> esc_html__('Title', 'edge-core'),
                'description' 	=> esc_html__('Enter testimonial title', 'edge-core'),
                'parent'      	=> $testimonial_meta_box,
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name'        	=> 'edge_testimonial_text',
                'type'        	=> 'text',
                'label'       	=> esc_html__('Text', 'edge-core'),
                'description' 	=> esc_html__('Enter testimonial text', 'edge-core'),
                'parent'      	=> $testimonial_meta_box,
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name'        	=> 'edge_testimonial_author',
                'type'        	=> 'text',
                'label'       	=> esc_html__('Author', 'edge-core'),
                'description' 	=> esc_html__('Enter author name', 'edge-core'),
                'parent'      	=> $testimonial_meta_box,
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name'        	=> 'edge_testimonial_position',
                'type'        	=> 'text',
                'label'       	=> esc_html__('Author Position', 'edge-core'),
                'description' 	=> esc_html__('Enter Author Position', 'edge-core'),
                'parent'      	=> $testimonial_meta_box,
            )
        );
    }

    add_action('adorn_edge_meta_boxes_map', 'edge_core_map_testimonials_meta', 95);
}