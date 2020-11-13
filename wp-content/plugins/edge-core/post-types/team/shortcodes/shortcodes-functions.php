<?php

if(!function_exists('edge_core_include_team_shortcodes')) {
	function edge_core_include_team_shortcodes() {
		include_once EDGE_CORE_CPT_PATH.'/team/shortcodes/team-list.php';
		include_once EDGE_CORE_CPT_PATH.'/team/shortcodes/team-member.php';
		include_once EDGE_CORE_CPT_PATH.'/team/shortcodes/team-slider.php';
	}
	
	add_action('edge_core_action_include_shortcodes_file', 'edge_core_include_team_shortcodes');
}

if(!function_exists('edge_core_add_team_shortcodes')) {
	function edge_core_add_team_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'EdgeCore\CPT\Shortcodes\Team\TeamList',
			'EdgeCore\CPT\Shortcodes\Team\TeamMember',
			'EdgeCore\CPT\Shortcodes\Team\TeamSlider'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	add_filter('edge_core_filter_add_vc_shortcode', 'edge_core_add_team_shortcodes');
}