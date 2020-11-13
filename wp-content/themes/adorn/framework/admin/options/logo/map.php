<?php

if ( ! function_exists('adorn_edge_logo_options_map') ) {
	/**
	 * General options page
	 */
	function adorn_edge_logo_options_map() {

		adorn_edge_add_admin_page(
			array(
				'slug'  => '_logo_page',
				'title' => esc_html__('Logo', 'adorn'),
				'icon'  => 'fa fa-institution'
			)
		);

		$panel_logo = adorn_edge_add_admin_panel(
			array(
				'page' => '_logo_page',
				'name' => 'panel_logo',
				'title' => esc_html__('Logo', 'adorn')
			)
		);

		adorn_edge_add_admin_field(
			array(
				'parent' => $panel_logo,
				'type' => 'yesno',
				'name' => 'hide_logo',
				'default_value' => 'no',
				'label' => esc_html__('Hide Logo', 'adorn'),
				'description' => esc_html__('Enabling this option will hide logo image', 'adorn'),
				'args' => array(
					"dependence" => true,
					"dependence_hide_on_yes" => "#edge_hide_logo_container",
					"dependence_show_on_yes" => ""
				)
			)
		);

		$hide_logo_container = adorn_edge_add_admin_container(
			array(
				'parent' => $panel_logo,
				'name' => 'hide_logo_container',
				'hidden_property' => 'hide_logo',
				'hidden_value' => 'yes'
			)
		);

		adorn_edge_add_admin_field(
			array(
				'name' => 'logo_image',
				'type' => 'image',
				'default_value' => EDGE_ASSETS_ROOT."/img/logo.png",
				'label' => esc_html__('Logo Image - Default', 'adorn'),
				'parent' => $hide_logo_container
			)
		);

		adorn_edge_add_admin_field(
			array(
				'name' => 'logo_image_dark',
				'type' => 'image',
				'default_value' => EDGE_ASSETS_ROOT."/img/logo_dark.png",
				'label' => esc_html__('Logo Image - Dark', 'adorn'),
				'parent' => $hide_logo_container
			)
		);

		adorn_edge_add_admin_field(
			array(
				'name' => 'logo_image_light',
				'type' => 'image',
				'default_value' => EDGE_ASSETS_ROOT."/img/logo_white.png",
				'label' => esc_html__('Logo Image - Light', 'adorn'),
				'parent' => $hide_logo_container
			)
		);

		adorn_edge_add_admin_field(
			array(
				'name' => 'logo_image_sticky',
				'type' => 'image',
				'default_value' => EDGE_ASSETS_ROOT."/img/logo.png",
				'label' => esc_html__('Logo Image - Sticky', 'adorn'),
				'parent' => $hide_logo_container
			)
		);

		adorn_edge_add_admin_field(
			array(
				'name' => 'logo_image_mobile',
				'type' => 'image',
				'default_value' => EDGE_ASSETS_ROOT."/img/logo.png",
				'label' => esc_html__('Logo Image - Mobile', 'adorn'),
				'parent' => $hide_logo_container
			)
		);

	}

	add_action( 'adorn_edge_options_map', 'adorn_edge_logo_options_map', 2);
}