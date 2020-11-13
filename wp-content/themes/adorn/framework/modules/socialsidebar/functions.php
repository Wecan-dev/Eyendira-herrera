<?php
if(!function_exists('adorn_edge_get_social_sidebar')){

	function adorn_edge_get_social_sidebar(){

		$show_social_sidebar = adorn_edge_get_meta_field_intersect('enable_social_sidebar') === 'yes' ? true : false;
		$sidebar_classes = array();
		$skin = adorn_edge_get_meta_field_intersect('social_sidebar_light');
		$skin_class = $skin === 'yes' ? 'edge-social-sidebar-light' : '';

        $sidebar_classes[] = $skin_class;

		$parameters = array(
			'networks' => adorn_edge_get_social_sidebar_networks(),
			'icon_params' => array(
				'icon_pack' => 'font_awesome',
				'icon_color'     => '#555',
				'hover_icon_color' => '#000',
				'custom_size' => '13',
				'margin' => '0 6px'
			),
			'classes' => implode(' ',$sidebar_classes ),
			'show_sidebar' => $show_social_sidebar
		);

		adorn_edge_get_module_template_part('templates/social-sidebar', 'socialsidebar', '', $parameters);
	}
	add_action('adorn_edge_after_header_area', 'adorn_edge_get_social_sidebar', 10);

}

if(!function_exists('adorn_edge_get_social_sidebar_networks')){

	function adorn_edge_get_social_sidebar_networks(){

		$helper_array = array('facebook', 'instagram', 'pinterest', 'twitter');
		$networks = array();

		foreach ($helper_array as $network){
			$networks[$network] = array(
				'icon' => 'fa-'.$network,
				'link' => adorn_edge_options()->getOptionValue('social_sidebar_'.$network)
			);
		}

		return $networks;

	}

}