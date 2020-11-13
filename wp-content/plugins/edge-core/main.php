<?php
/*
Plugin Name: Edge Core
Description: Plugin that adds all post types needed by our theme
Author: Edge Themes
Version: 1.3
*/

require_once 'load.php';

add_action('after_setup_theme', array(EdgeCore\CPT\PostTypesRegister::getInstance(), 'register'));

if(!function_exists('edge_core_activation')) {
    /**
     * Triggers when plugin is activated. It calls flush_rewrite_rules
     * and defines adorn_edge_core_on_activate action
     */
    function edge_core_activation() {
        do_action('adorn_edge_core_on_activate');

        EdgeCore\CPT\PostTypesRegister::getInstance()->register();
        flush_rewrite_rules();
    }

    register_activation_hook(__FILE__, 'edge_core_activation');
}

if(!function_exists('edge_core_text_domain')) {
    /**
     * Loads plugin text domain so it can be used in translation
     */
    function edge_core_text_domain() {
        load_plugin_textdomain('edge-core', false, EDGE_CORE_REL_PATH.'/languages');
    }

    add_action('plugins_loaded', 'edge_core_text_domain');
}

if(!function_exists('edge_core_version_class')) {
	/**
	 * Adds plugins version class to body
	 * @param $classes
	 * @return array
	 */
	function edge_core_version_class($classes) {
		$classes[] = 'edge-core-'.EDGE_CORE_VERSION;
		
		return $classes;
	}
	
	add_filter('body_class', 'edge_core_version_class');
}

if(!function_exists('edge_core_theme_installed')) {
	/**
	 * Checks whether theme is installed or not
	 * @return bool
	 */
	function edge_core_theme_installed() {
		return defined('EDGE_ROOT');
	}
}

if (!function_exists('edge_core_is_woocommerce_installed')) {
	/**
	 * Function that checks if woocommerce is installed
	 * @return bool
	 */
	function edge_core_is_woocommerce_installed() {
		return function_exists('is_woocommerce');
	}
}

if(!function_exists('edge_core_is_revolution_slider_installed')) {
	function edge_core_is_revolution_slider_installed() {
		return class_exists('RevSliderFront');
	}
}

if(!function_exists('edge_core_theme_menu')) {
    /**
     * Function that generates admin menu for options page.
     * It generates one admin page per options page.
     */
    function edge_core_theme_menu() {
        if (edge_core_theme_installed()) {

            global $adorn_Framework;
            adorn_edge_init_theme_options();

            $page_hook_suffix = add_menu_page(
                'Edge Options',      // The value used to populate the browser's title bar when the menu page is active
	            'Edge Options',      // The text of the menu in the administrator's sidebar
                'administrator',                  // What roles are able to access the menu
                'adorn_edge_theme_menu',                // The ID used to bind submenu items to this menu
                array($adorn_Framework->getSkin(), 'renderOptions'), // The callback function used to render this menu
                $adorn_Framework->getSkin()->getMenuIcon('options'),             // Icon For menu Item
                $adorn_Framework->getSkin()->getMenuItemPosition('options')            // Position
            );

            foreach ($adorn_Framework->edgeOptions->adminPages as $key=>$value ) {
                $slug = "";

                if (!empty($value->slug)) {
                    $slug = "_tab".$value->slug;
                }

                $subpage_hook_suffix = add_submenu_page(
                    'adorn_edge_theme_menu',
	                'Edge Options - '.$value->title,                   // The value used to populate the browser's title bar when the menu page is active
                    $value->title,                   // The text of the menu in the administrator's sidebar
                    'administrator',                  // What roles are able to access the menu
                    'adorn_edge_theme_menu'.$slug,                // The ID used to bind submenu items to this menu
                    array($adorn_Framework->getSkin(), 'renderOptions')
                );

                add_action('admin_print_scripts-'.$subpage_hook_suffix, 'adorn_edge_enqueue_admin_scripts');
                add_action('admin_print_styles-'.$subpage_hook_suffix, 'adorn_edge_enqueue_admin_styles');
            };

            add_action('admin_print_scripts-'.$page_hook_suffix, 'adorn_edge_enqueue_admin_scripts');
            add_action('admin_print_styles-'.$page_hook_suffix, 'adorn_edge_enqueue_admin_styles');
        }
    }

    add_action( 'admin_menu', 'edge_core_theme_menu');
}
if(!function_exists('edge_core_themename_theme_menu_backup_options')) {
	/**
	 * Function that generates admin menu for options page.
	 * It generates one admin page per options page.
	 */
	function edge_core_themename_theme_menu_backup_options() {
		if (edge_core_theme_installed()) {
			global $adorn_Framework;
			
			$slug = "_backup_options";
			$page_hook_suffix = add_submenu_page(
				'adorn_edge_theme_menu',
				'Edge Options - Backup Options',                   // The value used to populate the browser's title bar when the menu page is active
				'Backup Options',                   // The text of the menu in the administrator's sidebar
				'administrator',                  // What roles are able to access the menu
				'adorn_edge_theme_menu'.$slug,                // The ID used to bind submenu items to this menu
				array($adorn_Framework->getSkin(), 'renderBackupOptions')
			);
			
			add_action('admin_print_scripts-'.$page_hook_suffix, 'adorn_edge_enqueue_admin_scripts');
			add_action('admin_print_styles-'.$page_hook_suffix, 'adorn_edge_enqueue_admin_styles');
		}
	}

	add_action( 'admin_menu', 'edge_core_themename_theme_menu_backup_options');
}

if(!function_exists('edge_core_theme_setup')) {

    function edge_core_theme_setup() {

        add_filter('widget_text', 'do_shortcode');

    }

    add_action('plugins_loaded', 'edge_core_theme_setup');
}