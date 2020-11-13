<?php

if ( ! function_exists('adorn_edge_general_options_map') ) {
    /**
     * General options page
     */
    function adorn_edge_general_options_map() {

        adorn_edge_add_admin_page(
            array(
                'slug'  => '',
                'title' => esc_html__('General', 'adorn'),
                'icon'  => 'fa fa-institution'
            )
        );


        $panel_appearance_style = adorn_edge_add_admin_panel(
            array(
                'page'  => '',
                'name'  => 'panel_appearance',
                'title' => esc_html__('Appearance', 'adorn')
            )
        );

        adorn_edge_add_admin_field(
            array(
                'name'          => 'google_fonts',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Google Font Family', 'adorn'),
                'description'   => esc_html__('Choose a default Google font for your site', 'adorn'),
                'parent' => $panel_appearance_style
            )
        );

        adorn_edge_add_admin_field(
            array(
                'name'          => 'additional_google_fonts',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__('Additional Google Fonts', 'adorn'),
                'parent'        => $panel_appearance_style,
                'args'          => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#edge_additional_google_fonts_container"
                )
            )
        );

        $additional_google_fonts_container = adorn_edge_add_admin_container(
            array(
                'parent'            => $panel_appearance_style,
                'name'              => 'additional_google_fonts_container',
                'hidden_property'   => 'additional_google_fonts',
                'hidden_value'      => 'no'
            )
        );

        adorn_edge_add_admin_field(
            array(
                'name'          => 'additional_google_font1',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'adorn'),
                'description'   => esc_html__('Choose additional Google font for your site', 'adorn'),
                'parent'        => $additional_google_fonts_container
            )
        );

        adorn_edge_add_admin_field(
            array(
                'name'          => 'additional_google_font2',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'adorn'),
                'description'   => esc_html__('Choose additional Google font for your site', 'adorn'),
                'parent'        => $additional_google_fonts_container
            )
        );

        adorn_edge_add_admin_field(
            array(
                'name'          => 'additional_google_font3',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'adorn'),
                'description'   => esc_html__('Choose additional Google font for your site', 'adorn'),
                'parent'        => $additional_google_fonts_container
            )
        );

        adorn_edge_add_admin_field(
            array(
                'name'          => 'additional_google_font4',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'adorn'),
                'description'   => esc_html__('Choose additional Google font for your site', 'adorn'),
                'parent'        => $additional_google_fonts_container
            )
        );

        adorn_edge_add_admin_field(
            array(
                'name'          => 'additional_google_font5',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => esc_html__('Font Family', 'adorn'),
                'description'   => esc_html__('Choose additional Google font for your site', 'adorn'),
                'parent'        => $additional_google_fonts_container
            )
        );

        adorn_edge_add_admin_field(
            array(
                'name' => 'google_font_weight',
                'type' => 'checkboxgroup',
                'default_value' => '',
                'label' => esc_html__('Google Fonts Style & Weight', 'adorn'),
                'description' => esc_html__('Choose a default Google font weights for your site. Impact on page load time', 'adorn'),
                'parent' => $panel_appearance_style,
                'options' => array(
                    '100'       => esc_html__('100 Thin', 'adorn'),
                    '100italic' => esc_html__('100 Thin Italic', 'adorn'),
                    '200'       => esc_html__('200 Extra-Light', 'adorn'),
                    '200italic' => esc_html__('200 Extra-Light Italic', 'adorn'),
                    '300'       => esc_html__('300 Light', 'adorn'),
                    '300italic' => esc_html__('300 Light Italic', 'adorn'),
                    '400'       => esc_html__('400 Regular', 'adorn'),
                    '400italic' => esc_html__('400 Regular Italic', 'adorn'),
                    '500'       => esc_html__('500 Medium', 'adorn'),
                    '500italic' => esc_html__('500 Medium Italic', 'adorn'),
                    '600'       => esc_html__('600 Semi-Bold', 'adorn'),
                    '600italic' => esc_html__('600 Semi-Bold Italic', 'adorn'),
                    '700'       => esc_html__('700 Bold', 'adorn'),
                    '700italic' => esc_html__('700 Bold Italic', 'adorn'),
                    '800'       => esc_html__('800 Extra-Bold', 'adorn'),
                    '800italic' => esc_html__('800 Extra-Bold Italic', 'adorn'),
                    '900'       => esc_html__('900 Ultra-Bold', 'adorn'),
                    '900italic' => esc_html__('900 Ultra-Bold Italic', 'adorn')
                )
            )
        );

        adorn_edge_add_admin_field(
            array(
                'name' => 'google_font_subset',
                'type' => 'checkboxgroup',
                'default_value' => '',
                'label' => esc_html__('Google Fonts Subset', 'adorn'),
                'description' => esc_html__('Choose a default Google font subsets for your site', 'adorn'),
                'parent' => $panel_appearance_style,
                'options' => array(
                    'latin' => esc_html__('Latin', 'adorn'),
                    'latin-ext' => esc_html__('Latin Extended', 'adorn'),
                    'cyrillic' => esc_html__('Cyrillic', 'adorn'),
                    'cyrillic-ext' => esc_html__('Cyrillic Extended', 'adorn'),
                    'greek' => esc_html__('Greek', 'adorn'),
                    'greek-ext' => esc_html__('Greek Extended', 'adorn'),
                    'vietnamese' => esc_html__('Vietnamese', 'adorn')
                )
            )
        );

        adorn_edge_add_admin_field(
            array(
                'name'          => 'first_color',
                'type'          => 'color',
                'label'         => esc_html__('First Main Color', 'adorn'),
                'description'   => esc_html__('Choose the most dominant theme color. Default color is #00bbb3', 'adorn'),
                'parent'        => $panel_appearance_style
            )
        );

        adorn_edge_add_admin_field(
            array(
                'name'          => 'page_background_color',
                'type'          => 'color',
                'label'         => esc_html__('Page Background Color', 'adorn'),
                'description'   => esc_html__('Choose the background color for page content. Default color is #ffffff', 'adorn'),
                'parent'        => $panel_appearance_style
            )
        );

        adorn_edge_add_admin_field(
            array(
                'name'          => 'selection_color',
                'type'          => 'color',
                'label'         => esc_html__('Text Selection Color', 'adorn'),
                'description'   => esc_html__('Choose the color users see when selecting text', 'adorn'),
                'parent'        => $panel_appearance_style
            )
        );

        adorn_edge_add_admin_field(
            array(
                'name'          => 'boxed',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__('Boxed Layout', 'adorn'),
                'description'   => '',
                'parent'        => $panel_appearance_style,
                'args'          => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#edge_boxed_container"
                )
            )
        );

        $boxed_container = adorn_edge_add_admin_container(
            array(
                'parent'            => $panel_appearance_style,
                'name'              => 'boxed_container',
                'hidden_property'   => 'boxed',
                'hidden_value'      => 'no'
            )
        );

        adorn_edge_add_admin_field(
            array(
                'name'          => 'page_background_color_in_box',
                'type'          => 'color',
                'label'         => esc_html__('Page Background Color', 'adorn'),
                'description'   => esc_html__('Choose the page background color outside box', 'adorn'),
                'parent'        => $boxed_container
            )
        );

        adorn_edge_add_admin_field(
            array(
                'name'          => 'boxed_background_image',
                'type'          => 'image',
                'label'         => esc_html__('Background Image', 'adorn'),
                'description'   => esc_html__('Choose an image to be displayed in background', 'adorn'),
                'parent'        => $boxed_container
            )
        );

        adorn_edge_add_admin_field(
            array(
                'name'          => 'boxed_pattern_background_image',
                'type'          => 'image',
                'label'         => esc_html__('Background Pattern', 'adorn'),
                'description'   => esc_html__('Choose an image to be used as background pattern', 'adorn'),
                'parent'        => $boxed_container
            )
        );

        adorn_edge_add_admin_field(
            array(
                'name'          => 'boxed_background_image_attachment',
                'type'          => 'select',
                'default_value' => 'fixed',
                'label'         => esc_html__('Background Image Attachment', 'adorn'),
                'description'   => esc_html__('Choose background image attachment', 'adorn'),
                'parent'        => $boxed_container,
                'options'       => array(
                    'fixed'     => esc_html__('Fixed', 'adorn'),
                    'scroll'    => esc_html__('Scroll', 'adorn')
                )
            )
        );
        
        adorn_edge_add_admin_field(
            array(
                'name'          => 'paspartu',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => esc_html__('Passepartout', 'adorn'),
                'description'   => esc_html__('Enabling this option will display passepartout around site content', 'adorn'),
                'parent'        => $panel_appearance_style,
                'args'          => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#edge_paspartu_container"
                )
            )
        );

        $paspartu_container = adorn_edge_add_admin_container(
            array(
                'parent'            => $panel_appearance_style,
                'name'              => 'paspartu_container',
                'hidden_property'   => 'paspartu',
                'hidden_value'      => 'no'
            )
        );

        adorn_edge_add_admin_field(
            array(
                'name'          => 'paspartu_color',
                'type'          => 'color',
                'label'         => esc_html__('Passepartout Color', 'adorn'),
                'description'   => esc_html__('Choose passepartout color, default value is #ffffff', 'adorn'),
                'parent'        => $paspartu_container
            )
        );

        adorn_edge_add_admin_field(
            array(
                'name' => 'paspartu_width',
                'type' => 'text',
                'label' => esc_html__('Passepartout Size', 'adorn'),
                'description' => esc_html__('Enter size amount for passepartout', 'adorn'),
                'parent' => $paspartu_container,
                'args' => array(
                    'col_width' => 2,
                    'suffix' => '%'
                )
            )
        );

        adorn_edge_add_admin_field(
            array(
                'parent' => $paspartu_container,
                'type' => 'yesno',
                'default_value' => 'no',
                'name' => 'disable_top_paspartu',
                'label' => esc_html__('Disable Top Passepartout', 'adorn')
            )
        );

        adorn_edge_add_admin_field(
            array(
                'name'          => 'initial_content_width',
                'type'          => 'select',
                'default_value' => 'edge-grid-1300',
                'label'         => esc_html__('Initial Width of Content', 'adorn'),
                'description'   => esc_html__('Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'adorn'),
                'parent'        => $panel_appearance_style,
                'options'       => array(
                    'edge-grid-1100' => esc_html__('1100px', 'adorn'),
                    'edge-grid-1300' => esc_html__('1300px - default', 'adorn'),
                    'edge-grid-1200' => esc_html__('1200px', 'adorn'),
                    'edge-grid-1000' => esc_html__('1000px', 'adorn'),
                    'edge-grid-800'  => esc_html__('800px', 'adorn')
                )
            )
        );

        $panel_settings = adorn_edge_add_admin_panel(
            array(
                'page'  => '',
                'name'  => 'panel_settings',
                'title' => esc_html__('Behaviour', 'adorn')
            )
        );

		adorn_edge_add_admin_field(
			array(
				'name'          => 'smooth_page_transitions',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Smooth Page Transitions', 'adorn' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'adorn' ),
				'parent'        => $panel_settings,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#edge_page_transitions_container"
				)
			)
		);

		$page_transitions_container = adorn_edge_add_admin_container(
			array(
				'parent'          => $panel_settings,
				'name'            => 'page_transitions_container',
				'hidden_property' => 'smooth_page_transitions',
				'hidden_value'    => 'no'
			)
		);

		adorn_edge_add_admin_field(
			array(
				'name'          => 'page_transition_preloader',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Preloading Animation', 'adorn' ),
				'description'   => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'adorn' ),
				'parent'        => $page_transitions_container,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#edge_page_transition_preloader_container"
				)
			)
		);

		$page_transition_preloader_container = adorn_edge_add_admin_container(
			array(
				'parent'          => $page_transitions_container,
				'name'            => 'page_transition_preloader_container',
				'hidden_property' => 'page_transition_preloader',
				'hidden_value'    => 'no'
			)
		);


		adorn_edge_add_admin_field(
			array(
				'name'   => 'smooth_pt_bgnd_color',
				'type'   => 'color',
				'label'  => esc_html__( 'Page Loader Background Color', 'adorn' ),
				'parent' => $page_transition_preloader_container
			)
		);

		$group_pt_spinner_animation = adorn_edge_add_admin_group(
			array(
				'name'        => 'group_pt_spinner_animation',
				'title'       => esc_html__( 'Loader Style', 'adorn' ),
				'description' => esc_html__( 'Define styles for loader spinner animation', 'adorn' ),
				'parent'      => $page_transition_preloader_container
			)
		);

		$row_pt_spinner_animation = adorn_edge_add_admin_row(
			array(
				'name'   => 'row_pt_spinner_animation',
				'parent' => $group_pt_spinner_animation
			)
		);

		adorn_edge_add_admin_field(
			array(
				'type'          => 'selectsimple',
				'name'          => 'smooth_pt_spinner_type',
				'default_value' => '',
				'label'         => esc_html__( 'Spinner Type', 'adorn' ),
				'parent'        => $row_pt_spinner_animation,
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

		adorn_edge_add_admin_field(
			array(
				'type'          => 'colorsimple',
				'name'          => 'smooth_pt_spinner_color',
				'default_value' => '',
				'label'         => esc_html__( 'Spinner Color', 'adorn' ),
				'parent'        => $row_pt_spinner_animation
			)
		);

		adorn_edge_add_admin_field(
			array(
				'name'          => 'page_transition_fadeout',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Fade Out Animation', 'adorn' ),
				'description'   => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'adorn' ),
				'parent'        => $page_transitions_container
			)
		);

        adorn_edge_add_admin_field(
            array(
                'name'          => 'show_back_button',
                'type'          => 'yesno',
                'default_value' => 'yes',
                'label'         => esc_html__('Show "Back To Top Button"', 'adorn'),
                'description'   => esc_html__('Enabling this option will display a Back to Top button on every page', 'adorn'),
                'parent'        => $panel_settings
            )
        );

        adorn_edge_add_admin_field(
            array(
                'name'          => 'responsiveness',
                'type'          => 'yesno',
                'default_value' => 'yes',
                'label'         => esc_html__('Responsiveness', 'adorn'),
                'description'   => esc_html__('Enabling this option will make all pages responsive', 'adorn'),
                'parent'        => $panel_settings
            )
        );

        $panel_custom_code = adorn_edge_add_admin_panel(
            array(
                'page'  => '',
                'name'  => 'panel_custom_code',
                'title' => esc_html__('Custom Code', 'adorn')
            )
        );

        adorn_edge_add_admin_field(
            array(
                'name'          => 'custom_css',
                'type'          => 'textarea',
                'label'         => esc_html__('Custom CSS', 'adorn'),
                'description'   => esc_html__('Enter your custom CSS here', 'adorn'),
                'parent'        => $panel_custom_code
            )
        );

        adorn_edge_add_admin_field(
            array(
                'name'          => 'custom_js',
                'type'          => 'textarea',
                'label'         => esc_html__('Custom JS', 'adorn'),
                'description'   => esc_html__('Enter your custom Javascript here', 'adorn'),
                'parent'        => $panel_custom_code
            )
        );
	
	    $panel_google_api = adorn_edge_add_admin_panel(
		    array(
			    'page'  => '',
			    'name'  => 'panel_google_api',
			    'title' => esc_html__('Google API', 'adorn')
		    )
	    );
	
	    adorn_edge_add_admin_field(
		    array(
			    'name'        => 'google_maps_api_key',
			    'type'        => 'text',
			    'label'       => esc_html__('Google Maps Api Key', 'adorn'),
			    'description' => esc_html__('Insert your Google Maps API key here. For instructions on how to create a Google Maps API key, please refer to our to our documentation.', 'adorn'),
			    'parent'      => $panel_google_api
		    )
	    );
    }

    add_action( 'adorn_edge_options_map', 'adorn_edge_general_options_map', 1);
}