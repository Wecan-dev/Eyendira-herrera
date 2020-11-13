<?php
if(!function_exists('adorn_edge_social_sidebar_options')){

	function adorn_edge_social_sidebar_options(){

		$networks = array(
			'facebook' => array(
				'url'   => 'https://www.facebook.com/',
				'title' => esc_html__('Facebook', 'adorn')
			),
			'instagram' => array(
				'url'   => 'https://www.instagram.com/',
				'title' => esc_html__('Instagram', 'adorn')
			),
            'pinterest' => array(
                'url'   => 'https://www.pinterest.com/',
                'title' => esc_html__('Pinterest', 'adorn')
            ),
			'twitter' => array(
				'url'   => 'https://twitter.com/',
				'title' => esc_html__('Twitter', 'adorn')
			)
		);

		/**
		 * Enable Social Sidebar
		 */
		$sidebar_panel = adorn_edge_add_admin_panel(
			array(
				'title' => esc_html__('Social Sidebar', 'adorn'),
				'name' => 'social_sidebar',
				'page' => '_social_page'
			)
		);

        adorn_edge_add_admin_field(array(
			'type' => 'yesno',
			'name' => 'enable_social_sidebar',
			'default_value' => 'no',
			'label' => esc_html__('Enable Social Sidebar', 'adorn'),
			'description' => esc_html__('Enabling this option will show social sidebar', 'adorn'),
			'args' => array(
				'dependence' => true,
				'dependence_hide_on_yes' => '',
				'dependence_show_on_yes' => '#edge_panel_social_sidebar_networks, #edge_panel_show_social_share_on'
			),
			'parent' => $sidebar_panel
		));

		$social_sidebar_networks = adorn_edge_add_admin_container(array(
			'name' => 'panel_social_sidebar_networks',
            'hidden_property' => 'enable_social_sidebar',
            'hidden_value' => 'no',
            'parent' => $sidebar_panel
		));

        adorn_edge_add_admin_field(
            array(
                'name' => 'social_sidebar_light',
                'type' => 'select',
                'default_value' => 'no',
                'label' => esc_html__('Light Social Sidebar', 'adorn'),
                'description' => esc_html__('Enabling this option will show light social sidebar', 'adorn'),
                'parent' => $social_sidebar_networks,
                'options' => adorn_edge_get_yes_no_select_array(false)
            )
        );

		foreach ($networks as $network_key => $network){

			adorn_edge_add_admin_field(array(
				'type' => 'text',
				'name' => 'social_sidebar_'.$network_key,
				'default_value' => esc_url($network['url']),
				'label' => esc_attr($network['title']).' '.esc_html__('Url', 'adorn'),
				'parent' => $social_sidebar_networks
			));

		}

	}
	add_action('adorn_edge_additional_social_options', 'adorn_edge_social_sidebar_options');

}