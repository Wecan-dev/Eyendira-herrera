<?php

if(!function_exists('edge_core_include_shortcodes_file')) {
	/**
	 * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
	 */
	function edge_core_include_shortcodes_file() {
		foreach(glob(EDGE_CORE_SHORTCODES_PATH.'/*/load.php') as $shortcode_load) {
			include_once $shortcode_load;
		}
		
		do_action('edge_core_action_include_shortcodes_file');
	}
	
	add_action('init', 'edge_core_include_shortcodes_file', 6); // permission 6 is set to be before vc_before_init hook that has permission 9
}

if(!function_exists('edge_core_load_shortcodes')) {
	function edge_core_load_shortcodes() {
		include_once EDGE_CORE_ABS_PATH.'/lib/shortcode-loader.php';
		
		EdgeCore\Lib\ShortcodeLoader::getInstance()->load();
	}
	
	add_action('init', 'edge_core_load_shortcodes', 7); // permission 7 is set to be before vc_before_init hook that has permission 9 and after edge_core_include_shortcodes_file hook
}