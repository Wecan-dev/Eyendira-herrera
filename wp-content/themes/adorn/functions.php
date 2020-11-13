<?php
include_once get_template_directory() . '/theme-includes.php';

if (!function_exists('adorn_edge_styles')) {
    /**
     * Function that includes theme's core styles
     */
    function adorn_edge_styles() {

        //include theme's core styles
        wp_enqueue_style('adorn-edge-default-style', EDGE_ROOT . '/style.css');
        wp_enqueue_style('adorn-edge-modules', EDGE_ASSETS_ROOT . '/css/modules.min.css');

        adorn_edge_icon_collections()->enqueueStyles();

        wp_enqueue_style('wp-mediaelement');

        //is woocommerce installed?
        if (adorn_edge_is_woocommerce_installed()) {
            if (adorn_edge_load_woo_assets()) {

                //include theme's woocommerce styles
                wp_enqueue_style('adorn-edge-woo', EDGE_ASSETS_ROOT . '/css/woocommerce.min.css');
            }
        }

        //define files afer which style dynamic needs to be included. It should be included last so it can override other files
        $style_dynamic_deps_array = array();
        if (adorn_edge_load_woo_assets()) {
            $style_dynamic_deps_array = array('adorn-edge-woo', 'adorn-edge-woo-responsive');
        }

        if (file_exists(EDGE_ROOT_DIR . '/assets/css/style_dynamic.css') && adorn_edge_is_css_folder_writable() && !is_multisite()) {
            wp_enqueue_style('adorn-edge-style-dynamic', EDGE_ASSETS_ROOT . '/css/style_dynamic.css', $style_dynamic_deps_array, filemtime(EDGE_ROOT_DIR . '/assets/css/style_dynamic.css')); //it must be included after woocommerce styles so it can override it
        } else if(file_exists(EDGE_ROOT_DIR.'/assets/css/style_dynamic_ms_id_'. adorn_edge_get_multisite_blog_id() .'.css') && adorn_edge_is_css_folder_writable() && is_multisite()) {
	        wp_enqueue_style('adorn-edge-style-dynamic', EDGE_ASSETS_ROOT.'/css/style_dynamic_ms_id_'. adorn_edge_get_multisite_blog_id() .'.css', $style_dynamic_deps_array, filemtime(EDGE_ROOT_DIR.'/assets/css/style_dynamic_ms_id_'. adorn_edge_get_multisite_blog_id() .'.css')); //it must be included after woocommerce styles so it can override it
        }

        //is responsive option turned on?
        if (adorn_edge_is_responsive_on()) {
            wp_enqueue_style('adorn-edge-modules-responsive', EDGE_ASSETS_ROOT . '/css/modules-responsive.min.css');

            //is woocommerce installed?
            if (adorn_edge_is_woocommerce_installed()) {
                if (adorn_edge_load_woo_assets()) {

                    //include theme's woocommerce responsive styles
                    wp_enqueue_style('adorn-edge-woo-responsive', EDGE_ASSETS_ROOT . '/css/woocommerce-responsive.min.css');
                }
            }

            //include proper styles
            if (file_exists(EDGE_ROOT_DIR . '/assets/css/style_dynamic_responsive.css') && adorn_edge_is_css_folder_writable() && !is_multisite()) {
                wp_enqueue_style('adorn-edge-style-dynamic-responsive', EDGE_ASSETS_ROOT . '/css/style_dynamic_responsive.css', array(), filemtime(EDGE_ROOT_DIR . '/assets/css/style_dynamic_responsive.css'));
            } else if(file_exists(EDGE_ROOT_DIR.'/assets/css/style_dynamic_responsive_ms_id_'. adorn_edge_get_multisite_blog_id() .'.css') && adorn_edge_is_css_folder_writable() && is_multisite()) {
	            wp_enqueue_style('adorn-edge-style-dynamic-responsive', EDGE_ASSETS_ROOT.'/css/style_dynamic_responsive_ms_id_'. adorn_edge_get_multisite_blog_id() .'.css', array(), filemtime(EDGE_ROOT_DIR.'/assets/css/style_dynamic_responsive_ms_id_'. adorn_edge_get_multisite_blog_id() .'.css'));
            }
        }
    }

    add_action('wp_enqueue_scripts', 'adorn_edge_styles');
}

if (!function_exists('adorn_edge_google_fonts_styles')) {
    /**
     * Function that includes google fonts defined anywhere in the theme
     */
    function adorn_edge_google_fonts_styles() {
        $font_simple_field_array = adorn_edge_options()->getOptionsByType('fontsimple');
        if (!(is_array($font_simple_field_array) && count($font_simple_field_array) > 0)) {
            $font_simple_field_array = array();
        }

        $font_field_array = adorn_edge_options()->getOptionsByType('font');
        if (!(is_array($font_field_array) && count($font_field_array) > 0)) {
            $font_field_array = array();
        }

        $available_font_options = array_merge($font_simple_field_array, $font_field_array);

        $google_font_weight_array = adorn_edge_options()->getOptionValue('google_font_weight');
        if (!empty($google_font_weight_array)) {
            $google_font_weight_array = array_slice(adorn_edge_options()->getOptionValue('google_font_weight'), 1);
        }

        $font_weight_str = '300,400,500,700,900';
        if (!empty($google_font_weight_array) && $google_font_weight_array !== '') {
            $font_weight_str = implode(',', $google_font_weight_array);
        }

        $google_font_subset_array = adorn_edge_options()->getOptionValue('google_font_subset');
        if (!empty($google_font_subset_array)) {
            $google_font_subset_array = array_slice(adorn_edge_options()->getOptionValue('google_font_subset'), 1);
        }

        $font_subset_str = 'latin-ext';
        if (!empty($google_font_subset_array) && $google_font_subset_array !== '') {
            $font_subset_str = implode(',', $google_font_subset_array);
        }

        //define available font options array
        $fonts_array = array();
        foreach ($available_font_options as $font_option) {
            //is font set and not set to default and not empty?
            $font_option_value = adorn_edge_options()->getOptionValue($font_option);
            if (adorn_edge_is_font_option_valid($font_option_value) && !adorn_edge_is_native_font($font_option_value)) {
                $font_option_string = $font_option_value . ':' . $font_weight_str;
                if (!in_array($font_option_string, $fonts_array)) {
                    $fonts_array[] = $font_option_string;
                }
            }
        }

        $fonts_array = array_diff($fonts_array, array('-1:' . $font_weight_str));
        $google_fonts_string = implode('|', $fonts_array);

        //default fonts
	    $default_font_string = 'Inconsolata:' . $font_weight_str . '|Ubuntu:' . $font_weight_str . '|Playfair Display:' . $font_weight_str;
        $protocol = is_ssl() ? 'https:' : 'http:';

        //is google font option checked anywhere in theme?
        if (count($fonts_array) > 0) {

            //include all checked fonts
            $fonts_full_list = $default_font_string . '|' . str_replace('+', ' ', $google_fonts_string);
            $fonts_full_list_args = array(
                'family' => urlencode($fonts_full_list),
                'subset' => urlencode($font_subset_str),
            );

            $adorn_fonts = add_query_arg($fonts_full_list_args, $protocol . '//fonts.googleapis.com/css');
            wp_enqueue_style('adorn-edge-google-fonts', esc_url_raw($adorn_fonts), array(), '1.0.0');

        } else {
            //include default google font that theme is using
            $default_fonts_args = array(
                'family' => urlencode($default_font_string),
                'subset' => urlencode($font_subset_str),
            );
            $adorn_fonts = add_query_arg($default_fonts_args, $protocol . '//fonts.googleapis.com/css');
            wp_enqueue_style('adorn-edge-google-fonts', esc_url_raw($adorn_fonts), array(), '1.0.0');
        }
    }
    add_action('wp_enqueue_scripts', 'adorn_edge_google_fonts_styles');
}

if (!function_exists('adorn_edge_scripts')) {
    /**
     * Function that includes all necessary scripts
     */
    function adorn_edge_scripts() {
        global $wp_scripts;

        //init theme core scripts
        wp_enqueue_script('jquery-ui-core');
        wp_enqueue_script('jquery-ui-tabs');
        wp_enqueue_script('jquery-ui-accordion');
        wp_enqueue_script('wp-mediaelement');

        // 3rd party JavaScripts that we used in our theme
        wp_enqueue_script('appear', EDGE_ASSETS_ROOT . '/js/modules/plugins/jquery.appear.js', array('jquery'), false, true);
        wp_enqueue_script('modernizr', EDGE_ASSETS_ROOT . '/js/modules/plugins/modernizr.min.js', array('jquery'), false, true);
        wp_enqueue_script('hoverIntent', EDGE_ASSETS_ROOT . '/js/modules/plugins/jquery.hoverIntent.min.js', array('jquery'), false, true);
        wp_enqueue_script('jquery-plugin', EDGE_ASSETS_ROOT . '/js/modules/plugins/jquery.plugin.js', array('jquery'), false, true);
        wp_enqueue_script('countdown', EDGE_ASSETS_ROOT . '/js/modules/plugins/jquery.countdown.min.js', array('jquery'), false, true);
        wp_enqueue_script('owl-carousel', EDGE_ASSETS_ROOT . '/js/modules/plugins/owl.carousel.min.js', array('jquery'), false, true);
        wp_enqueue_script('parallax', EDGE_ASSETS_ROOT . '/js/modules/plugins/parallax.min.js', array('jquery'), false, true);
        wp_enqueue_script('easypiechart', EDGE_ASSETS_ROOT . '/js/modules/plugins/easypiechart.js', array('jquery'), false, true);
        wp_enqueue_script('waypoints', EDGE_ASSETS_ROOT . '/js/modules/plugins/jquery.waypoints.min.js', array('jquery'), false, true);
        wp_enqueue_script('chart', EDGE_ASSETS_ROOT . '/js/modules/plugins/Chart.min.js', array('jquery'), false, true);
        wp_enqueue_script('counter', EDGE_ASSETS_ROOT . '/js/modules/plugins/counter.js', array('jquery'), false, true);
        wp_enqueue_script('absoluteCounter', EDGE_ASSETS_ROOT . '/js/modules/plugins/absoluteCounter.min.js', array('jquery'), false, true);
        wp_enqueue_script('fluidvids', EDGE_ASSETS_ROOT . '/js/modules/plugins/fluidvids.min.js', array('jquery'), false, true);
        wp_enqueue_script('prettyPhoto', EDGE_ASSETS_ROOT . '/js/modules/plugins/jquery.prettyPhoto.js', array('jquery'), false, true);
        wp_enqueue_script('nicescroll', EDGE_ASSETS_ROOT . '/js/modules/plugins/jquery.nicescroll.min.js', array('jquery'), false, true);
        wp_enqueue_script('parallaxScroll', EDGE_ASSETS_ROOT . '/js/modules/plugins/jquery.parallax-scroll.js', array('jquery'), false, true);
        wp_enqueue_script('ScrollToPlugin', EDGE_ASSETS_ROOT . '/js/modules/plugins/ScrollToPlugin.min.js', array('jquery'), false, true);
        wp_enqueue_script('waitforimages', EDGE_ASSETS_ROOT . '/js/modules/plugins/jquery.waitforimages.js', array('jquery'), false, true);
        wp_enqueue_script('jquery-easing-1.3', EDGE_ASSETS_ROOT . '/js/modules/plugins/jquery.easing.1.3.js', array('jquery'), false, true);
        wp_enqueue_script('multiscroll', EDGE_ASSETS_ROOT . '/js/modules/plugins/jquery.multiscroll.min.js', array('jquery'), false, true);
        wp_enqueue_script('isotope', EDGE_ASSETS_ROOT . '/js/modules/plugins/isotope.pkgd.min.js', array('jquery'), false, true);
        wp_enqueue_script('packery', EDGE_ASSETS_ROOT . '/js/modules/plugins/packery-mode.pkgd.min.js', array('jquery'), false, true);
        wp_enqueue_script('fullPage', EDGE_ASSETS_ROOT . '/js/modules/plugins/jquery.fullPage.min.js', array('jquery'), false, true);

        if (adorn_edge_is_woocommerce_installed()) {
            wp_enqueue_script('select2');
        }

        //include google map api script
        $google_maps_api_key = adorn_edge_options()->getOptionValue('google_maps_api_key');
        if (!empty($google_maps_api_key)) {
            wp_enqueue_script('adorn-edge-google-map-api', '//maps.googleapis.com/maps/api/js?key=' . $google_maps_api_key, array(), false, true);
        }

        wp_enqueue_script('adorn-edge-modules', EDGE_ASSETS_ROOT . '/js/modules.min.js', array('jquery'), false, true);

        //include comment reply script
        $wp_scripts->add_data('comment-reply', 'group', 1);
        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
    }

    add_action('wp_enqueue_scripts', 'adorn_edge_scripts');
}

//defined content width variable
if (!isset($content_width)) $content_width = 1300;

if (!function_exists('adorn_edge_theme_setup')) {
    /**
     * Function that adds various features to theme. Also defines image sizes that are used in a theme
     */
    function adorn_edge_theme_setup() {
        //add support for feed links
        add_theme_support('automatic-feed-links');

        //add support for post formats
        add_theme_support('post-formats', array('gallery', 'link', 'quote', 'video', 'audio'));

        //add theme support for post thumbnails
        add_theme_support('post-thumbnails');

        //add theme support for title tag
        add_theme_support('title-tag');

        //define thumbnail sizes
        add_image_size('adorn_square', 550, 550, true);
        add_image_size('adorn_landscape', 1100, 730, true);
        add_image_size('adorn_portrait', 730, 1100, true);
        add_image_size('adorn_huge', 1100, 1100, true);

        load_theme_textdomain('adorn', get_template_directory() . '/languages');
    }

    add_action('after_setup_theme', 'adorn_edge_theme_setup');
}

if ( ! function_exists( 'adorn_edge_enqueue_editor_customizer_styles' ) ) {
	/**
	 * Enqueue supplemental block editor styles
	 */
	function adorn_edge_enqueue_editor_customizer_styles() {
		wp_enqueue_style( 'adorn-style-modules-admin-styles', EDGE_FRAMEWORK_ADMIN_ASSETS_ROOT . '/css/edge-modules-admin.css' );
		wp_enqueue_style( 'adorn-style-handle-editor-customizer-styles', EDGE_FRAMEWORK_ADMIN_ASSETS_ROOT . '/css/editor-customizer-style.css' );
	}

	// add google font
	add_action( 'enqueue_block_editor_assets', 'adorn_edge_google_fonts_styles' );
	// add action
	add_action( 'enqueue_block_editor_assets', 'adorn_edge_enqueue_editor_customizer_styles' );
}

if (!function_exists('adorn_edge_is_responsive_on')) {
    /**
     * Checks whether responsive mode is enabled in theme options
     * @return bool
     */
    function adorn_edge_is_responsive_on() {
        return adorn_edge_options()->getOptionValue('responsiveness') !== 'no';
    }
}

if (!function_exists('adorn_edge_rgba_color')) {
    /**
     * Function that generates rgba part of css color property
     *
     * @param $color string hex color
     * @param $transparency float transparency value between 0 and 1
     *
     * @return string generated rgba string
     */
    function adorn_edge_rgba_color($color, $transparency) {
        if ($color !== '' && $transparency !== '') {
            $rgba_color = '';

            $rgb_color_array = adorn_edge_hex2rgb($color);
            $rgba_color .= 'rgba(' . implode(', ', $rgb_color_array) . ', ' . $transparency . ')';

            return $rgba_color;
        }
    }
}

if (!function_exists('adorn_edge_header_meta')) {
    /**
     * Function that echoes meta data if our seo is enabled
     */
    function adorn_edge_header_meta() { ?>

        <meta charset="<?php bloginfo('charset'); ?>"/>
        <link rel="profile" href="http://gmpg.org/xfn/11"/>
        <?php if (is_singular() && pings_open(get_queried_object())) : ?>
            <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <?php endif; ?>

    <?php }

    add_action('adorn_edge_header_meta', 'adorn_edge_header_meta');
}

if (!function_exists('adorn_edge_user_scalable_meta')) {
    /**
     * Function that outputs user scalable meta if responsiveness is turned on
     * Hooked to adorn_edge_header_meta action
     */
    function adorn_edge_user_scalable_meta() {
        //is responsiveness option is chosen?
        if (adorn_edge_is_responsive_on()) { ?>
            <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=yes">
        <?php } else { ?>
            <meta name="viewport" content="width=1200,user-scalable=yes">
        <?php }
    }

    add_action('adorn_edge_header_meta', 'adorn_edge_user_scalable_meta');
}

if (!function_exists('adorn_edge_smooth_page_transitions')) {
	/**
	 * Function that outputs smooth page transitions html if smooth page transitions functionality is turned on
	 * Hooked to adorn_edge_after_body_tag action
	 */
	function adorn_edge_smooth_page_transitions() {
	    $id = adorn_edge_get_page_id();
		if(adorn_edge_get_meta_field_intersect('smooth_page_transitions',$id) === 'yes' && adorn_edge_get_meta_field_intersect('page_transition_preloader',$id) === 'yes') { ?>
			<div class="edge-smooth-transition-loader edge-mimic-ajax">
				<div class="edge-st-loader">
					<div class="edge-st-loader1">
						<?php adorn_edge_loading_spinners(); ?>
					</div>
				</div>
			</div>
		<?php }
	}
	
	add_action('adorn_edge_after_body_tag', 'adorn_edge_smooth_page_transitions', 10);
}

if (!function_exists('adorn_edge_back_to_top_button')) {
	/**
	 * Function that outputs back to top button html if back to top functionality is turned on
	 * Hooked to adorn_edge_after_header_area action
	 */
	function adorn_edge_back_to_top_button() {
		if (adorn_edge_options()->getOptionValue('show_back_button') == 'yes') { ?>
			<a id='edge-back-to-top' href='#'>
                <span class="edge-back-to-top-text">
                    <?php esc_html_e('Back to top','adorn')?>
                </span>
			</a>
		<?php }
	}
	
	add_action('adorn_edge_after_header_area', 'adorn_edge_back_to_top_button', 10);
}

if (!function_exists('adorn_edge_get_page_id')) {
    /**
     * Function that returns current page / post id.
     * Checks if current page is woocommerce page and returns that id if it is.
     * Checks if current page is any archive page (category, tag, date, author etc.) and returns -1 because that isn't
     * page that is created in WP admin.
     *
     * @return int
     *
     * @version 0.1
     *
     * @see adorn_edge_is_woocommerce_installed()
     * @see adorn_edge_is_woocommerce_shop()
     */
    function adorn_edge_get_page_id() {
        if (adorn_edge_is_woocommerce_installed() && adorn_edge_is_woocommerce_shop()) {
            return adorn_edge_get_woo_shop_page_id();
        }

        if (adorn_edge_is_default_wp_template()) {
            return -1;
        }

        return get_queried_object_id();
    }
}

if (!function_exists('adorn_edge_get_multisite_blog_id')) {
    /**
     * Check is multisite and return blog id
     *
     * @return int
     */
    function adorn_edge_get_multisite_blog_id() {
        if(is_multisite()){
            return get_blog_details()->blog_id;
        }
    }
}

if (!function_exists('adorn_edge_is_default_wp_template')) {
    /**
     * Function that checks if current page archive page, search, 404 or default home blog page
     * @return bool
     *
     * @see is_archive()
     * @see is_search()
     * @see is_404()
     * @see is_front_page()
     * @see is_home()
     */
    function adorn_edge_is_default_wp_template() {
        return is_archive() || is_search() || is_404() || (is_front_page() && is_home());
    }
}

if (!function_exists('adorn_edge_has_shortcode')) {
    /**
     * Function that checks whether shortcode exists on current page / post
     *
     * @param string shortcode to find
     * @param string content to check. If isn't passed current post content will be used
     *
     * @return bool whether content has shortcode or not
     */
    function adorn_edge_has_shortcode($shortcode, $content = '') {
        $has_shortcode = false;

        if ($shortcode) {
            //if content variable isn't past
            if ($content == '') {
                //take content from current post
                $page_id = adorn_edge_get_page_id();
                if (!empty($page_id)) {
                    $current_post = get_post($page_id);

                    if (is_object($current_post) && property_exists($current_post, 'post_content')) {
                        $content = $current_post->post_content;
                    }
                }
            }

            //does content has shortcode added?
            if (stripos($content, '[' . $shortcode) !== false) {
                $has_shortcode = true;
            }
        }

        return $has_shortcode;
    }
}

if (!function_exists('adorn_edge_page_custom_style')) {
    /**
     * Function that print custom page style
     */
    function adorn_edge_page_custom_style() {
        $style = apply_filters('adorn_edge_add_page_custom_style', $style = array());

        if ($style !== '') {
	        if (adorn_edge_is_woocommerce_installed() && adorn_edge_load_woo_assets()) {
		        wp_add_inline_style('adorn-edge-woo', $style);
	        } else {
		        wp_add_inline_style('adorn-edge-modules', $style);
	        }
        }
    }

    add_action('wp_enqueue_scripts', 'adorn_edge_page_custom_style');
}

if (!function_exists('adorn_edge_container_style')) {
    /**
     * Function that return container style
     */
    function adorn_edge_container_style($style) {
        $id = adorn_edge_get_page_id();
        $class_id = adorn_edge_get_page_id();
        if (adorn_edge_is_woocommerce_installed() && is_product()) {
            $class_id = get_the_ID();
        }

        $class_prefix = adorn_edge_get_unique_page_class($class_id);

        $container_selector = array(
            $class_prefix . ' .edge-content .edge-content-inner > .edge-container',
            $class_prefix . ' .edge-content .edge-content-inner > .edge-full-width',
        );

        $container_class = array();
        $page_backgorund_color = get_post_meta($id, "edge_page_background_color_meta", true);

        if ($page_backgorund_color) {
            $container_class['background-color'] = $page_backgorund_color;
        }

        $current_style = adorn_edge_dynamic_css($container_selector, $container_class);
        $current_style = $current_style . $style;

        return $current_style;
    }

    add_filter('adorn_edge_add_page_custom_style', 'adorn_edge_container_style');
}

if (!function_exists('adorn_edge_boxed_style')) {
    /**
     * Function that return container style
     */
    function adorn_edge_boxed_style($style) {

        $id = adorn_edge_get_page_id();

        $class_prefix = adorn_edge_get_unique_page_class($id);

        $container_selector = array(
            $class_prefix . '.edge-boxed .edge-wrapper'
        );

        $container_style = array();

        if (get_post_meta($id, "edge_boxed_meta", true) == 'yes') {
            $page_backgorund_color = get_post_meta($id, "edge_page_background_color_in_box_meta", true);
            $page_backgorund_image = get_post_meta($id, "edge_boxed_background_image_meta", true);
            $page_backgorund_image_pattern = get_post_meta($id, "edge_boxed_pattern_background_image_meta", true);
            $page_backgorund_attachment = get_post_meta($id, "edge_boxed_background_image_attachment_meta", true);

            if ($page_backgorund_color) {
                $container_style['background-color'] = $page_backgorund_color;
            }

            if ($page_backgorund_image_pattern) {
                $container_style['background-image'] = 'url(' . $page_backgorund_image_pattern . ')';
                $container_style['background-position'] = '0px 0px';
                $container_style['background-repeat'] = 'repeat';
            }

            if ($page_backgorund_image) {
                $container_style['background-image'] = 'url(' . $page_backgorund_image . ')';
                $container_style['background-position'] = 'center 0px';
                $container_style['background-repeat'] = 'no-repeat';
            }

            if ($page_backgorund_attachment && $page_backgorund_image != '') {
                $container_style['background-attachment'] = $page_backgorund_attachment;
                if ($page_backgorund_attachment == 'fixed') {
                    $container_style['background-size'] = 'cover';
                } else {
                    $container_style['background-size'] = 'contain';
                }
            }
        }
        
        $current_style = adorn_edge_dynamic_css($container_selector, $container_style);

        $current_style = $current_style . $style;
        
        return $current_style;
    }

    add_filter('adorn_edge_add_page_custom_style', 'adorn_edge_boxed_style');
}

if (!function_exists('adorn_edge_content_padding_top')) {
    /**
     * Function that return padding for content
     */
    function adorn_edge_content_padding_top($style) {
        $id = adorn_edge_get_page_id();
        $class_id = adorn_edge_get_page_id();
        if (adorn_edge_is_woocommerce_installed() && is_product()) {
            $class_id = get_the_ID();
        }

        $class_prefix = adorn_edge_get_unique_page_class($class_id);

        $current_style = '';

        $content_selector = array(
            $class_prefix . ' .edge-content .edge-content-inner > .edge-container > .edge-container-inner',
            $class_prefix . ' .edge-content .edge-content-inner > .edge-full-width > .edge-full-width-inner',
        );

        $content_class = array();

        $page_padding_top = get_post_meta($id, "edge_page_content_top_padding", true);

        if ($page_padding_top !== '') {
            if (get_post_meta($id, "edge_page_content_top_padding_mobile", true) == 'yes') {
                $content_class['padding-top'] = adorn_edge_filter_px($page_padding_top) . 'px !important';
            } else {
                $content_class['padding-top'] = adorn_edge_filter_px($page_padding_top) . 'px';
            }
            $current_style .= adorn_edge_dynamic_css($content_selector, $content_class);
        }

        $current_style = $current_style . $style;

        return $current_style;
    }

    add_filter('adorn_edge_add_page_custom_style', 'adorn_edge_content_padding_top');
}

if (!function_exists('adorn_edge_get_unique_page_class')) {
    /**
     * Returns unique page class based on post type and page id
     *
     * @return string
     */
    function adorn_edge_get_unique_page_class($id) {
        $page_class = '';
	    
	    if ( is_single() ) {
		    $page_class = '.postid-' . $id;
	    } elseif ( is_home() ) {
		    $page_class .= '.home';
	    } elseif ( is_archive() || $id === adorn_edge_get_woo_shop_page_id() ) {
		    $page_class .= '.archive';
	    } elseif ( is_search() ) {
		    $page_class .= '.search';
	    } elseif ( is_404() ) {
		    $page_class .= '.error404';
	    } else {
		    $page_class .= '.page-id-' . $id;
	    }

        return $page_class;
    }
}

if (!function_exists('adorn_edge_print_custom_css')) {
    /**
     * Prints out custom css from theme options
     */
    function adorn_edge_print_custom_css() {
        $custom_css = adorn_edge_options()->getOptionValue('custom_css');

        if (!empty($custom_css)) {
            wp_add_inline_style('adorn-edge-modules', $custom_css);
        }
    }

    add_action('wp_enqueue_scripts', 'adorn_edge_print_custom_css');
}

if (!function_exists('adorn_edge_print_custom_js')) {
    /**
     * Prints out custom css from theme options
     */
    function adorn_edge_print_custom_js() {
        $custom_js = adorn_edge_options()->getOptionValue('custom_js');

        if (!empty($custom_js)) {
            wp_add_inline_script('adorn-edge-modules', $custom_js);
        }
    }

    add_action('wp_enqueue_scripts', 'adorn_edge_print_custom_js');
}

if (!function_exists('adorn_edge_get_global_variables')) {
    /**
     * Function that generates global variables and put them in array so they could be used in the theme
     */
    function adorn_edge_get_global_variables() {
        $global_variables = array();

        $global_variables['edgeAddForAdminBar'] = is_admin_bar_showing() ? 32 : 0;
        $global_variables['edgeElementAppearAmount'] = -100;
        $global_variables['edgeAddingToCartLabel'] = esc_html__('Adding to Cart...', 'adorn');

        $global_variables = apply_filters('adorn_edge_js_global_variables', $global_variables);

        wp_localize_script('adorn-edge-modules', 'edgeGlobalVars', array(
            'vars' => $global_variables
        ));
    }

    add_action('wp_enqueue_scripts', 'adorn_edge_get_global_variables');
}

if (!function_exists('adorn_edge_per_page_js_variables')) {
    /**
     * Outputs global JS variable that holds page settings
     */
    function adorn_edge_per_page_js_variables() {
        $per_page_js_vars = apply_filters('adorn_edge_per_page_js_vars', array());

        wp_localize_script('adorn-edge-modules', 'edgePerPageVars', array(
            'vars' => $per_page_js_vars
        ));
    }

    add_action('wp_enqueue_scripts', 'adorn_edge_per_page_js_variables');
}

if (!function_exists('adorn_edge_content_elem_style_attr')) {
    /**
     * Defines filter for adding custom styles to content HTML element
     */
    function adorn_edge_content_elem_style_attr() {
        $styles = apply_filters('adorn_edge_content_elem_style_attr', array());

        adorn_edge_inline_style($styles);
    }
}

if (!function_exists('adorn_edge_is_woocommerce_installed')) {
    /**
     * Function that checks if woocommerce is installed
     * @return bool
     */
    function adorn_edge_is_woocommerce_installed() {
        return function_exists('is_woocommerce');
    }
}

if (!function_exists('adorn_edge_core_plugin_installed')) {
    //is Edge CPT installed?
    function adorn_edge_core_plugin_installed() {
        return defined('EDGE_CORE_VERSION');
    }
}

if (!function_exists('adorn_edge_visual_composer_installed')) {
    /**
     * Function that checks if visual composer installed
     * @return bool
     */
    function adorn_edge_visual_composer_installed() {
        //is Visual Composer installed?
        if (class_exists('WPBakeryVisualComposerAbstract')) {
            return true;
        }

        return false;
    }
}

if (!function_exists('adorn_edge_contact_form_7_installed')) {
    /**
     * Function that checks if contact form 7 installed
     * @return bool
     */
    function adorn_edge_contact_form_7_installed() {
        //is Contact Form 7 installed?
        if (defined('WPCF7_VERSION')) {
            return true;
        }

        return false;
    }
}

if (!function_exists('adorn_edge_is_wpml_installed')) {
    /**
     * Function that checks if WPML plugin is installed
     * @return bool
     *
     * @version 0.1
     */
    function adorn_edge_is_wpml_installed() {
        return defined('ICL_SITEPRESS_VERSION');
    }
}

if ( ! function_exists( 'adorn_edge_is_plugin_installed' ) ) {
	/**
	 * Function that checks if forward plugin installed
	 *
	 * @param $plugin string
	 *
	 * @return bool
	 */
	function adorn_edge_is_plugin_installed( $plugin ) {
		switch ( $plugin ) {
			case 'core':
				return defined( 'EDGE_CORE_VERSION' );
				break;
			case 'woocommerce':
				return function_exists( 'is_woocommerce' );
				break;
			case 'visual-composer':
				return class_exists( 'WPBakeryVisualComposerAbstract' );
				break;
			case 'revolution-slider':
				return class_exists( 'RevSliderFront' );
				break;
			case 'contact-form-7':
				return defined( 'WPCF7_VERSION' );
				break;
			case 'wpml':
				return defined( 'ICL_SITEPRESS_VERSION' );
				break;
			case 'gutenberg-editor':
				return class_exists( 'WP_Block_Type' );
				break;
			case 'gutenberg-plugin':
				return function_exists( 'is_gutenberg_page' ) && is_gutenberg_page();
				break;
			default:
				return false;
				break;
		}
	}
}

if (!function_exists('adorn_edge_max_image_width_srcset')) {
    /**
     * Set max width for srcset to 1920
     *
     * @return int
     */
    function adorn_edge_max_image_width_srcset() {
        return 1920;
    }

    add_filter('max_srcset_image_width', 'adorn_edge_max_image_width_srcset');
}

if(!function_exists('adorn_edge_attachment_image_additional_fields')) {
	/**
	 *
	 * @param $form_fields array, fields to include in attachment form
	 * @param $post object, attachment record in database
	 *
	 * @return mixed
	 */
	function adorn_edge_attachment_image_additional_fields($form_fields, $post) {
		
		// ADDING IMAGE LINK FILED - START //

		$form_fields['attachment-image-link'] = array(
			'label' => 'Image Link',
			'input' => 'text',
			'application' => 'image',
			'exclusions'  => array( 'audio', 'video' ),
			'value' => get_post_meta($post->ID, 'attachment_image_link', true)
		);

		// ADDING IMAGE LINK FILED - END //

		// ADDING IMAGE TARGET FILED - START //

		$options_image_target = array(
			'_selft'            => esc_html__('Same Window', 'adorn'),
			'_blank'       => esc_html__('New Window', 'adorn'),
		);

		$html_image_target     = '';
		$selected_image_target = get_post_meta($post->ID, 'attachment_image_target', true);

		$html_image_target .= '<select name="attachments['.$post->ID.'][attachment-image-target]" class="attachment-image-target" data-setting="attachment-image-target">';
		// Browse and add the options
		foreach($options_image_target as $key => $value) {
			if($key == $selected_image_target) {
				$html_image_target .= '<option value="'.$key.'" selected>'.$value.'</option>';
			} else {
				$html_image_target .= '<option value="'.$key.'">'.$value.'</option>';
			}
		}

		$html_image_target .= '</select>';

		$form_fields['attachment-image-target'] = array(
			'label' => 'Image Target',
			'input' => 'html',
			'html'  => $html_image_target,
			'application' => 'image',
			'exclusions'  => array( 'audio', 'video' ),
			'value' => get_post_meta($post->ID, 'attachment_image_target', true)
		);

		// ADDING IMAGE TARGET FILED - END //

		return $form_fields;
	}

	add_filter('attachment_fields_to_edit', 'adorn_edge_attachment_image_additional_fields', 10, 2);
}

if(!function_exists('adorn_edge_attachment_image_additional_fields_save')) {
	/**
	 * Save values of Attachment Image sizes in media uploader
	 *
	 * @param $post array, the post data for database
	 * @param $attachment array, attachment fields from $_POST form
	 *
	 * @return mixed
	 */
	function adorn_edge_attachment_image_additional_fields_save($post, $attachment) {

		if(isset($attachment['attachment-image-link'])) {
			update_post_meta($post['ID'], 'attachment_image_link', $attachment['attachment-image-link']);
		}

		if(isset($attachment['attachment-image-target'])) {
			update_post_meta($post['ID'], 'attachment_image_target', $attachment['attachment-image-target']);
		}
		
		return $post;
	}

	add_filter('attachment_fields_to_save', 'adorn_edge_attachment_image_additional_fields_save', 10, 2);
}

// GUTENBERG COMPATIBILITY

if ( ! function_exists( 'adorn_edge_is_gutenberg_installed' ) ) {
    /**
     * Function that checks if Gutenberg plugin installed
     * @return bool
     */
    function adorn_edge_is_gutenberg_installed() {
        return function_exists( 'is_gutenberg_page' ) && is_gutenberg_page();
    }
}

if ( ! function_exists( 'adorn_edge_get_module_part' ) ) {
	function adorn_edge_get_module_part( $module ) {
		return $module;
	}
}
