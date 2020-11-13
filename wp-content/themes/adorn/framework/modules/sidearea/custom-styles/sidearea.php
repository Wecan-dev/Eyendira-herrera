<?php

if (!function_exists('adorn_edge_side_area_slide_from_right_type_style')) {

	function adorn_edge_side_area_slide_from_right_type_style()	{
		$width = adorn_edge_options()->getOptionValue('side_area_width');
		
		if ($width !== '') {
			echo adorn_edge_dynamic_css('.edge-side-menu-slide-from-right .edge-side-menu', array(
				'right' => '-'.adorn_edge_filter_px($width) . 'px',
				'width' => adorn_edge_filter_px($width) . 'px'
			));
		}
	}

	add_action('adorn_edge_style_dynamic', 'adorn_edge_side_area_slide_from_right_type_style');
}

if (!function_exists('adorn_edge_side_area_icon_color_styles')) {

	function adorn_edge_side_area_icon_color_styles() {
		$icon_color             = adorn_edge_options()->getOptionValue('side_area_icon_color');
		$icon_hover_color       = adorn_edge_options()->getOptionValue('side_area_icon_hover_color');
		$close_icon_color       = adorn_edge_options()->getOptionValue('side_area_close_icon_color');
		$close_icon_hover_color = adorn_edge_options()->getOptionValue('side_area_close_icon_hover_color');
		
		$icon_hover_selector    = array(
			'.edge-side-menu-button-opener:hover',
			'.edge-side-menu-button-opener.opened'
		);
		
		if (!empty($icon_color)) {
			echo adorn_edge_dynamic_css('.edge-side-menu-button-opener', array(
				'color' => $icon_color
			));
		}

		if (!empty($icon_hover_color)) {
			echo adorn_edge_dynamic_css($icon_hover_selector, array(
				'color' => $icon_hover_color . '!important'
			));
		}

		if (!empty($close_icon_color)) {
			echo adorn_edge_dynamic_css('.edge-side-menu a.edge-close-side-menu', array(
				'color' => $close_icon_color
			));
		}

		if (!empty($close_icon_hover_color)) {
			echo adorn_edge_dynamic_css('.edge-side-menu a.edge-close-side-menu:hover', array(
				'color' => $close_icon_hover_color
			));
		}
	}

	add_action('adorn_edge_style_dynamic', 'adorn_edge_side_area_icon_color_styles');
}

if (!function_exists('adorn_edge_side_area_styles')) {
	function adorn_edge_side_area_styles() {
		
		$side_area_styles = array();
		$background_color = adorn_edge_options()->getOptionValue('side_area_background_color');
		$padding          = adorn_edge_options()->getOptionValue('side_area_padding');
		$text_alignment   = adorn_edge_options()->getOptionValue('side_area_aligment');

		if (!empty($background_color)) {
			$side_area_styles['background-color'] = $background_color;
		}

		if (!empty($padding)) {
			$side_area_styles['padding'] = esc_attr($padding);
		}
		
		if (!empty($text_alignment)) {
			$side_area_styles['text-align'] = $text_alignment;
		}

		if (!empty($side_area_styles)) {
			echo adorn_edge_dynamic_css('.edge-side-menu', $side_area_styles);
		}
		
		if($text_alignment === 'center') {
			echo adorn_edge_dynamic_css('.edge-side-menu .widget img', array(
				'margin' => '0 auto'
			));
		}
	}

	add_action('adorn_edge_style_dynamic', 'adorn_edge_side_area_styles');
}