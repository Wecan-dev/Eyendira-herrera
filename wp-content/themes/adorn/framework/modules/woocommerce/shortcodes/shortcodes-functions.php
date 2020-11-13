<?php

if(!function_exists('adorn_edge_include_woocommerce_shortcodes')) {
	function adorn_edge_include_woocommerce_shortcodes() {
		foreach(glob(EDGE_FRAMEWORK_MODULES_ROOT_DIR.'/woocommerce/shortcodes/*/load.php') as $shortcode_load) {
			include_once $shortcode_load;
		}

	}
	
	if(adorn_edge_core_plugin_installed()) {
		add_action('edge_core_action_include_shortcodes_file', 'adorn_edge_include_woocommerce_shortcodes');
	}
}

if(!function_exists('adorn_edge_get_formated_slider_number')){

	function adorn_edge_get_formated_slider_number($number){

		$return_value = '';
		if($number < 10){
			$return_value = (int)'0'.$number;
		}
		else{
			$return_value = $number;
		}

		return $return_value;
	}

}