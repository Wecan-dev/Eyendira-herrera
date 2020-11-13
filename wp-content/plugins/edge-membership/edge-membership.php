<?php
/**
 * Plugin Name: Edge Membership
 * Description: Plugin that adds social login and user dashboard page
 * Author: Edge Themes
 * Version: 1.0.1
 */

require_once 'load.php';

if ( ! function_exists( 'edge_membership_text_domain' ) ) {
	/**
	 * Loads plugin text domain so it can be used in translation
	 */
	function edge_membership_text_domain() {
		load_plugin_textdomain( 'edge-membership', false, EDGE_MEMBERSHIP_REL_PATH . '/languages' );
	}

	add_action( 'plugins_loaded', 'edge_membership_text_domain' );
}

if ( ! function_exists( 'edge_membership_scripts' ) ) {
	/**
	 * Loads plugin scripts
	 */
	function edge_membership_scripts() {

		wp_enqueue_style( 'edge-membership-style', plugins_url( EDGE_MEMBERSHIP_REL_PATH . '/assets/css/membership.min.css' ) );
		wp_enqueue_style( 'edge-membership-responsive-style', plugins_url( EDGE_MEMBERSHIP_REL_PATH . '/assets/css/membership-responsive.min.css' ) );

		$array_deps = array(
			'underscore',
			'jquery-ui-tabs'
		);
		if ( edge_membership_theme_installed() ) {
			$array_deps[] = 'adorn-edge-modules';
		}
		wp_enqueue_script( 'edge-membership-script', plugins_url( EDGE_MEMBERSHIP_REL_PATH . '/assets/js/membership.min.js' ), $array_deps, false, true );
	}

	add_action( 'wp_enqueue_scripts', 'edge_membership_scripts' );
}