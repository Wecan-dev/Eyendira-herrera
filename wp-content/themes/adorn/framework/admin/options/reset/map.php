<?php

if ( ! function_exists('adorn_edge_reset_options_map') ) {
	/**
	 * Reset options panel
	 */
	function adorn_edge_reset_options_map() {

		adorn_edge_add_admin_page(
			array(
				'slug'  => '_reset_page',
				'title' => esc_html__('Reset', 'adorn'),
				'icon'  => 'fa fa-retweet'
			)
		);

		$panel_reset = adorn_edge_add_admin_panel(
			array(
				'page'  => '_reset_page',
				'name'  => 'panel_reset',
				'title' => esc_html__('Reset', 'adorn')
			)
		);

		adorn_edge_add_admin_field(array(
			'type'	=> 'yesno',
			'name'	=> 'reset_to_defaults',
			'default_value'	=> 'no',
			'label'			=> esc_html__('Reset to Defaults', 'adorn'),
			'description'	=> esc_html__('This option will reset all Select Options values to defaults', 'adorn'),
			'parent'		=> $panel_reset
		));
	}

	add_action( 'adorn_edge_options_map', 'adorn_edge_reset_options_map', 100 );
}