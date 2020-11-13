<?php

if ( ! function_exists('adorn_edge_popup_options_map') ) {

    function adorn_edge_popup_options_map() {

        $cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );

        $contact_forms = array();
        if ( $cf7 ) {
            foreach ( $cf7 as $cform ) {
                $contact_forms[ $cform->ID ] = $cform->post_title;
            }
        } else {
            $contact_forms[0] = esc_html__('No contact forms found', 'adorn');
        }

        adorn_edge_add_admin_page(
            array(
                'slug' => '_popup_page',
                'title' => esc_html__('Pop-up', 'adorn'),
                'icon' => 'fa fa-pencil-square-o'
            )
        );

        $popup_panel = adorn_edge_add_admin_panel(
            array(
                'title' => esc_html__('Pop-up', 'adorn'),
                'name' => 'popup',
                'page' => '_popup_page'
            )
        );

        adorn_edge_add_admin_field(
            array(
                'parent'		=> $popup_panel,
                'type'			=> 'yesno',
                'name'			=> 'enable_popup',
                'default_value'	=> 'no',
                'label'			=> esc_html__('Enable Pop-up', 'adorn'),
                'description'	=> '',
                'args'			=> array(
                    'dependence' => true,
                    'dependence_hide_on_yes' => '',
                    'dependence_show_on_yes' => '#edge_enable_popup_container'
                )
            )
        );

        $enable_popup_container = adorn_edge_add_admin_container(
            array(
                'parent'			=> $popup_panel,
                'name'				=> 'enable_popup_container',
                'hidden_property'	=> 'enable_popup',
                'hidden_value'		=> 'no',
            )
        );

        adorn_edge_add_admin_field(
            array(
                'parent' => $enable_popup_container,
                'type' => 'image',
                'name' => 'popup_image',
                'default_value' => '',
                'label' => esc_html__('Background Image', 'adorn'),
                'description' => esc_html__('Choose a background image for pop-up window', 'adorn')
            )
        );

        adorn_edge_add_admin_field(array(
            'parent' => $enable_popup_container,
            'type' => 'text',
            'name' => 'popup_title',
            'default_value' => '',
            'label' => esc_html__('Title', 'adorn'),
            'description' => esc_html__('Enter title pop-up window', 'adorn')
        ));

        adorn_edge_add_admin_field(array(
            'parent' => $enable_popup_container,
            'type' => 'text',
            'name' => 'popup_subtitle',
            'default_value' => '',
            'label' => esc_html__('Subtitle', 'adorn'),
            'description' => esc_html__('Enter subtitle pop-up window', 'adorn')
        ));

        adorn_edge_add_admin_field(
            array(
                'name'          => 'popup_contact_form',
                'type'          => 'select',
                'default_value' => '',
                'label'         => esc_html__('Select Contact Form', 'adorn'),
                'description'   => esc_html__('Choose contact form to display in popup window', 'adorn'),
                'parent'        => $enable_popup_container,
                'options'       => $contact_forms
            )
        );

        adorn_edge_add_admin_field(
            array(
                'name'          => 'popup_contact_form_style',
                'type'          => 'select',
                'default_value' => '',
                'label'         => esc_html__('Contact Form Style', 'adorn'),
                'description'   => esc_html__('Choose style defined in Contact Form 7 option tab', 'adorn'),
                'parent'        => $enable_popup_container,
                'options'       => array(
                    'default' => 'Default',
                    'cf7_custom_style_1' => esc_html__('Custom Style 1', 'adorn'),
                    'cf7_custom_style_2' => esc_html__('Custom Style 2', 'adorn'),
                    'cf7_custom_style_3' => esc_html__('Custom Style 3', 'adorn')
                )
            )
        );

	    adorn_edge_add_admin_field(array(
		    'parent' => $enable_popup_container,
		    'type' => 'text',
		    'name' => 'popup_desc',
		    'default_value' => '',
		    'label' => esc_html__('Description', 'adorn'),
		    'description' => esc_html__('Enter description pop-up window', 'adorn')
	    ));


    }

    add_action('adorn_edge_options_map', 'adorn_edge_popup_options_map', 16);
}