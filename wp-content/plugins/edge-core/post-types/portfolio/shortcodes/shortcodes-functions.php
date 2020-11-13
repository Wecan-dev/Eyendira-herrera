<?php

if(!function_exists('edge_core_include_portfolio_shortcodes')) {
	function edge_core_include_portfolio_shortcodes() {
		include_once EDGE_CORE_CPT_PATH.'/portfolio/shortcodes/portfolio-list.php';
		include_once EDGE_CORE_CPT_PATH.'/portfolio/shortcodes/portfolio-project-info.php';
		include_once EDGE_CORE_CPT_PATH.'/portfolio/shortcodes/portfolio-slider.php';
	}
	
	add_action('edge_core_action_include_shortcodes_file', 'edge_core_include_portfolio_shortcodes');
}

if(!function_exists('edge_core_add_portfolio_shortcodes')) {
	function edge_core_add_portfolio_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'EdgeCore\CPT\Shortcodes\Portfolio\PortfolioList',
			'EdgeCore\CPT\Shortcodes\Portfolio\PortfolioProjectInfo',
			'EdgeCore\CPT\Shortcodes\Portfolio\PortfolioSlider'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	add_filter('edge_core_filter_add_vc_shortcode', 'edge_core_add_portfolio_shortcodes');
}