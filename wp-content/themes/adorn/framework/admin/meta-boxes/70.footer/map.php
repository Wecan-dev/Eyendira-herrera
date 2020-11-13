<?php

if(!function_exists('adorn_edge_map_footer_meta')) {
    function adorn_edge_map_footer_meta() {
        $footer_meta_box = adorn_edge_create_meta_box(
            array(
                'scope' => array('page', 'portfolio-item', 'post', 'team-member'),
                'title' => esc_html__('Footer', 'adorn'),
                'name' => 'footer_meta'
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name' => 'edge_disable_footer_meta',
                'type' => 'yesno',
                'default_value' => 'no',
                'label' => esc_html__('Disable Footer for this Page', 'adorn'),
                'description' => esc_html__('Enabling this option will hide footer on this page', 'adorn'),
                'parent' => $footer_meta_box
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name' => 'edge_show_footer_top_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Show Footer Top', 'adorn'),
                'description' => esc_html__('Enabling this option will show Footer Top area', 'adorn'),
                'parent' => $footer_meta_box,
                'options' => adorn_edge_get_yes_no_select_array()
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'type'          => 'select',
                'name'          => 'edge_footer_top_skin_meta',
                'default_value' => '',
                'label'         => esc_html__('Footer Top Skin', 'adorn'),
                'description'   => esc_html__('Choose a footer top style to make footer top widgets in that predefined style', 'adorn'),
                'options'       => array(
                    ''         => '',
                    'standard' => esc_html__('Standard', 'adorn'),
                    'light'    => esc_html__('Light', 'adorn'),
                    'dark'     => esc_html__('Dark', 'adorn')
                ),
                'parent'        => $footer_meta_box,
            )
        );

        adorn_edge_create_meta_box_field(
            array(
            'name' => 'edge_footer_top_background_color_meta',
            'type' => 'color',
            'label' => esc_html__('Footer Top Background Color', 'adorn'),
            'description' => esc_html__('Set background color for top footer area', 'adorn'),
            'parent' => $footer_meta_box
        ));

        adorn_edge_create_meta_box_field(
            array(
                'name' => 'edge_show_footer_bottom_meta',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Show Footer Bottom', 'adorn'),
                'description' => esc_html__('Enabling this option will show Footer Bottom area', 'adorn'),
                'parent' => $footer_meta_box,
                'options' => adorn_edge_get_yes_no_select_array()
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'type'          => 'select',
                'name'          => 'edge_footer_bottom_skin_meta',
                'default_value' => '',
                'label'         => esc_html__('Footer Bottom Skin', 'adorn'),
                'description'   => esc_html__('Choose a footer bottom style to make footer bottom widgets in that predefined style', 'adorn'),
                'options'       => array(
                    ''         => '',
                    'standard' => esc_html__('Standard', 'adorn'),
                    'light'    => esc_html__('Light', 'adorn'),
                    'dark'     => esc_html__('Dark', 'adorn')
                ),
                'parent'        => $footer_meta_box,
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name' => 'edge_footer_bottom_background_color_meta',
                'type' => 'color',
                'label' => esc_html__('Footer Bottom Background Color', 'adorn'),
                'description' => esc_html__('Set background color for bottom footer area', 'adorn'),
                'parent' => $footer_meta_box
            ));

        adorn_edge_create_meta_box_field(
            array(
                'type'          => 'select',
                'name'          => 'edge_footer_in_grid_meta',
                'default_value' => '',
                'label'         => esc_html__('Footer in Grid', 'adorn'),
                'description'   => esc_html__('Enabling this option will place Footer content in grid', 'adorn'),
                'options'       => array(
                    ''    => esc_html__('Default', 'adorn'),
                    'yes' => esc_html__('Yes', 'adorn'),
                    'no'  => esc_html__('No', 'adorn')
                ),
                'parent'        => $footer_meta_box,
            )
        );

        $adorn_custom_sidebars = adorn_edge_get_custom_sidebars();
        adorn_edge_create_meta_box_field(
            array(
                'type'          => 'yesno',
                'name'          => 'show_footer_custom_widget_areas',
                'default_value' => 'no',
                'label'         => esc_html__('Use Custom Widget Areas in Footer', 'adorn'),
                'args'          => array(
                    'dependence'             => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#edge_footer_custom_widget_areas'
                ),
                'parent'        => $footer_meta_box,
            )
        );

        $show_footer_custom_widget_areas = adorn_edge_add_admin_container(
            array(
                'name'            => 'footer_custom_widget_areas',
                'hidden_property' => 'show_footer_custom_widget_areas',
                'hidden_value'    => 'no',
                'parent'          => $footer_meta_box
            )
        );

        $top_cols_num = 4;

        for ($i = 1; $i <= $top_cols_num; $i++) {

            adorn_edge_create_meta_box_field(array(
                'name'        => 'edge_footer_top_meta_' . $i,
                'type'        => 'selectblank',
                'label'       => esc_html__('Choose Widget Area in Footer Top Column ', 'adorn') . $i,
                'description' => esc_html__('Choose Custom Widget area to display in Footer Top Column ', 'adorn') . $i,
                'parent'      => $show_footer_custom_widget_areas,
                'options'     => $adorn_custom_sidebars
            ));

        }

        $bottom_cols_num = 3;

        for ($i = 1; $i <= $bottom_cols_num; $i++) {

            adorn_edge_create_meta_box_field(array(
                'name'        => 'edge_footer_bottom_meta_' . $i,
                'type'        => 'selectblank',
                'label'       => esc_html__('Choose Widget Area in Footer Bottom Column ', 'adorn') . $i,
                'description' => esc_html__('Choose Custom Widget area to display in Footer Bottom Column ', 'adorn') . $i,
                'parent'      => $show_footer_custom_widget_areas,
                'options'     => $adorn_custom_sidebars
            ));

        }


    }

    add_action('adorn_edge_meta_boxes_map', 'adorn_edge_map_footer_meta', 70);
}