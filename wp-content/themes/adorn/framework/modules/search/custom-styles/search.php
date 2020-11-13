<?php

if (!function_exists('adorn_edge_search_opener_icon_size')) {
	function adorn_edge_search_opener_icon_size() {
		$icon_size = adorn_edge_options()->getOptionValue('header_search_icon_size');
		
		if (!empty($icon_size)) {
			echo adorn_edge_dynamic_css('.edge-search-opener', array(
				'font-size' => adorn_edge_filter_px($icon_size) . 'px'
			));
		}
	}

	add_action('adorn_edge_style_dynamic', 'adorn_edge_search_opener_icon_size');
}

if (!function_exists('adorn_edge_search_opener_icon_colors')) {
	function adorn_edge_search_opener_icon_colors() {
		$icon_color       = adorn_edge_options()->getOptionValue('header_search_icon_color');
		$icon_hover_color = adorn_edge_options()->getOptionValue('header_search_icon_hover_color');
		
		if (!empty($icon_color)) {
			echo adorn_edge_dynamic_css('.edge-search-opener', array(
				'color' => $icon_color
			));
		}

		if (!empty($icon_hover_color)) {
			echo adorn_edge_dynamic_css('.edge-search-opener:hover', array(
				'color' => $icon_hover_color
			));
		}
	}

	add_action('adorn_edge_style_dynamic', 'adorn_edge_search_opener_icon_colors');
}

if (!function_exists('adorn_edge_search_opener_text_styles')) {
	function adorn_edge_search_opener_text_styles() {
		$item_styles = adorn_edge_get_typography_styles('search_icon_text');
		
		$item_selector = array(
			'.edge-search-icon-text'
		);
		
		echo adorn_edge_dynamic_css($item_selector, $item_styles);
		
		$text_hover_color = adorn_edge_options()->getOptionValue('search_icon_text_color_hover');
		
		if (!empty($text_hover_color)) {
			echo adorn_edge_dynamic_css('.edge-search-opener:hover .edge-search-icon-text', array(
				'color' => $text_hover_color
			));
		}
	}

	add_action('adorn_edge_style_dynamic', 'adorn_edge_search_opener_text_styles');
}