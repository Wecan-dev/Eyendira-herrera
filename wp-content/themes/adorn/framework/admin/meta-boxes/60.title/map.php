<?php

if(!function_exists('adorn_edge_map_title_meta')) {
    function adorn_edge_map_title_meta() {
        $title_meta_box = adorn_edge_create_meta_box(
            array(
                'scope' => array('page', 'portfolio-item', 'post', 'team-member'),
                'title' => esc_html__('Title', 'adorn'),
                'name' => 'title_meta'
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name' => 'edge_show_title_area_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Show Title Area', 'adorn'),
                'description' => esc_html__('Disabling this option will turn off page title area', 'adorn'),
                'parent' => $title_meta_box,
                'options' => adorn_edge_get_yes_no_select_array(),
                'args' => array(
                    "dependence" => true,
                    "hide" => array(
                        "" => "",
                        "no" => "#edge_edge_show_title_area_meta_container",
                        "yes" => ""
                    ),
                    "show" => array(
                        "" => "#edge_edge_show_title_area_meta_container",
                        "no" => "",
                        "yes" => "#edge_edge_show_title_area_meta_container"
                    )
                )
            )
        );

        $show_title_area_meta_container = adorn_edge_add_admin_container(
            array(
                'parent' => $title_meta_box,
                'name' => 'edge_show_title_area_meta_container',
                'hidden_property' => 'edge_show_title_area_meta',
                'hidden_value' => 'no'
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name' => 'edge_title_area_type_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Title Area Type', 'adorn'),
                'description' => esc_html__('Choose title type', 'adorn'),
                'parent' => $show_title_area_meta_container,
                'options' => array(
                    '' => esc_html__('Default', 'adorn'),
                    'standard' => esc_html__('Standard', 'adorn'),
                    'breadcrumb' => esc_html__('Breadcrumb', 'adorn')
                ),
                'args' => array(
                    "dependence" => true,
                    "hide" => array(
                        "standard" => "",
                        "breadcrumb" => "#edge_edge_title_area_type_meta_container"
                    ),
                    "show" => array(
                        "" => "#edge_edge_title_area_type_meta_container",
                        "standard" => "#edge_edge_title_area_type_meta_container",
                        "breadcrumb" => ""
                    )
                )
            )
        );

        $title_area_type_meta_container = adorn_edge_add_admin_container(
            array(
                'parent' => $show_title_area_meta_container,
                'name' => 'edge_title_area_type_meta_container',
                'hidden_property' => 'edge_title_area_type_meta',
                'hidden_value' => 'breadcrumb'
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name' => 'edge_title_area_enable_breadcrumbs_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Enable Breadcrumbs', 'adorn'),
                'description' => esc_html__('This option will display Breadcrumbs in Title Area', 'adorn'),
                'parent' => $title_area_type_meta_container,
                'options' => adorn_edge_get_yes_no_select_array()
            )
        );



        adorn_edge_create_meta_box_field(
            array(
                'name' => 'edge_title_area_vertical_alignment_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Vertical Alignment', 'adorn'),
                'description' => esc_html__('Specify title vertical alignment', 'adorn'),
                'parent' => $show_title_area_meta_container,
                'options' => array(
                    '' => esc_html__('Default', 'adorn'),
                    'header_bottom' => esc_html__('From Bottom of Header', 'adorn'),
                    'window_top' => esc_html__('From Window Top', 'adorn')
                )
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name' => 'edge_title_area_content_alignment_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Horizontal Alignment', 'adorn'),
                'description' => esc_html__('Specify title horizontal alignment', 'adorn'),
                'parent' => $show_title_area_meta_container,
                'options' => array(
                    '' => esc_html__('Default', 'adorn'),
                    'left' => esc_html__('Left', 'adorn'),
                    'center' => esc_html__('Center', 'adorn'),
                    'right' => esc_html__('Right', 'adorn')
                )
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name' => 'edge_title_area_title_tag_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Title Tag', 'adorn'),
                'parent' => $title_area_type_meta_container,
                'options' => adorn_edge_get_title_tag(true)
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name' => 'edge_page_title_font_size_meta',
                'type' => 'text',
                'default_value' => '',
                'label' => esc_html__('Title Size', 'adorn'),
                'parent' => $title_area_type_meta_container,
                'args' => array(
                    'col_width' => 2,
                    'suffix' => 'px'
                )
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name' => 'edge_title_text_color_meta',
                'type' => 'color',
                'label' => esc_html__('Title Color', 'adorn'),
                'description' => esc_html__('Choose a color for title text', 'adorn'),
                'parent' => $show_title_area_meta_container
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name' => 'edge_title_area_background_color_meta',
                'type' => 'color',
                'label' => esc_html__('Background Color', 'adorn'),
                'description' => esc_html__('Choose a background color for title area', 'adorn'),
                'parent' => $show_title_area_meta_container
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name' => 'edge_hide_background_image_meta',
                'type' => 'yesno',
                'default_value' => 'no',
                'label' => esc_html__('Hide Background Image', 'adorn'),
                'description' => esc_html__('Enable this option to hide background image in title area', 'adorn'),
                'parent' => $show_title_area_meta_container,
                'args' => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "#edge_edge_hide_background_image_meta_container",
                    "dependence_show_on_yes" => ""
                )
            )
        );

        $hide_background_image_meta_container = adorn_edge_add_admin_container(
            array(
                'parent' => $show_title_area_meta_container,
                'name' => 'edge_hide_background_image_meta_container',
                'hidden_property' => 'edge_hide_background_image_meta',
                'hidden_value' => 'yes'
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name' => 'edge_title_area_background_image_meta',
                'type' => 'image',
                'label' => esc_html__('Background Image', 'adorn'),
                'description' => esc_html__('Choose an Image for title area', 'adorn'),
                'parent' => $hide_background_image_meta_container
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name' => 'edge_title_area_background_image_responsive_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Background Responsive Image', 'adorn'),
                'description' => esc_html__('Enabling this option will make Title background image responsive', 'adorn'),
                'parent' => $hide_background_image_meta_container,
                'options' => adorn_edge_get_yes_no_select_array(),
                'args' => array(
                    "dependence" => true,
                    "hide" => array(
                        "" => "",
                        "no" => "",
                        "yes" => "#edge_edge_title_area_background_image_responsive_meta_container, #edge_edge_title_area_height_meta"
                    ),
                    "show" => array(
                        "" => "#edge_edge_title_area_background_image_responsive_meta_container, #edge_edge_title_area_height_meta",
                        "no" => "#edge_edge_title_area_background_image_responsive_meta_container, #edge_edge_title_area_height_meta",
                        "yes" => ""
                    )
                )
            )
        );

        $title_area_background_image_responsive_meta_container = adorn_edge_add_admin_container(
            array(
                'parent' => $hide_background_image_meta_container,
                'name' => 'edge_title_area_background_image_responsive_meta_container',
                'hidden_property' => 'edge_title_area_background_image_responsive_meta',
                'hidden_value' => 'yes'
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name' => 'edge_title_area_background_image_parallax_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Background Image in Parallax', 'adorn'),
                'description' => esc_html__('Enabling this option will make Title background image parallax', 'adorn'),
                'parent' => $title_area_background_image_responsive_meta_container,
                'options' => array(
                    '' => esc_html__('Default', 'adorn'),
                    'no' => esc_html__('No', 'adorn'),
                    'yes' => esc_html__('Yes', 'adorn'),
                    'yes_zoom' => esc_html__('Yes, with zoom out', 'adorn')
                )
            )
        );

        adorn_edge_create_meta_box_field(array(
            'name' => 'edge_title_area_height_meta',
            'type' => 'text',
            'label' => esc_html__('Height', 'adorn'),
            'description' => esc_html__('Set a height for Title Area', 'adorn'),
            'parent' => $show_title_area_meta_container,
            'args' => array(
                'col_width' => 2,
                'suffix' => 'px'
            )
        ));

        adorn_edge_create_meta_box_field(array(
            'name' => 'edge_title_area_subtitle_meta',
            'type' => 'text',
            'default_value' => '',
            'label' => esc_html__('Subtitle Text', 'adorn'),
            'description' => esc_html__('Enter your subtitle text', 'adorn'),
            'parent' => $show_title_area_meta_container,
            'args' => array(
                'col_width' => 6
            )
        ));

        adorn_edge_create_meta_box_field(
            array(
                'name' => 'edge_subtitle_color_meta',
                'type' => 'color',
                'label' => esc_html__('Subtitle Color', 'adorn'),
                'description' => esc_html__('Choose a color for subtitle text', 'adorn'),
                'parent' => $show_title_area_meta_container
            )
        );
    }

    add_action('adorn_edge_meta_boxes_map', 'adorn_edge_map_title_meta', 60);
}