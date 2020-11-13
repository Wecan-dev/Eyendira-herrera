<?php

if(!function_exists('edge_core_map_masonry_gallery_meta')) {
    function edge_core_map_masonry_gallery_meta() {
        $masonry_gallery_meta_box = adorn_edge_create_meta_box(
            array(
                'scope' => array('masonry-gallery'),
                'title' => esc_html__('Masonry Gallery General', 'edge-core'),
                'name' => 'masonry_gallery_meta'
            )
        );
	    
        adorn_edge_create_meta_box_field(
            array(
                'name' => 'edge_masonry_gallery_item_title_tag',
                'type' => 'select',
                'default_value' => 'h4',
                'label' => esc_html__('Title Tag', 'edge-core'),
                'parent' => $masonry_gallery_meta_box,
                'options' => adorn_edge_get_title_tag()
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name' => 'edge_masonry_gallery_item_text',
                'type' => 'text',
                'label' => esc_html__('Text', 'edge-core'),
                'parent' => $masonry_gallery_meta_box
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name' => 'edge_masonry_gallery_item_image',
                'type' => 'image',
                'label' => esc_html__('Custom Item Icon', 'edge-core'),
                'parent' => $masonry_gallery_meta_box
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name' => 'edge_masonry_gallery_item_link',
                'type' => 'text',
                'label' => esc_html__('Link', 'edge-core'),
                'parent' => $masonry_gallery_meta_box
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name' => 'edge_masonry_gallery_item_link_target',
                'type' => 'select',
                'default_value' => '_self',
                'label' => esc_html__('Link Target', 'edge-core'),
                'parent' => $masonry_gallery_meta_box,
                'options' => adorn_edge_get_link_target_array()
            )
        );

        adorn_edge_add_admin_section_title(array(
            'name'   => 'edge_section_style_title',
            'parent' => $masonry_gallery_meta_box,
            'title'  => esc_html__('Masonry Gallery Item Style', 'edge-core')
        ));

        adorn_edge_create_meta_box_field(
            array(
                'name' => 'edge_masonry_gallery_item_size',
                'type' => 'select',
                'default_value' => 'square-small',
                'label' => esc_html__('Size', 'edge-core'),
                'parent' => $masonry_gallery_meta_box,
                'options' => array(
                    'square-small'			=> esc_html__('Square Small', 'edge-core'),
                    'square-big'			=> esc_html__('Square Big', 'edge-core'),
                    'rectangle-portrait'	=> esc_html__('Rectangle Portrait', 'edge-core'),
                    'rectangle-landscape'	=> esc_html__('Rectangle Landscape', 'edge-core')
                )
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name' => 'edge_masonry_gallery_item_type',
                'type' => 'select',
                'default_value' => 'standard',
                'label' => esc_html__('Type', 'edge-core'),
                'parent' => $masonry_gallery_meta_box,
                'options' => array(
                    'standard'		=> esc_html__('Standard', 'edge-core'),
                    'with-button'	=> esc_html__('With Button', 'edge-core'),
                    'simple'		=> esc_html__('Simple', 'edge-core')
                ),
                'args' => array(
                    'dependence' => true,
                    'hide' => array(
                        'with-button' => '#edge_masonry_gallery_item_simple_type_container',
                        'simple' => '#edge_masonry_gallery_item_button_type_container',
                        'standard' => '#edge_masonry_gallery_item_button_type_container, #edge_masonry_gallery_item_simple_type_container'
                    ),
                    'show' => array(
                        'with-button' => '#edge_masonry_gallery_item_button_type_container',
                        'simple' => '#edge_masonry_gallery_item_simple_type_container',
                        'standard' => ''
                    )
                )
            )
        );

        $masonry_gallery_item_button_type_container = adorn_edge_add_admin_container_no_style(array(
            'name'				=> 'masonry_gallery_item_button_type_container',
            'parent'			=> $masonry_gallery_meta_box,
            'hidden_property'	=> 'edge_masonry_gallery_item_type',
            'hidden_values'		=> array('standard', 'simple')
        ));

        adorn_edge_create_meta_box_field(
            array(
                'name' => 'edge_masonry_gallery_button_label',
                'type' => 'text',
                'label' => esc_html__('Button Label', 'edge-core'),
                'parent' => $masonry_gallery_item_button_type_container
            )
        );

        $masonry_gallery_item_simple_type_container = adorn_edge_add_admin_container_no_style(array(
            'name'				=> 'masonry_gallery_item_simple_type_container',
            'parent'			=> $masonry_gallery_meta_box,
            'hidden_property'	=> 'edge_masonry_gallery_item_type',
            'hidden_values'		=> array('standard', 'with-button')
        ));

        adorn_edge_create_meta_box_field(
            array(
                'name' => 'edge_masonry_gallery_simple_content_background_skin',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Content Background Skin', 'edge-core'),
                'parent' => $masonry_gallery_item_simple_type_container,
                'options' => array(
                    'default' => esc_html__('Default', 'edge-core'),
                    'light'	=> esc_html__('Light', 'edge-core'),
                    'dark'	=> esc_html__('Dark', 'edge-core')
                )
            )
        );
    }

    add_action('adorn_edge_meta_boxes_map', 'edge_core_map_masonry_gallery_meta', 45);
}