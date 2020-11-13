<?php

if(!function_exists('adorn_edge_map_general_meta')) {

    function adorn_edge_map_general_meta() {

        $general_meta_box = adorn_edge_create_meta_box(
            array(
                'scope' => array('page', 'portfolio-item', 'post', 'team-member'),
                'title' => esc_html__('General', 'adorn'),
                'name' => 'general_meta'
            )
        );

		adorn_edge_create_meta_box_field(
			array(
				'name'          => 'edge_smooth_page_transitions_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Smooth Page Transitions', 'adorn' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'adorn' ),
				'parent'        => $general_meta_box,
				'options'     => adorn_edge_get_yes_no_select_array(),
				'args'          => array(
					"dependence"             => true,
					"hide"       => array(
						""    => "#edge_page_transitions_container_meta",
						"no"  => "#edge_page_transitions_container_meta",
						"yes" => ""
					),
					"show"       => array(
						""    => "",
						"no"  => "",
						"yes" => "#edge_page_transitions_container_meta"
					)
				)
			)
		);

		$page_transitions_container_meta = adorn_edge_add_admin_container(
			array(
				'parent'          => $general_meta_box,
				'name'            => 'page_transitions_container_meta',
				'hidden_property' => 'edge_smooth_page_transitions_meta',
				'hidden_values'   => array('','no')
			)
		);

		adorn_edge_create_meta_box_field(
			array(
				'name'          => 'edge_page_transition_preloader_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Enable Preloading Animation', 'adorn' ),
				'description'   => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'adorn' ),
				'parent'        => $page_transitions_container_meta,
				'options'     => adorn_edge_get_yes_no_select_array(),
				'args'          => array(
					"dependence"             => true,
					"hide"       => array(
						""    => "#edge_page_transition_preloader_container_meta",
						"no"  => "#edge_page_transition_preloader_container_meta",
						"yes" => ""
					),
					"show"       => array(
						""    => "",
						"no"  => "",
						"yes" => "#edge_page_transition_preloader_container_meta"
					)
				)
			)
		);

		$page_transition_preloader_container_meta = adorn_edge_add_admin_container(
			array(
				'parent'          => $page_transitions_container_meta,
				'name'            => 'page_transition_preloader_container_meta',
				'hidden_property' => 'edge_page_transition_preloader_meta',
				'hidden_values'   => array('','no')
			)
		);

		adorn_edge_create_meta_box_field(
			array(
				'name'   => 'edge_smooth_pt_bgnd_color_meta',
				'type'   => 'color',
				'label'  => esc_html__( 'Page Loader Background Color', 'adorn' ),
				'parent' => $page_transition_preloader_container_meta
			)
		);

		$group_pt_spinner_animation_meta = adorn_edge_add_admin_group(
			array(
				'name'        => 'group_pt_spinner_animation_meta',
				'title'       => esc_html__( 'Loader Style', 'adorn' ),
				'description' => esc_html__( 'Define styles for loader spinner animation', 'adorn' ),
				'parent'      => $page_transition_preloader_container_meta
			)
		);

		$row_pt_spinner_animation_meta = adorn_edge_add_admin_row(
			array(
				'name'   => 'row_pt_spinner_animation_meta',
				'parent' => $group_pt_spinner_animation_meta
			)
		);

		adorn_edge_create_meta_box_field(
			array(
				'type'          => 'selectsimple',
				'name'          => 'edge_smooth_pt_spinner_type_meta',
				'default_value' => '',
				'label'         => esc_html__( 'Spinner Type', 'adorn' ),
				'parent'        => $row_pt_spinner_animation_meta,
				'options'       => array(
					'rotate_circles'        => esc_html__( 'Rotate Circles', 'adorn' ),
					'pulse'                 => esc_html__( 'Pulse', 'adorn' ),
					'double_pulse'          => esc_html__( 'Double Pulse', 'adorn' ),
					'cube'                  => esc_html__( 'Cube', 'adorn' ),
					'rotating_cubes'        => esc_html__( 'Rotating Cubes', 'adorn' ),
					'stripes'               => esc_html__( 'Stripes', 'adorn' ),
					'wave'                  => esc_html__( 'Wave', 'adorn' ),
					'two_rotating_circles'  => esc_html__( '2 Rotating Circles', 'adorn' ),
					'five_rotating_circles' => esc_html__( '5 Rotating Circles', 'adorn' ),
					'atom'                  => esc_html__( 'Atom', 'adorn' ),
					'clock'                 => esc_html__( 'Clock', 'adorn' ),
					'mitosis'               => esc_html__( 'Mitosis', 'adorn' ),
					'lines'                 => esc_html__( 'Lines', 'adorn' ),
					'fussion'               => esc_html__( 'Fussion', 'adorn' ),
					'wave_circles'          => esc_html__( 'Wave Circles', 'adorn' ),
					'pulse_circles'         => esc_html__( 'Pulse Circles', 'adorn' )
				)
			)
		);

		adorn_edge_create_meta_box_field(
			array(
				'type'          => 'colorsimple',
				'name'          => 'edge_smooth_pt_spinner_color_meta',
				'default_value' => '',
				'label'         => esc_html__( 'Spinner Color', 'adorn' ),
				'parent'        => $row_pt_spinner_animation_meta
			)
		);

		adorn_edge_create_meta_box_field(
			array(
				'name'          => 'edge_page_transition_fadeout_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Enable Fade Out Animation', 'adorn' ),
				'description'   => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'adorn' ),
				'options'     => adorn_edge_get_yes_no_select_array(),
				'parent'        => $page_transitions_container_meta

			)
		);

        adorn_edge_create_meta_box_field(
            array(
                'name' => 'edge_page_background_color_meta',
                'type' => 'color',
                'label' => esc_html__('Page Background Color', 'adorn'),
                'description' => esc_html__('Choose background color for page content', 'adorn'),
                'parent' => $general_meta_box
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name' => 'edge_page_slider_meta',
                'type' => 'text',
                'default_value' => '',
                'label' => esc_html__('Slider Shortcode', 'adorn'),
                'description' => esc_html__('Paste your slider shortcode here', 'adorn'),
                'parent' => $general_meta_box
            )
        );

        $edge_content_padding_group = adorn_edge_add_admin_group(array(
            'name' => 'content_padding_group',
            'title' => esc_html__('Content Style', 'adorn'),
            'description' => esc_html__('Define styles for Content area', 'adorn'),
            'parent' => $general_meta_box
        ));

        $edge_content_padding_row = adorn_edge_add_admin_row(array(
            'name' => 'edge_content_padding_row',
            'next' => true,
            'parent' => $edge_content_padding_group
        ));

        adorn_edge_create_meta_box_field(
            array(
                'name' => 'edge_page_content_top_padding',
                'type' => 'textsimple',
                'default_value' => '',
                'label' => esc_html__('Content Top Padding', 'adorn'),
                'parent' => $edge_content_padding_row,
                'args' => array(
                    'suffix' => 'px'
                )
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name' => 'edge_page_content_top_padding_mobile',
                'type' => 'selectsimple',
                'label' => esc_html__('Set this top padding for mobile header', 'adorn'),
                'parent' => $edge_content_padding_row,
                'options' => adorn_edge_get_yes_no_select_array(false)
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name' => 'edge_page_comments_meta',
                'type' => 'select',
                'label' => esc_html__('Show Comments', 'adorn'),
                'description' => esc_html__('Enabling this option will show comments on your page', 'adorn'),
                'parent' => $general_meta_box,
                'options' => adorn_edge_get_yes_no_select_array()
            )
        );


	    adorn_edge_create_meta_box_field(
		    array(
			    'name' => 'edge_enable_social_sidebar_meta',
			    'type' => 'select',
			    'label' => esc_html__('Show Social Sidebar', 'adorn'),
			    'description' => esc_html__('Enabling this option will show social sidebar on your page', 'adorn'),
			    'parent' => $general_meta_box,
			    'options' => adorn_edge_get_yes_no_select_array(),
                'args'          => array(
                    'dependence' => true,
                    'hide'       => array(
                        ''    => '#edge_social_sidebar_container',
                        'no'  => '#edge_social_sidebar_container',
                        'yes' => ''
                    ),
                    'show'       => array(
                        ''    => '',
                        'no'  => '',
                        'yes' => '#edge_social_sidebar_container'
                    )
                )
		    )
	    );

        $social_sidebar_container = adorn_edge_add_admin_container(array(
            'type'            => 'container',
            'name'            => 'social_sidebar_container',
            'parent'          => $general_meta_box,
            'hidden_property' => 'edge_enable_social_sidebar_meta',
            'hidden_value'    => 'no',
            'hidden_values'   => array('', 'no')
        ));

        adorn_edge_create_meta_box_field(
            array(
                'name' => 'edge_social_sidebar_light_meta',
                'type' => 'select',
                'label' => esc_html__('Light Social Sidebar', 'adorn'),
                'description' => esc_html__('Enabling this option will show light social sidebar', 'adorn'),
                'parent' => $social_sidebar_container,
                'options' => adorn_edge_get_yes_no_select_array(true)
            )
        );



        adorn_edge_create_meta_box_field(
            array(
                'name'          => 'edge_boxed_meta',
                'type'          => 'select',
                'default_value' => '',
                'label'         => esc_html__('Boxed Layout', 'adorn'),
                'parent'        => $general_meta_box,
                'options'     => array(
                    '' => '',
                    'yes' => esc_html__('Yes', 'adorn'),
                    'no' => esc_html__('No', 'adorn'),
                ),
                'args'          => array(
                    "dependence" => true,
                    'show' => array(
                        '' => '',
                        'yes' => '#edge_edge_boxed_container_meta',
                        'no' => '',

                    ),
                    'hide' => array(
                        '' => '#edge_edge_boxed_container_meta',
                        'yes' => '',
                        'no' => '#edge_edge_boxed_container_meta',
                    )
                )
            )
        );

        $boxed_container = adorn_edge_add_admin_container(
            array(
                'parent'            => $general_meta_box,
                'name'              => 'edge_boxed_container_meta',
                'hidden_property'   => 'edge_boxed_meta',
                'hidden_values'     => array('','no')
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name'        => 'edge_page_background_color_in_box_meta',
                'type'        => 'color',
                'label'       => esc_html__('Page Background Color', 'adorn'),
                'description' => esc_html__('Choose the page background color outside box.', 'adorn'),
                'parent'      => $boxed_container
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name'        => 'edge_boxed_pattern_background_image_meta',
                'type'        => 'image',
                'label'       => esc_html__('Background Pattern', 'adorn'),
                'description' => esc_html__('Choose an image to be used as background pattern', 'adorn'),
                'parent'      => $boxed_container
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name'        => 'edge_boxed_background_image_meta',
                'type'        => 'image',
                'label'       => esc_html__('Background Image', 'adorn'),
                'description' => esc_html__('Choose an image to be displayed in background', 'adorn'),
                'parent'      => $boxed_container,
            )
        );

        adorn_edge_create_meta_box_field(
            array(
                'name'          => 'edge_boxed_background_image_attachment_meta',
                'type'          => 'select',
                'default_value' => 'fixed',
                'label'         => esc_html__('Background Image Attachment', 'adorn'),
                'description'   => esc_html__('Choose background image attachment if background image option is set', 'adorn'),
                'parent'        => $boxed_container,
                'options'       => array(
                    'fixed'  => esc_html__('Fixed', 'adorn'),
                    'scroll' => esc_html__('Scroll', 'adorn')
                )
            )
        );
    }

    add_action('adorn_edge_meta_boxes_map', 'adorn_edge_map_general_meta', 10);
}