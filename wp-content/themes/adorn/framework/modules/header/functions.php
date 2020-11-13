<?php

if(!function_exists('adorn_edge_header_register_main_navigation')) {
    /**
     * Registers main navigation
     */
    function adorn_edge_header_register_main_navigation() {
        register_nav_menus(
            array(
                'main-navigation' => esc_html__('Main Navigation', 'adorn'),
                'vertical-navigation' => esc_html__('Vertical Navigation', 'adorn'),
                'divided-left-navigation' => esc_html__('Divided Left Navigation', 'adorn'),
                'divided-right-navigation' => esc_html__('Divided Right Navigation', 'adorn'),
                'mobile-navigation' => esc_html__('Mobile Navigation', 'adorn')
            )
        );
    }

    add_action('after_setup_theme', 'adorn_edge_header_register_main_navigation');
}

if(!function_exists('adorn_edge_is_top_bar_transparent')) {
    /**
     * Checks if top bar is transparent or not
     *
     * @return bool
     */
    function adorn_edge_is_top_bar_transparent() {
        $top_bar_enabled = adorn_edge_is_top_bar_enabled();

        $top_bar_bg_color = adorn_edge_options()->getOptionValue('top_bar_background_color');
        $top_bar_transparency = adorn_edge_options()->getOptionValue('top_bar_background_transparency');

        if($top_bar_enabled && $top_bar_bg_color !== '' && $top_bar_transparency !== '') {
            return $top_bar_transparency >= 0 && $top_bar_transparency < 1;
        }

        return false;
    }
}

if(!function_exists('adorn_edge_is_top_bar_completely_transparent')) {
    function adorn_edge_is_top_bar_completely_transparent() {
        $top_bar_enabled = adorn_edge_is_top_bar_enabled();

        $top_bar_bg_color = adorn_edge_options()->getOptionValue('top_bar_background_color');
        $top_bar_transparency = adorn_edge_options()->getOptionValue('top_bar_background_transparency');

        if($top_bar_enabled && $top_bar_bg_color !== '' && $top_bar_transparency !== '') {
            return $top_bar_transparency === '0';
        }

        return false;
    }
}

if(!function_exists('adorn_edge_is_top_bar_enabled')) {
    function adorn_edge_is_top_bar_enabled() {
        $top_bar_enabled = adorn_edge_get_meta_field_intersect('top_bar') === 'yes';

        return $top_bar_enabled;
    }
}

if(!function_exists('adorn_edge_get_top_bar_height')) {
    /**
     * Returns top bar height
     *
     * @return bool|int|void
     */
    function adorn_edge_get_top_bar_height() {
        if(adorn_edge_is_top_bar_enabled()) {
            $top_bar_height = adorn_edge_filter_px(adorn_edge_options()->getOptionValue('top_bar_height'));

            return $top_bar_height !== '' ? intval($top_bar_height) : 55;
        }

        return 0;
    }
}

if(!function_exists('adorn_edge_get_top_bar_background_height')) {
	/**
	 * Returns top bar background height
	 *
	 * @return bool|int|void
	 */
	function adorn_edge_get_top_bar_background_height() {

		$top_bar_height = adorn_edge_filter_px(adorn_edge_options()->getOptionValue('top_bar_height'));
		$header_height = adorn_edge_filter_px(adorn_edge_options()->getOptionValue('menu_area_height'));

		if($top_bar_height == ''){
			$top_bar_height = 55;
		}
		if($header_height == ''){
			$header_height = 90;
		}

		$top_bar_background_height = round($top_bar_height) + round($header_height / 2);
		
		return $top_bar_background_height;
	}
}

if(!function_exists('adorn_edge_get_sticky_header_height')) {
    /**
     * Returns top sticky header height
     *
     * @return bool|int|void
     */
    function adorn_edge_get_sticky_header_height() {
        //sticky menu height, needed only for sticky header on scroll up
        if((adorn_edge_get_meta_field_intersect('header_type') === 'header-standard' || adorn_edge_get_meta_field_intersect('header_type') === 'header-divided') && in_array(adorn_edge_options()->getOptionValue('header_behaviour'), array('sticky-header-on-scroll-up'))) {

            $sticky_header_height = adorn_edge_filter_px(adorn_edge_options()->getOptionValue('sticky_header_height'));

            return $sticky_header_height !== '' ? intval($sticky_header_height) : 60;
        }

        return 0;
    }
}

if(!function_exists('adorn_edge_get_sticky_header_height_of_complete_transparency')) {
    /**
     * Returns top sticky header height it is fully transparent. used in anchor logic
     *
     * @return bool|int|void
     */
    function adorn_edge_get_sticky_header_height_of_complete_transparency() {

        if((adorn_edge_get_meta_field_intersect('header_type') === 'header-standard' || adorn_edge_get_meta_field_intersect('header_type') === 'header-divided')) {
            $stickyHeaderTransparent = adorn_edge_options()->getOptionValue('sticky_header_background_color') !== '' && adorn_edge_options()->getOptionValue('sticky_header_transparency') === '0';

            if($stickyHeaderTransparent) {
                return 0;
            } else {
                $sticky_header_height = adorn_edge_filter_px(adorn_edge_options()->getOptionValue('sticky_header_height'));

                return $sticky_header_height !== '' ? intval($sticky_header_height) : 60;
            }
        }

        return 0;
    }
}

if(!function_exists('adorn_edge_get_sticky_scroll_amount')) {
    /**
     * Returns top sticky scroll amount
     *
     * @return bool|int|void
     */
    function adorn_edge_get_sticky_scroll_amount() {

		//sticky menu scroll amount
		if(adorn_edge_options()->getOptionValue('header_type') !== 'header-vertical' &&
			in_array(adorn_edge_get_meta_field_intersect('header_behaviour', adorn_edge_get_page_id()), array(
				'sticky-header-on-scroll-up',
				'sticky-header-on-scroll-down-up'
			))
		) {

			$sticky_scroll_amount = adorn_edge_filter_px(adorn_edge_get_meta_field_intersect('scroll_amount_for_sticky'));

			return $sticky_scroll_amount !== '' ? intval($sticky_scroll_amount) : 0;
		}

        return 0;
    }
}